<?php $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'recebidas',
    'dataProvider'=>$dataProvider,
    'selectionChanged'=>'function(id){$("#myModal").modal(); showMessage($.fn.yiiGridView.getSelection(id));}',
    'summaryText'=>t('Mostra').' {start} - {end} '.t('em'). ' {count} '.t('resultados'),
   // 'filter' => $model,
    'htmlOptions'=>array(
        'class'=>'display dataTable',
    ),
    'rowCssClassExpression'=>'($data->VISTA==0)?"new":""',
    'pager' => array(
            'header'=>false,
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
                            'value'=>'($data->VISTA==1)?"<div class=\"msg_icon open\"></div>":"<div class=\"msg_icon new\"></div>"',

                        ),
                array(
                        'name'=>'ASSUNTO',
                        'type'=>'raw',
                        'htmlOptions'=>array('width'=>'45%'),
                        'value'=>'$data->MENSAGEM->ASSUNTO',
                    ), 
                array(
                        'name'=>'DE',
                        'type'=>'raw',
                        'htmlOptions'=>array('width'=>'25%'),
                        'value'=>'$data->MENSAGEM->REMETENTE->NOME',
                    ),  
                array(
                        'name'=>'DATA_ENVIO',
                        'type'=>'raw',
                        'htmlOptions'=>array('width'=>'25%'),
                        'value'=>'$data->MENSAGEM->DATA_ENVIO',
                    ),         		
                array(
                        'class'=>'bootstrap.widgets.TbButtonColumn',
                        'template' => '{delete}',
                        'buttons' => array(
                            'delete' => array(
                                'url'=>'$this->grid->controller->createUrl("/portal/mensagens/delete",array("id"=>$data->ID_MSG,"t"=>1))',
                                'label'=> t('Apagar'),
                                'options'=>array(
                                )
                            )
                        ),
                        'deleteConfirmation'=>t('Tem a Certeza que deseja eliminar este Item?'),
                ),
        ),
)); ?>


<?php $cs = Yii::app()->getClientScript();  
        $cs->registerScript(
          'my-hello-world-1',
          'function showMessage(id){
              var str=id.toString();
              var n=str.split(",");
              var id= n[0];
              $("#result").load("'.$this->createUrl('/portal/mensagens/view/id/').'/"+id+"/t/1");
              }',
          CClientScript::POS_END
        ); ?>

<?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'myModal')); ?>
 
    <div id="result">

    </div>
    
<?php $this->endWidget(); ?>
