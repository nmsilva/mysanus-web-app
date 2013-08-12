<div class="clear"></div>

<?php if(!$model->isNewRecord): ?>

<?php echo $form->hiddenField(EntidadeServico::model(),'ID_SERV',array('value'=>$model->ID_SERV,'style'=>'width:100px')); ?>

<div class="buttons">
    <?php echo CHtml::button(t('Novo'), array('class'=>'btn btn-small novo')); ?>
</div>
<div class="box">
     <textarea class="template" style="display: none;" rows="0" cols="0">
        <tr class="templateContent">
            <td>
                <?php echo $form->dropDownList(EntidadeServico::model(),'ID_ENT',CHtml::listData(Entidade::model()->findAll(),'ID_ENT','NOME'),array('style'=>'width:100px'));?>
            </td>
            <td>
                <?php echo $form->textField(EntidadeServico::model(),'VALOR',array('style'=>'width:100px')); ?>
            </td>
            <td>
                <?php echo $form->textField(EntidadeServico::model(),'COD_SERVICO',array('style'=>'width:100px')); ?>
            </td>
            <td>
                <?php echo $form->textField(EntidadeServico::model(),'DESIG_SERVICO',array('style'=>'width:100px')); ?>
            </td>
            <td>
                <?php echo $form->textField(EntidadeServico::model(),'TAXA',array('style'=>'width:100px')); ?>
            </td>
            <td>
                <?php echo $form->textField(EntidadeServico::model(),'TAXA_URGENT',array('style'=>'width:100px')); ?>
            </td>
            <td>
                <?php echo CHtml::button('S', array('class'=>'btn btn-small btn-success','onclick'=>'addItem();')); ?>
                <?php echo CHtml::button('C', array('class'=>'btn btn-small btn-danger','onclick'=>'cancelItem();')); ?>
            </td>
        </tr>
    </textarea>   
    <table class="templateFrame" >
        <thead>
            <tr>
                <th width="100px" ><?php echo EntidadeServico::model()->getAttributeLabel('ID_ENT');?></th>
                <th width="115px"><?php echo EntidadeServico::model()->getAttributeLabel('VALOR');?></th>
                <th width="115px"><?php echo EntidadeServico::model()->getAttributeLabel('COD_SERVICO');?></th>
                <th width="115px"><?php echo EntidadeServico::model()->getAttributeLabel('DESIG_SERVICO');?></th>
                <th width="115px"><?php echo EntidadeServico::model()->getAttributeLabel('TAXA');?></th>
                <th width="115px"><?php echo EntidadeServico::model()->getAttributeLabel('TAXA_URGENT');?></th>
                <th></th>
            </tr>
        </thead>
        <tbody class="templateTarget">
            
            <?php $this->renderPartial('_entidades',array('entidades'=>$entidades
                                                )); ?>
            
        </tbody>
    </table>

</div>

<script language="javascript">
    var novo=false;
    var edit=false;
    
    $(document).ready(function(){
        
        $('.novo').click(function(){
            newItem();
        });

    });
   
    function newItem(){
        if(!novo)
        {
            var template = $('.template').val();
            var place = $(".templateTarget");
            place.prepend(template);
            
            novo=true;
        }
    }
    
    function cancelItem(){  
        var place = $('.templateContent');
        place.remove();
        
        novo=false;
    }
    
    function editItem(elem,ent,serv){
       
       if(!edit && !novo){
            $.ajax({
              url: "<?php echo $this->createAbsoluteUrl('/portal/servicos/editrow'); ?>",
              type: "POST",
              data: "ID_ENT="+ent+"&ID_SERV="+serv,
              dataType:"html"
            }).done(function(result) { 

                  $(elem).parents('tr').html(result);

                  novo=true;
                  edit=true;
            });
        }
    }
    
    function saveItem(ent,serv){
        
        $.ajax({
            url: "<?php echo $this->createAbsoluteUrl('/portal/servicos/saverow'); ?>",
            type: "POST",
            data: $('#horizontalForm').serialize()+"&ID_ENT="+ent+"&ID_SERV="+serv,
            dataType:"html"
          }).done(function(result) { 
                if(result=="true"){
                    refreshItems();
                }
                else{
                    alert("Error!");
                }
          });
    }
    
    function addItem(){
       
        var url="<?php echo $this->createAbsoluteUrl('/portal/servicos/newrow'); ?>";
        
        $.ajax({
            url: url,
            type: "POST",
            data: $('#horizontalForm').serialize(),
            dataType:"html"
          }).done(function(result) { 
                if(result=="true"){
                    refreshItems();
                }
                else{
                    alert("Error!");
                }
          });
        
        
    }
    
    function delItem(ent,serv){
        
        $.ajax({
            url: "<?php echo $this->createAbsoluteUrl('/portal/servicos/delrow'); ?>",
            type: "POST",
            data: "ID_ENT="+ent+"&ID_SERV="+serv,
            dataType:"html"
          }).done(function(result) { 

                if(result=="true"){
                    refreshItems();
                }
                    
          });
          
    }
    
    function refreshItems()
    {
        var id_serv= <?php echo $model->ID_SERV; ?>;
        
        $.ajax({
            url: "<?php echo $this->createAbsoluteUrl('/portal/servicos/refreshrows'); ?>",
            type: "POST",
            data: "ID_SERV="+id_serv,
            dataType:"html"
          }).done(function(result) { 
                $(".templateTarget").html(result);
                
                novo=false;
                edit=false;
          });
    }
    
</script>


<style>
.buttons{
    margin-bottom: 10px;
}
.box {
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    border: 1px solid #E9E9E9;
    background-color: #F9F9F9;
    border-color: #CBCBCB #CBCBCB #8F8F8F;
    border-image: none;
    border-style: solid;
    border-width: 1px;
    margin-bottom: 20px;
    -webkit-box-shadow: rgba(0, 0, 0, 0.1) 0 1px 0px;
    -moz-box-shadow: rgba(0,0,0,0.1) 0 1px 0px;
    box-shadow: rgba(0, 0, 0, 0.1) 0 1px 0px;
    overflow: hidden;
    min-height: 300px;
    padding: 10px;
}
.box table{
    width: 100%;
    margin-bottom: 0;
    border-collapse: collapse;
}
.box table thead th{
    font-weight: bold;
    color: #7E838B;
    font-size: 12px;
}
.box table td, .box table th{
    border-color: #C4C4C4;
    padding: 6px 12px;
}
.box table td{
    border-top: 1px solid #DDD;
}
</style>

<?php else: ?>

<div class="alert in alert-block fade alert-warning">
    <a class="close" data-dismiss="alert">×</a>
    <strong><?php echo t('Aviso');?>!</strong> <?php echo t('Tem que efectuar a Gravação do Registo para poder inserir as Tabelas');?>
</div>

<?php endif; ?>
