<?php

class FrontController extends Controller
{
        public $lang;
        
        public function __construct($id, $module = null) {
                parent::__construct($id, $module);
                
                Yii::app()->counter->refresh();
                
                $app = Yii::app();
                if (isset($_GET['lang']))
                {
                    $app->language = $_GET['lang'];
                    $app->session['_lang'] = $app->language;
                    
                    
                    //$this->redirect(Yii::app()->request->getUrlReferrer(true));
                }
                else if (isset($app->session['_lang']))
                {
                    $app->language = $app->session['_lang'];
                }
                else{
                    $app->session['_lang'] = Idioma::model()->findByPk(Opcoes::model()->getDefaultLang())->SHORT;
                    $app->language = $app->session['_lang'];
                }
                
                $this->lang=$this->getAppLanguage();
                
                $this->pageTitle=Opcoes::model()->getSEOProperty('title',Yii::app()->language);
                $this->metaKeywords = Opcoes::model()->getSEOProperty('keywords',Yii::app()->language);
                $this->metaDescription = Opcoes::model()->getSEOProperty('desc',Yii::app()->language);
                $this->addMetaProperty('fb:app_id',Yii::app()->params['fbAppId']);

        }
        
        public function getAppLanguage()
        {
            $result= Idioma::model()->find('SHORT=:short',array('short' => Yii::app()->language));
            return $result->LANG_ID;
        }
        
	public function actions()
	{
               
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'MyCViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{                                   
                $this->redirect($this->createUrl('/site/front/page', array('view'=>Opcoes::model()->getDefaultIndexPage())));
	}
        
        public function actionCategoria()
	{                   
                $categoria=Categoria::model()->getBySlug($_GET['pages']);
                
                $artigo=null;
                if($categoria){
                    $artigo=ArtigoCategoria::model()->find('ID_CAT=:id', array('id'=>$categoria->ID_CAT));
                    $cat_idioma = CategoriaIdioma::model()->find('ID_CAT=:id AND LANG_ID=:lang', array('id'=>$categoria->ID_CAT,'lang'=>$this->lang));
                }
                
                $model=null;
                if($artigo ){
                    $model=ArtigoIdioma::model()->findByPk(array('OBJETO_ID'=>$artigo->OBJETO_ID,'LANG_ID'=> $this->lang));
                }
                else
                    $model=new ArtigoIdioma;
                
                if(!$cat_idioma or $categoria->ESTADO==0)
                    $this->redirectError();
                
                $this->pageTitle = $cat_idioma->TITULO.' | MySanus';
                if($cat_idioma->KEYWORDS!="")
                    $this->metaKeywords = $cat_idioma->KEYWORDS;
                if($cat_idioma->DESCRICAO!="")
                    $this->metaDescription = $cat_idioma->DESCRICAO;
                
		$this->render('categoria',array('model'=>$model,'cat_idioma'=>$cat_idioma));
	}
        
        public function redirectError()
        {
            $this->redirect($this->createUrl('/site/front/error'));
        }
        
        public function actionArtigo($name)
        {
            $artigo= Artigo::model()->find('SLUG=:slug', array('slug'=>$name));
            
            $model=null;
            if($artigo)
                $model= ArtigoIdioma::model()->findByPk (array('OBJETO_ID'=>$artigo->OBJETO_ID,'LANG_ID'=>$this->lang));
            
            if(!$model or $artigo->ESTADO==0)
                $this->redirectError();
            
            $this->pageTitle = $model->TITULO.' | MySanus';
            
            $this->render('artigo',array('model'=>$model,
                                         'artigo'=>$artigo));
        }
        
        public function actionError()
	{                   
		$this->render('error');
	}
        
	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				// send email
				//mail(Yii::app()->params['adminEmail'],$subject,$model->mensage,$headers);

				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
                
                $cat = CategoriaIdioma::model()->find('ID_CAT=:id AND LANG_ID=:lang', array('id'=>'5','lang'=>$this->lang));

                if(!$cat)
                     $this->redirectError();

                $this->pageTitle = $cat->TITULO.' | MySanus';
                $this->metaKeywords = $cat->KEYWORDS;
                $this->metaDescription = $cat->DESCRICAO;
                
		$this->render('contact',array('model'=>$model,'cat'=>$cat));
	}


	public function actionUser()
	{   
                Yii::import("portal.models.acesso.*");
                
		$user=new Utilizador;
                $utente=new Utente;
                         
                //print_r($_POST);
                
		if(isset($_POST['Utilizador']) and isset($_POST['Utente']))
		{
                        
			$user->attributes=$_POST['Utilizador'];
                        $utente->attributes=$_POST['Utente'];
                        
                        $valid= $utente->validate();
                        $valid= $user->validate() and $valid;

                        if($valid)
			{
                            $user->save();
                            
                            $utente->ID_USER=$user->ID_USER;
                            $utente->save();
                            
                            Yii::app()->user->setFlash('success', '<strong>'.t('').'Sucesso!</strong> '.t('O Utilizador foi registado com Sucesso! <br> Verifique o seu Email para validar o Registo.'));
                            
                            $this->refresh();
			}
		}
                
                    
		$this->render('user',array('user'=>$user,
                                           'utente'=>$utente));
	}

	public function actionLogin()
	{                 
                $form=new PortalLoginForm;
                if(isset($_POST['PortalLoginForm']))
                {
                    $form->attributes=$_POST['PortalLoginForm'];
                    if($form->validate() && $form->login()){
                        $result = array('sucess' => true);
                    }
                    else{
                        $result = array('sucess' => false, 
                                        'errors' => $form->errors);
                    }

                    echo json_encode($result);

                }
        

	}
        
        public function behaviors()
        {
            return array(
                'seo'=>array('class'=>'ext.seo.components.SeoControllerBehavior'),
            );
        }


}