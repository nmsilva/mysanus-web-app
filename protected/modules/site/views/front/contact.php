<?php
/* @var $this SiteController */
/* @var $model ContactForm */
/* @var $form CActiveForm */

?>

<!-- Gmaps library -->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="<?php echo $this->module->assetsUrl; ?>/js/jquery.gmap.min.js"></script>

<script language="javascript">

$(document).ready(function() {
    /* ---------------------------------------------------------------------- */
    /*  Google Maps
    /* ---------------------------------------------------------------------- */

    // Needed variables
    var $map                = $('#map'),
        $address            = 'Rua Ponte de Pau, 19 – R/C · Portugal';


    $map.gMap({
            address: $address,
            zoom: 16,
            markers: [
                    { 'address' : $address }
            ]
    });
});

</script>

<?php $this->widget('application.modules.site.components.TitleWidget', array(
  'crumbs' => array(
    array('name' => $cat->TITULO),
  ),
  'title' => $cat->TITULO, 
)); ?>

<!-- map of location-->
<div id="map"></div>

<div class="main two">
    <div class="sub-title">
        <h3>Entre em contato conosco</h3>
    </div>


    <?php if(Yii::app()->user->hasFlash('contact')): ?>

    <div class="flash-success">
        <?php echo Yii::app()->user->getFlash('contact'); ?>
    </div>

    <?php else: ?>

            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'contact-form',
                'htmlOptions'=>array('class'=>'form'),
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
            )); ?>
                
                <div id="comment-input" class="">

                    <!-- <input type="text" name="contact_name" id="author" placeholder="Nome" size="22" tabindex="1" aria-required="true" class="input-name  ">
                    <input type="text" name="email" id="email" placeholder="Email" size="22" tabindex="2" aria-required="true" class="input-email ">
                    <input type="text" name="url" id="url" placeholder="Assunto" size="22" tabindex="3" class="input-website ">
                    -->

                    <?php echo $form->textField($model,'name',array('placeholder'=>'Nome')); ?>
                    <?php echo $form->textField($model,'email',array('placeholder'=>'Email')); ?>
                    <?php echo $form->textField($model,'subject',array('placeholder'=>'Assunto')); ?>
                    
                </div>
                
                <div id="comment-textarea">

                    <!--<textarea name="comment" id="comment" cols="39" rows="4" tabindex="4" class="textarea-comment" placeholder="Mensagem"></textarea>
                    -->
                    <?php echo $form->textArea($model,'mensage',array('rows'=>4, 'cols'=>39,'placeholder'=>'Mensagem')); ?>

                </div>

                <?php echo CHtml::errorSummary($model); ?>
                
                <br>
                <div id="comment-submit">

                    <p></p>
                    <div><?php echo CHtml::submitButton('Enviar',array('class'=>'button small green')); ?></div><p></p> 

                </div>

        <?php $this->endWidget(); ?>

    <?php endif; ?>

</div>
<div class="side"> 

    <div class="widget">

        <div class="heading">
            <h3>Informação de Contato</h3>
        </div>    

        <p class="address">
            MySanus – Medical Solutions<br>
            Rua Ponte de Pau, 19<br>
            3510-110 Viseu</p>

        <p class="phone">Telefone: </p>

        <p class="fax">Fax: </p>

        <p class="email">Email: <a href="mailto:"></a></p>

        <p class="web">Web: <a href="www.mysanus.pt">www.mysanus.pt</a></p>
    </div>

</div>
