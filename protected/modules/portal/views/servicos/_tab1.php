<div class="section">
    <?php echo $form->labelEx($model,'NOME'); ?>
    <div> <?php echo $form->textField($model,'NOME',array('class'=>'large')); ?>
          <?php echo $form->error($model,'NOME'); ?>
    </div>
</div>


<div class="section">
    <?php echo $form->labelEx($model,'ID_ESP'); ?>
    <div> <?php echo $form->dropDownList($model,'ID_ESP',CHtml::listData(Especialidade::model()->findAll(),'ID_ESP','NOME'));?>
    </div>
</div>
