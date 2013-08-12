<div class="clear"></div>
<a href="#" class="btn-nova-perg btn btn-small">Nova Pergunta</a>
<a href="#" class="btn-guarda-perg btn btn-small btn-success" style="display: none;">Guardar</a>
<a href="#" class="btn-cancel-perg btn btn-small btn-danger" style="display: none;">Cancelar</a>

<textarea class="template-resposta" style="display: none;" rows="0" cols="0">
    <li>
        <label></label>
        <input type="text" name="Resposta[][]" class="txt-resposta" placeholder="Resposta"/>
        <?php echo CHtml::button('D', array('class'=>'btn btn-small btn-danger','onclick'=>'delResposta(this);')); ?>
    </li>
</textarea>
<textarea class="template-pergunta" style="display: none;" rows="0" cols="0">
    <div class="pergunta nova-pergunta">
        <input type="text" class="txt-pergunta" name="Pergunta[]" placeholder="Pergunta"/>
        <label class="title-pergunta"></label>
        <?php echo CHtml::button('D', array('style'=>'float:right;margin-right:10px;','class'=>'btn btn-small btn-danger','onclick'=>'delPergunta(this);')); ?>
        <?php echo CHtml::button('E', array('style'=>'float:right;margin-right:5px;','class'=>'btn btn-small','onclick'=>'editPergunta(this);')); ?>
        <?php echo CHtml::button('S', array('style'=>'float:right;margin-right:23px;','class'=>'save-pergunta btn btn-small btn-success','onclick'=>'guardaPergunta(this);')); ?>
        <ul class="respostas">
        </ul>
        <a href="#" class="nova-resposta" onclick="novaResposta(this);">Adicionar Resposta</a>
    </div>
</textarea>

<div class="perguntas">
    <?php foreach ($perguntas as $key=> $pergunta): ?>
        <div class="pergunta">
            <input type="text" style="display:none;" class="txt-pergunta" name="Pergunta[]" placeholder="Pergunta" value="<?php echo $pergunta->PERGUNTA;?>"/>
            <label class="title-pergunta"><?php echo $pergunta->PERGUNTA;?></label>
            <?php echo CHtml::button('D', array('style'=>'float:right;margin-right:10px;','class'=>'btn btn-small btn-danger','onclick'=>'delPergunta(this);')); ?>
            <?php echo CHtml::button('E', array('style'=>'float:right;margin-right:5px;','class'=>'btn btn-small','onclick'=>'editPergunta(this);')); ?>
            <?php echo CHtml::button('S', array('style'=>'display:none;float:right;margin-right:23px;','class'=>'save-pergunta btn btn-small btn-success','onclick'=>'guardaPergunta(this);')); ?>
            <ul class="respostas">
                <?php foreach ($pergunta->getRespostas() as $resposta): ?>
                    <li>
                        <label><?php echo $resposta->RESPOSTA; ?></label>
                        <input style="display:none;" type="text" name="Resposta[<?php echo $key;?>][]" class="txt-resposta" placeholder="Resposta" value="<?php echo $resposta->RESPOSTA; ?>"/>
                        <?php echo CHtml::button('D', array('style'=>'display:none;','class'=>'btn btn-small btn-danger','onclick'=>'delResposta(this);')); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <a href="#" style="display:none;" class="nova-resposta" onclick="novaResposta(this);">Adicionar Resposta</a>
        </div>
    <?php endforeach; ?>
</div>

<script language="javascript">
    
    var novo=false;
    
    $('.btn-nova-perg').click(function(){
        
        if(!novo){
            novo=true;
            $(this).attr("disabled", "disabled");
            $('.btn-cancel-perg').show();
            $('.btn-guarda-perg').show();
            
            novaPergunta();
        }
        
        return false;
    });
    
    $('.btn-cancel-perg').click(function (){
        $('.nova-pergunta').remove();
        cancelPergunta();
    });
    
    $('.btn-guarda-perg').click(function (){
        guardaPergunta();
        cancelPergunta();
    });
    
    function novaPergunta(){
        
        var template = $('.template-pergunta').val();
        $(".perguntas").prepend(template);
        
        var pergunta = $('.pergunta').first();
        $(pergunta).children('.txt-pergunta').focus();
        $(pergunta).children('label').hide();
        $(pergunta).children('input[type="button"]').hide();
        
        
    }
    
    function guardaPergunta(elem){
        
        if(elem)
            var pergunta = $(elem).parent('.pergunta');
        else
            var pergunta = $('.pergunta').first();
        
        $(pergunta).children('.title-pergunta').html($(pergunta).children('.txt-pergunta').val());
        $(pergunta).children('input').hide();
        $(pergunta).children('.nova-resposta').hide();
        
        $(pergunta).children('label').show();
        $(pergunta).children('input[type="button"]').show();
        
        $(pergunta).children('.save-pergunta').hide();
                
        $(pergunta).removeClass('nova-pergunta');
        
        $(pergunta).children('ul').children('li').each(function(){
            $(this).children('label').show();
            $(this).children('input').hide();
            $(this).children('label').html($(this).children('input[type="text"]').val());
        });
        enumeraTexts();
    }
    
    function enumeraTexts()
    {
        var num=0;
        $('.pergunta').each(function(){
            
            $(this).children('ul').children('li').each(function(){
                $(this).children('input').attr('name','Resposta['+num+'][]');
            });
            num++;
        });
    }
    
    function cancelPergunta(){
        novo=false;
        $('.btn-nova-perg').removeAttr("disabled");
        $('.btn-cancel-perg').hide();
        $('.btn-guarda-perg').hide();
    }
    
    function editPergunta(elem){
        
        var pergunta= $(elem).parent('.pergunta');
        
        $(pergunta).children('.nova-resposta').show();
        $(pergunta).children('.txt-pergunta').show();
        
        $(pergunta).children('.title-pergunta').hide();
        $(pergunta).children('input[type="button"]').hide();

        $(pergunta).children('.save-pergunta').show();
        
        $(pergunta).children('ul').children('li').each(function(){
            $(this).children('label').hide();
            $(this).children('input').show();
            $(this).children('input[type="button"]').show();
        });
    }
    
    function delPergunta(elem){
        $(elem).parent('.pergunta').remove();
    }
    
    function novaResposta(elem){
                
        var template = $('.template-resposta').val();
        
        var pergunta = $(elem).parent('.pergunta').first();
        $(pergunta).children(".respostas").append(template);
        
        $(pergunta).find('.txt-resposta').last().focus();
        
        return false;
    }
    
    function delResposta(elem){        
        $(elem).parent('li').remove();
    }
            
</script>

<style>    
    .perguntas{
        width: 100%;
        min-height: 150px;
        overflow: hidden;
    }    
    .perguntas .pergunta{
        margin: 15px 0;
        width: 99%;
        min-height: 50px;
        border: 1px solid #DFDFDF;
        background: #E9E9E9;
        background: -moz-linear-gradient(top, #E9E9E9 0%, #EAEAEA 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#E9E9E9), color-stop(100%,#EAEAEA));
        background: -webkit-linear-gradient(top, #E9E9E9 0%,#EAEAEA 100%);
        background: -o-linear-gradient(top, #E9E9E9 0%,#EAEAEA 100%);
        background: -ms-linear-gradient(top, #E9E9E9 0%,#EAEAEA 100%);
        background: linear-gradient(top, #E9E9E9 0%,#EAEAEA 100%);
        border-radius: 5px;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        padding: 10px 0;
    }
    .perguntas .pergunta input.txt-pergunta{
        margin-left: 10px;
        width: 91.5%;
        font-weight: bold;
    }
    .perguntas .pergunta input[type="text"]{
        background: #E9E9E9;
        border: 1px solid #e5e4e4;
        border-radius: 0;
        -moz-border-radius: 0;
        -webkit-border-radius: 0; 
        box-shadow: none;
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        font-size: 12px;
    }
    .perguntas .pergunta input[type="text"]:focus{
        background:#fff; 
        border: 1px dashed #ccc;
    }
    .perguntas .pergunta ul.respostas{
        padding-left: 35px;
        list-style: circle;
        width: 100%;
        overflow: hidden;
    }
    .perguntas .pergunta ul.respostas li{
        list-style: circle;
    }
    .perguntas .pergunta ul.respostas .txt-resposta{
        margin: 2px 0;
        width: 86%;
    }
    .perguntas .pergunta a.nova-resposta{
        color: #1b6c83;
        text-decoration: underline;
        font-size: 12px;
        margin-left: 45px;
    }
    .perguntas .pergunta label.title-pergunta{
        margin-left: 10px;
        font-weight: bold;
        width: 80%;
        float: left;
        font-size: 12px;
    }
    .perguntas .pergunta ul.respostas li label{
        font-size: 12px;
    }
    
</style>