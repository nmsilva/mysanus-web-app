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
                        'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), 
                        'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'), // success, info, warning, error or danger
                    ),
                )); ?>

                <?php if($save): ?>
                    <script language="javascript">

                         function refreshParent()
                         {
                           window.top.location.reload();
                         }

                         setTimeout('refreshParent()',3000);
                         
                    </script>            
                <?php endif; ?>
                    
                <div class="section">
                    <?php echo $form->labelEx($model,'LINGUA'); ?>
                    <div> <?php echo $form->dropDownList($model,'LINGUA', array(
                                     'pt' => t('Português'),'en' => t('Inglês'),'fr'=>t('Françês'),'es'=>t('Espanhol'))); ?>
                    </div>
                </div>

                <div class="section">
                    <?php echo $form->labelEx($model,'PAIS'); ?>
                    <div> <?php echo $form->dropDownList($model,'PAIS', array(
                                     '1' => t('Portugal'),'2' => t('Inglaterra'),'3'=>t('França'),'4'=>t('Espanha'))); ?>
                    </div>
                </div>

            <div class="clear"></div>
        </div><!-- End content -->
    </div>

<?php $this->endWidget(); ?>