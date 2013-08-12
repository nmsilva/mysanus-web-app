<?php

class FornecedoresController extends Controller
{
	public function actionIndex()
	{
                $model =new Fornecedor('search');

                if(isset($_GET['Fornecedor'])) {
                    $model->attributes=$_GET['Fornecedor'];

                } 

                $provider=$model->search();
                $this->render('index',array(
                    'model'=>$model,
                    'dataProvider'=>$provider,
                ));
	}
        
        public function actionCreate()
        {
            $model= new Fornecedor;
            
            $this->loadForm($model);
        }
        
        public function actionUpdate($id)
        {
            $model= $this->loadModel($id);
            
            $this->loadForm($model);
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
			$model= $this->loadModel($id);
                        
                        $model->delete();
                        
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
        }
        
        private function loadForm($model)
        {
                if(isset($_POST['Fornecedor']))
		{
                        
                        $model->attributes=$_POST['Fornecedor'];

                        if($model->validate())
                        {
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
                ));
        }
        
        public function loadModel($id)
        {
                $model= Fornecedor::model()->findByPk($id);
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
                            'actions'=>array('index','delete','create', 'update','view'),
                            'expression'=>'($user->rule==="admin")'
                        ),
			array('deny',
                            'users'=>array('*'),
                        ),
		);
	}
	
}