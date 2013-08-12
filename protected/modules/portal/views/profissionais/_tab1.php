    <div class="section">
        <?php echo $form->labelEx($user,'NOME'); ?>
        <div> <?php echo $form->textField($user,'NOME',array('class'=>'large')); ?>
              <?php echo $form->error($user,'NOME'); ?>
        </div>
   </div>

   <div class="section">
        <?php echo $form->labelEx($user,'EMAIL'); ?>
        <div> <?php echo $form->textField($user,'EMAIL',array('class'=>'large')); ?>
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
                                'class'=>'',
                        ),
                )); ?>
            <?php echo $form->error($user,'DATA_NASC'); ?>
            <span class="f_help"></span></div>
   </div>
   
   <div class="section">
        <?php echo $form->labelEx($pro,'ID_TIPO'); ?> 
       <div> <?php echo $form->dropDownList($pro,'ID_TIPO',CHtml::listData(TipoProfissional::model()->findAll(),'ID_TIPO','DESCRICAO'));?>
            <span class="f_help"></span></div>
   </div>

    <div class="section">
        <?php echo $form->labelEx($pro,'VALOR'); ?>
        <div> <?php echo $form->textField($pro,'VALOR',array('class'=>'xsmall')); ?>
              <?php echo $form->error($pro,'VALOR'); ?>
        </div>
   </div>

   <div class="section">
        <?php echo $form->labelEx($pro,'TIPO_ESPECIALIDADE'); ?> 
        <div> <?php echo $form->dropDownList($pro,'TIPO_ESPECIALIDADE',CHtml::listData(TipoEspecialidade::model()->findAll(),'ID_TIPO','DESCRICAO'));?>
            <span class="f_help"></span></div>
   </div>



    

    