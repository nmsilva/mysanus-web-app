<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

<div class="actions-bar">
    <?php if(user()->rule=="admin"): ?>

        <?php echo CHtml::link(t('Voltar'),array('/portal/'.$this->id),array('name'=>'save','style'=>'float:right;margin-right:10px;','class'=>'btn btn-small')); ?>

    <?php endif; if(user()->rule=="admin" or user()->rule=="utente"): ?>

        <?php if(!$user->isNewRecord): ?>
            <?php echo CHtml::submitButton(t('Gravar'),array('name'=>'save','style'=>'float: right; margin-right:10px;','class'=>'btn btn-small btn-success')); ?>
        <?php endif; ?>

    <?php endif; if(user()->rule=="admin"): ?>

        <?php echo CHtml::submitButton((!$user->isNewRecord)? t('Gravar e Sair'): t('Adicionar'),array('name'=>'end','style'=>'float: right;margin-right:10px;','class'=>'btn btn-small btn-info')); ?>
    <?php endif; ?>
</div>

<div class="widget">
    <div class="header">
        <span><span class="ico gray user"></span><?php echo $this->pageTitle;?></span>
        
        <?php if(user()->rule=="admin"): ?>
        
            <?php echo CHtml::link(t('Voltar'),array('/portal/'.$this->id),array('name'=>'save','style'=>'float:right;margin-right:10px;','class'=>'btn btn-small')); ?>
    
        <?php endif; if(user()->rule=="admin" or user()->rule=="utente"): ?>
        
            <?php if(!$user->isNewRecord): ?>
                <?php echo CHtml::submitButton(t('Gravar'),array('name'=>'save','style'=>'float: right; margin-top: 5px;margin-right:10px;','class'=>'btn btn-small btn-success')); ?>
            <?php endif; ?>
        
        <?php endif; if(user()->rule=="admin"): ?>
        
            <?php echo CHtml::submitButton((!$user->isNewRecord)? t('Gravar e Sair'): t('Adicionar'),array('name'=>'end','style'=>'float: right; margin-top: 5px;margin-right:10px;','class'=>'btn btn-small btn-info')); ?>
        <?php endif; ?>
        
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

        <?php // echo $form->errorSummary($user); ?>

        <?php $this->widget('CTabView',array(
                'activeTab'=>(isset($_POST['active-tab'])? substr($_POST['active-tab'],1):'tab1'),
                'id'=>'forms-tab',
                'tabs'=>array(
                    'tab1'=>array(
                        'title'=>t('Geral'),
                        'view'=>'_tab1',
                        'data'=>array('form'=>$form,
                                      'user'=>$user,
                                      'utente'=>$utente,
                                      'foto'=>$foto),
                    ),
                    'tab2'=>array(
                        'title'=>t('Contatos'),
                        'view'=>'_tab2',
                        'data'=>array('form'=>$form,
                                      'user'=>$user,
                                      'utente'=>$utente),
                    ),
                    'tab3'=>array(
                        'title'=>t('Entidades'),
                        'view'=>'_tab3',
                        'data'=>array('form'=>$form,
                                      'user'=>$user,
                                      'utente'=>$utente),
                    ),
                ),
                'htmlOptions'=>array(
                    'class'=>'form-tabs'
                )
            ));?>

            <input type="hidden" name="active-tab" id="active-tab" value="<?php echo (isset($_POST['active-tab'])? $_POST['active-tab']:'#tab1') ?>"/>
            
        <div class="clear"></div>
    </div><!-- End content -->
</div>
    
<?php $this->endWidget(); ?>
