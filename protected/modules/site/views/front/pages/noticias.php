<?php 
$model = CategoriaIdioma::model()->find('ID_CAT=:id AND LANG_ID=:lang', array('id'=>'6','lang'=>$this->getAppLanguage()));

if($model==null)
    $this->redirect($this->createUrl('/site/front/error'));

?>

<?php $this->widget('application.modules.site.components.TitleWidget', array(
  'crumbs' => array(
    array('name' => $model->TITULO),
  ),
  'title' => $model->TITULO, 
)); ?>

<?php $artigos= ArtigoCategoria::model()->findAll('ID_CAT=:id', array('id'=>'6')) ?>

<div class="main two text">
    <div class="blog-item-holder">
        
        <?php foreach ($artigos as $key => $artigo): ?>
            
            <?php $model = Artigo::model()->findByPk($artigo->OBJETO_ID)?>
            <?php $model_idioma = ArtigoIdioma::model()->findByPk(array('OBJETO_ID'=>$model->OBJETO_ID,'LANG_ID'=>$this->getAppLanguage())); ?>
            
            <?php if($model_idioma && $model->ESTADO==1):?>
        
                <div class="gdl-blog-full">
                    <div class="blog-content-wrapper">
                        <h3 class="blog-title">
                            <a href="<?php echo $this->createUrl('/site/front/artigo',array('name'=>$model->SLUG));?>"><?php echo $model_idioma->TITULO; ?></a>
                        </h3>
                        <div class="blog-info-wrapper">
                            <div class="blog-date-wrapper">
                                <a href="<?php echo $this->createUrl('/site/front/page/view/noticias/',array('d'=>substr($model->DATA_CRIACAO, 0, 7))); ?>">
                                    <?php echo $model->DATA_CRIACAO; ?>
                                </a>
                            </div>
    <!--                        <div class="blog-author">
                                <a href="http://themes.goodlayers.com/medicalplus/author/admin/" title="Posts by admin" rel="author">admin</a>
                            </div>-->
    <!--                        <div class="blog-comment">
                                <a href="http://themes.goodlayers.com/medicalplus/this-is-just-a-single-clean-post/#comments" title="Comment on This is Just a Single Clean Post">1</a>
                            </div>-->
                            <div class="blog-tag">
                                <a href="<?php echo $this->createUrl('/site/front/page/view/noticias/',array('tag'=>'people')); ?>" rel="tag">people</a>
                            </div>
                            <div class="clear">

                            </div>

                        </div>
                        <?php if($model->IMAGEM): ?>
                            <div class="blog-media-wrapper gdl-image">
                                <a href="<?php echo $this->createUrl('/site/front/artigo',array('name'=>$model->SLUG));?>">
                                    <img src="<?php echo Media::model()->getPublicUrl()."/".$model->IMAGEM->PATH; ?>" alt="">
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="blog-content">
                            <?php echo Helper::the_excerpt($model_idioma->CONTENT); ?>
                            <div class="clear"></div>
                            <a class="blog-continue-reading" href="<?php echo $this->createUrl('/site/front/artigo',array('name'=>$model->SLUG));?>"> LER MAIS</a>
                        </div>
                    </div>
                </div>
        
            <?php endif; ?>
        <?php endforeach; ?>
                
    </div>

</div>
<div class="side">
      
</div>
