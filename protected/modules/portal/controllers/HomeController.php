<?php

class HomeController extends Controller
{
	public function actionIndex()
	{
		$this->layout="main";
		$this->render('index');
	}

        public function actionRefresh()
        {
            $user_id=user()->getId();
            
            $result['notificacoes']= get_notifications_number($user_id);
            $result['mensagens']= get_messages_number($user_id);
            $result['total']=$result['notificacoes']+$result['mensagens'];
            
            echo json_encode($result);
            
        }
        
        public function actionIdentidade()
        {

            echo json_encode(user()->isGuest);
        }
        
	public function actionLogout() {
                Yii::app()->user->logout(false);
                $this->redirect(Yii::app()->user->loginUrl);
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
}
