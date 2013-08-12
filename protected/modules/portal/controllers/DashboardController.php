<?php

class DashboardController extends Controller
{
	public function actionIndex()
	{
                $id_user=user()->getId();
//                $notificacoes= NotificacaoUtilizador::model()->findAll('APAGADA=0 and ID_USER=:user',array('user'=>user()->getId()));
//                $mensagens= MensagemUtilizador::model()->findAll('APAGADA=0 and ID_USER=:user LIMIT 4', array('user'=>user()->getId()));
                
                $notf=new NotificacaoUtilizador('search');
                
                $notificacoes=$notf->search($id_user)->getData();
                
                $msg =new MensagemUtilizador('search');
                $mensagens=$msg->search($id_user)->getData();
                
		$this->render('index',array('notificacoes'=>$notificacoes,
                                            'mensagens'=>$mensagens));
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