<?php

class ProfissionaisController extends Controller
{
	public function actionIndex()
	{
		$model =new Profissional('search');

                if(isset($_GET['Profissional'])) {
                    $model->attributes=$_GET['Profissional'];

                } 

                $provider=$model->search();

                $this->render('index',array(
                    'model'=>$model,
                    'dataProvider'=>$provider,
                ));
	}
        
        private function loadForm($user,$pro)
        {
                if(isset($_POST['Utilizador']) and isset($_POST['Profissional']))
		{
                        $password=$user->PASSWORD;
                        
                        $user->attributes=$_POST['Utilizador'];
                        $pro->attributes=$_POST['Profissional'];
                        
                        if($user->isNewRecord)
                            $password=Randomness::randomString(5);

                        $user->PASSWORD=$password;
                        $user->CONFIRM_PASSWORD=$user->PASSWORD;
                        $user->TERMOS=1;
                        
                        $valid= $pro->validate();
                        $valid= $user->validate() and $valid;
                        
                        if($valid)
                        {
                            $user->save();
                            
                            $pro->ID_USER=$user->ID_USER;
                            $pro->save();
                            
                            ProfissionalEspecialidade::model()->deleteAll('ID_USER=:user', array('user'=>$user->ID_USER));
                            
                            foreach ($_POST['ProfissionalEspecialidade'] as $key => $value) {
                                
                                if($value==1)
                                {
                                    $new_model=new ProfissionalEspecialidade;

                                    $new_model->ID_USER=$user->ID_USER;
                                    $new_model->ID_ESP=$key;

                                    $new_model->save();

                                    unset($new_model);
                                }
                            }
                            
                            if(isset($_POST['end']))
                                $this->redirect(array('/portal/'.$this->id));
                            else
                                Yii::app()->user->setFlash('success', '<strong>'.t('Gravação com Sucesso').'!</strong> '.t(''));
                        }
                        else
                            Yii::app()->user->setFlash('error', '<strong>'.t('Erro na Validação').'!</strong> '.t('Existem Erros na validação dos campos inseridos!'));
                }
                
                $ID_TIPO=-1;
                if(!$user->isNewRecord)
                {
                    $list=ProfissionalEspecialidade::model()->findAll('ID_USER=:user', array('user'=>$user->ID_USER));
                    
                    if(count($list)>0)
                        $ID_TIPO=$list[0]->ESPECIALIDADE->ID_TIPO;
                }
                
                $this->render('_form',array(
                    'pro'=>$pro,
                    'user'=>$user,
                    'area'=>$ID_TIPO,
                ));
        }
        
        public function actionCreate()
        {
                $user= new Utilizador;
                $pro= new Profissional;
                
                $this->loadForm($user, $pro);
                
        }
        
        public function actionUpdate($id)
        {
            $pro= $this->loadModel($id);
            $user=$this->loadUtilizador($id);
            
            $this->loadForm($user, $pro);
            
        }
        
        public function actionView($id)
        {
            $this->actionUpdate($id);
        }
        
        public function actionEspecialidades()
        {
            if(isset($_POST['ID_TIPO']) and isset($_POST['ID_USER']))
            {
                if($_POST['ID_USER']!=-1){
                    $model= $this->loadUtilizador($_POST['ID_USER']);
                }
                else{
                    $model=new Utilizador;
                }
                
                $list=Especialidade::model()->findAll('ID_TIPO=:tipo', array('tipo'=>$_POST['ID_TIPO']));
                
                $this->renderPartial('_especialidades', array('list'=>$list,'model'=>$model));
            }
        }
        
        public function loadModel($id)
        {
                $model= Profissional::model()->findByPk($id);
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
                            'actions'=>array('index','delete','create', 'update','view','especialidades'),
                            'expression'=>'($user->rule==="admin")'
                        ),
                        array('allow',
                            'actions'=>array('view','especialidades'),
                            'expression'=>'($user->rule==="medico" or $user->rule==="enfermeiro" or $user->rule==="tecnico")'
                        ),
			array('deny',
                            'users'=>array('*'),
                        ),
		);
	}
}