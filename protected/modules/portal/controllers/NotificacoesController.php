<?php

class NotificacoesController extends Controller
{
	public function actionIndex()
	{
		$model =new NotificacaoUtilizador('search');

                if(isset($_GET['NotificacaoUtilizador'])) {
                    $model->attributes=$_GET['NotificacaoUtilizador'];

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
            
            $var=explode(',', $id);
            $id=$var[1];
            //$notificacao=$this->loadModel($id);
            $notf_user= $this->loadNotificacaoUtilizador($id);

            if($notf_user->VISTA==0)
            {
                $notf_user->VISTA=1;
                $notf_user->DATA_VISUALI=new CDbExpression('NOW()');
                $notf_user->update();  

            }
            
            $this->redirect(array('/portal/notificacoes'));
        }
        
        public function actionDelete($id)
        {
                if(Yii::app()->request->isPostRequest)
		{
                        $model= $this->loadNotificacaoUtilizador($id);
                        
                        if($model){
                            $model->APAGADA=1;
                            $model->update();
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('index'),
				'users'=>array('@'),
			),
		);
	}
        
        public function loadModel($id)
        {
                $model= Notificacao::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
        }
        
        public function loadNotificacaoUtilizador($id)
        {
                $model= NotificacaoUtilizador::model()->findByPk(array('ID_NOTF'=>$id,'ID_USER'=>user()->getId()));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
        }
}