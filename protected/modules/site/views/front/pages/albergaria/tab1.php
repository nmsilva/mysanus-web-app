<?php 
$model = ArtigoIdioma::model()->find('OBJETO_ID=:id AND LANG_ID=:lang', array('id'=>'18','lang'=>$this->lang));

if($model==null)
    $this->redirect($this->createUrl('/site/front/error'));

?>

<div class="box-jfontsize">
    <a class="jfontsize-button" id="jfontsize-m" href="#">A-</a>
    <a class="jfontsize-button" id="jfontsize-d" href="#">A</a>
    <a class="jfontsize-button" id="jfontsize-p" href="#">A+</a>
</div>

<div class="text">
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


