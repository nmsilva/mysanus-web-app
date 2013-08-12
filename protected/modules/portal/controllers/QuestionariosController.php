<?php

class QuestionariosController extends Controller
{
	public function actionIndex()
	{
                $model =new Questionario('search');

                if(isset($_GET['Questionario'])) {
                    $model->attributes=$_GET['Questionario'];

                } 

                $provider=$model->search();
                $this->render('index',array(
                    'model'=>$model,
                    'dataProvider'=>$provider,
                ));
	}
 
        public function actionCreate()
        {
            $model= new Questionario;
            
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
        
        private function loadForm($model)
        {
//                print_r($_POST);
                if(isset($_POST['Questionario']))
		{
                        
                        $model->attributes=$_POST['Questionario'];

                        if($model->validate())
                        {
                            $model->save();
                            
                            $this->deletePerguntas($model);
                            
                            if(isset($_POST['Pergunta']))
                            {
                                foreach ($_POST['Pergunta'] as $key_perg => $value_perg) {
                                    $pergunta=new Pergunta;
                                    $pergunta->PERGUNTA=$value_perg;
                                    $pergunta->ID_QUEST=$model->ID_QUEST;
                                    $pergunta->save();
                                    
//                                    print_r($_POST['Resposta']);
                                    
                                    foreach ($_POST['Resposta'][$key_perg] as $key_resp => $value_resp) {
                                        $resp=new Resposta;
                                        $resp->ID_PERG=$pergunta->ID_PERG;
                                        $resp->RESPOSTA=$value_resp;
                                        $resp->save();
                                        
                                        unset($resp);
                                    }
                                    
                                    unset($pergunta);
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
                
                $perguntas=array();
                if(!$model->isNewRecord)
                {
                    $perguntas=Pergunta::model()->findAll('ID_QUEST=:quest', array('quest'=>$model->ID_QUEST));
                }
                
                $this->render('_form',array(
                    'model'=>$model,
                    'perguntas'=>$perguntas,
                ));
        }
        
        private function deletePerguntas($model)
        {
            $perguntas=Pergunta::model()->findAll('ID_QUEST=:quest', array('quest'=>$model->ID_QUEST));
            
            foreach ($perguntas as $pergunta) {
                Resposta::model()->deleteAll('ID_PERG=:perg', array('perg'=>$pergunta->ID_PERG));
                $pergunta->delete();
            }
            
            
        }
        
        public function loadModel($id)
        {
                $model= Questionario::model()->findByPk($id);
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