<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="pt" xml:lang="pt-PT" xmlns:fb="http://www.facebook.com/2008/fbml">
    <head>

            <!--[if lte IE 8]>
           <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
           <![endif]-->

           <link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl; ?>/css/reset.css"/>
           <link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl; ?>/css/style.css"/>
           <link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl; ?>/css/dashboard.css"/>
           
           <link rel="stylesheet" type="text/css" href="<?php echo $this->module->assetsUrl; ?>/css/zice.style.css"/>
           
           <script type="text/javascript" src="<?php echo $this->module->assetsUrl; ?>/js/jquery.js"></script>
           <script type="text/javascript" src="<?php echo $this->module->assetsUrl; ?>/js/custom.js"></script>
    </head>
    <body>
        <div class="content-iframe">
            <?php echo $content; ?>
            
        </div>
        
        <script language="javascript">
           $(document).ready(function(){
                    //Check to see if the window is top if not then display button
                    $(window).scroll(function(){
                            
                            if ($(this).scrollTop() > 50) {
                                    $('.actions-bar').fadeIn();
                            } else {
                                    $('.actions-bar').fadeOut();
                            }
                    });

            });
        </script>
    </body>
</html>