<?php

class UtentesController extends Controller
{
	public function actionIndex()
	{

                $model =new Utente('search');

                if(isset($_GET['Utente'])) {
                    $model->attributes=$_GET['Utente'];
                } 

                $provider=$model->search();

                $this->render('index',array(
                    'model'=>$model,
                    'dataProvider'=>$provider,
                ));
            
	}
        
        private function loadForm($user,$utente)
        {
                $foto=new FotoUploadForm;
                
                if(isset($_POST['Utilizador']) and isset($_POST['Utente']))
		{
                        $password=$user->PASSWORD;
                        
			$user->attributes=$_POST['Utilizador'];
                        $utente->attributes=$_POST['Utente'];
                        
                        
                        if($user->isNewRecord)
                            $password=Randomness::randomString(5);

                        $user->PASSWORD=$password;
                        $user->CONFIRM_PASSWORD=$user->PASSWORD;
                        $user->TERMOS=1;
                            
                        $valid= $utente->validate();
                        $valid= $user->validate() and $valid;
                        
                        if($valid)
			{
                            if($user->isNewRecord){
                                $user->save();
                                $utente->ID_USER=$user->ID_USER;
                            }
                            
                            $imagem=CUploadedFile::getInstance($foto,'file');
                            if(is_object($imagem))
                            {
                                
                                $rnd=dechex(rand()%999999999);
                                $name=$rnd."_".$user->ID_USER;
                                
                                if(!empty($user->FOTO))
                                    unlink(Helper::getFotoPath()."/".$user->FOTO);
                                
                                $user->FOTO = "{$name}.{$imagem->getExtensionName()}";  // random number + file name
                                
                                $path=Helper::getFotoPath()."/".$user->FOTO;
                                $imagem->saveAs($path);
                                
                                $resize_image = Yii::app()->image->load($path);
                                $resize_image->resize(180, 135);
                                $resize_image->save();

                            }
                            
                            $user->save();
                            $utente->save();
                            
                            if(isset($_POST['end']))
                                $this->redirect(array('/portal/'.$this->id));
                            else
                                Yii::app()->user->setFlash('success', '<strong>'.t('Gravação com Sucesso').'!</strong> '.t(''));

			}
                        else
                            Yii::app()->user->setFlash('error', '<strong>'.t('Erro na Validação').'!</strong> '.t('Existem Erros na validação dos campos inseridos!'));
		}
                
                $this->render('_form',array('user'=>$user,
                                             'utente'=>$utente,
                                             'foto'=>$foto));
        }
        
        public function actionCreate()
        {
                $this->pageTitle=t("Adicionar Novo Utente");
                
                $user=new Utilizador;
                $utente=new Utente;
                
		$this->loadForm($user, $utente);
        }
        
        public function actionUpdate($id)
        {
            $this->pageTitle=t("Editar Utente");
            
            $utente= $this->loadModel($id);
            $user=$this->loadUtilizador($id);
            
            $this->loadForm($user, $utente);
            
        }
        
        public function actionAdmin($id)
        {
            $user=$this->loadUtilizador($id);
            
            if(isset($_POST['Utilizador']))
            {
                        
                $user->attributes=$_POST['Utilizador'];
                $user->TERMOS=1;
                        
                if($user->validate())
                {
                    $user->getHashPassword();
                    $user->save(false);
                    
                }
                else
                    Yii::app()->user->setFlash('error', '<strong>'.t('Erro na Validação').'!</strong> '.t('Existem Erros na validação dos campos inseridos!'));
                
            }
            
            $this->render('_admin',array('user'=>$user));
        }
        
        public function actionView($id)
        {
            $this->actionUpdate($id);
        }
        
        public function actionDelete($id)
        {
                if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$utente= $this->loadModel($id);
                        $user=$this->loadUtilizador($id);
                        
                        $utente->delete();
                        $user->delete();
                        
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }
        
        public function loadModel($id)
        {
                $model=Utente::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
        }
        
        public function loadUtilizador($id)
        {
                $model= Utilizador::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
            
        }
        
        /**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
                        array('allow',
                            'actions'=>array('index','delete','create', 'update','admin'),
                            'expression'=>'($user->rule==="admin")'
                        ),
                        array('allow',
                            'actions'=>array('view'),
                            'expression'=>'($user->rule==="utente") or ($user->rule==="admin")'
                        ),
			array('deny',
                            'users'=>array('*'),
                        ),
		);
	}

}