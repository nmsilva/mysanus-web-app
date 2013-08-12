<div class="section" >
    <?php echo $this->form->labelEx($this->model,$this->field); ?>
   <div id="section-tipos"> <?php echo $this->form->dropDownList($this->model,$this->field,$this->items,array('id'=>'tipos'));?>
          <?php echo CHtml::button(t('Novo'), array('id'=>'novo-tipo','style'=>'margin-left:10px;','class'=>'btn btn-small')); ?>
    </div>
    <div id="form-novo-tipo" style="display: none;">

    <?php echo CHtml::textField('tipo', '', array('placeholder'=> t('Novo').' '.$this->model->getAttributeLabel($this->field),'id'=>'descricao','class'=>'')) ?>

    <?php echo CHtml::ajaxButton('Gravar',
                    array($this->ajaxUrl),
                    array('data'=>array(
                                     'descricao'=>'js:$("#descricao").val()',
                                 ),
                           'type'=>'POST', 
                           'success'=>'function(data){  
                                    if(data=="empty")
                                    {
                                        alert("'.t('Não Pode ser Vazio!').'");
                                    }else{
                                        $("#tipos").append(new Option($("#descricao").val(), data, true, true));
                                        hideFormTipo();
                                    }
                                }',
                        ),
                    array('class'=>'btn btn-small',
                          'style'=>'margin-left:5px;'));
    ?>
    
    <?php echo CHtml::button(t('Cancelar'), array('id'=>'cancel-tipo','style'=>'margin-left:5px;','class'=>'btn btn-small btn-danger')); ?>
        
    </div>
</div>
<style>
#form-novo-tipo{
    margin-left: 25%;
    overflow: hidden;
    width: 390px;
}
</style>
<script language="javascript">
        
    $('#novo-tipo').click(function (){
        showFormTipo();        
    });
    
    $('#cancel-tipo').click(function (){
        hideFormTipo();        
    });
    
    function showFormTipo()
    {
            $('#section-tipos').hide();
            $('#form-novo-tipo').show();
    }
    
    function hideFormTipo()
    {
            $('#section-tipos').show();
            $('#form-novo-tipo').hide();
    }
</script>