<?php 
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Removed as WP3.2 doesnt like this
 */
// check_admin_referer();
if(!current_user_can("manage_options")){
    exit;
}

if(isset($_POST['sola_nl_cron_send'])){
    $time = date("Y-m-d H:i:s",current_time('timestamp')); 
    $sola_nl_check = sola_nl_finish_camp(3, $time);
    if ( is_wp_error($sola_nl_check) ) { 
        sola_return_error($sola_nl_check);  
    } else {
        echo "<div id=\"message\" class=\"updated\"><p>".__("Campaign Ready to Send","sola")."</p></div>";
    }
    if (function_exists('sola_nl_add_subs_to_camp_pro')) {
        sola_nl_add_subs_to_camp_pro(intval($_GET['camp_id']));
    } else { 
        sola_nl_add_subs_to_camp(intval($_GET['camp_id']));
    }
    header("location:" . admin_url("admin.php?page=sola-nl-menu") );
    

    
} else if(isset($_POST['sola_nl_save_automatic'])){
    $time = date("Y-m-d H:i:s",current_time('timestamp')); 
    $sola_nl_check = sola_nl_finish_camp(3, $time);
    if ( is_wp_error($sola_nl_check) ) { 
        sola_return_error($sola_nl_check);  
    } else {
        echo "<div id=\"message\" class=\"updated\"><p>".__("Automatic campaign saved","sola")."</p></div>";
    }
    header("location:" . admin_url("admin.php?page=sola-nl-menu") );
    
}else if(isset($_POST['schedule_send'])){
    if($_POST['schedule_date'] == ''){
        $the_date = date("Y-m-d H:i:s",current_time('timestamp')); 
    } else {
        $the_date = sanitize_text_field($_POST['schedule_date']);
    }
    $schedule_format = $the_date . " " . intval($_POST['schedule_hour']) . ":" . intval($_POST['schedule_minutes']) . ":00";
    $sola_nl_check = sola_nl_finish_camp(3, $schedule_format);
    if ( is_wp_error($sola_nl_check) ) { 
        sola_return_error($sola_nl_check);  
    } else {
        echo "<div id=\"message\" class=\"updated\"><p>".__("Campaign Ready to Send","sola")."</p></div>";
    }
    sola_nl_add_subs_to_camp(intval($_GET['camp_id']));
    header("location:" . admin_url("admin.php?page=sola-nl-menu") );
}

    