<?php
/*
 * Plugin Name: JT Smooth Mousewheel Scroll
 * Plugin URI: http://www.studio-jt.co.kr
 * Description: 마우스 휠의 스크롤 이동을 부드럽게 합니다.
 * Version: 1.0.1
 * Author: 스튜디오 제이티 (support@studio-jt.co.kr)
 * Author URI: studio-jt.co.kr
*/

if ( !defined( 'ABSPATH' ) ) exit;



/*----------------------------------------------------------------------------
 * Uninstall Hook
 ---------------------------------------------------------------------------*/
register_uninstall_hook(__FILE__, 'jtCgs_ss_option_destroy');



/*----------------------------------------------------------------------------
 * Add Action
 ---------------------------------------------------------------------------*/
add_action('admin_menu', 'jtCgs_ss_create_menu');
add_action('admin_enqueue_scripts', 'jtCgs_ss_enqueue_scripts');
add_action('wp_footer', 'jtCgs_ss_Show_script');



/*----------------------------------------------------------------------------
 * Admin Page Script & Stylesheet
 ---------------------------------------------------------------------------*/
function jtCgs_ss_enqueue_scripts(){
    wp_enqueue_script('jtCgs_ss-wheelscroll-script', Plugins_url('/js/jt-wheelscroll-admin.js', __FILE__), array('jquery'), '1.0.0', true);
    wp_enqueue_style('jtCgs_ss-font-awesome', Plugins_url('/css/font-awesome.min.css', __FILE__), false, '4.1.0');
    wp_enqueue_style('jtCgs_ss-wheelscroll-style', Plugins_url('/css/jt-wheelscroll-admin.css', __FILE__), false, '1.0.1');
}



/*----------------------------------------------------------------------------
 * Admin Menu & Option setting
 ---------------------------------------------------------------------------*/
function jtCgs_ss_create_menu(){
    add_menu_page('smooth mousewheel scroll', 'Smooth Scroll', 'administrator', __FILE__, 
                'jtCgs_ss_settings_page', Plugins_url('/img/jt-icon.png', __FILE__));
                
    add_action('admin_init', 'jtCgs_ss_option_settings');
}

function jtCgs_ss_option_settings(){
    register_setting('jtCgs_ss_setting', 'jtcgs_ss_device_check');
    register_setting('jtCgs_ss_setting', 'jtcgs_ss_easing_check');
    register_setting('jtCgs_ss_setting', 'jtcgs_ss_scroll_size');
    register_setting('jtCgs_ss_setting', 'jtcgs_ss_scroll_speed');
    register_setting('jtCgs_ss_setting', 'jtcgs_ss_scroll_easing');
}



/*----------------------------------------------------------------------------
 * Plugin Option Delete
 ---------------------------------------------------------------------------*/
function jtCgs_ss_option_destroy(){
    delete_option('jtcgs_ss_device_check');
    delete_option('jtcgs_ss_easing_check');
    delete_option('jtcgs_ss_scroll_size');
    delete_option('jtcgs_ss_scroll_speed');
    delete_option('jtcgs_ss_scroll_easing');
}



/*----------------------------------------------------------------------------
 * Admin Setting Page
 ---------------------------------------------------------------------------*/
function jtCgs_ss_settings_page(){
  $device = get_option('jtcgs_ss_device_check');
  $easing_check = get_option('jtcgs_ss_easing_check');
  $size = get_option('jtcgs_ss_scroll_size');
  $speed =  get_option('jtcgs_ss_scroll_speed');
  $easing =  get_option('jtcgs_ss_scroll_easing');
?>

<?php
if($easing_check == "easing_ok") :
    $easing = $easing == "" ? "easeOutQuart" : $easing;
?>

<script>
    jQuery(document).ready(function($){
       
        $(".scroll_option option").first().remove();
        
        $(".scroll_option option").each(function(){
            if($(this).val() == "<?php echo $easing ?>"){
                $(this).prependTo(".scroll_option select");
            }
        });
    });
</script>

<?php endif; ?>

<div id="jt_cgs_setting_page">
    <header>
        <h1><span>JT</span> Smooth Mousewheel Scroll</h1>
    </header>
    <main>
        <form name="jtcgs_ss_form" method="post" action="options.php">
        <?php settings_fields('jtCgs_ss_setting'); ?>
            <div class="device_option">
                <p><input type='radio' name="jtcgs_ss_device_check" value="all_device" id="all_device" <?php if($device == "all_device" || $device == "") echo 'checked="checked"'; ?> /><label for="all_device">모두 사용</label>
                   <input type='radio' name="jtcgs_ss_device_check" value="no_mac" id="no_mac" <?php if($device == "no_mac") echo 'checked="checked"'; ?> /><label for="no_mac">MacOS 제외</label>
            </div>
            <div class="script_option">
                <ul>
                    <li <?php if($easing_check == "easing_ok") echo 'class="check"'; ?>><input type="checkbox" name="jtcgs_ss_easing_check" <?php if($easing_check == "easing_ok") echo 'checked="checked"'; ?> value="easing_ok" id="easing_plugin" /><label for="easing_plugin">'jQuery Easing Plugin'을 사용합니다. <span>Version: 1.3</span></label></li>
                </ul>
                <p><i class="fa fa-question-circle"></i>jQuery Easing Plugin을 사용하면 휠 스크롤을 통한 이동 모션에 효과를 줄 수 있습니다.</p>
                </p>
            </div>
            <div class="scroll_option">
                <ul>
                    <li><i class="fa fa-cog"></i> 마우스 휠 스크롤의 이동 거리를 <input type="number" id="scroll_size" name="jtcgs_ss_scroll_size" value="<?php if($size != "") echo $size; else echo "300"; ?>" />px 로 합니다. <span>(기본값 : 300)</span></li>
                    <li><i class="fa fa-cog"></i> 마우스 휠 스크롤의 이동 속도를 <input type="number" id="scroll_speed" name="jtcgs_ss_scroll_speed" value="<?php if($speed != "") echo $speed; else echo "600"; ?>" />ms(밀리초)로 합니다. <span>(기본값 : 600)</span></li>
                    <li><i class="fa fa-cog"></i> 스크롤 될 때 애니메이션의 모션을  
                        <select name="jtcgs_ss_scroll_easing"><option value=""></option><option value="jswing">jswing</option><option value="def">def</option><option value="easeInQuad">easeInQuad</option>
                            <option value="easeOutQuad">easeOutQuad</option><option value="easeInOutQuad">easeInOutQuad</option><option value="easeInCubic">easeInCubic</option>
                            <option value="easeOutCubic">easeOutCubic</option><option value="easeInOutCubic">easeInOutCubic</option><option value="easeInQuart">easeInQuart</option>
                            <option value="easeOutQuart">easeOutQuart</option><option value="easeInOutQuart">easeInOutQuart</option><option value="easeInQuint">easeInQuint</option>
                            <option value="easeOutQuint">easeOutQuint</option><option value="easeInOutQuint">easeInOutQuint</option><option value="easeInSine">easeInSine</option>
                            <option value="easeOutSine">easeOutSine</option><option value="easeInOutSine">easeInOutSine</option><option value="easeInExpo">easeInExpo</option>
                            <option checked="checked" value="easeOutExpo">easeOutExpo</option><option value="easeInOutExpo">easeInOutExpo</option><option value="easeInCirc">easeInCirc</option>
                            <option value="easeOutCirc">easeOutCirc</option><option value="easeInOutCirc">easeInOutCirc</option><option value="easeInElastic">easeInElastic</option>
                            <option value="easeOutElastic">easeOutElastic</option><option value="easeInOutElastic">easeInOutElastic</option><option value="easeInBack">easeInBack</option>
                            <option value="easeOutBack">easeOutBack</option><option value="easeInOutBack">easeInOutBack</option><option value="easeInBounce">easeInBounce</option>
                            <option value="easeOutBounce">easeOutBounce</option><option value="easeInOutBounce">easeInOutBounce</option>
                        </select> 로 합니다. <span>(기본값 : easeOutQuart)</span>
                        <p><i class="fa fa-question-circle"></i>모션 효과 데모 - <a href="https://jqueryui.com/resources/demos/effect/easing.html" target="_blank" title="새창">https://jqueryui.com/resources/demos/effect/easing.html</a></p>
                    </li>
                </ul>
            </div>
            <div class="option_submit">
                <p><i class="fa fa-check"></i>저장</p>
            </div>
        </form>
    </main>
    <footer>
        <h2>REFERENCE</h2>
        <p><i class="fa fa-github"></i> jQuery Easing Plugin - <a href="https://github.com/gdsmith/jquery.easing" title="새창" target="_blank">https://github.com/gdsmith/jquery.easing</a></p>
    </footer>
    
    <?php if($_GET['settings-updated'] == TRUE) : ?>
    <article id="save_ok"><p><i class="fa fa-check-circle-o"></i> 완료</p></article>
    <?php endif ?>
    
</div>

<?php
}



/*----------------------------------------------------------------------------
 * Show Plugin Script
 ---------------------------------------------------------------------------*/
function jtCgs_ss_Show_script(){
    if(wp_is_mobile() == false){
        if(get_option('jtcgs_ss_easing_check') == "easing_ok"){
            wp_enqueue_script('jtCgs_ss-easing', Plugins_url('/js/jquery.easing.1.3.min.js', __FILE__), array('jquery'), '1.3', true);
        }
        wp_enqueue_script('jtCgs_ss-show-jquery', Plugins_url('/js/jt-wheelscroll-show.js', __FILE__), array('jquery'), '1.0.1', true);
    }


    $jtCgs_ss_parmas_array = array(
        'device' => get_option('jtcgs_ss_device_check'),
        'size' => get_option('jtcgs_ss_scroll_size'),
        'speed' => get_option('jtcgs_ss_scroll_speed'),
        'easingCheck' => get_option('jtcgs_ss_easing_check'),
        'easing' => get_option('jtcgs_ss_scroll_easing')
    );
    
    wp_localize_script( 'jtCgs_ss-show-jquery', 'jtCgs_ss_parmas', $jtCgs_ss_parmas_array );
}

?>