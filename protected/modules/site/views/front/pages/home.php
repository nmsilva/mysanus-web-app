<?php if($galeria=MediaGaleria::model()->getImagensGaleria('1')): ?>

    <div class="slider">
        <?php $this->widget('bootstrap.widgets.TbCarousel', array(
        'items'=>$galeria,
    )); ?>
    
    <!--<img src="<?php echo $this->module->assetsUrl; ?>/images/slide.png" />-->
</div>
<?php endif; ?>

<script type="text/javascript" src="<?php echo $this->module->assetsUrl; ?>/js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?php echo $this->module->assetsUrl; ?>/js/jquery.em.js"></script>
<script type="text/javascript" src="<?php echo $this->module->assetsUrl; ?>/js/jquery.jscrollpane.min.js"></script>

<link rel="stylesheet" type="text/css" media="all" href="<?php echo $this->module->assetsUrl; ?>/css/jScrollPane.css" />

<script language="javascript">
    $(function()
    {
            $('.scroll-pane').jScrollPane();
    });
</script>
        
<div class="main one">

    <div class="destaques-home">
        <div class="destaque-home">
            <div class="d-title">
                <div class="pacientes d-icon"></div>
                <div class="d-name">
                    <span><?php echo t('PARA');?></span><br>
                    <?php echo t('PACIENTES');?>
                </div>
            </div>
            <div class="d-content">
                <ul class="links-pacientes">
                    <li>
                        <a href="<?php echo $this->createUrl('/site/front/user'); ?>">
                            <span><?php echo t('Registe-se no nosso portal');?></span>
                            <img src="<?php echo $this->module->assetsUrl; ?>/images/portal-inicio.png" alt=""/>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $this->createUrl('/site/front/contact'); ?>">
                            <span><?php echo t('pedido de contato');?></span>
                            <img src="<?php echo $this->module->assetsUrl; ?>/images/contacto-inicio.png" alt=""/>
                        </a>
                    </li>
                    <li>
                        <a href="">
                            <span><?php echo t('encontrar médico');?></span>
                            <img src="<?php echo $this->module->assetsUrl; ?>/images/medicos-inicio.png" alt=""/>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="destaque-home bg-destaque center-destaque">
            <div class="d-title">
                <div class="servicos d-icon"></div>
                <div class="d-name">
                    <span>MySanus</span><br>
                    <?php echo t('SERVIÇOS');?>
                </div>
            </div>
            <div class="d-content">
                <ul class="links-servicos">
                    <li>
                        <a href="<?php echo $this->createUrl('/site/front/page',array('view'=>'mysanus_braga')); ?>">
                            <img src="<?php echo $this->module->assetsUrl; ?>/images/braga_destaque.jpg" alt="" />
                            <p>MEDICAL SÈNIOR RESIDENCE</p>
                            <span>BRAGA</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $this->createUrl('/site/front/page',array('view'=>'mysanus_albergaria')); ?>">
                            <img src="<?php echo $this->module->assetsUrl; ?>/images/albergaria_destaque.png" alt="" />
                            <p>Medicina e Reabilitação Integrada DO BAIXO VOUGA</p>
                            <span>Albergaria</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="destaque-home bg-destaque">
            <div class="d-title">
                <div class="noticias d-icon"></div>
                <div class="d-name">
                    <br>
                    <?php echo t('NOTICIAS RECENTES');?>
                </div>
            </div>
            <div class="d-content">
                <div class="scroll-pane">
                    <ul class="links-noticias">
                        
                        <?php $artigos= ArtigoCategoria::model()->findAll('ID_CAT=:id', array('id'=>'6')) ?>
                        
                         <?php foreach ($artigos as $key => $artigo): ?>
            
                            <?php $model = Artigo::model()->findByPk($artigo->OBJETO_ID)?>
                            <?php $model_idioma = ArtigoIdioma::model()->findByPk(array('OBJETO_ID'=>$model->OBJETO_ID,'LANG_ID'=>$this->getAppLanguage())); ?>

                            <?php if($model_idioma && $model->ESTADO==1):?>
                                
                                <li><a href="<?php echo $this->createUrl('/site/front/artigo',array('name'=>$model->SLUG));?>">
                                        <span class="name"><?php echo $model_idioma->TITULO; ?></span>
                                        <span class="date"><?php echo substr($model->DATA_CRIACAO, 0, 10); ?></span>
                                        <span class="ver">ver</span>
                                    </a>
                                </li>
                                
                            <?php endif; ?>
                        <?php endforeach; ?>

                    </ul>
                </div>
            </div>
        </div>
   </div> 

    <div class="destaque-bar">
        <h3>Titulo de Exemplo de Destaque</h3>
        <p>Texto de exemplo de destaque.<br>
            Texto de exemplo de destaque.Texto de exemplo de destaque.Texto de exemplo de destaque.Texto de exemplo de destaque.Texto de exemplo de destaque.Texto de exemplo de destaque.Texto de exemplo de destaque.Texto de exemplo de destaque.
        </p>

        <a href="" class="link-destaque">
            link destaque
        </a>
    </div>

</div>