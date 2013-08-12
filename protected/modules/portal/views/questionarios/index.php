<div class="widget">
    <div class="header">
        <span><span class="ico gray user"></span><?php echo $this->pageTitle;?></span>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'label'=>t('Adicionar Questionario'),
            'size'=>'small',
            'url'=> $this->createUrl($this->id.'/create'),
        )); ?>
    </div>
    <div class="content"> 
               
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
                                array('name'=>'ID_QUEST',
                                        'type'=>'raw',
                                        'htmlOptions'=>array('width'=>'6%'),
                                        'value'=>'$data->ID_QUEST',
                                    ),
                                array(
                                        'name'=>'NOME',
                                        'type'=>'raw',
                                        'htmlOptions'=>array('width'=>'63%'),
                                        'value'=>'$data->NOME',
                                    ),  
                                array(
                                        'name'=>'DATA_CRIACAO',
                                        'type'=>'raw',
                                        'htmlOptions'=>array('width'=>'25%'),
                                        'value'=>'$data->DATA_CRIACAO',
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