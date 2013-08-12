<div class="modal-body" id="result">
    <div class="clear"></div>
    <div style="border: 1px #CCC solid; margin-top:15px;">
    <div class="msgOhead" style="background-color: #F9F9F9;padding: 10px 20px 7px 20px;border: 2px white solid;">
            <div style="float:left; width:60%;"><strong><?php echo t("De");?>:</strong> <font color="#AAA"><?php echo $mensagem->REMETENTE->NOME; ?></font>
          </div>
            <div style="float:right;width:40%;" align="right"><font color="#AAA"> <?php echo $mensagem->DATA_ENVIO; ?></font>
            </div>
            <div class="clear"></div>
            <div style="float:left; width:60%;padding: 5px 0 0px 0;"><strong><?php echo t("Assunto");?>:</strong><font color="#AAA"> <?php echo $mensagem->ASSUNTO; ?> </font></div>
    <div class="clear"></div>
    </div>
    </div>
    <div style="margin-top: 20px;">
          <p><?php echo $mensagem->CONTEUDO; ?></p>
    </div>
</div>

<div class="modal-footer">
    <?php echo CHtml::link(t('Apagar'),array('/portal/mensagens/delete/id/'.$mensagem->ID_MSG."/t/".$mensagem->REMETENTE->ID_USER),array('name'=>'delete','style'=>'','class'=>'btn btn-small btn-danger')); ?>
    
    <?php echo CHtml::link(t('Responder'),array('/portal/mensagens/create/user/'.$mensagem->REMETENTE->ID_USER),array('name'=>'delete','style'=>'','class'=>'btn btn-small btn-info')); ?>
    
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>t('Fechar'),
        'url'=>'#',
        'htmlOptions'=>array('onclick'=>($refresh)?'document.location = "'.$this->createUrl('/portal/mensagens/').'";':'','data-dismiss'=>'modal'),
    )); ?>
</div>



