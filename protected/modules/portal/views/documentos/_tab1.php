<div class="section">
    <?php echo $form->labelEx($model,'IDENTIFICACAO'); ?>
    <div> <?php echo $form->textField($model,'IDENTIFICACAO',array('class'=>'full')); ?>
          <?php echo $form->error($model,'IDENTIFICACAO'); ?>
    </div>
</div>

<div class="section">
    <?php echo $form->labelEx($doc_model,'file'); ?>
    <div> <?php echo $form->fileField($doc_model, 'file'); ?>
    </div>
</div>