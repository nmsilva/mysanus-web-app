
<div class="twoOne">
    <div class="section">
        <?php echo $form->labelEx($user,'NOME'); ?>
        <div> <?php echo $form->textField($user,'NOME',array('class'=>'full')); ?>
              <?php echo $form->error($user,'NOME'); ?>
        </div>
    </div>

    <div class="section">
        <?php echo $form->labelEx($user,'EMAIL'); ?>
        <div> <?php echo $form->textField($user,'EMAIL',array('class'=>'full')); ?>
              <?php echo $form->error($user,'EMAIL'); ?>
        </div>
    </div>
    
    <div class="section">
        <?php echo $form->labelEx($user,'BI'); ?>
        <div> <?php $this->widget('CMaskedTextField', array(
                    'model' => $user,
                    'attribute' => 'BI',
                    'mask' => '999999999',
                    'placeholder' => '_',
                    'htmlOptions'=>array('class'=>'medium'),
                    ));
                ?>
              <?php echo $form->error($user,'BI'); ?>
        </div>
    </div>
    
    <div class="section">
        <?php echo $form->labelEx($utente,'NIF'); ?>
        <div> <?php $this->widget('CMaskedTextField', array(
                    'model' => $utente,
                    'attribute' => 'NIF',
                    'mask' => '999999999',
                    'placeholder' => '_',
                    'htmlOptions'=>array('class'=>'medium'),
                    ));
                ?>
              <?php echo $form->error($utente,'NIF'); ?>
        </div>
    </div>
    
    <div class="section">
        <?php echo $form->labelEx($utente,'NCONTRIBUINTE'); ?>
        <div> <?php echo $form->textField($utente,'NCONTRIBUINTE',array('class'=>'medium')); ?>
              <?php echo $form->error($utente,'NCONTRIBUINTE'); ?>
        </div>
    </div>
    
    <div class="section">
        <?php echo $form->labelEx($utente,'NBENEFICIARIO'); ?>
        <div> <?php echo $form->textField($utente,'NBENEFICIARIO',array('class'=>'medium')); ?>
              <?php echo $form->error($utente,'NBENEFICIARIO'); ?>
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
                                'class'=>'medium',
                        ),
                )); ?>
            
            <?php echo $form->error($user,'DATA_NASC'); ?>
            <span class="f_help"></span></div>
    </div>

    <div class="section">
        <?php echo $form->labelEx($utente,'SEXO',array('class'=>'required')); ?>
        <div> 
            <?php echo $form->dropDownList($utente,'SEXO',array('' => t('- selecione -'),
                                                                'M'=> t('Masculino'),
                                                                'F'=> t('Feminino')));?>
            <?php echo $form->error($utente,'SEXO'); ?>

        </div>
    </div>
    
    <div class="section">
        <?php echo $form->labelEx($utente,'ESTADO_CIVIL',array('class'=>'required')); ?>
        <div> 
            <?php echo $form->dropDownList($utente,'ESTADO_CIVIL',array('' => t('Indiferente'),
                                                                '0'=> t('Solteiro(a)'),
                                                                '1'=> t('Casado(a)'),
                                                                '2'=> t('Separado(a)'),
                                                                '3'=> t('Divorciado(a)'),
                                                                '4'=> t('Viúvo(a)')));?>
            <?php echo $form->error($utente,'ESTADO_CIVIL'); ?>

        </div>
    </div>
</div>
<div class="oneThree">
    <div class="profileSetting">
            <div class="avartar">
                <?php if(!empty($user->FOTO)):?>
                <img src="<?php echo Helper::getFotoPublicUrl()."/".$user->FOTO; ?>" width="180" height="180" alt="avatar">
                <?php else: ?>
                    <img src="<?php echo $this->module->assetsUrl; ?>/images/avatar.png" width="180" height="180" alt="avatar">
                <?php endif; ?>
            </div>
            <div class="avartar">
                <input class="file fileupload" placeholder="Choose File" style="display: inline; color: rgb(102, 102, 102); font-size: 11px; width: 142px;">
                <div class="filebtn" style="width: 190px; height: 30px; background-image: url(<?php echo $this->module->assetsUrl; ?>/images/addFiles.png); display: inline; position: absolute; margin-left: -168px; background-position: 100% 50%; background-repeat: no-repeat no-repeat;">
                    <?php echo $form->fileField($foto, 'file',array('style'=>'position: absolute; height: 30px; width: 170px; margin-left: 5px; display: inline; cursor: pointer; opacity: 0;')); ?>
                </div>
            </div>
    </div>
</div>