(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	var style={
		insertRule:function(selector,rules,contxt)
		{
		  var context=contxt||document,stylesheet;

		  if(typeof context.styleSheets=='object')
		  {
			if(context.styleSheets.length)
			{
			  stylesheet=context.styleSheets[context.styleSheets.length-1];
			}
			if(context.styleSheets.length)
			{
			  if(context.createStyleSheet)
			  {
				stylesheet=context.createStyleSheet();
			  }
			  else
			  {
				context.getElementsByTagName('head')[0].appendChild(context.createElement('style'));
				stylesheet=context.styleSheets[context.styleSheets.length-1];
			  }
			}
			if(stylesheet.addRule)
			{
			  for(var i=0;i<selector.length;++i)
			  {
				stylesheet.addRule(selector[i],rules);
			  }
			}
			else
			{
			  stylesheet.insertRule(selector.join(',') + '{' + rules + '}', stylesheet.cssRules.length);  
			}
		  }
		}
	};

	
	wp.customize( 'current_form_id', function( setting ) {
		var valu = setting.get();

		//Radio buttons
		wp.customize( 'gravitizer_radio_field_margin_'+valu, function( value ) {
			value.bind( function( newval ) {
				$('#gform_wrapper_'+valu+' .gravitizer-radio-wrapper .mdc-form-field').css('margin-bottom', newval+'px' );
			});
		});
		wp.customize( 'gravitizer_radio_label_placement_'+valu, function( value ) {
			value.bind( function( newval ) {
				$('#gform_wrapper_'+valu+' .gravitizer-radio-wrapper .mdc-form-field>label').css('margin-top', newval+'px' );
			});
		});
		wp.customize( 'gravitizer_radio_label_size_'+valu, function( value ) {
			value.bind( function( newval ) {
				$('#gform_wrapper_'+valu+' .gravitizer-radio-wrapper .mdc-form-field>label').css('font-size', newval+'px' );
			});
		});

		//Text field and textarea
		wp.customize( 'gravitizer_textfield_placeholder_size_'+valu, function( value ) {
			value.bind( function( newval ) {
				$('#gform_wrapper_'+valu+' .mdc-text-field:not(.mdc-text-field--disabled):not(.mdc-text-field--focused) .mdc-floating-label').css('font-size', newval+'px' );
				style.insertRule(['#gform_wrapper_'+valu+' .mdc-text-field--textarea .mdc-floating-label'],  'font-size:'+newval+'px;');
			});
		});
		wp.customize( 'gravitizer_textfield_placeholder_floating_position_'+valu, function( value ) {
			value.bind( function( newval ) {
				style.insertRule(['#gform_wrapper_'+valu+' .mdc-text-field .mdc-notched-outline--upgraded .mdc-floating-label--float-above'],  'transform: translateY('+newval+'px) scale(0.75);');
			});
		});
		wp.customize( 'gravitizer_normal_textfield_placeholder_floating_position_'+valu, function( value ) {
			value.bind( function( newval ) {
				style.insertRule(['#gform_wrapper_'+valu+' .mdc-text-field:not(.mdc-text-field--outlined).mdc-text-field--with-leading-icon .mdc-floating-label--float-above'],  'transform: translateY('+newval+'px) translateX(0px) scale(0.75);');
				style.insertRule(['#gform_wrapper_'+valu+' .mdc-text-field:not(.mdc-text-field--outlined) .mdc-floating-label--float-above'],  'transform: translateY('+newval+'px) translateX(0px) scale(0.75);');
			});
		});
		wp.customize( 'gravitizer_textfield_enable_radius_'+valu, function( value ) {
			value.bind( function( newval ) {
				if(newval === 'yes') {
					style.insertRule(['#gform_wrapper_'+valu+' .mdc-text-field--outlined .mdc-notched-outline .mdc-notched-outline__leading'],  'border-radius:4px 0px 0px 4px;');
					style.insertRule(['#gform_wrapper_'+valu+' .mdc-text-field--outlined .mdc-notched-outline .mdc-notched-outline__trailing'],  'border-radius:0px 4px 4px 0px;');
				}
				else if(newval === 'no') {
					style.insertRule(['#gform_wrapper_'+valu+' .mdc-text-field--outlined .mdc-notched-outline .mdc-notched-outline__leading'],  'border-radius:0px 0px 0px 0px;');
					style.insertRule(['#gform_wrapper_'+valu+' .mdc-text-field--outlined .mdc-notched-outline .mdc-notched-outline__trailing'],  'border-radius:0px 0px 0px 0px;');
				}
			});
		});


		//Switch field
		wp.customize( 'gravitizer_switch_field_margin_'+valu, function( value ) {
			value.bind( function( newval ) {
				style.insertRule(['#gform_wrapper_'+valu+' .gravitizer-switch-wrapper'],  'margin-bottom:'+newval+'px;');
			});
		});
		wp.customize( 'gravitizer_switch_label_placement_'+valu, function( value ) {
			value.bind( function( newval ) {
				style.insertRule(['#gform_wrapper_'+valu+' .gravitizer-switch-wrapper label'],  'margin-top:'+newval+'px;');
			});
		});
		wp.customize( 'gravitizer_switch_label_size_'+valu, function( value ) {
			value.bind( function( newval ) {
				style.insertRule(['#gform_wrapper_'+valu+' .gravitizer-switch-wrapper label'],  'font-size:'+newval+'px;');
			});
		});



		// Checkbox field
		
		wp.customize( 'gravitizer_checkbox_field_margin_'+valu, function( value ) {
			value.bind( function( newval ) {
				style.insertRule(['#gform_wrapper_'+valu+' .gravitizer-checkbox-wrapper .mdc-form-field'],  'margin-bottom:'+newval+'px;');
			});
		});
		wp.customize( 'gravitizer_checkbox_label_placement_'+valu, function( value ) {
			value.bind( function( newval ) {
				style.insertRule(['#gform_wrapper_'+valu+' .gravitizer-checkbox-wrapper .mdc-form-field>label'],  'margin-top:'+newval+'px;');
			});
		});
		
		wp.customize( 'gravitizer_checkbox_label_size_'+valu, function( value ) {
			value.bind( function( newval ) {
				style.insertRule(['#gform_wrapper_'+valu+' .gravitizer-checkbox-wrapper .mdc-form-field>label'],  'font-size:'+newval+'px;');
			});
		});
		


		

		// Global styles
		wp.customize( 'gravitizer_form_wrapper_color_'+valu, function( value ) {
			value.bind( function( newval ) {
				style.insertRule(['#gform_wrapper_'+valu],  'background-color:'+newval+';');
			});
		});
		wp.customize( 'gravitizer_wrapper_padding_'+valu, function( value ) {
			value.bind( function( newval ) {
				style.insertRule(['#gform_wrapper_'+valu],  'padding:'+newval+'px;');
			});
		});
		wp.customize( 'gravitizer_field_value_color_'+valu, function( value ) {
			value.bind( function( newval ) {
				style.insertRule(['#gform_wrapper_'+valu+' .mdc-text-field:not(.mdc-text-field--disabled) .mdc-text-field__input'],  'color:'+newval+';');
				style.insertRule(['#gform_wrapper_'+valu+' .mdc-select:not(.mdc-select--disabled) .mdc-select__selected-text'],  'color:'+newval+';');
				style.insertRule(['#gform_wrapper_'+valu+' textarea'],  'color:'+newval+';');
			});
		});
	});
	
	

})( jQuery );
