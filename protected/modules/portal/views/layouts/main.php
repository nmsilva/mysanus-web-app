<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt" xml:lang="pt-PT" xmlns:fb="http://www.facebook.com/2008/fbml">
    <head>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        
        <link rel="shortcut icon" href="<?php echo $this->module->assetsUrl; ?>/images/icon.png">
        
        <!--[if lte IE 8]>
        <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl; ?>/css/reset.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl; ?>/css/style.css"/>
        
         
<!--        <script type="text/javascript" src="<?php echo $this->module->assetsUrl; ?>/js/jquery.js"></script>-->
        <script type="text/javascript" src="<?php echo $this->module->assetsUrl; ?>/js/custom.js"></script>

    </head>
    <body>
            
            <?php   //shortcut
            
//                $translate=Yii::app()->translate;               
//                if($translate->hasMessages()){      
//                  echo $translate->translateLink(t('Traduzir Página'))."|";                  
//                }       
//                echo $translate->editLink(t('Gerir Traduções'))."|";       
//                echo $translate->missingLink(t('Mudar Traduções'));
//
//                echo $translate->dropdown();                                                                                       
            ?>
        
            <!-- begin header-->
            <header>

                <!-- begin wrapper-->
                <section class="wrapper">
                    
                    <div class="logo">
                        <img src="<?php echo $this->module->assetsUrl; ?>/images/logo.png" />
                    </div>
                    <div class="menu">
                        <ul class="top">
                            <?php if(user()->rule=='admin'):?>
                            
                                <li class="s"><a href=""><span class="icos-photos"></span><?php echo t("My Sanus");?></a></li>
                                <li><a href=""><span class="icos-user"></span><?php echo t("Registos");?></a></li>
                                <li><a href=""><span class="icos-user"></span><?php echo t("Serviços");?></a></li>
                                <li><a href=""><span class="icos-user"></span><?php echo t("Outros");?></a></li>
                                
                            <?php elseif(user()->rule=='utente'):?>
                                
                                <li class="s"><a href=""><span class="icos-photos"></span><?php echo t("My Sanus");?></a></li>
                                <li><a href=""><span class="icos-user"></span><?php echo t("Serviços");?></a></li>
                                <li><a href=""><span class="icos-user"></span><?php echo t("Outros");?></a></li>
                                
                            <?php elseif(user()->rule=='medico' or user()->rule=='enfermeiro' or user()->rule=='tecnico'):?>
                                
                                <li class="s"><a href=""><span class="icos-photos"></span><?php echo t("My Sanus");?></a></li>
                                <li><a href=""><span class="icos-user"></span><?php echo t("Agenda");?></a></li>
                                <li><a href=""><span class="icos-user"></span><?php echo t("Outros");?></a></li>
                                                            
                            <?php endif; ?>
                                
                        </ul>
                        <div class="welcome">
                            <?php echo t("Bem Vindo");?>,<br>
                            <b><?php echo user()->name; ?></b>
                        </div>
                        <div class="user">

                            <a href="<?php echo $this->createUrl('home/logout'); ?>" class="btn logout"><span class="icos-logout"></span><label>Sair</label></a>
                            
                            
                            <a href="#" id="mensagens" onclick="openWin({c:'<?php echo $this->createAbsoluteUrl('/portal/mensagens'); ?>',i:'people', r:this},'Mensagens')" rel="tooltip" title="<?php echo t('Tem')." ".$this->module->values['messages']." ".t('Mensagens Novas!');?>" class="btn"><span class="icos-message"></span>
                                <span class="notifications" style="margin-left: 20px;<?php if($this->module->values['messages']==0)echo "display:none;"; ?>"><?php echo $this->module->values['messages']; ?></span>
                            </a>
                            
                            <a href="#" id="notificacoes" onclick="openWin({c:'<?php echo $this->createAbsoluteUrl('/portal/notificacoes'); ?>',i:'people', r:this},'Notificações')" rel="tooltip" title="<?php echo t('Tem')." ".$this->module->values['notifications']." ".t('Notificações Novas!');?>" class="btn"><span class="icos-notificacoes"></span>
                                <span class="notifications" style="margin-left: 20px;<?php if($this->module->values['notifications']==0)echo "display:none;"; ?>"><?php echo $this->module->values['notifications']; ?></span>
                            </a>
                            
                            <script language="javascript">
                            
                                
                                $(document).ready(function() {
                                    $.ajaxSetup({ cache: false }); // This part addresses an IE bug.  without it, IE will only load the first number and will never refresh
                                    
                                    
                                    // Função para refresh das notificações e das mensagens na menu principal
                                    setInterval(function() {
                                        $.ajax({
                                                url: "<?php echo $this->createAbsoluteUrl('/portal/home/refresh'); ?>",
                                                type: "GET",
                                                dataType: "json"
                                          }).done(function(result) { 
           
                                                $("#notificacoes").attr('data-original-title','<?php echo t("Tem "); ?>'+result.notificacoes+'<?php echo t(" Notificações Novas!");?>');
                                                $("#mensagens").attr('data-original-title','<?php echo t("Tem "); ?>'+result.mensagens+'<?php echo t(" Mensagens Novas!");?>');
                                                
                                                if(result.notificacoes>0)
                                                {
                                                    $("#notificacoes span.notifications").html(result.notificacoes);
                                                    $("#notificacoes span.notifications").show();
                                                }
                                                else{
                                                    $("#notificacoes span.notifications").hide();
                                                }

                                                if(result.mensagens>0)
                                                {
                                                    $("#mensagens span.notifications").html(result.mensagens);
                                                    $("#mensagens span.notifications").show();
                                                }
                                                else{
                                                    $("#mensagens span.notifications").hide();
                                                }
    
                                                
                                          });
                                    }, 3000); // the "3000" here refers to the time to refresh the div.  it is in milliseconds. 
                                    
                                    
                                    // Função para verificar tempo de inactividade de Utilizador a cada minuto(ajax request);
                                    setInterval(function() {
                                        $.ajax({
                                                url: "<?php echo $this->createAbsoluteUrl('/portal/home/identidade'); ?>",
                                                type: "GET",
                                                dataType: "json"
                                          }).done(function(result) { 
                                           
                                                if(result==true){
                                                    window.location.refresh();
                                                }

                                          });
                                        
                                    },60000);
                                });
                            </script>
                            
                        </div>
                        <div class="links">
                            
                            <?php if(user()->rule=='admin'):?>
                                <?php get_admin_menu($this); ?>
                            <?php elseif(user()->rule=='utente'):?>
                                <?php get_utentes_menu($this); ?>
                            <?php elseif(user()->rule=='medico'):?>
                                <?php get_medicos_menu($this); ?>
                            <?php elseif(user()->rule=='enfermeiro'):?>
                                <?php get_enfermeiros_menu($this); ?>
                            <?php elseif(user()->rule=='tecnico'):?>
                                <?php get_tecnico_menu($this); ?>
                            <?php endif; ?>
                            
                        </div>
                    </div>
                    
                </section>
                <!-- end wrapper-->

            </header>
            <!-- end header-->
            
            <!-- begin navigation-->
            <nav>
                
                <!-- begin wrapper-->
                <section class="wrapper">

                    <ul>
                        <li class="s home">
                            <a href="#">
                                <strong class="icon icon-home">.</strong>
                                <span><?php echo t("Inicio");?></span>
                            </a>
                        </li>
                    </ul>
                    
                </section>
                <!-- end wrapper-->
                
            </nav>
            <!-- end navigation-->

            <!-- begin main-->
            <section id="content-body">
                                
                <table>
                    <tbody>
                        <tr>
                            <td class="l" style="padding: 0;">&nbsp;</td>
                            <td class="c" >
                                <iframe id="dashboard-iframe" src="<?php echo $this->createUrl('/portal/dashboard'); ?>"></iframe>
                            </td>
                            <td class="r" style="padding: 0;">&nbsp;</td>
                        </tr>
                    </tbody>
                </table>
                
            </section>
            <!-- end main-->

            <!-- begin footer-->
            <footer>
                
                <!-- begin wrapper-->
                <section class="wrapper">
                    
                </section>
                <!-- end wrapper-->
                
            </footer>
            <!-- end footer-->

    </body>
</html>