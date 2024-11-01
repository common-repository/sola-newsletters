<?php 
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Removed as WP doesn't like this from WP3.2
 */
// check_admin_referer();
if(!current_user_can("manage_options")){
    exit;
}


$sola_nl_ajax_nonce = wp_create_nonce("sola_nl");
$camp_details = sola_nl_get_camp_details(intval($_GET['camp_id']));
$theme_id = $camp_details->theme_id;
if (isset($camp_details->theme_data)) {
    $theme_array = json_decode($camp_details->theme_data);
    $theme_data = sola_nl_get_theme_data(stripslashes($theme_array[0]));

}
$styles = $camp_details->styles;

?>

<script language="javascript">
    var sola_nl_nonce = '<?php echo $sola_nl_ajax_nonce; ?>';
    var sola_is_editing = false;
    var sola_is_editing_id = null;
    var camp_id = <?php echo intval($_GET['camp_id']) ?>;
</script>

<?php

$camp_type = maybe_unserialize($camp_details->automatic_data);

if(isset($camp_type['action'])) { $auto_camp_type = $camp_type['action']; } else { $auto_camp_type = '2'; } ;

$sola_nl_is_autocamp = $camp_details->type == '2' && $auto_camp_type == 3 ? true : false;

?>

<div id="sola_nl_export_dialog" style="display:none;" title="<?php _e('Theme export', 'sola_t'); ?>">
    <strong><?php _e("Theme data","sola"); ?></strong><br />
    <textarea class='sola_nl_export_textarea_data' style='width:100%; height:25%;'></textarea><br />
    <strong><?php _e("Style data","sola"); ?></strong><br />
    <textarea class='sola_nl_export_textarea_styles' style='width:100%; height:25%;'></textarea><br />
    <strong><?php _e("HTML","sola"); ?></strong><br />
    <textarea class='sola_nl_export_textarea_html' style='width:100%; height:25%;'></textarea><br />
</div>
<div class="sola-content-fixed" style="z-index:100">
    <div class="sola-header-content ">        
        <div class="sola-sidebar-header <?php echo ($sola_nl_is_autocamp ? 'sola_nl_autocamp' : '') ?>">
            <ul>
                <li class="active editor_options_header <?php if($auto_camp_type == 3){ echo 'automatic'; } else { echo 'manual'; } ?>" did="editor-content" id="content-options"><?php _e("Content","sola"); ?></li>
                <li class="editor_options_header <?php if($auto_camp_type == 3){ echo 'automatic'; } else { echo 'manual'; } ?>" did="editor-styles" id="style-options"><?php _e("Style","sola"); ?></li>
                <?php if ($sola_nl_is_autocamp) { ?>
                    <li class="editor_options_header <?php if($auto_camp_type == 3){ echo 'automatic'; } else { echo 'manual'; } ?>" did="editor-automatic" id="automatic-options"><?php _e("Options","sola"); ?></li>
                <?php } ?>
            </ul>
            
        </div>
        <div class="header-right">
            <button class="button sola_nl_open_export_dialog" style="float:left;"><?php _e("Export","sola"); ?></button>
            <a id="sola_nl_next_temp_btn" class='button-primary sola_nl_preview_btn' ><?php _e("Next","sola"); ?></a>
            <div id='sola_nl_save_text' ><?php if ($_SERVER['REMOTE_ADDR'] == "127.0.0.1") { echo "<span style='color:red'>". __("You are currently using the plugin on your localhost. Various elements such as images will NOT show up in your test or final email as they reference your hard drive which is not accessible via the web to others", 'sola'). "</span>"; } ?></div>
        </div>
    </div>
    <div class="sidebar ">
        
        <div id="editor_options">
            <div id="editor-content" class="content">
                <?php if ($camp_details->type == '2' && $auto_camp_type == 3) { ?>
                <div class="add-box sola_addable_item  sola_css_ai_text" type="automatic_content" id="auto-content">
                    <div class="add-box-title">
                        <h3><?php _e("Content","sola"); ?></h3>
                        <i class="fa fa-3x fa-file-text-o" data-toggle="tooltip" data-placement="top" title="Click and Drag"></i>
                    </div>
                </div>
                <?php } ?>
                <div class="add-box sola_addable_item sola_css_ai_text" type="text">
                    <div class="add-box-title">
                        <h3><?php _e("Text","sola"); ?></h3>
                        <i class="fa fa-3x fa-font" data-toggle="tooltip" data-placement="top" title="Click and Drag"></i>
                    </div>
                </div>
                <div class="add-box sola_css_ai_table sola_show_editior_div">
                    <div class="add-box-title">
                        <h3><?php _e("Table","sola"); ?></h3>
                        <i class="fa fa-3x fa-table" data-toggle="tooltip" data-placement="top" title="Click to Expand/Collapse"></i>
                    </div>
                    <div class="sola-extra-content" style="padding:0 20px 10px 20px;">
                        <div class="add-box" style="width:80px; height:80px; margin: 10px 10px 10px 10px;" data-toggle="tooltip" data-placement="top" title="Click and Drag">
                            <div class="add-box-title sola_addable_item" type="table" cols="2">
                                <center>
                                    <h5><?php _e("2 cols","sola"); ?></h5>
                                    <i class="fa fa-2x fa-table"></i>
                                </center>
                            </div>
                        </div>
                        <div class="add-box" style="width:80px; height:80px; margin: 10px 10px 10px 10px;" data-toggle="tooltip" data-placement="top" title="Click and Drag">
                            <div class="add-box-title sola_addable_item" type="table" cols="3">
                                <center>
                                    <h5><?php _e("3 cols","sola"); ?></h5>
                                    <i class="fa fa-2x fa-table"></i>
                                </center>
                            </div>
                        </div>
                        <div class="add-box" style="width:80px; height:80px; margin: 10px 10px 10px 10px;" data-toggle="tooltip" data-placement="top" title="Click and Drag">
                            <div class="add-box-title sola_addable_item" type="table" cols="4">
                                <center>
                                    <h5><?php _e("4 cols","sola"); ?></h5>
                                    <i class="fa fa-2x fa-table"></i>
                                </center>                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                <div class="add-box sola_show_editior_div">
                    <div class="add-box-title">
                        <h3><?php _e("Button","sola"); ?></h3>
                        <i class="fa fa-3x fa-square" data-toggle="tooltip" data-placement="top" title="Click to Expand/Collapse"></i>
                    </div>
                    <div class="sola-extra-content" style="padding:0 20px 10px 10px;">
                        
                        <div class="form-group">
                            <label>
                                <?php _e("Button Text","sola"); ?>
                            </label>
                            <input type="text" class="form-control" id="sola_nl_btn_text" value="<?php _e('Put Your Text Here', 'sola'); ?>"/>
                        </div>
                        <div class="form-group">
                            <label>
                                <?php _e("Link","sola"); ?>
                            </label>
                            <input type="text" class="form-control" id="sola_nl_btn_link" placeholder="http://www.linkhere.com"/>
                        </div>
                        <div class="sola_addable_item" type="btn" data-toggle="tooltip" data-placement="top" title="Click and Drag"><a href="" style="text-decoration:none; display: block; " class="sola_nl_btn"  id="sola_nl_btn"><?php _e('Put Your Text Here', 'sola'); ?></a></div>
                    </div>
                </div>
                
                <div class="add-box sola_show_editior_div">
                    <div class="add-box-title">
                        <h3><?php _e("Blog Post","sola"); ?></h3>
                        <i class="fa fa-3x fa-bullhorn" data-toggle="tooltip" data-placement="top" title="Click to Expand/Collapse"></i>   
                    </div>
                    <div class="sola-extra-content">
    
                         <div class="blog_post_search" id="datafetch">
                            <input type="text" id="blog_post_search" placeholder="Search.." onkeyup="sola_search_blog_posts()">
                        </div>

                        <div id="sola_nl_blog_list">
                            
                        

                        <?php

                        $i = 1;
                        $args = array( 'posts_per_page' => 10 );
                        global $post;
                        $myposts = get_posts( $args );
                        foreach ( $myposts as $post ) : 
                            setup_postdata($post);
                            $sola_feat_image_url = "";
                            if (has_post_thumbnail( $post->ID ) ): 
                                $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
                                $sola_feat_image_url = $image[0]; 
                            endif; ?>


                                <div class="sola_newsletter_addableitems" data-toggle="tooltip" data-placement="top" title="Click and Drag">
                                    
                                    <div class="sola_addable_item sola_sub_addable_item <?php if($i == 1) {?>first<?php } ?>" type="blog_post" 
                                         value="<?php echo get_the_excerpt(); ?>" 
                                         feat_image="<?php echo $sola_feat_image_url ?>" 
                                         title="<?php the_title(); ?>"
                                         post_url="<?php echo get_permalink(); ?>">
                                             <?php the_title(); ?>
                                    </div>
                                    <?php $i++ ?>
                                </div>

                        <?php

                        endforeach;
                        ?>
                        </div>
                    </div>
                </div>
                
                <div class="add-box sola_show_editior_div">
                    <div class="add-box-title">
                        <h3><?php _e("Images","sola"); ?></h3>
                        <i class="fa fa-3x fa-picture-o" data-toggle="tooltip" data-placement="top" title="Click to Expand/Collapse"></i>
                    </div>
                    <div class="sola-extra-content">
                        <center>
                            <label for="upload_image">
                                <input id="upload_image_button" class="button" type="button" value="<?php _e('Choose Image', 'sola'); ?>" />
                            </label>
                        </center>    
                        <hr/>
                        <div id="images"><!-- Images Returned from pop up box -->
                            
                            
                            <?php 
                            if (is_array($theme_array)) {
                                $dir = @stripslashes($theme_array[0])."/img/";
                                $files = scandir($dir, 1);   
                                foreach($files as $file){
                                    if($file != "." && $file != ".."){
                                        ?>
                                        <div type="image" truesrc="<?php echo $theme_array[1]; ?>/img/<?php echo $file ?>" thumbnail="<?php echo $theme_array[1]; ?>/img/<?php echo $file ?>" class="sola_addable_image ui-draggable ui-draggable-handle" style="float:left; padding:3px; margin:3px;" >

                                            <img src="<?php echo $theme_array[1]; ?>/img/<?php echo $file ?>"  width="100%" style="max-width:313px;"/>
                                        </div>
                                <?php
                                    }
                                }
                            }

                        ?>
                        </div>
                    </div>
                </div>
                
                <div class="add-box sola_show_editior_div">
                    <div class="add-box-title">
                        <h3><?php _e("Divider","sola"); ?></h3>
                        <i class="fa fa-3x fa-bars" data-toggle="tooltip" data-placement="top" title="Click to Expand/Collapse"></i>
                    </div>
                    
                    <div class="sola-extra-content">
                            <div type="divider" truesrc="" thumbnail="" class="sola_addable_hr sola_sub_addable_item" align="center"><em><?php _e("Insert divider","sola"); ?></em></div>
                        <?php 

                            $dir = PLUGIN_URL.'/images/hr';
                            $files = scandir($dir, 1);   
                            foreach($files as $file){
                                if($file != "." && $file != ".."){
                                    ?>
                            <div type="image_divider" truesrc="<?php echo PLUGIN_DIR ?>/images/hr/<?php echo $file ?>" thumbnail="<?php echo PLUGIN_DIR ?>/images/hr/<?php echo $file ?>" class="sola_addable_hr sola_sub_addable_item" data-toggle="tooltip" data-placement="top" title="Click and Drag">

                                <img src="<?php echo PLUGIN_DIR ?>/images/hr/<?php echo $file ?>"  width="100%" style="max-width:540px"/>
                            </div>
                            <?php
                                }
                            }

                        ?>
                    </div>

            
                </div>
                <div class="add-box sola_show_editior_div">
                    <div class="add-box-title">
                        <h3><?php _e("Social","sola"); ?></h3>
                        <i class="fa fa-3x fa-thumbs-up" data-toggle="tooltip" data-placement="top" title="Click to Expand/Collapse"></i>
                    </div>
                    <div class="sola-extra-content">
                        <?php 
                        $i = 1;
                        
                        $dir = PLUGIN_URL.'/images/social-icons';
                        $folders = scandir($dir, 1);
                        $social_links = get_option("sola_nl_social_links");
                        ksort($social_links);
                        $i = 1;
                        // check if there are links
                        $check = 0;
                        foreach($social_links as $social_name=>$social_link){
                            if($social_link){
                                $check = 1;
                            }
                        }
                        if($check == 1){
                            foreach ($folders as $folder) {
                                if($folder != "." && $folder != ".."){
                                    if(is_dir($dir."/".$folder)){?>
                                        <div class="sola_addable_item sola_sub_addable_item <?php if($i == 1) {?>first<?php } ?>" type="social_icons" style="padding: 5px 0; text-align: center;">
                                        <?php  $i++;
                                        foreach($social_links as $social_name=>$social_link){
                                            if($social_link != ""){ ?>
                                                <a href="<?php echo $social_link ?>" title="<?php echo $social_name ?>" target="_blank" style="display:inline-block;">
                                                    <img type="social_icon"  src="<?php echo PLUGIN_DIR ?>/images/social-icons/<?php echo $folder ?>/<?php echo $social_name ?>.png" />
                                                </a>
                                            <?php } 

                                        }  ?>
                                        </div>
                                <?php }

                                }

                            }
                        } else { ?>
                            <div style="padding-right: 10px; text-align: center;">
                                <?php _e("Please go into Sola Settings and Add links to your social Networks","sola"); ?>
                            </div> <?php
                        }
                           
                        ?>
                    </div>
                    
                </div>
                <div class="add-box sola_show_editior_div">
                    <div class="add-box-title">
                        <h3><?php _e("Shortcodes","sola"); ?></h3>
                        <i class="fa fa-3x fa-code" data-toggle="tooltip" data-placement="top" title="Click to Expand/Collapse"></i>
                    </div>
                    <div class="sola-extra-content" style="padding:0 20px 10px 10px;">
                        <div class="form-group">
                            <label>
                                <?php _e("User First Name","sola"); ?>
                            </label>
                            <input type="text" class="form-control" id="sola_nl_btn_text" readme value="<?php _e('[sola_nl_first_name]', 'sola'); ?>"/>
                        </div>
                        <div class="form-group">
                            <label>
                                <?php _e("User Last Name","sola"); ?>
                            </label>
                            <input type="text" class="form-control" id="sola_nl_btn_text" readme value="<?php _e('[sola_nl_last_name]', 'sola'); ?>"/>
                        </div>
                    </div>
                </div>
                    
                    
                   
                </div>
                <div style="clear: both"></div>
                
            </div>
            
            <div id="editor-styles" class="styles" style="display:none">
                <?php sola_get_style_editor($theme_id, $styles) ?>
            </div>
            <?php if ($camp_details->type == '2' && $auto_camp_type == 3) { ?>
            
            <div id="editor-automatic" class="content" style="display: none; text-align: left; margin: 5px;">
                <form name="automatic_options_form" id="auto_options_form">
                    <div style="text-align: center;">                        
                        <div class="add-box active" id="automatic-layout-1">
                            <input type="radio" name="automatic_layout" style="display: none;" value="layout-1" id="layout-1"/>
                            <img class="sola_auto_layout" title="<?php _e('Layout 1', 'sola'); ?>" src="<?php echo PLUGIN_DIR.'/images/automatic-post-layout-1.png'; ?>">
                        </div>
                        <div class="add-box" id="automatic-layout-2">
                            <input type="radio" name="automatic_layout" style="display: none;" value="layout-2" id="layout-2"/>
                            <img class="sola_auto_layout" title="<?php _e('Layout 2', 'sola'); ?>" src="<?php echo PLUGIN_DIR.'/images/automatic-post-layout-2.png'; ?>">
                        </div>
                        <div class="add-box" id="automatic-layout-3">
                            <input type="radio" name="automatic_layout" style="display: none;" value="layout-3" id="layout-3"/>
                            <img class="sola_auto_layout" title="<?php _e('Layout 3', 'sola'); ?>" src="<?php echo PLUGIN_DIR.'/images/automatic-post-layout-3.png'; ?>">
                        </div>
                        <div class="add-box" id="automatic-layout-4">
                            <input type="radio" name="automatic_layout" style="display: none;" value="layout-4" id="layout-4"/>
                            <img class="sola_auto_layout" title="<?php _e('Layout 4', 'sola'); ?>" src="<?php echo PLUGIN_DIR.'/images/automatic-post-layout-4.png'; ?>">
                        </div>
                    </div>
                    <div class="automatic-layouts" id="auto_options">
                
                        <p style="margin-top: 15px; ">                        
                            <input type="number" min="1" id="automatic_options_posts" name="automatic_options_posts" style="width: 50px;" value="1"/>
                            <label for="automatic_options_posts"><?php _e('Number of Posts', 'sola'); ?></label>
                        </p> 
                        <p>                        
                            <input type="number" min="1" max="3" id="automatic_options_columns" name="automatic_options_columns" style="width: 50px;" value="1"/>
                            <label for="automatic_options_posts"><?php _e('Number of Posts Per Row', 'sola'); ?></label>
                        </p> 
                        <p>                        
                            <input type="number" min="1" id="automatic_post_length" name="automatic_post_length" style="width: 50px;" value="255"/>
                            <label for="automatic_post_length"><?php _e('Length Of Excerpt (chars)', 'sola'); ?></label>
                        </p> 
                        <p>
                            <input type="checkbox" name="automatic_options_checkboxes[]" value="automatic_title" checked/>
                            <label for="automatic_title"><?php _e('Include Title', 'sola'); ?></label>
                        </p>
                        <p>
                            <input type="checkbox" name="automatic_options_checkboxes[]" value="automatic_content" checked/>
                            <label for="automatic_content"><?php _e('Include Content', 'sola'); ?></label>
                        </p>
                        <p>
                            <input type="checkbox" name="automatic_options_checkboxes[]" value="automatic_readmore" checked/>
                            <label for="automatic_readmore"><?php _e('Include "Read More" Link', 'sola'); ?></label>
                        </p>
                        <p>
                            <input type="checkbox" name="automatic_options_checkboxes[]" value="automatic_image" checked/>
                            <label for="automatic_image"><?php _e('Include Image', 'sola'); ?></label>
                        </p>                       
                        <p>
                            <input type="checkbox" name="automatic_options_checkboxes[]" value="automatic_author" checked/>
                            <label for="automatic_author"><?php _e('Include Author', 'sola'); ?></label>
                        </p>
                        <p>
                            <input type="checkbox" name="automatic_options_checkboxes[]" value="automatic_post_date" checked/>
                            <label for="automatic_post_date"><?php _e('Include Post Date', 'sola'); ?></label>
                        </p>
                        
                    </div>
                    <div class="sola_nl_beta_error">
                        <strong class="sola_nl_beta_message"><?php _e('This functionality is still in Beta. If you experience any issues please contact ', 'sola'); ?><a href='http://solaplugins.com/support-desk/' target='_BLANK'><?php _e('support', 'sola'); ?></a></strong>
                    </div>
                </form>
            </div>
            <?php } ?>
        </div>
        <div id="sola_nl_send_test">
            <input type="email" value="<?php echo get_option('admin_email')?>" class="sola-input" id="sola_nl_to_mail_test" />
            <button class="button-primary sola_send_preview"><?php _e("Send Test","sola"); ?></button>
            
        </div>
    </div>  
    
</div>
<div id="sola_newsletter_preview"> 
        <?php       
            $letter = sola_nl_get_letter(intval($_GET['camp_id']), $theme_id);
            echo $letter;
        ?>
</div>
        
<div id="sola_nl_collapsable">
    <i class="fa fa-desktop"></i>
</div>

