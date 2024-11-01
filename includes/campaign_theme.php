<?php 
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Removed as WP doesn't like this since WP 3.2
 */
// check_admin_referer();
if(!current_user_can("manage_options")){
    exit;
}

$camp_id = intval($_GET['camp_id']); 
//$themes = sola_get_theme_basic();

wp_register_style( 'sola_nl_cp_jqueryui_styles', "https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css", array(), '1.1' );
wp_enqueue_style( 'sola_nl_cp_jqueryui_styles' );

wp_register_script('sola_nl_cp_jqueryui_scripts', "https://code.jquery.com/ui/1.12.1/jquery-ui.js", false);
wp_enqueue_script( 'sola_nl_cp_jqueryui_scripts' );

?>
            <!-- Just added this -->
<script type="text/javascript">
    jQuery( function() {
        jQuery( "#tabs" ).tabs();
     } );

</script>

<div class="wrap">    
    <h2><?php _e('Your Themes', "sola") ?>   </h2>
    <div id="icon-edit" class="icon32 icon32-posts-post"><br></div>
        <div id="tabs">
            <!-- Just added this -->
            <ul >
                <li><a href="#tabs-1">Themes</a></li>
                <li><a href="#tabs-2">Upload</a></li>
            </ul>
            <!-- Just added this -->
            <div id="tabs-1"> 
                <form method="post" action="<?php echo admin_url('admin.php?page=sola-nl-menu&action=theme&camp_id=' . $camp_id); ?>">
                    <input type="hidden" value="<?php echo $camp_id ?>" name="camp_id">
                    <h3>Default Themes</h3>
                    <hr>
                    <br>
                    <?php sola_nl_theme_selection(); ?>

                    <br><br>
                    <h3>Theme Store</h3>
                    <hr>
                    <br>
                    <br>
                    <div class="avail_themes_wrapper">
                        <?php sola_nl_theme_selection_available(); ?>
                        
                    </div>
                    <br>
                     <input type="submit" value="<?php _e("Next","sola"); ?>" class="button-primary button-large" name="sola_set_theme">
                 </form>  
            </div>
             <!-- Upload a theme section -->
            <div id="tabs-2"> 
                <h3><?php _e("Upload a theme","sola"); ?></h3>
                <form method="POST" enctype="multipart/form-data" name="sola_theme_upload"><input type="file" name="sola_theme_file" /><input type="submit" value="<?php _e("Upload","sola"); ?>" class="button-primary button-large" name="sola_upload_theme_btn"></form>
            </div>
        </div> 
        <br>
       
</div>
<?php include 'footer.php'; ?>