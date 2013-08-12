<div class="widget">
    <div class="header">
        <span><span class="ico gray user"></span><?php echo $this->pageTitle;?></span>
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
                    'rowCssClassExpression'=>'($data->VISTA==0)?"new":""',
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
                                        'name'=>'CONTEUDO',
                                        'type'=>'raw',
                                        'htmlOptions'=>array('width'=>'70%'),
                                        'value'=>'$data->NOTIFICACAO->CONTEUDO',
                                    ), 
                                array(
                                        'name'=>'DATA_ENVIO',
                                        'type'=>'raw',
                                        'htmlOptions'=>array('width'=>'25%'),
                                        'value'=>'$data->NOTIFICACAO->DATA_ENVIO',
                                    ),         		
                                array(
                                        'class'=>'bootstrap.widgets.TbButtonColumn',
                                        'template' => ' {delete}',
                                        'buttons' => array(
                                            'delete' => array(
                                                'url'=>'$this->grid->controller->createUrl("/portal/notificacoes/delete",array("id"=>$data->ID_NOTF))',
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
