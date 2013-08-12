
<div class="section">
    <?php echo $form->labelEx($user,'CIDADE'); ?>
    <div> <?php echo $form->textField($user,'CIDADE',array('class'=>'medium')); ?>
          <?php echo $form->error($user,'CIDADE'); ?>
    </div>
</div>

<div class="section">
    <?php echo $form->labelEx($user,'LOCALIDADE'); ?>
    <div> <?php echo $form->textField($user,'LOCALIDADE',array('class'=>'medium')); ?>
          <?php echo $form->error($user,'LOCALIDADE'); ?>
    </div>
</div>

<div class="section">
    <?php echo $form->labelEx($user,'CODIGO_POSTAL'); ?>
    <div> <?php $this->widget('CMaskedTextField', array(
                    'model' => $user,
                    'attribute' => 'CODIGO_POSTAL',
                    'mask' => '9999-999',
                    'placeholder' => '_',
                    'htmlOptions'=>array('class'=>'small'),
                    ));
                ?>
          <?php echo $form->error($user,'CODIGO_POSTAL'); ?>
    </div>
</div>

<div class="section">
    <?php echo $form->labelEx($user,'RUA'); ?>
    <div> <?php echo $form->textField($user,'RUA',array('class'=>'medium')); ?>
          <?php echo $form->error($user,'RUA'); ?>
    </div>
</div>

<div class="section">
    <?php echo $form->labelEx($user,'TELEMOVEL'); ?>
    <div> <?php echo $form->textField($user,'TELEMOVEL',array('class'=>'medium')); ?>
          <?php echo $form->error($user,'TELEMOVEL'); ?>
    </div>
</div>