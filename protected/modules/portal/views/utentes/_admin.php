<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
)); ?>

<div class="widget">
    <div class="header">
        <span><span class="ico gray user"></span><?php echo $this->pageTitle;?></span>
        
        <?php echo CHtml::submitButton(t('Gravar'),array('name'=>'save','style'=>'float: right; margin-top: 5px;margin-right:10px;','class'=>'btn btn-small btn-success')); ?>

    </div>
    <div class="content"> 
            
        <?php $this->widget('bootstrap.widgets.TbAlert', array(
                'block'=>true, // display a larger alert block?
                'fade'=>true, // use transitions?
                'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
                'alerts'=>array( // configurations per alert type
                    'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
                ),
            )); ?>
        
            <?php //echo $form->errorSummary($user); ?>
        
            <div class="section">
                <?php echo $form->labelEx($user,'NOME'); ?>
                <div> <?php echo $form->textField($user,'NOME',array('class'=>'medium')); ?>
                      <?php echo $form->error($user,'NOME'); ?>
                </div>
            </div>

            <div class="section">
                <?php echo $form->labelEx($user,'EMAIL'); ?>
                <div> <?php echo $form->textField($user,'EMAIL',array('class'=>'medium')); ?>
                      <?php echo $form->error($user,'EMAIL'); ?>
                </div>
            </div>
            
            <div class="section">
                <?php echo $form->labelEx($user,'PASSWORD'); ?>
                <div> <?php echo $form->passwordField($user,'PASSWORD',array('class'=>'small', 'value'=>'')); ?>
                      <?php echo $form->error($user,'PASSWORD'); ?>
                </div>
            </div>
            <div class="section">
                <?php echo $form->labelEx($user,'CONFIRM_PASSWORD'); ?>
                <div> <?php echo $form->passwordField($user,'CONFIRM_PASSWORD',array('class'=>'small','value'=>'')); ?>
                      <?php echo $form->error($user,'CONFIRM_PASSWORD'); ?>
                </div>
            </div>
                
            <div class="section">
                <?php echo $form->labelEx($user,'BI'); ?>
                <div> <?php $this->widget('CMaskedTextField', array(
                            'model' => $user,
                            'attribute' => 'BI',
                            'mask' => '999999999',
                            'placeholder' => '_',
                            'htmlOptions'=>array('class'=>'small'),
                            ));
                        ?>
                      <?php echo $form->error($user,'BI'); ?>
                </div>
            </div>

            <div class="section">
                <?php echo $form->labelEx($user,'DATA_NASC'); ?>  
                <div> 
                  <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                                'model'=>$user,
                                'attribute'=>'DATA_NASC',
                                'value'=>$user->DATA_NASC,
                                // additional javascript options for the date picker plugin
                                'options'=>array(
                                        'changeMonth'=>true,
                                        'changeYear'=>true,
                                        'showAnim'=>'fold',
                                        'showButtonPanel'=>false,
                                        'autoSize'=>true,
                                        'dateFormat'=>'yy-mm-dd',
                                ),
                                'htmlOptions'=>array(
                                        'class'=>'small',
                                ),
                        )); ?>

                    <?php echo $form->error($user,'DATA_NASC'); ?>
                    <span class="f_help"></span></div>
            </div>

        <div class="clear"></div>
    </div><!-- End content -->
</div>
    
<?php $this->endWidget(); ?>