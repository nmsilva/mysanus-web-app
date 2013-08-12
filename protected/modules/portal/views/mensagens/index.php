<div class="widget">
    <div class="header">
        <span><span class="ico gray user"></span><?php echo $this->pageTitle;?></span>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>t('Nova Mensagem'),
            'size'=>'small',
            'url'=> $this->createUrl($this->id.'/create'),
        )); ?>
    </div>
    <div class="content"> 
        
        <?php $this->widget('CTabView',array(
                'activeTab'=>(isset($_POST['active-tab'])? substr($_POST['active-tab'],1):'tab1'),
                'id'=>'message-tab',
                'tabs'=>array(
                    'tab1'=>array(
                        'title'=>t('Caixa de Entrada'),
                        'view'=>'_recebidas',
                        'data'=>array(
                                'model'=>$recebidas,
                                'dataProvider'=>$providerRecebidas,
                            ),
                    ),
                    'tab2'=>array(
                        'title'=>t('Caixa de Saída'),
                        'view'=>'_enviadas',
                        'data'=>array(
                                'model'=>$enviadas,
                                'dataProvider'=>$providerEnviadas,
                            ),
                    ),
                ),
                'htmlOptions'=>array(
                    'class'=>'form-tabs'
                )
            ));?>
        
        <div class="clear"></div>
    </div><!-- End content -->
</div>
