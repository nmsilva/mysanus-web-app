<ul>
<?php foreach ($idiomas as $key => $idioma): ?>
    
    <li><a href="<?php echo $this->getOwner()->createMultilanguageReturnUrl($idioma->SHORT);?>" ><?php echo CHtml::image(Yii::app()->getAssetManager()->publish(Yii::app()->getModule('site')->getBasePath()."/assets/images/bandeiras/".$idioma->BANDEIRA),"image",array('style'=>'margin-top:6px;width:25px;height:23px;')); ?> </a></li>
    
<?php endforeach; ?>
</ul>
