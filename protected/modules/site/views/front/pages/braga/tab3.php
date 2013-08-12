<?php $this->widget('ext.fancybox.EFancyBox', array(
    'target'=>'a[rel=gallery]',
    'config'=>array(),
    )
); ?>

<div class="gdl-gallery-item">
<?php foreach(MediaGaleria::model()->getImagensGaleria('2') as $key =>$image): ?>

    <div class="three columns mb20">
        <div class="gdl-gallery-image">
            <a href="<?php echo $image['image']; ?>" rel="gallery">
                <img src="<?php echo $image['image']; ?>" alt="" style="opacity: 1; ">
            </a>
        </div>
    </div>    
    
<?php endforeach; ?>
</div>

