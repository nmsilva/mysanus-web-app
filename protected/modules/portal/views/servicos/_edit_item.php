<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
)); ?>

<tr class="templateContent">
    <td><?php echo Entidade::model()->findByPk($model->ID_ENT)->NOME; ?></td>
    <td>
        <?php echo $form->textField($model,'VALOR',array('style'=>'width:100px')); ?>
    </td>
    <td>
        <?php echo $form->textField($model,'COD_SERVICO',array('style'=>'width:100px')); ?>
    </td>
    <td>
        <?php echo $form->textField($model,'DESIG_SERVICO',array('style'=>'width:100px')); ?>
    </td>
    <td>
        <?php echo $form->textField($model,'TAXA',array('style'=>'width:100px')); ?>
    </td>
    <td>
        <?php echo $form->textField($model,'TAXA_URGENT',array('style'=>'width:100px')); ?>
    </td>
    <td>
        <?php echo CHtml::button('S', array('class'=>'btn btn-small btn-success','onclick'=>'saveItem('.$model->ID_ENT.','.$model->ID_SERV.');')); ?>
        <?php echo CHtml::button('C', array('class'=>'btn btn-small btn-danger','onclick'=>'refreshItems();')); ?>
    </td>
</tr>

<?php $this->endWidget(); ?>