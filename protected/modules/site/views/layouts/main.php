<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt" xml:lang="pt-PT" xmlns:fb="http://www.facebook.com/2008/fbml">
    <head>        
        <?php Yii::app()->controller->widget('ext.seo.widgets.SeoHead',array(
            'httpEquivs'=>array(
                'Content-Type'=>'text/html; charset=utf-8',
                'Content-Language'=> Yii::app()->language
            ),
        )); ?>
        
        <link rel="shortcut icon" href="<?php echo $this->module->assetsUrl; ?>/images/icon.png">
        
        <meta name="viewport" content="width=device-width" />
            
        <!--[if lte IE 8]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        
        <!--<link rel="stylesheet" id="Google-Font-css" href="http://fonts.googleapis.com/css?family=Droid+Serif%3Asubset%3Dlatin%3An%2Ci%2Cb%2Cbi%7CLato%3Asubset%3Dlatin%3An%2Ci%2Cb%2Cbi%7COpen+Sans%3Asubset%3Dlatin%3An%2Ci%2Cb%2Cbi%7C&amp;ver=3.4.2" type="text/css" media="all">-->
            
        <!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600,700,800" rel="stylesheet" type="text/css">-->
            
        <link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl; ?>/css/reset.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl; ?>/css/style.css"/>
        
        <!--<script type="text/javascript" src="<?php echo $this->module->assetsUrl; ?>/js/jquery.js"></script>-->
        
        <script type="text/javascript" language="javascript" src="<?php echo $this->module->assetsUrl; ?>/js/jquery.jfontsize-1.0.pack.js"></script>
        
        <script type="text/javascript" src="<?php echo $this->module->assetsUrl; ?>/js/custom.js"></script>
        

    </head>
    <body>
        
        <?php if(isset(user()->type) and user()->type == CMS_STATE): ?>
        
            <div id="language-bar" style="text-align: right; padding:5px 10px 5px 0px">
                    <?php   //shortcut
                    $translate=Yii::app()->translate;               
                    if($translate->hasMessages()){      
                      echo $translate->translateLink(t('Traduzir Página'))."|";                  
                    }       
                    echo $translate->editLink(t('Gerir Traduções'))."|";       
                    echo $translate->missingLink(t('Mudar Traduções'));


                    ?>
            </div>
        <?php endif; ?>
        
        <!-- begin top-bar-->
        <section id="top-bar">
            
            <section class="bg-top-bar">
                <!-- begin wrapper-->
                <section class="wrapper">
                    <div class="languages">
                        <?php $this->widget('application.modules.site.components.LanguageMenuWidget'); ?>
                    </div>
<!--                    <div class="portal-title">
                        <img src="<?php echo $this->module->assetsUrl; ?>/images/portal.png"/>
                        <span>Portal MySanus</span>
                    </div>-->

                    <?php if(user()->isGuest ): ?>

                    <div class="portal-login">
                        <a href="<?php echo $this->createUrl('front/user'); ?>" class="box novo-utilizador">
                            <span>Novo Utilizador</span>
                        </a>
                        <a href="#" class="box entrar" data-toggle="modal" data-target="#myModal" >
                            <span>Entrar</span>
                        </a>
                    </div>

                    <?php elseif(user()->type == CMS_STATE):?>

                         <div class="portal-login">
                            <a class="box novo-utilizador">
                                <span><?php echo user()->name; ?></span>
                            </a>
                             <a href="<?php echo Yii::app()->getUrlManager()->createUrl('/cms',array(),'',false); ?>" class="box entrar">
                                <span>CMS</span>
                            </a>
                        </div>

                    <?php elseif(user()->type == PORTAL_STATE): ?>

                     <div class="portal-login">
                        <a class="box novo-utilizador">
                            <span><?php echo user()->email; ?></span>
                        </a>
                        <a href="<?php echo Yii::app()->getUrlManager()->createUrl('/portal',array(),'',false); ?>" class="box entrar">
                            <span>Portal</span>
                        </a>
                    </div>

                    <?php endif; ?>

                </section>
                <!-- end wrapper-->
            </section>
            
        </section>
        <!-- end top-bar-->
        
        <!-- begin header-->
        <header>
            
            <!-- begin wrapper-->
            <section class="wrapper">
                
                <section class="logo">
                    <a href="<?php echo $this->createUrl('/site/front'); ?>"><img src="<?php echo $this->module->assetsUrl; ?>/images/logo.png"/></a>
                </section>
                
                <!-- begin navigation-->
                <nav>
                    <div class="search-box">

                    </div>

                    <?php $this->widget('zii.widgets.CMenu',array(
                            'htmlOptions'=>array('class'=>'menu'),
                            'items'=>Menu::model()->getItems('1',$this->lang)
                    )); ?>

                </nav>
                
                <div id="nav-select" class="combo-menu">
                    <select>
                        <option value="" selected><?php echo t('ir para..');?></option>
                        <option value="home.html">INICIO</option>
                        <option value="quem_somos.html">QUEM SOMOS </option>
                        <option value="#">MYSANUS</option>
                        <option value="mysanus_braga.html"> -BRAGA</option>
                        <option value="mysanus_porto.html"> -PORTO</option>
                        <option value="mysanus_albergaria.html"> -ALBERGARIA</option>
                        <option value="servicos.html">SERVIÇOS</option>
                        <option value="noticias.html">NOTICIAS</option>
                        <option value="contatos.html">CONTATOS</option>
                    </select>
                </div>
                
                <!-- end navigation-->
                
            </section>
            <!-- end wrapper-->
            
        </header>
        <!-- end header-->
            
            
        <!-- begin main-->
        <section id="content-body">
            
            <!-- begin wrapper-->
            <section class="wrapper">
                
                <div class="header-shadow"></div>
                
                <div class="content">
                    
                	<?php echo $content; ?>

                </div>
                
            </section>
            <!-- end wrapper-->
            
        </section>
        <!-- end main-->

        
        <!-- begin footer-->
        <footer>
            
            <!-- begin wrapper-->
            <section class="wrapper">
                <img src="<?php echo $this->module->assetsUrl; ?>/images/icon.png" alt="" class="image-footer"/>
                
                <div class="block-footer">
                    <h4>MySanus</h4>
                    
                    <?php $this->widget('zii.widgets.CMenu',array(
                            'htmlOptions'=>array('class'=>'menu'),
                            'items'=>Menu::model()->getItems('5',$this->lang)
                    )); ?>
                    
                </div>
                <div class="block-footer">
                    <h4><?php echo t('Locais'); ?></h4>
                    
                    <?php $this->widget('zii.widgets.CMenu',array(
                            'htmlOptions'=>array('class'=>'menu'),
                            'items'=>Menu::model()->getItems('6',$this->lang)
                    )); ?>
                    
                </div>
                <div class="block-footer">
                    <h4><?php echo t('Redes Sociais'); ?></h4>
                    
                    <?php $this->widget('zii.widgets.CMenu',array(
                            'htmlOptions'=>array('class'=>'menu'),
                            'items'=>Menu::model()->getItems('7',$this->lang)
                    )); ?>
                    
                </div>
                
            </section>
            <!-- end wrapper-->
            
        </footer>
        <!-- end footer-->
        
        <section id="credits-bar">

            <section class="wrapper">
        		Copyright &copy; <?php echo date('Y'); ?> by My Company.
				All Rights Reserved.
            </section>
            
        </section>

        <div id="login-modal"><?php $this->widget('UserLoginWidget'); ?></div>
        
        
        <?php if(!isset(Yii::app()->request->cookies['show'])): ?>
            <?php $this->beginWidget('bootstrap.widgets.TbModal', 
                            array('id'=>'modal_initial',
                                  'options'=>array(
                                      'show'=>true,
                                  ),
                                  'htmlOptions'=>array('style'=>'width:450px;'))); ?>

                <div class="modal-header">
                    <a class="close" data-dismiss="modal">&times;</a>
                    <h4>Bem Vindo ao Site do MySanus</h4>
                </div>

                <div class="modal-body">
                    <p>Este site encontra-se em <b>Manutenção</b>! <br><br>
                       Pedimos Desculpa por alguma inconveniência.</p>
                </div>

                <div class="modal-footer">
                    <?php $this->widget('bootstrap.widgets.TbButton', array(
                        'label'=>'Fechar',
                        'url'=>'#',
                        'htmlOptions'=>array('data-dismiss'=>'modal'),
                    )); ?>
                </div>

            <?php $this->endWidget(); ?>
        
            <?php Yii::app()->request->cookies['show'] = new CHttpCookie('show', true); ?>
        <?php endif; ?>
        
        
        
    </body>
</html>