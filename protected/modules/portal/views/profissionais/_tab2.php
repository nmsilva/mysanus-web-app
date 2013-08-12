<!--<script src="<?php echo $this->module->assetsUrl; ?>/js/jquery.elastic.source.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
            // <![CDATA[
            jQuery.noConflict();
            jQuery(document).ready(function(){			
                    jQuery('textarea').elastic();
                    jQuery('textarea').trigger('update');
            });	
            // ]]>
    </script>-->
                
   <div class="section">
        <?php echo $form->labelEx($pro,'FORMACAO'); ?>   
        <div> <?php echo $form->textArea($pro,'FORMACAO',array('class'=>'full')); ?>
              <?php echo $form->error($pro,'FORMACAO'); ?>
            <span class="f_help"></span>
        </div>
   </div>
    
   <div class="section">
        <?php echo $form->labelEx($pro,'EXPERIENCIA_PROFISSIONAL'); ?> 
        <div> <?php echo $form->textArea($pro,'EXPERIENCIA_PROFISSIONAL',array('class'=>'full')); ?>
              <?php echo $form->error($pro,'EXPERIENCIA_PROFISSIONAL'); ?>
            <span class="f_help"></span>
        </div>
   </div>
    
   <div class="section">
        <?php echo $form->labelEx($pro,'AREAS_COMPETENCIA'); ?>   
        <div> <?php echo $form->textArea($pro,'AREAS_COMPETENCIA',array('class'=>'full')); ?>
              <?php echo $form->error($pro,'AREAS_COMPETENCIA'); ?>
            <span class="f_help"></span>
        </div>
   </div>

   <div class="section">
        <?php echo $form->labelEx($pro,'PREMIOS'); ?>
        <div> <?php echo $form->textArea($pro,'PREMIOS',array('class'=>'full')); ?>
              <?php echo $form->error($pro,'PREMIOS'); ?>
            <span class="f_help"></span>
        </div>
   </div>