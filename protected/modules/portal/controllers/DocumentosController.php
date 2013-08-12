<?php

class DocumentosController extends Controller
{
	public function actionIndex()
	{
		$model =new Documento('search');

                if(isset($_GET['Documento'])) {
                    $model->attributes=$_GET['Documento'];

                } 
                $provider=$model->search(user()->getId());
                $this->render('index',array(
                    'model'=>$model,
                    'dataProvider'=>$provider,
                ));
	}
        
        private function saveDoc($doc_model,$model)
        {
            $doc=CUploadedFile::getInstance($doc_model,'file');
                
            if(is_object($doc))
            {
                $relative_path=Documento::model()->getDocumentosPath();

                if(!empty($model->PATH))
                {   
                    $filename="{$relative_path}/{$model->PATH}";

                    if(is_file($filename))
                        unlink($filename);
                }

                $rnd=dechex(rand()%999999999);
                $name=date('Ymdis').$rnd."_";
                $_subfolder = date("mdY");


                $path = "{$relative_path}/{$_subfolder}/"; 
                $name_file="{$name}.{$doc->getExtensionName()}";

                if( !is_dir( $path ) ) {
                    mkdir( $path, 0777, true );
                    chmod ( $path , 0777 );
                }
                $doc->saveAs($path.$name_file);
                chmod( $path.$name_file, 0777 );

                $model->TIPO = $doc->getExtensionName();
                $model->PATH = "{$_subfolder}/{$name_file}"; 

            }
        }
        
        private function loadForm($model)
        {
            $doc_model=new DocUploadForm;
            
            if(isset($_POST['Documento']))
            {
                $model->attributes=$_POST['Documento'];
                
                $model->ID_USER= user()->getId();
                
                $this->saveDoc($doc_model,$model);
                
                if($model->validate()){
                    $model->save();
                    
                    if(isset($_POST['end']))
                        $this->redirect(array('/portal/'.$this->id));
                    else
                        Yii::app()->user->setFlash('success', '<strong>'.t('Gravação com Sucesso').'!</strong> '.t(''));

                }
                else
                    Yii::app()->user->setFlash('error', '<strong>'.t('Erro na Validação').'!</strong> '.t('Existem Erros na validação dos campos inseridos!'));
                
            }
            
            $this->render('_form',array(
                    'model'=>$model,
                    'doc_model'=>$doc_model,
            ));
        }
        
        public function actionCreate()
        {
            $model=new Documento;
            
            $this->loadForm($model);
            
        }
        
        public function actionUpdate($id)
        {
            $model= $this->loadModel($id);
            
            $this->loadForm($model);
            
        }
        
        public function actionView($id)
        {
            
            
        }
        
        public function actionDelete($id)
        {
                if(Yii::app()->request->isPostRequest)
		{
                        
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index'),
				'users'=>array('@'),
			),
		);
	}
        
        public function loadModel($id)
        {
                $model= Documento::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
        }
        
        
}