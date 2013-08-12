$(document).ready(function() {
    
    $('.text-search').click(function(){
        $(this).animate({width:'200px'});
        $(this).parent().addClass('selected');
    });
    
    $('.text-search').blur(function(){
        $(this).animate({width:'130px'});
        $(this).parent().removeClass('selected');
    });
    
    // Blog Hover
    jQuery(".gdl-gallery-image img").hover(function(){
            jQuery(this).animate({ opacity: 0.55 }, 150);
    }, function(){
            jQuery(this).animate({ opacity: 1 }, 150);
    });
    
    // To make dropdown actually work
    // To make more unobtrusive: http://css-tricks.com/4064-unobtrusive-page-changer/
    $("#nav-select select").change(function() {
        window.location = $(this).find("option:selected").val();
    });
      
});

