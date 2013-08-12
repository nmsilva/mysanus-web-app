$(document).ready(function() {
    $(window).resize(function(){$("#content-body td").height($(window).height()-137)}).resize();
    
    $(".menu .top a").click(function(){
        var li = $(this).parent('li');
        
        $(".menu .top li").removeClass("s");
        
        li.addClass("s");
        $(".menu .links ul").hide();
        $(".menu .links ul:eq("+$(".menu .top a").index(this)+")").show();
        return false;
    });
    
    $('#forms-tab ul.tabs li a').click(function(){
        $('#active-tab').val($(this).attr('href'));
    });
    
});

$("nav li .icon-close").live("click",function(c){
    var b=$("nav li").index($(this).parents("li"));
    var a=$("nav li").size();
    $("nav li:eq("+(b+1==a?b-1:b+1)+")").click();
    $(this).parents("li").remove();
    $("#content-body iframe:eq("+b+")").remove();
    c.stopPropagation();
});

$("nav li").live("click",function(){
    var c=$("nav li").index(this);
    $("nav li").removeClass("s");
    $(this).addClass("s");
    $("#content-body iframe").hide();
    $("#content-body iframe:eq("+c+")").show()
});

function openWin(c,name){
    var b="";
    var a={c:"",i:"",t:"",r:"",par1:"",par2:"",par3:"",par4:"",par5:"",par6:"",par7:"",par8:"",par9:"",par10:"",success:function(){}};
    $.extend(a,c);
    if(a.i!="")
        a.i="icon-"+a.i;
    if(a.r!=""&&a.t=="")
        a.t=$(a.r).text();
    
    if(name)
        var n=name;
    else
        var n=a.t;

    $("nav ul").append('<li><a href="#"><strong class="icon '+a.i+'">.</strong><span>'+n+'</span><strong class="icon icon-close">.</strong></a></li>');
    
    for(i=1;i<11;i++){
        if(a["par"+i]&&typeof a["par"+i]=="object")
            b+=(b==""?"?":"&")+"par"+i+"="+$(a["par"+i]).val();
        else if(a["par"+i]!="")
            b+=(b==""?"?":"&")+"par"+i+"="+a["par"+i]
    }
    var d=document.createElement('iframe');
    d.src=a.c==""?"about:blank":a.c+b;
    d.onload=a.success;
    d.frameBorder="no";
    $("#content-body td:eq(1)").append(d);
    $("nav li:last").click();
    return d.contentWindow
}

function openDashboardWin(c,name){
    var b="";
    var a={c:"",i:"",t:"",r:"",par1:"",par2:"",par3:"",par4:"",par5:"",par6:"",par7:"",par8:"",par9:"",par10:"",success:function(){}};
    $.extend(a,c);
    if(a.i!="")
        a.i="icon-"+a.i;
    if(a.r!=""&&a.t=="")
        a.t=$(a.r).text();
    
    if(name)
        var n=name;
    else
        var n=a.t;

    
    $("nav ul", window.parent.document).append('<li><a href="#"><strong class="icon '+a.i+'">.</strong><span>'+n+'</span><strong class="icon icon-close">.</strong></a></li>');
    
    for(i=1;i<11;i++){
        if(a["par"+i]&&typeof a["par"+i]=="object")
            b+=(b==""?"?":"&")+"par"+i+"="+$(a["par"+i]).val();
        else if(a["par"+i]!="")
            b+=(b==""?"?":"&")+"par"+i+"="+a["par"+i]
    }
    var d=document.createElement('iframe');
    d.src=a.c==""?"about:blank":a.c+b;
    d.onload=a.success;
    d.frameBorder="no";
    $("#content-body td:eq(1)", window.parent.document).append(d);
    $("nav li:last", window.parent.document).click();
    return d.contentWindow
}

