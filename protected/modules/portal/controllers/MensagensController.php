<?php

class MensagensController extends Controller
{
	public function actionIndex()
	{
                $id_user=user()->getId();
            
		$enviadas =new Mensagem('search');
                if(isset($_GET['Mensagem'])) {
                    $enviadas->attributes=$_GET['Mensagem'];
                } 
                $providerEnviadas=$enviadas->search($id_user);
                
                
                $recebidas =new MensagemUtilizador('search');
                if(isset($_GET['MensagemUtilizador'])) {
                    $recebidas->attributes=$_GET['MensagemUtilizador'];
                } 
                $providerRecebidas=$recebidas->search($id_user);
                
                
                $this->render('index',array(
                    'enviadas'=>$enviadas,
                    'providerEnviadas'=>$providerEnviadas,
                    'recebidas'=>$recebidas,
                    'providerRecebidas'=>$providerRecebidas,
                ));
            
	}
        
        private function loadForm($mensagem,$user="")
        {
                $return=FALSE;
                
                if(!$mensagem->isNewRecord)
                    $mensagem->DESTINATARIOS= Mensagem::getDestinatarios ($mensagem->ID_MSG);
                else{
                    if(!empty($user))
                    {
                        $mensagem->DESTINATARIOS=Utilizador::model()->findByPk($user)->NOME;
                    }
                    $return=TRUE;
                }
                    
                if(isset($_POST['Mensagem']))
                {
                    $id_user=user()->getId();
                    
                    $mensagem->attributes=$_POST['Mensagem'];
                    $mensagem->ID_USER=$id_user;
                    
                    if($mensagem->validate())
                    {
                        
                         if(isset($_POST['send'])){
                             
                             $notificacao=new Notificacao;
                             $notificacao->CONTEUDO=t("Recebeu uma Mensagem Nova de ".$mensagem->REMETENTE->NOME."!");
                             $notificacao->DATA_ENVIO=new CDbExpression('NOW()');
                             $notificacao->save();
                             
                             $mensagem->ENVIADA=1;
                             $mensagem->DATA_ENVIO = new CDbExpression('NOW()');
                             
                         }
                         
                         $mensagem->save();
                        
                         MensagemUtilizador::model()->deleteAll('ID_MSG=:id', array('id'=>$mensagem->ID_MSG));
                         $users = explode(",", $mensagem->DESTINATARIOS);
                        
                         foreach ($users as $user) {
                             
                             $model=new MensagemUtilizador;
                             
                             $model->ID_MSG=$mensagem->ID_MSG;
                             
                             $ID_USER=Utilizador::model()->find('NOME=:nome', array('nome'=>$user))->ID_USER;
                             
                             $model->ID_USER=$ID_USER;
                             $model->VISTA=0;
                             
                             $model->save();
                             
                             if(isset($_POST['send']) && $notificacao){
                                 $not_user=new NotificacaoUtilizador;
                                 
                                 $not_user->ID_USER=$ID_USER;
                                 $not_user->ID_NOTF=$notificacao->ID_NOTF;
                                 
                                 $not_user->save();
                             }
                         
                             unset($model,$not_user);
                         }

                         Yii::app()->user->setFlash('success', '<strong>'.t('Gravação com Sucesso').'!</strong> '.t(''));
                         
                         if($return)
                             $this->redirect(array('/portal/mensagens/update/id/'.$mensagem->ID_MSG));
                    }
                    
                }
                
                $this->render('_form',array(
                    'mensagem'=>$mensagem
                ));
        }
        
        public function actionCreate($user="")
        {
            
            $mensagem=new Mensagem;
            
            $this->loadForm($mensagem,$user);
        }
        
        public function actionUpdate($id)
        {
            $mensagem= $this->loadModel($id);
            
            $this->loadForm($mensagem);
        }
        
        public function actionView($id,$t=0)
        {
            $refresh=FALSE;
            
            if(get_num_new_messages()>0)
                $refresh=TRUE;
            
            $mensagem= $this->loadModel($id);
            
            $msg_utilizador=$this->loadMensagemUtilizador($id);
            if($msg_utilizador->VISTA==0)
            {
                $msg_utilizador->VISTA=1;
                $msg_utilizador->DATA_VISUALI=new CDbExpression('NOW()');
                $msg_utilizador->update();
                
            }
            
            if($t==1){
                $this->render('view',array(
                        'mensagem'=>$mensagem,
                        'refresh'=>$refresh,
                ));
            }
            else{
                $this->render('view2',array(
                        'mensagem'=>$mensagem,
                        'refresh'=>$refresh,
                ));
            }
        }
        
        public function actionDelete($id,$t)
        {  
                
                if($t=="0"){
                    $model= $this->loadModel($id);
                    $tab="#tab2";
                }else{
                    $model= $this->loadMensagemUtilizador($id);
                    $tab="#tab1";
                }

                if($model){
                    $model->APAGADA=1;
                    $model->update();
                }

                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'.$tab));
        }
        
        public function loadModel($id)
        {
                $model=Mensagem::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
        }
        
        public function loadMensagemUtilizador($id)
        {
                $model= MensagemUtilizador::model()->findByPk(array('ID_MSG'=>$id,'ID_USER'=>user()->getId()));
                
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
        }
        
        public function actionUtilizadores()
        {
            $result = array();

            $cursor = Utilizador::model()->findAll();

            if (!empty($cursor))
            {
                foreach ($cursor as $id => $value)
                {
                    $result[] = array('id' => $value->NOME, 'name' => $value->NOME);
                }
            }
            

            header('Content-type: application/json');
            echo CJSON::encode($result);
            Yii::app()->end();
    
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