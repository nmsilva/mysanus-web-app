<?php

class EntidadesController extends Controller
{
	public function actionIndex()
	{
                $model =new Entidade('search');

                if(isset($_GET['Entidade'])) {
                    $model->attributes=$_GET['Entidade'];

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
                    $model=new TipoEntidade;
                    $model->NOME=$_POST['descricao'];
                    $model->save();

                    echo $model->ID_TIPO;
                }
                else
                    echo "empty";
            }

        }
        
        public function actionCreate()
        {
            $model= new Entidade;
            
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
                if(isset($_POST['Entidade']))
		{
                        
                        $model->attributes=$_POST['Entidade'];

                        if($model->validate())
                        {
                            $model->save();
                            
                            LocalEntidade::model()->deleteAll('ID_ENT=:ent', array('ent'=>$model->ID_ENT));
                            
                            foreach ($_POST['LocalEntidade'] as $key => $value) {
                                
                                if($value==1)
                                {
                                    $local_entidade=new LocalEntidade;

                                    $local_entidade->ID_ENT=$model->ID_ENT;
                                    $local_entidade->ID_LOC=$key;

                                    $local_entidade->save();

                                    unset($local_entidade);
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
                
                $locais= Local::model()->findAll();
                
                $this->render('_form',array(
                    'model'=>$model,
                    'locais'=>$locais,
                ));
        }
        
        public function loadModel($id)
        {
                $model= Entidade::model()->findByPk($id);
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