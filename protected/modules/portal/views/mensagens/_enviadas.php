<?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'enviadas',
        'dataProvider'=>$dataProvider,
        'selectionChanged'=>"function(id){window.location='" . Yii::app()->urlManager->createUrl('/portal/mensagens/update', array('id'=>'')) . "/' + $.fn.yiiGridView.getSelection(id);}",
        'summaryText'=>t('Mostra').' {start} - {end} '.t('em'). ' {count} '.t('resultados'),
       // 'filter' => $model,
        'htmlOptions'=>array(
            'class'=>'display static  dataTable',
        ),
        'rowCssClassExpression'=>'($data->ENVIADA==0)?"edit":""',
        'pager' => array(
                'header'=>t('Ir para a Página:'),
                'nextPageLabel' => t('Seguinte'),
                'prevPageLabel' => t('Anterior'),
                'firstPageLabel' => t('Primeiro'),
                'lastPageLabel' => t('Ultimo'),
                'pageSize'=> 10
            ),
            'columns'=>array( 
                   array(
                            'name'=>'',
                            'type'=>'html',
                            'htmlOptions'=>array('width'=>'5%'),
                            'value'=>'($data->ENVIADA==1)?"<div class=\"msg_icon ans\" title=\"Mensagem Enviada!\"></div>":"<div class=\"msg_icon create\" title=\"Mensagem por Enviar!\"></div>"',

                        ),
                    array(
                            'name'=>'ASSUNTO',
                            'htmlOptions'=>array('width'=>'40%'),
                            'value'=>'$data->ASSUNTO',
                        ), 
                    array(
                            'name'=>'PARA',
                            'htmlOptions'=>array('width'=>'28%'),
                            'value'=>'Mensagem::model()->getDestinatarios($data->ID_MSG)',
                        ),  
                    array(
                            'name'=>'DATA_ENVIO',
                            'htmlOptions'=>array('width'=>'20%'),
                            'value'=>'$data->DATA_ENVIO',
                        ),         		
                    array(
                            'class'=>'bootstrap.widgets.TbButtonColumn',
                            'template' => '{update} {delete}',
                            'buttons' => array(
                                'update' => array(
                                    'label'=> t('Editar'),
                                    'options'=>array(
                                    )
                                ),
                                'delete' => array(
                                    'url'=>'$this->grid->controller->createUrl("/portal/mensagens/delete",array("id"=>$data->ID_MSG,"t"=>0))',
                                    'label'=> t('Apagar'),
                                    'options'=>array(
                                    )
                                )
                            ),
                            'deleteConfirmation'=>t('Tem a Certeza que deseja eliminar este Item?'),
                    ),
            ),
    )); ?>

