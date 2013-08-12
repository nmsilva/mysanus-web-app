
<?php $this->widget('application.modules.site.components.TitleWidget', array(
  'crumbs' => array(
    array('name' => $cat_idioma->TITULO),
  ),
  'title' => $cat_idioma->TITULO, 
)); ?>

<div class="box-jfontsize one" style="width: 98%;">
    <a class="jfontsize-button" id="jfontsize-m" href="#">A-</a>
    <a class="jfontsize-button" id="jfontsize-d" href="#">A</a>
    <a class="jfontsize-button" id="jfontsize-p" href="#">A+</a>
</div>

<div class="main one text">
    <?php echo $model->CONTENT; ?>
</div>

<script type="text/javascript" language="javascript">
    $('.text').jfontsize({
        btnMinusClasseId: '#jfontsize-m',
        btnDefaultClasseId: '#jfontsize-d',
        btnPlusClasseId: '#jfontsize-p',
        btnMinusMaxHits: 1,
        btnPlusMaxHits: 3,
        sizeChange: 2
    });
</script>
