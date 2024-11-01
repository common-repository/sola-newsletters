<?php

if(version_compare(get_bloginfo('version'),'5.0', '>=') ){
/**
* Registers gutenberg block for registration forms
**/
function sola_newsletters_gutenberg_block() {
 
 wp_register_style(
     'sola-newsletters-gutenberg-editor',
     PLUGIN_DIR.'/includes/blocks/gutenberg-block/editor.css',
     array( 'wp-edit-blocks' )
  
 );

 wp_register_style(
     'sola-newsletters-gutenberg-style',
     PLUGIN_DIR. '/includes/blocks/gutenberg-block/style.css',
     array( )
     
 );
 wp_register_script(
     'sola-newsletters-gutenberg-js',
     PLUGIN_DIR. '/includes/blocks/gutenberg-block/block.js',
     array(
        'wp-blocks', 
        'wp-element', 
        'wp-components', 
        'wp-editor'
     )
 );

 register_block_type( 'sola-registration-form-gutenberg-block/sola-newsletters-gutenberg-registration-form', array(
     'style' => 'sola-newsletters-gutenberg-style',
     'editor_style' => 'sola-newsletters-gutenberg-editor',
     'editor_script' => 'sola-newsletters-gutenberg-js',
      'attributes' => array(
          'sola' => array(
                'type' => 'string'
                    ),
            'alignment' => array(
                'type' => 'string',
                'default' => 'center'
            ),

            'submit_button_color' => array(
                'type' => 'string'
            ),

            'color_text_submit_button' => array(
                'type' => 'string'
            ),
        ),
       'render_callback' => 'sl_newsletters_gutenberg_render'
    ));

    //localize advance setting button
    $site_parameters = array(
        'advanced_setting_button' => 'admin.php?page=sola-nl-menu-settings',
        );
    wp_localize_script( 'sola-newsletters-gutenberg-js', 'sola_nl_gutenberg_sub_form', $site_parameters );
    wp_enqueue_script( 'sola-newsletters-gutenberg-js' );
}


function sl_newsletters_gutenberg_render($attributes){


    // Text Align
    $txt_align = '';
     if(!empty($attributes['alignment'])){
       $txt_align = 'style = "text-align:' . $attributes['alignment'] . ';"';
     }

     // Button color
     $inline_style = '';
     if(!empty($attributes['submit_button_color'])){
     $inline_style = '<style>.sola_nl_signup_btn[type="submit"] { background: ' . $attributes['submit_button_color'] . ';}</style>';
     }

    // Button color
    if(!empty($attributes['color_text_submit_button']) ){
    $inline_style .= '<style>.sola_nl_signup_btn[type="submit"] { color:' . $attributes['color_text_submit_button'] . ';}</style>';
    }

 
    $attributes = $inline_style . "<div $txt_align>" . do_shortcode('[sola_nl_sign_up]') . "</div>";
    return  $attributes;
}
}
add_action( 'init', 'sola_newsletters_gutenberg_block' );