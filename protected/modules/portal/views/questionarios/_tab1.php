<div class="section">
    <?php echo $form->labelEx($model,'NOME'); ?>
    <div> <?php echo $form->textField($model,'NOME',array('class'=>'large')); ?>
          <?php echo $form->error($model,'NOME'); ?>
    </div>
</div>