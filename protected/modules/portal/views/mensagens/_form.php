<?php /** @var BootActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'horizontalForm',
    'type'=>'horizontal',
)); ?>

<div class="widget">
    <div class="header">
        <span><span class="ico gray user"></span><?php echo $this->pageTitle;?></span>
        
        <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label'=>t('Voltar'),
                'size'=>'small',
                'url'=> $this->createUrl('/portal/mensagens#tab2'),
            )); ?>
        
        <?php if($mensagem->ENVIADA==0): ?>
        
            <?php echo CHtml::submitButton(t('Gravar'),array('name'=>'save','style'=>'float: right; margin-top: 5px;margin-right:10px;','class'=>'btn btn-small')); ?>
            <?php echo CHtml::submitButton(t('Gravar e Enviar'),array('name'=>'send','style'=>'float: right; margin-top: 5px;margin-right:10px;','class'=>'btn btn-small btn-info')); ?>
        <?php endif; ?>
        
        <?php if(!$mensagem->isNewRecord): ?>
            <?php echo CHtml::link(t('Apagar'),array('/portal/mensagens/delete/id/'.$mensagem->ID_MSG."/t/0"),array('name'=>'delete','style'=>'float: right; margin-top: 5px;margin-right:10px;','class'=>'btn btn-small btn-danger')); ?>
        <?php endif; ?>
        
    </div>
    <div class="content"> 
        
        <?php $this->widget('bootstrap.widgets.TbAlert', array(
                'block'=>true, // display a larger alert block?
                'fade'=>true, // use transitions?
                'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
                'alerts'=>array( // configurations per alert type
                    'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'),
                    'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&times;'),// success, info, warning, error or danger
                ),
            )); ?>
        
        <?php if($mensagem->ENVIADA==0): ?>
            <div class="section">
                <?php echo $form->labelEx($mensagem,'DESTINATARIOS'); ?>
                <div> 
                    <?php $this->widget('ext.widgets.tokeninput.TokenInput', array(
                            'model' => $mensagem,
                            'attribute' => 'DESTINATARIOS',
                            'url' => array('/portal/mensagens/utilizadores'),
                            'options' => array(
                                'allowCreation' => true,
                                'preventDuplicates' => true,
                                'resultsFormatter' => 'js:function(item){ return "<li><p>" + item.name + "</p></li>" }',
                                'theme' => 'facebook',
                            ),
                        )); ?>
                        <?php echo $form->error($mensagem,'DESTINATARIOS'); ?>
                </div>
            </div> 
        
            <div class="section">
                <?php echo $form->labelEx($mensagem,'ASSUNTO'); ?>
                <div> <?php echo $form->textField($mensagem,'ASSUNTO',array('class'=>'full')); ?>
                      <?php echo $form->error($mensagem,'ASSUNTO'); ?>
                </div>
            </div>
        
            <div class="section">
            <?php echo $form->labelEx($mensagem,'CONTEUDO'); ?>
            <div> 
                    <?php $this->widget('ext.widgets.xheditor.XHeditor',array(
                            'model'=>$mensagem,
                            'modelAttribute'=>'CONTEUDO',
                            'config'=>array(
                                'id'=>'xheditor_1',
                                'tools'=>'mfull', // mini, simple, mfull, full or from XHeditor::$_tools, tool names are case sensitive
                                'skin'=>'default', // default, nostyle, o2007blue, o2007silver, vista
                                'width'=>'707px',
                                'height'=>'300px',
                                'loadCSS'=>XHtml::cssUrl('editor.css'),
                            ),
                        )); ?>
                    <?php echo $form->error($mensagem,'CONTEUDO'); ?>
                </div>
            </div>
        
        <?php else: ?>
        
            <div class="section">
                <?php echo $form->labelEx($mensagem,'DESTINATARIOS'); ?>
                <div> 
                    <?php echo $form->textField($mensagem,'DESTINATARIOS',array('class'=>'full','disabled'=>'disabled')); ?>
                </div>
            </div> 
            
            <div class="section">
                <?php echo $form->labelEx($mensagem,'ASSUNTO'); ?>
                <div> 
                        <p><?php echo $mensagem->ASSUNTO;?><p>
                </div>
            </div>
            
            <div class="section">
                <?php echo $form->labelEx($mensagem,'CONTEUDO'); ?>
                <div> 
                    <p>
                        <?php echo $mensagem->CONTEUDO;?>
                    </p>
                </div>
            </div>
            
            
        <?php endif; ?>
        

        <div class="clear"></div>
    </div><!-- End content -->
</div>
    
<?php $this->endWidget(); ?>