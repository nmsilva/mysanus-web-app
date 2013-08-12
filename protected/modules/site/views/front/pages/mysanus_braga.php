<div class="destaques">
    <img src="<?php echo $this->module->assetsUrl; ?>/images/mysanus_braga.png" />
</div>

<?php 
$model = CategoriaIdioma::model()->find('ID_CAT=:id AND LANG_ID=:lang', array('id'=>'3','lang'=>$this->lang));

if($model==null)$this->redirectError();

?>

<?php $this->widget('application.modules.site.components.TitleWidget', array(
  'crumbs' => array(
    array('name' => $model->TITULO),
  ),
  'title' => $model->TITULO, 
)); ?>


<?php 
$_tab1=ArtigoIdioma::model()->find('OBJETO_ID=:id AND LANG_ID=:lang', array('id'=>'3','lang'=>$this->lang));
$_tab2=ArtigoIdioma::model()->find('OBJETO_ID=:id AND LANG_ID=:lang', array('id'=>'4','lang'=>$this->lang));
$_tab3=ArtigoIdioma::model()->find('OBJETO_ID=:id AND LANG_ID=:lang', array('id'=>'5','lang'=>$this->lang));
$_tab4=ArtigoIdioma::model()->find('OBJETO_ID=:id AND LANG_ID=:lang', array('id'=>'6','lang'=>$this->lang));
?>

<?php if($_tab1 && $_tab2 && $_tab3 && $_tab4): ?>
    <div class="main-tabs one">
        <?php $this->widget('CTabView',array(
        'activeTab'=>'tab4',
        'tabs'=>array(
            'tab1'=>array(
                'title'=>$_tab1->TITULO,
                'view'=>'pages/braga/tab1'
            ),
            'tab2'=>array(
                'title'=>$_tab2->TITULO,
                'view'=>'pages/braga/tab2'
            ),
            'tab3'=>array(
                'title'=>$_tab3->TITULO,
                'view'=>'pages/braga/tab3'
            ),
            'tab4'=>array(
                'title'=>$_tab4->TITULO,
                'view'=>'pages/braga/tab4'
            )
        ),
        'htmlOptions'=>array(
            'class'=>'tabs-content'
        )
    ));?>
    </div>
<?php endif; ?>


