<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
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
        
        <?php if(!$model->isNewRecord): ?>

            <?php $this->widget('CTabView',array(
                    'activeTab'=>(isset($_POST['active-tab'])? substr($_POST['active-tab'],1):'tab1'),
                    'id'=>'forms-tab',
                    'tabs'=>array(
                        'tab1'=>array(
                            'title'=>t('Geral'),
                            'view'=>'_tab1',
                            'data'=>array('form'=>$form,
                                          'model'=>$model,
                                          'doc_model'=>$doc_model),
                        ),
                        'tab2'=>array(
                            'title'=>t('Pré-Visualizar'),
                            'view'=>'_tab2',
                            'data'=>array('form'=>$form,
                                          'model'=>$model),
                        ),
                    ),
                    'htmlOptions'=>array(
                        'class'=>'form-tabs'
                    )
                ));?>

                <input type="hidden" name="active-tab" id="active-tab" value="<?php echo (isset($_POST['active-tab'])? $_POST['active-tab']:'#tab1') ?>"/>
            <?php else: ?>
            
                <?php $this->renderPartial('_tab1',array('form'=>$form,
                                                'model'=>$model,
                                                'doc_model'=>$doc_model));?>
            <?php endif; ?>
           
        <div class="clear"></div>
    </div><!-- End content -->
</div>


<?php $this->endWidget(); ?>