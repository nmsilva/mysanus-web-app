<?php

class TiposEspecialidadeController extends Controller
{
	public function actionIndex()
	{
		$model =new TipoEspecialidade('search');

                if(isset($_GET['TipoEspecialidade'])) {
                    $model->attributes=$_GET['TipoEspecialidade'];

                } 
                
                $id_user=user()->getId();
                $provider=$model->search($id_user);

                $this->render('index',array(
                    'model'=>$model,
                    'dataProvider'=>$provider,
                ));
	}
        
        public function actionView($id)
        {
            
        }
        
        public function actionDelete($id)
        {
                if(Yii::app()->request->isPostRequest)
		{
                        $especialidades=Especialidade::model()->findAll('ID_TIPO=:id', array('id'=>$id));
                                                
                        if(!$especialidades)
                        {
                            $model=$this->loadModel($id);
                            
                            $model->delete();
                        }
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
                        array('allow',
                            'actions'=>array('index','delete','create', 'update','view'),
                            'expression'=>'($user->rule==="admin")'
                        ),
			array('deny',
                            'users'=>array('*'),
                        ),
		);
	}
        
        public function loadModel($id)
        {
                $model= TipoEspecialidade::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
        }
        
       
}