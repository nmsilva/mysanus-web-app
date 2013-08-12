<div class="widget">
    <div class="header">
        <span><span class="ico gray user"></span><?php echo $this->pageTitle;?></span>
        
        <?php echo CHtml::link(t('Voltar'),array('/portal/especialidades'),array('name'=>'save','style'=>'float:right;margin-right:10px;','class'=>'btn btn-small')); ?>
    
    </div>
    <div class="content"> 
                        
                <?php $this->widget('zii.widgets.grid.CGridView', array(
                    'id'=>'object-grid',
                    'dataProvider'=>$dataProvider,
                    'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl('/portal/'.$this->id.'/view', array('id'=>'')) . "/' + $.fn.yiiGridView.getSelection(id);}",
                    'summaryText'=>t('Mostra').' {start} - {end} '.t('em'). ' {count} '.t('resultados'),
                   // 'filter' => $model,
                    'htmlOptions'=>array(
                        'class'=>'display static  dataTable',
                    ),
                    'pager' => array(
                            'header'=>t('Ir par a Página:'),
                            'nextPageLabel' => t('Seguinte'),
                            'prevPageLabel' => t('Anterior'),
                            'firstPageLabel' => t('Primeiro'),
                            'lastPageLabel' => t('Ultimo'),
                            'pageSize'=> 10
                        ),
                        'columns'=>array(
                                array(
                                        'name'=>'ID_TIPO',
                                        'type'=>'raw',
                                        'htmlOptions'=>array('width'=>'10%'),
                                        'value'=>'$data->ID_TIPO',
                                    ), 
                                array(
                                        'name'=>'DESCRICAO',
                                        'type'=>'raw',
                                        'htmlOptions'=>array('width'=>'85%'),
                                        'value'=>'$data->DESCRICAO',
                                    ),         		
                                array(
                                        'class'=>'bootstrap.widgets.TbButtonColumn',
                                        'template' => ' {delete}',
                                        'buttons' => array(
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
