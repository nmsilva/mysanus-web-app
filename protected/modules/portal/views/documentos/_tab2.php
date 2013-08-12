<?php $image_types= array("jpg", "png", "gif"); ?>

<?php if(in_array($model->TIPO,$image_types)): ?>
    
    <?php echo CHtml::image($model->getPublicUrl(),"image"); ?>

<?php endif; ?>

