<?php

class DefinicoesController extends Controller
{
	public function actionIndex()
	{
                $model=new DefinicoesForm();
                $save=FALSE;
                
                if(isset($_POST['DefinicoesForm']))
                {
                    $model->attributes=$_POST['DefinicoesForm'];
                    
                    if($model->validate()){
                        $model->save();
                        
                        $save=TRUE;
                        Yii::app()->user->setFlash('success', '<strong>'.t('Gravação com Sucesso').'!</strong> '.t('A página será actualizada dentro de segundos!'));
                    }
                }
                
                $model->getValuesDefinicoes();
                
		$this->render('index',array('model'=>$model,'save'=>$save));
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