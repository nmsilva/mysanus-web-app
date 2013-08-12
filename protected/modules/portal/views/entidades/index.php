<div class="widget">
    <div class="header">
        <span><span class="ico gray user"></span><?php echo $this->pageTitle;?></span>        
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>t('Adicionar Entidade'),
            'size'=>'small',
            'url'=> $this->createUrl($this->id.'/create'),
        )); ?>
        
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>t('Gerir Tipos Entidade'),
            'size'=>'small',
            'url'=> $this->createUrl('/portal/tiposentidade'),
        )); ?>
    </div>
    <div class="content"> 
                <?php Yii::app()->clientScript->registerScript('search', "
                $('input#q').keyup(function(){
                $.fn.yiiGridView.update('object-grid', {
                    data: $(this).serialize()
                });
                return false;
              });
              ");
              ?>

              <input type="text" id="q" name="Entidade[NOME]" class="search" style="width: 96.8%; "/>

            <?php $this->widget('zii.widgets.grid.CGridView', array(
                    'id'=>'object-grid',
                    'dataProvider'=>$dataProvider,
                    'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl('/portal/'.$this->id.'/update', array('id'=>'')) . "/' + $.fn.yiiGridView.getSelection(id);}",
                    'summaryText'=>t('Mostra').' {start} - {end} '.t('em'). ' {count} '.t('resultados'),
                   // 'filter' => $model,
                    'htmlOptions'=>array(
                        'class'=>'display static  dataTable',
                    ),
                    'pager' => array(
                            'header'=>t('Ir para a Página:'),
                            'nextPageLabel' => t('Seguinte'),
                            'prevPageLabel' => t('Anterior'),
                            'firstPageLabel' => t('Primeiro'),
                            'lastPageLabel' => t('Ultimo'),
                            'pageSize'=> 10
                        ),
                        'columns'=>array(
                                array('name'=>'ID_ENT',
                                        'type'=>'raw',
                                        'htmlOptions'=>array('width'=>'6%'),
                                        'value'=>'$data->ID_ENT',
                                    ),
                                array(
                                        'name'=>'NOME',
                                        'type'=>'raw',
                                        'htmlOptions'=>array('width'=>'63%'),
                                        'value'=>'$data->NOME',
                                    ),  
                                array(
                                        'name'=>'TIPO',
                                        'type'=>'raw',
                                        'htmlOptions'=>array('width'=>'25%'),
                                        'value'=>'$data->TIPO->NOME',
                                    ),         		
                                array(
                                        'class'=>'bootstrap.widgets.TbButtonColumn',
                                        'template' => '{view} {delete}',
                                        'buttons' => array(
                                            'update' => array(
                                                'label'=> t('Ver'),
                                                'options'=>array(
                                                )
                                            ),
                                            'delete' => array(
                                                'label'=> t('Apagar'),
                                                'options'=>array(
                                                )
                                            )
                                        ),
                                        'deleteConfirmation'=>t('Tem a Certeza que deseja eliminar este Item?'),
                                ),
                        ),
                )); ?>
        
        <div class="clear"></div>
    </div><!-- End content -->
</div>