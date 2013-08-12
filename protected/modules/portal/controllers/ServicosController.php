<?php

class ServicosController extends Controller
{
	public function actionIndex()
	{
                $model =new Servico('search');

                if(isset($_GET['Servico'])) {
                    $model->attributes=$_GET['Servico'];

                } 

                $provider=$model->search();
                $this->render('index',array(
                    'model'=>$model,
                    'dataProvider'=>$provider,
                ));
	}
        
        public function actionNewRow()
        {
            $sucess=FALSE;
            
            if(isset($_POST['EntidadeServico']))
            {
                $model=new EntidadeServico;
                $model->attributes=$_POST['EntidadeServico'];

                $test=EntidadeServico::model()->findByPk(array('ID_ENT'=>$model->ID_ENT,'ID_SERV'=>$model->ID_SERV));
                
                if($model->validate() and (!$test)){
                    $model->save();
                    $sucess=TRUE;
                }
            }
            
            echo json_encode($sucess);
        }
        
        public function actionSaveRow(){
            
            $sucess=FALSE;
            
            if(isset($_POST['ID_SERV']) and isset($_POST['ID_ENT']) and isset($_POST['EntidadeServico']))
            {
                $model=EntidadeServico::model()->findByPk(array('ID_ENT'=>$_POST['ID_ENT'],'ID_SERV'=>$_POST['ID_SERV']));
                
                $model->attributes=$_POST['EntidadeServico'];
                
                if($model->validate()){
                    $model->update();
                    $sucess=TRUE;
                }
            }
            
            echo json_encode($sucess);
        }
        
        public function actionDelRow(){
            $sucess=FALSE;
            
            if(isset($_POST['ID_SERV']) and isset($_POST['ID_ENT']))
            {
                if(EntidadeServico::model()->deleteByPk(array('ID_ENT'=>$_POST['ID_ENT'],'ID_SERV'=>$_POST['ID_SERV'])))
                {
                    $sucess=TRUE;
                }
            }
            
            echo json_encode($sucess);
        }
        
        public function actionEditRow()
        {
            if(isset($_POST['ID_SERV']) and isset($_POST['ID_ENT']))
            {
                $model=EntidadeServico::model()->findByPk(array('ID_ENT'=>$_POST['ID_ENT'],'ID_SERV'=>$_POST['ID_SERV']));
                
                $this->renderPartial('_edit_item',array(
                    'model'=>$model,
                ));
            }
             
        }
        
        public function actionRefreshRows()
        {
            if(isset($_POST['ID_SERV']))
            {
                $entidades=EntidadeServico::model()->findAll('ID_SERV=:serv', array('serv'=>$_POST['ID_SERV']));

                $this->renderPartial('_entidades',array(
                    'entidades'=>$entidades,
                ));
            }
        }
        
        public function actionCreate()
        {
            $model= new Servico;
            
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
                if(isset($_POST['Servico']))
		{
                        
                        $model->attributes=$_POST['Servico'];

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
                
                $entidades=array();
                
                if(!$model->isNewRecord)
                    $entidades=EntidadeServico::model()->findAll('ID_SERV=:serv', array('serv'=>$model->ID_SERV));
                
                $this->render('_form',array(
                    'model'=>$model,
                    'entidades'=>$entidades,
                ));
        }
        
        public function loadModel($id)
        {
                $model= Servico::model()->findByPk($id);
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
                            'actions'=>array('index','delete','create', 'update','view','newrow','delrow','refreshrows','editrow','saverow'),
                            'expression'=>'($user->rule==="admin")'
                        ),
			array('deny',
                            'users'=>array('*'),
                        ),
		);
	}
	
}