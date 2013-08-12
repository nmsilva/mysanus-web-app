<div class="section">
    <?php echo $form->labelEx($model,'NOME'); ?>
    <div> <?php echo $form->textField($model,'NOME',array('class'=>'large')); ?>
          <?php echo $form->error($model,'NOME'); ?>
    </div>
</div>

<div class="section">
    <?php echo $form->labelEx($model,'SIGLA'); ?>
    <div> <?php echo $form->textField($model,'SIGLA',array('class'=>'medium')); ?>
          <?php echo $form->error($model,'SIGLA'); ?>
    </div>
</div>

<div class="section">
    <?php echo $form->labelEx($model,'NIF'); ?>
    <div> <?php $this->widget('CMaskedTextField', array(
                'model' => $model,
                'attribute' => 'NIF',
                'mask' => '999999999',
                'placeholder' => '_',
                'htmlOptions'=>array('class'=>'xsmall'),
                ));
            ?>
          <?php echo $form->error($model,'NIF'); ?>
    </div>
</div>

<?php $this->widget('application.modules.portal.widgets.tiposSearch.tiposSearchWidget',
        array('form'=>$form,
              'model'=>$model,
              'field'=>'ID_TIPO',
              'items'=>CHtml::listData(TipoEntidade::model()->findAll(),'ID_TIPO','NOME'),
              'ajaxUrl'=>'/portal/'.$this->id.'/addtipo')); ?>

<div class="section">
    <?php echo $form->labelEx($model,'TELEFONE'); ?>
    <div> <?php echo $form->textField($model,'TELEFONE',array('class'=>'small')); ?>
          <?php echo $form->error($model,'TELEFONE'); ?>
    </div>
</div>

<div class="section">
    <?php echo $form->labelEx($model,'PORTA'); ?>
    <div> <?php echo $form->textField($model,'PORTA',array('class'=>'xsmall')); ?>
          <?php echo $form->error($model,'PORTA'); ?>
    </div>
</div>

<div class="section">
    <?php echo $form->labelEx($model,'RUA'); ?>
    <div> <?php echo $form->textField($model,'RUA',array('class'=>'medium')); ?>
          <?php echo $form->error($model,'RUA'); ?>
    </div>
</div>

<div class="section">
    <?php echo $form->labelEx($model,'CODIGO_POSTAL'); ?>
    <div> <?php $this->widget('CMaskedTextField', array(
                    'model' => $model,
                    'attribute' => 'CODIGO_POSTAL',
                    'mask' => '9999-999',
                    'placeholder' => '_',
                    'htmlOptions'=>array('class'=>'xsmall'),
                    ));
                ?>
          <?php echo $form->error($model,'CODIGO_POSTAL'); ?>
    </div>
</div>

<div class="section">
    <?php echo $form->labelEx($model,'LOCALIDADE'); ?>
    <div> <?php echo $form->textField($model,'LOCALIDADE',array('class'=>'medium')); ?>
          <?php echo $form->error($model,'LOCALIDADE'); ?>
    </div>
</div>

<div class="section">
    <?php echo $form->labelEx($model,'CIDADE'); ?>
    <div> <?php echo $form->textField($model,'CIDADE',array('class'=>'medium')); ?>
          <?php echo $form->error($model,'CIDADE'); ?>
    </div>
</div>