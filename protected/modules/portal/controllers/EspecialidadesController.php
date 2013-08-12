<?php

class EspecialidadesController extends Controller
{
	public function actionIndex()
	{
                $model =new Especialidade('search');

                if(isset($_GET['Especialidade'])) {
                    $model->attributes=$_GET['Especialidade'];

                } 

                $provider=$model->search();
                $this->render('index',array(
                    'model'=>$model,
                    'dataProvider'=>$provider,
                ));
	}
        
        public function actionAddTipo()
        {
            if(isset($_POST['descricao']))
            {
                if(!empty($_POST['descricao']))
                {
                    $model=new TipoEspecialidade;
                    $model->DESCRICAO=$_POST['descricao'];
                    $model->save();

                    echo $model->ID_TIPO;
                }
                else
                    echo "empty";
            }

        }
        
        public function actionCreate()
        {
            $model= new Especialidade;
            
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
                if(isset($_POST['Especialidade']))
		{
                        
                        $model->attributes=$_POST['Especialidade'];

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
                $model= Especialidade::model()->findByPk($id);
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
                            'actions'=>array('index','delete','create', 'update','view','addtipo'),
                            'expression'=>'($user->rule==="admin")'
                        ),
			array('deny',
                            'users'=>array('*'),
                        ),
		);
	}
	
}