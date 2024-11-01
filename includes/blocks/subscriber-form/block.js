/* BLOCK: Sola Newsletters Subsriber Sign-up form */

 function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

( function() {
	var __ = wp.i18n.__;
	var el = wp.element.createElement;
	var children = wp.blocks.source.children;
	var registerBlockType = wp.blocks.registerBlockType;
	var sola_nl_nonce = getCookie('sola_nl');

	registerBlockType( 'sola-newsletters/subscriber-form', {
		title: __( 'Sola Newsletter - Subscriber Form', 'SOLA_NL' ),
		icon: 'admin-users',
		category: 'common',

		edit: function( props ) {
			output_title = el(
				'h3',
				{ }, 
				'Newsletter'
			);

			output_form_row_name_label = el(
				'label',
				{
					className: 'sub_name_label'
				}, 
				'Name:'
			);
			output_form_row_name_input = el(
				'input',
				{	
					type: 'text',
					name: 'sub_name',
					className: 'sub_name_input' 
				}
			);

			output_form_row_name = el(
				'div',
				{ className: 'sola_sign_up_form_row' }, 
				output_form_row_name_label,
				output_form_row_name_input
			);

			// Email Input
			output_form_row_email_label = el(
				'label',
				{
					className: 'sub_email_label'
				}, 
				'Email:'
			);
			output_form_row_email_input = el(
				'input',
				{ 
					type: 'text',
					name: 'sub_email',
					className: 'sub_email_input'
				}
			);

			output_form_row_email = el(
				'div',
				{ className: 'sola_sign_up_form_row' }, 
				output_form_row_email_label,
				output_form_row_email_input
			);

			output_hidden_input_action = el(
				'input',
				{ 
					type: 'hidden',
					name: 'action',
					value: 'sola_nl_sign_up_add_sub'
				}
			);
			output_hidden_input_security = el(
				'input',
				{ 
					type: 'hidden',
					name: 'security',
					value: sola_nl_nonce
				}
			);

			output_hidden_div = el(
				'div',
				{ 
					style: {
						display: 'none'
					},
				}, 
				output_hidden_input_action,
				output_hidden_input_security
			);

			output_submit_button = el(
				'input',
				{ 
					type: 'submit',
					value: 'Subscribe',
					className: 'subscriber_submit_btn'
				}
			);
			output_submit_button_div = el(
				'div',
				{ }, 
				output_submit_button
			);

			output_form = el(
				'div',
				{ className: 'sola_nl_sub_form' }, 
				output_form_row_name,
				output_form_row_email,
				output_hidden_div,
				output_submit_button_div
			);

			output_title_div = el(
				'div',
				{ id: 'sola_nl_title' }, 
				output_title,
				output_form
			);
			

			return el(
				'div', // Tag type.
				{ className: 'sola_nl_sign_up_box'},
				output_title_div
			);
		},

		// The "save" property must be specified and must be a valid function.
		save: function( props ) {
			//jQuery('.subscriber_form').html( '<div>manamabob<b></b></div>');
			//var output = document.createElement("p");
			//output.innerHTML = "Text.";
			// Creates a <p class='wp-block-gb-basic-01'></p>.
			output_title = el(
				'h3',
				{ }, 
				'Newsletter'
			);

			output_form_row_name_label = el(
				'label',
				{
					className: 'sub_name_label'
				}, 
				'Name:'
			);
			output_form_row_name_input = el(
				'input',
				{	
					type: 'text',
					name: 'sub_name',
					className: 'sub_name_input' 
				}
			);

			output_form_row_name = el(
				'div',
				{ className: 'sola_sign_up_form_row' }, 
				output_form_row_name_label,
				output_form_row_name_input
			);

			// Email Input
			output_form_row_email_label = el(
				'label',
				{
					className: 'sub_email_label'
				}, 
				'Email:'
			);
			output_form_row_email_input = el(
				'input',
				{ 
					type: 'text',
					name: 'sub_email',
					className: 'sub_email_input'
				}
			);

			output_form_row_email = el(
				'div',
				{ className: 'sola_sign_up_form_row' }, 
				output_form_row_email_label,
				output_form_row_email_input
			);

			output_hidden_input_action = el(
				'input',
				{ 
					type: 'hidden',
					name: 'action',
					value: 'sola_nl_sign_up_add_sub'
				}
			);
			output_hidden_input_security = el(
				'input',
				{ 
					type: 'hidden',
					name: 'security',
					value: sola_nl_nonce
				}
			);

			output_hidden_div = el(
				'div',
				{ 
					style: {
						display: 'none'
					},
				}, 
				output_hidden_input_action,
				output_hidden_input_security
			);

			output_submit_button = el(
				'input',
				{ 
					type: 'submit',
					value: 'Subscribe'
				}
			);
			output_submit_button_div = el(
				'div',
				{ }, 
				output_submit_button
			);

			output_form = el(
				'form',
				{ className: 'sola_nl_sub_form' }, 
				output_form_row_name,
				output_form_row_email,
				output_hidden_div,
				output_submit_button_div
			);

			output_title_div = el(
				'div',
				{ id: 'sola_nl_title' }, 
				output_title,
				output_form
			);
			
			return el(
				'div', // Tag type.
				{ className: 'sola_nl_sign_up_box'},
				output_title_div
			);
		},
	} );

})();
