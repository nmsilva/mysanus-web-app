<ul>
    <?php foreach ($list as $key => $esp): ?>
        <li class="<?php echo (!$model->isNewRecord)?($esp->isProfissional($model->ID_USER))?"active":"":""; ?>">
            <input class="elem-<?php echo $esp->ID_ESP; ?>" type="hidden" name="ProfissionalEspecialidade[<?php echo $esp->ID_ESP; ?>]" value="<?php echo (!$model->isNewRecord)?($esp->isProfissional($model->ID_USER))?"1":"0":""; ?>"/>
            <a href="" rel="elem-<?php echo $esp->ID_ESP; ?>"><?php echo $esp->NOME; ?></a>
        </li>
    <?php endforeach;?>
</ul>
<script language="javascript">
    
    $('.lista ul li a').click(function(){

        var parent= $(this).parent('li');
        
        if(parent.hasClass('active'))
        {
             $("."+$(this).attr('rel')).val("0");
             parent.removeClass('active');
        }else{
             $("."+$(this).attr('rel')).val("1");
             parent.addClass('active');
        }
        
        return false;
    });
    
</script>