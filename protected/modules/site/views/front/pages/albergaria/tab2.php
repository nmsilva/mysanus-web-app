<style>
    .tabs-left > .nav-tabs .active > a, .tabs-left > .nav-tabs .active > a:hover {
        background: #F3F4F4;
        border: none;
        width: 220px;
        border: 1px solid #CCC;
        border-right: none;
    }
    .tabs-left > .nav-tabs > li:first-child{
        margin-top: 0;
    }
    .tabs-left > .nav-tabs > li{
        margin-top: 6px;
        margin-bottom: 6px;
    }
    .tabs-left > .nav-tabs > li > a {
        margin-right: -2px;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border: 1px solid #CCC;
        border-radius: 4px;
        background: #F3F4F4;
        width: 200px;
        text-align: right;
        text-transform: uppercase;
        font-weight: bold;
    }
    .tab-content {
        border-radius: 4px;
        border: 1px solid #CCC;
        padding: 15px;
        min-height: 300px;
        background: #F3F4F4;
        overflow: auto;
    }
    .tabs-left > .nav-tabs {
        float: left;
        margin-right: 0;
        border-right: none;
    }
</style> 
<div class="box-jfontsize">
    <a class="jfontsize-button" id="jfontsize-m2" href="#">A-</a>
    <a class="jfontsize-button" id="jfontsize-d2" href="#">A</a>
    <a class="jfontsize-button" id="jfontsize-p2" href="#">A+</a>
</div>

<?php 
$tab1=ArtigoIdioma::model()->find('OBJETO_ID=:id AND LANG_ID=:lang', array('id'=>'19','lang'=>$this->lang));
$tab2=ArtigoIdioma::model()->find('OBJETO_ID=:id AND LANG_ID=:lang', array('id'=>'20','lang'=>$this->lang));
$tab3=ArtigoIdioma::model()->find('OBJETO_ID=:id AND LANG_ID=:lang', array('id'=>'21','lang'=>$this->lang));
$tab4=ArtigoIdioma::model()->find('OBJETO_ID=:id AND LANG_ID=:lang', array('id'=>'22','lang'=>$this->lang));
$tab5=ArtigoIdioma::model()->find('OBJETO_ID=:id AND LANG_ID=:lang', array('id'=>'23','lang'=>$this->lang));
$tab6=ArtigoIdioma::model()->find('OBJETO_ID=:id AND LANG_ID=:lang', array('id'=>'24','lang'=>$this->lang));
?>

<?php if($tab1 && $tab2 && $tab3 && $tab4): ?>
    <?php $this->widget('bootstrap.widgets.TbTabs', array(
        'type'=>'tabs',
        'placement'=>'left', // 'above', 'right', 'below' or 'left'
        'tabs'=>array(
            array('label'=>$tab1->TITULO, 'content'=>$tab1->CONTENT, 'active'=>true),
            array('label'=>$tab2->TITULO, 'content'=>$tab2->CONTENT),
            array('label'=>$tab3->TITULO, 'content'=>$tab3->CONTENT),
            array('label'=>$tab4->TITULO, 'content'=>$tab4->CONTENT),
            array('label'=>$tab5->TITULO, 'content'=>$tab5->CONTENT),
            array('label'=>$tab6->TITULO, 'content'=>$tab6->CONTENT),
        ),
    )); ?>
<?php endif; ?>

<script type="text/javascript" language="javascript">
    $('.tab-content').jfontsize({
        btnMinusClasseId: '#jfontsize-m2',
        btnDefaultClasseId: '#jfontsize-d2',
        btnPlusClasseId: '#jfontsize-p2',
        btnMinusMaxHits: 1,
        btnPlusMaxHits: 3,
        sizeChange: 2
    });
</script>


