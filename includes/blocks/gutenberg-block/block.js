
    var el = wp.element.createElement,
	registerBlockType = wp.blocks.registerBlockType,
	ServerSideRender = wp.components.ServerSideRender,
	TextControl = wp.components.TextControl,
	InspectorControls = wp.editor.InspectorControls;

    if(typeof wp.AlignmentToolbar === undefined){
        console.log('SOLA: Outdated version of WordPress core present, block will not function as intended');
    }
    
    if(typeof wp.BlockControls === undefined){
        console.log('SOLA: Outdated version of WordPress core present, block will not function as intended');
    }


    registerBlockType( 'sola-registration-form-gutenberg-block/sola-newsletters-gutenberg-registration-form', {
        title: 'Sola Newsletters Subscription Form',
        icon: 'welcome-widgets-menus',
        category: 'widgets',

        attributes: {
            alignment: {
                type: 'string',
                default: 'center'
        },
             submit_button_color: {
                 type: 'string'
                },
             color_text_submit_button: {
                 type: 'string'
                }

          },
       
        edit: function(props){

            //functions
            function updateColor(value) {
                props.setAttributes({submit_button_color: value.hex})
            }
  
            function updateColor_2(value) {
                props.setAttributes({color_text_submit_button: value.hex})
             }
    
  
            function onChangeAlignment( updatedAlignment ) {
                props.setAttributes( { alignment: updatedAlignment } );
            }

            //Reset Colors
            jQuery(function() {
                jQuery(document).ready(function(){

                    //reset button color
                    jQuery(document).on('click', '.reset_color_button_button', function() {
                       // jQuery(".sola_nl_signup_btn").css("background","inherit");
                       props.setAttributes({submit_button_color: ' '}) ;                   
                    });

                    //reset button color
                    jQuery(document).on('click', '.reset_color_button_text', function() {
              
                        props.setAttributes({color_text_submit_button: ' '});
                    
                    });
                });
        
            });



            alignment_bar_label = el(
                  'label',
                  { class: 'advanced_setting_label'
                },
                  'Align Text'
              );

            output_color_picker_label = el(
                'label',
                { class: 'advanced_setting_label'
              },
                'Button Color'
            );

            output_color_picker_text_label = el(
                'label',
                { class: 'advanced_setting_label'
              },
                'Button Text Color'
            );

              //align setting
            alignment_bar = el(
                wp.blockEditor.AlignmentToolbar, { alignment: props.attributes.alignment, onChange: onChangeAlignment 
                
                },
                'Align Text',
            );

            //button color settings
             output_color_picker = el(
               wp.components.ColorPicker, { submit_button_color: props.attributes.submit_button_color, onChangeComplete: updateColor,
                
                },
                'Button Color',
             );
        
             output_color_picker_text = el(
                 wp.components.ColorPicker, { color_text_submit_button: props.attributes.color_text_submit_button, onChangeComplete: updateColor_2 
                
                 },
                 'Buton Text Color',
             );

            // console.log(output_color_picker_text)

             edit_advanced_functions_button = el(
                'a',
                { 
                    href: sola_nl_gutenberg_sub_form.advanced_setting_button,
                    target: '_blank',
                    className: 'button button-secondary'
                },
                'Edit advanced settings'
            );

            add_break_to_list = el("br", null);

            reset_color_button_button = el(
                'button',
                { 
                    value: '',
                    className: 'reset_color_button_button button button-secondary'
                },
                'Rest Submit button color'
                
            );

            reset_color_button_text= el(
                'button',
                { 
                    value: '',
                    className: 'reset_color_button_text button button-secondary'
                },
                'Rest Submit button text color'
                
            );

              var PanelBody = wp.components.PanelBody;


		return [

			el( ServerSideRender, {
				block: 'sola-registration-form-gutenberg-block/sola-newsletters-gutenberg-registration-form',
				attributes: props.attributes,
            } ),
            

            add_controols_to_divs = el(
                InspectorControls,
                null,

                add_controols_to_divs_2 = el(PanelBody, {
                    title: 'Sola Newsletters Widget Settings',
                    initialOpen: true,
                   
                },
                alignment_bar_label,
                alignment_bar,
                output_color_picker_label,
                output_color_picker,
                reset_color_button_button,
                add_break_to_list,
                output_color_picker_text_label,
                output_color_picker_text,
                reset_color_button_text,
                add_break_to_list,
                edit_advanced_functions_button,  
            )
               
            ),
		];
        },
        save: function(props) {
        //return null because this is being rendered by PHP (includes/gutenberg-block/index.php)
          return null;
        }
    } );
