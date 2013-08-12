<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
)); ?>
 
<div class="actions-bar">

    <?php echo CHtml::link(t('Voltar'),array('/portal/'.$this->id),array('name'=>'save','style'=>'float:right;margin-right:10px;','class'=>'btn btn-small')); ?>
    
    <?php if(!$model->isNewRecord): ?>
        <?php echo CHtml::submitButton(t('Gravar'),array('name'=>'save','style'=>'float:right;margin-right:10px;','class'=>'btn btn-small btn-success')); ?>
    <?php endif; ?>

    <?php echo CHtml::submitButton((!$model->isNewRecord)? t('Gravar e Sair'): t('Adicionar'),array('name'=>'end','style'=>'float:right;margin-right:10px;','class'=>'btn btn-small btn-info')); ?>

</div>

<div class="widget">
    <div class="header">
        <span><span class="ico gray user"></span><?php echo $this->pageTitle;?></span>
        
        <?php echo CHtml::link(t('Voltar'),array('/portal/'.$this->id),array('name'=>'save','style'=>'float:right;margin-right:10px;','class'=>'btn btn-small')); ?>
    
        <?php if(!$model->isNewRecord): ?>
            <?php echo CHtml::submitButton(t('Gravar'),array('name'=>'save','style'=>'float: right; margin-top: 5px;margin-right:10px;','class'=>'btn btn-small btn-success')); ?>
        <?php endif; ?>

        <?php echo CHtml::submitButton((!$model->isNewRecord)? t('Gravar e Sair'): t('Adicionar'),array('name'=>'end','style'=>'float: right; margin-top: 5px;margin-right:10px;','class'=>'btn btn-small btn-info')); ?>

    </div>
    <div class="content"> 


        <?php $this->widget('bootstrap.widgets.TbAlert', array(
                'block'=>true, // display a larger alert block?
                'fade'=>true, // use transitions?
                'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
                'alerts'=>array( // configurations per alert type
                    'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), 
                    'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'),// success, info, warning, error or danger
                ),
            )); ?>

        <?php // echo $form->errorSummary($model); ?>
        
       <div class="section">
            <?php echo $form->labelEx($model,'IDENTIFICACAO'); ?>
            <div> <?php echo $form->textField($model,'IDENTIFICACAO',array('class'=>'full')); ?>
                  <?php echo $form->error($model,'IDENTIFICACAO'); ?>
            </div>
       </div>
        
       <div class="section">
            <?php echo $form->labelEx($model,'EMAIL'); ?>
            <div> <?php echo $form->textField($model,'EMAIL',array('class'=>'medium')); ?>
                  <?php echo $form->error($model,'EMAIL'); ?>
            </div>
       </div>
        
       <div class="section">
            <?php echo $form->labelEx($model,'NOME_CONTATO'); ?>
            <div> <?php echo $form->textField($model,'NOME_CONTATO',array('class'=>'full')); ?>
                  <?php echo $form->error($model,'NOME_CONTATO'); ?>
            </div>
       </div>
        
        <div class="section">
            <?php echo $form->labelEx($model,'TELEMOVEL'); ?>
            <div> <?php echo $form->textField($model,'TELEMOVEL',array('class'=>'small')); ?>
                  <?php echo $form->error($model,'TELEMOVEL'); ?>
            </div>
       </div>
        
       <div class="section">
            <?php echo $form->labelEx($model,'TELEFONE'); ?>
            <div> <?php echo $form->textField($model,'TELEFONE',array('class'=>'small')); ?>
                  <?php echo $form->error($model,'TELEFONE'); ?>
            </div>
       </div>
                
       <div class="section">
            <?php echo $form->labelEx($model,'SITE'); ?>
            <div> <?php echo $form->textField($model,'SITE',array('class'=>'medium')); ?>
                  <?php echo $form->error($model,'SITE'); ?>
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
                            'htmlOptions'=>array('class'=>'small'),
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
       
        <div class="section">
            <?php echo $form->labelEx($model,'OBSERVACOES'); ?>   
            <div> <?php echo $form->textArea($model,'OBSERVACOES',array('class'=>'full')); ?>
                  <?php echo $form->error($model,'OBSERVACOES'); ?>
                <span class="f_help"></span>
            </div>
       </div>
        
        <div class="clear"></div>
    </div><!-- End content -->
</div>


<?php $this->endWidget(); ?>