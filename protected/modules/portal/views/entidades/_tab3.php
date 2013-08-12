
<div class="clear"></div>
<div class="lista">
    <ul>
        <?php foreach ($locais as $key => $local): ?>
        
            <li class="<?php echo (!$model->isNewRecord)?($local->isEntidade($model->ID_ENT))?"active":"":""; ?>">
                <input class="local-<?php echo $local->ID_LOC; ?>" type="hidden" name="LocalEntidade[<?php echo $local->ID_LOC; ?>]" value="<?php echo (!$model->isNewRecord)?($local->isEntidade($model->ID_ENT))?"1":"0":""; ?>"/>
                <a href="" rel="local-<?php echo $local->ID_LOC; ?>" >
                    <span><?php echo $local->NOME; ?></span>
                    <p><?php echo $local->RUA; ?>, <?php echo $local->CODIGO_POSTAL; ?> <br> 
                       <?php echo $local->LOCALIDADE; ?>-<?php echo $local->CIDADE; ?></p>
                </a>
            </li>
        
        <?php endforeach; ?>
    </ul>
</div>


<style>
 .lista{
        width: 460px;
        height: 250px;
        border: 1px solid #DFDFDF;
        background: #E9E9E9;
        background: -moz-linear-gradient(top, #E9E9E9 0%, #EAEAEA 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#E9E9E9), color-stop(100%,#EAEAEA));
        background: -webkit-linear-gradient(top, #E9E9E9 0%,#EAEAEA 100%);
        background: -o-linear-gradient(top, #E9E9E9 0%,#EAEAEA 100%);
        background: -ms-linear-gradient(top, #E9E9E9 0%,#EAEAEA 100%);
        background: linear-gradient(top, #E9E9E9 0%,#EAEAEA 100%);
        border-radius: 3%;
        -moz-border-radius: 3%;
        -webkit-border-radius: 3%;
        margin-top: 15px;
    }
    .lista ul{
        margin: 0;
    }
    .lista ul li{
        padding: 5px 10px;
    }
    .lista ul li a{
        color: black;
        background: #FAFAFA;
        background: -moz-linear-gradient(top, #FAFAFA 0%, #DFDFDF 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#FAFAFA), color-stop(100%,#DFDFDF));
        background: -webkit-linear-gradient(top, #FAFAFA 0%,#DFDFDF 100%);
        background: -o-linear-gradient(top, #FAFAFA 0%,#DFDFDF 100%);
        background: -ms-linear-gradient(top, #FAFAFA 0%,#DFDFDF 100%);
        background: linear-gradient(top, #FAFAFA 0%,#DFDFDF 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fafafa', endColorstr='#dfdfdf',GradientType=0 );
        border: 1px solid #DFDFDF;
        transition: all 0.1s ease-in-out;
        -moz-transition: all 0.1s ease-in-out;
        -webkit-transition: all 0.1s ease-in-out;
        box-shadow: 0 2px 3px #B5B5B5, 0px 1px 0 white inset;
        -webkit-box-shadow: 0 2px 3px #B5B5B5, 0px 1px 0 white inset;
        -moz-box-shadow: 0 2px 3px #b5b5b5, 0px 1px 0 #fff inset;
        border-radius: 5%;
        -moz-border-radius: 5%;
        -webkit-border-radius: 5%;
        display: block;
        padding: 4px 8px;
        text-decoration: none;
    }
    .lista ul li.active a, .lista ul li a:active  {
        box-shadow: none;
        background: #f4f4f4;
        background: -moz-linear-gradient(top,  #f4f4f4 0%, #f7f7f7 100%);
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#f2f2f2), color-stop(100%,#f7f7f7));
        background: -webkit-linear-gradient(top,  #f4f4f4 0%,#f7f7f7 100%);
        background: -o-linear-gradient(top,  #f4f4f4 0%,#f7f7f7 100%);
        background: -ms-linear-gradient(top,  #f4f4f4 0%,#f7f7f7 100%);
        background: linear-gradient(top,  #f4f4f4 0%,#f7f7f7 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f4f4f4', endColorstr='#f7f7f7',GradientType=0 );
    }
    .lista ul li span{
        font-weight: bold;
    }
    .lista ul li p{
        font-size: 11px;
        color: #666;
        line-height: 12px;
        margin-top: 5px;
    }
</style>

<script language="javascript">

    $('.lista ul li a').click(function(){

        var parent= $(this).parent('li');
        
        if(parent.hasClass('active'))
        {
             parent.removeClass('active');
             $("."+$(this).attr('rel')).val("0");
        }else{
             parent.addClass('active');
             $("."+$(this).attr('rel')).val("1");
        }
        
        return false;
    });
    
   
</script>