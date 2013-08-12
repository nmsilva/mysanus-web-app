<?php $this->widget('application.modules.site.components.TitleWidget', array(
  'crumbs' => array(
    array('name' => t('Novo Utilizador')),
  ),
  'title' => t('Novo Utilizador'), 
)); ?>

<div class="main one">

    <?php /** @var BootActiveForm $form */
    $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
        'id'=>'horizontalForm',
        'type'=>'horizontal',
    )); ?>
        
            <?php $this->widget('bootstrap.widgets.TbAlert', array(
                'block'=>true, // display a larger alert block?
                'fade'=>true, // use transitions?
                'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
                'alerts'=>array( // configurations per alert type
                    'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
                ),
            )); ?>
    
                
            <?php // echo $form->errorSummary($user); ?>
    
            <?php // echo $form->errorSummary($utente); ?>
    
            <!--<div class="title-form">
                <h4>Dados Pessoais de Utilizador</h4>
            </div>-->

            <div class="control-group ">
                <?php echo $form->labelEx($user,'NOME',array('class'=>'control-label required')); ?>
                <div class="controls">
                    <?php echo $form->textField($user,'NOME',array('style'=>'width:48%;')); ?>
                    <?php echo $form->error($user,'NOME'); ?>
                </div>
            </div>

            <div class="control-group ">
                <?php echo $form->labelEx($utente,'SEXO',array('class'=>'control-label required')); ?>
                <div class="controls">
                    <?php echo $form->dropDownList($utente,'SEXO',array('' => t('- selecione -'),
                                                                        'M'=> t('Masculino'),
                                                                        'F'=> t('Feminino')));?>
                    <?php echo $form->error($utente,'SEXO'); ?>
                    
                </div>
            </div>

            <div class="control-group ">
                <?php echo $form->labelEx($user,'DATA_NASC',array('class'=>'control-label required')); ?>  
                <div class="controls">
                    <?php
                        $this->widget('CMaskedTextField', array(
                        'model' => $user,
                        'attribute' => 'DATA_NASC',
                        'mask' => '9999-99-99',
                        'placeholder' => '_',
                        ));
                    ?>
                    <?php echo $form->error($user,'DATA_NASC'); ?>
                </div>
            </div>


            <div class="control-group ">
                <?php echo $form->labelEx($user,'EMAIL',array('class'=>'control-label required')); ?>
                <div class="controls">
                    <?php echo $form->textField($user,'EMAIL'); ?>
                    <?php echo $form->error($user,'EMAIL'); ?>
                </div>
            </div>

            <div class="control-group ">
                <?php echo $form->labelEx($user,'PASSWORD',array('class'=>'control-label required')); ?>
                <div class="controls">
                    <?php echo $form->passwordField($user,'PASSWORD'); ?>
                    <?php echo $form->error($user,'PASSWORD'); ?>
                </div>
            </div>

            <div class="control-group ">
                <?php echo $form->labelEx($user,'CONFIRM_PASSWORD',array('class'=>'control-label required')); ?>
                <div class="controls">
                    <?php echo $form->passwordField($user,'CONFIRM_PASSWORD'); ?>
                    <?php echo $form->error($user,'CONFIRM_PASSWORD'); ?>
                </div>
            </div>

            <div class="control-group" style='margin-top:-15px;'>
                <label class="control-label" for="RegisterForm_terms"></label>
                <div class="controls">
                    <label class="checkbox">
                        <?php echo $form->checkBox($user,'TERMOS'); ?>
                        <label>* <?php echo t('Li e concordo com os');?> <a href=""><?php echo t('termos e condições'); ?></a><?php echo t(' do serviço MySanus.pt');?></label>
                        <?php echo $form->error($user,'TERMOS'); ?>
                    </label>
                </div>
            </div>
            <br>
            <div class="control-group" style='margin-top:-15px;'>
                <label class="control-label" for="RegisterForm_terms"></label>
                <div class="controls">
                    <?php echo CHtml::submitButton(t('Registar'),array('class'=>'button small green')); ?>
                </div>
            </div>



	<?php $this->endWidget(); ?>

</div>
