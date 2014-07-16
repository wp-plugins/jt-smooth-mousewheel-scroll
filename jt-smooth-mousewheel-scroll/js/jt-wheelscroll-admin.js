jQuery(document).ready(function($){"use strict";
   
    $("#jt_cgs_setting_page .script_option ul li input").change(function(){
        if($(this).attr("checked") == "checked"){
            $(this).parent().addClass("check");
            $(".scroll_option ul li").last().slideDown(300);
        }else{
            $(this).parent().removeClass("check");
            $(".scroll_option ul li").last().slideUp(300);
        }
    });
   
    $("#jt_cgs_setting_page .option_submit p").click(function(){
        if($("#scroll_size").val() == "") $("#scroll_size").attr("value", 300);
        if($("#scroll_speed").val() == "") $("#scroll_speed").attr("value", 600);
        document.jtcgs_ss_form.submit();
    });
    
    
    if($("#jt_cgs_setting_page .script_option ul li input").attr("checked") == "checked"){
        $(".scroll_option ul li").last().css("display", "block");
    }else{
        $(".scroll_option ul li").last().css("display", "none");
    }
    
    if($("#save_ok").length > 0){
        $("#save_ok").fadeIn(300).delay(800).fadeOut();
    }

});
