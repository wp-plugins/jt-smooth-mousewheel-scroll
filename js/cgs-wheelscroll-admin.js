jQuery(document).ready(function($){"use strict";
   
	var kor = new Array();
    	kor[0] = $("#all_device").next("label").text();
    	kor[1] = $("#no_mac").next("label").text();
    	kor[2] = $("#disable").next("label").text();
   		kor[3] = $("#easing_plugin").next("label").html();
   		kor[4] = $("#ps_plugin").html();
   		kor[5] = $(".scroll_option span").eq(0).text();
   		kor[6] = $(".scroll_option span").eq(1).text();
   		kor[7] = $(".scroll_option span").eq(2).text();
   		kor[8] = $(".scroll_option span").eq(3).text();
   		kor[9] = $(".scroll_option span").eq(4).text();
   		kor[10] = $(".scroll_option span").eq(5).text();
   		kor[11] = $(".scroll_option span").eq(6).text();
   		kor[12] = $(".scroll_option span").eq(7).text();
   		kor[13] = $(".scroll_option span").eq(8).text();
   		kor[14] = $(".scroll_option span").eq(9).text();
   		kor[15] = $("#submit p").html();
   		
    $("#translation_button").click(function(){
    	if($("#cgs_setting_page").attr("data-lang") == "kor"){
    		$(this).text("KOR");
    		$("#cgs_setting_page").attr("data-lang", "eng");
    		$("#all_device").next("label").text("Using all");
    		$("#no_mac").next("label").text("Do not use the mac OS");
    		$("#disable").next("label").text("Disable all");
    		$("#easing_plugin").next("label").html("Activate 'jQuery Easing Plugin' <span class=\"default\">Version: 1.3</span>");
    		$("#ps_plugin").html("<i class=\"fa fa-question-circle\"></i> If you use the 'jQuery Easing Plugin', you can give the effect to move the motion that you use the scroll wheel.");
    		$(".scroll_option span").eq(0).text("Scroll moving distance of the mouse wheel");
    		$(".scroll_option span").eq(1).text("px");
    		$(".scroll_option span").eq(2).text("(default : 300)");
    		$(".scroll_option span").eq(3).text("Scrolling speed of the mouse wheel");
    		$(".scroll_option span").eq(4).text("ms");
    		$(".scroll_option span").eq(5).text("(default : 600)");
    		$(".scroll_option span").eq(6).text("The motion of the animation when you scroll");
    		$(".scroll_option span").eq(7).text("");
    		$(".scroll_option span").eq(8).text("(default : easeOutQuart)");
    		$(".scroll_option span").eq(9).text("Motion effects example");
    		$("#submit p").html("<i class=\"fa fa-check\"></i>save");
    	}else{
    		$(this).text("ENG");
    		$("#cgs_setting_page").attr("data-lang", "kor");
    		$("#all_device").next("label").text(kor[0]);
    		$("#no_mac").next("label").text(kor[1]);
    		$("#disable").next("label").text(kor[2]);
    		$("#easing_plugin").next("label").html(kor[3]);
    		$("#ps_plugin").html(kor[4]);
    		$(".scroll_option span").eq(0).text(kor[5]);
    		$(".scroll_option span").eq(1).text(kor[6]);
    		$(".scroll_option span").eq(2).text(kor[7]);
    		$(".scroll_option span").eq(3).text(kor[8]);
    		$(".scroll_option span").eq(4).text(kor[9]);
    		$(".scroll_option span").eq(5).text(kor[10]);
    		$(".scroll_option span").eq(6).text(kor[11]);
    		$(".scroll_option span").eq(7).text(kor[12]);
    		$(".scroll_option span").eq(8).text(kor[13]);
    		$(".scroll_option span").eq(9).text(kor[14]);
    		$("#submit p").html(kor[15]);
    	}
    });
	   
    $("#cgs_setting_page .script_option ul li input").change(function(){
        if($(this).attr("checked") == "checked"){
            $(this).parent().addClass("check");
            $(".scroll_option ul li").last().slideDown(300);
        }else{
            $(this).parent().removeClass("check");
            $(".scroll_option ul li").last().slideUp(300);
        }
    });
   
    $("#cgs_setting_page .option_submit p").click(function(){
        if($("#scroll_size").val() == "") $("#scroll_size").attr("value", 300);
        if($("#scroll_speed").val() == "") $("#scroll_speed").attr("value", 600);
        document.cgs_ss_form.submit();
    });
    
    
    if($("#cgs_setting_page .script_option ul li input").attr("checked") == "checked"){
        $(".scroll_option ul li").last().css("display", "block");
    }else{
        $(".scroll_option ul li").last().css("display", "none");
    }
    
    if($("#save_ok").length > 0){
        $("#save_ok").fadeIn(200).delay(1000).fadeOut();
    }

});
