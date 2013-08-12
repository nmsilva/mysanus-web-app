<div class="site-title">
    <div class="title"><h2><?php echo $this->title; ?></h2></div>
    <div class="map">
        <ul>
        	<?php
                    $crumbs=array('name' => t('INICIO'), 'url' => array('/site/front'));
                    array_unshift($this->crumbs,$crumbs);
                                        
                    foreach($this->crumbs as $key => $crumb) {
                           if($crumb)
                           {
                                if(isset($crumb['url'])) {
                                    echo "<li>".CHtml::link($crumb['name'], $crumb['url'])."</li>";
                                } else {
                                    echo "<li><span>".$crumb['name']."</span></li>";
                                }

                                if($crumb!=end($this->crumbs)) {
                                    echo "<li>/</li>";
                                }
                           }
                       }
        	?>
            
        </ul>
    </div>
</div>