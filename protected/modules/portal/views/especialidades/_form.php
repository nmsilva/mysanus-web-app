<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
)); ?>
 
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
            <?php echo $form->labelEx($model,'NOME'); ?>
            <div> <?php echo $form->textField($model,'NOME',array('class'=>'full')); ?>
                  <?php echo $form->error($model,'NOME'); ?>
            </div>
       </div>
        
        <?php $this->widget('application.modules.portal.widgets.tiposSearch.tiposSearchWidget',
        array('form'=>$form,
              'model'=>$model,
              'field'=>'ID_TIPO',
              'items'=>CHtml::listData(TipoEspecialidade::model()->findAll(),'ID_TIPO','DESCRICAO'),
              'ajaxUrl'=>'/portal/'.$this->id.'/addtipo')); ?>
        
        <div class="clear"></div>
    </div><!-- End content -->
</div>

<?php $this->endWidget(); ?>