<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://codecanyon.net/user/divdojo/portfolio
 * @since      1.0.0
 *
 * @package    Gravitizer_Lite
 * @subpackage Gravitizer_Lite/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Gravitizer_Lite
 * @subpackage Gravitizer_Lite/admin
 * @author     DivDojo <divdojo@gmail.com>
 */
class Gravitizer_Lite_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Gravitizer_Lite_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Gravitizer_Lite_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/gravitizer-lite-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Gravitizer_Lite_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Gravitizer_Lite_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/gravitizer-lite-admin.js', array( 'jquery' ), $this->version, false );

	}


	// Function for automatically updating this plugin
	public function allow_auto_update( $update, $item ) {
		// Array of plugin slugs to always auto-update
		$plugins = array (
			'gravitizer-lite'
		);
		if ( in_array( $item->slug, $plugins ) ) {
			return true;
		} else {
			return $update;
		}
	}

	// Execute this function after the plugin is updated
	public function if_plugin_updated() {
		if(get_option('Gravitizer_Lite_Version') !== GRAVITIZER_LITE_VERSION) {
			// Plugin has been updated


			// Update the version
			update_option('Gravitizer_Lite_Version', GRAVITIZER_LITE_VERSION);
		}
	}


	public function gravitizer_editor_script(){
		?>
		<script type='text/javascript'>
			//Set default values for all type of fields
			function SetDefaultValues_text(field){
				field.gravitizerStatus = "no";
				field.desPlacement = 'above';
				field.iconPlacement = 'beginning';
				field.textboxType = 'normal';
			}
			function SetDefaultValues_website(field){
				field.gravitizerStatus = "no";
				field.desPlacement = 'above';
				field.iconPlacement = 'beginning';
				field.textboxType = 'normal';
			}
			function SetDefaultValues_phone(field){
				field.gravitizerStatus = "no";
				field.desPlacement = 'above';
				field.iconPlacement = 'beginning';
				field.textboxType = 'normal';
			}
			function SetDefaultValues_radio(field){
				field.gravitizerStatus = "no";
			}
			function SetDefaultValues_checkbox(field){
				field.gravitizerStatus = "no";
				field.checkboxType = 'tick';
			}
			function SetDefaultValues_address(field){
				field.gravitizerStatus = "no";
				field.textboxType = 'normal';
			}
			function SetDefaultValues_name(field){
				field.gravitizerStatus = "no";
				field.textboxType = 'normal';
			}
			function SetDefaultValues_number(field){
				field.gravitizerStatus = "no";
				field.textboxType = 'normal';
				field.desPlacement = 'above';
				field.iconPlacement = 'beginning';
			}
			function SetDefaultValues_email(field){
				field.gravitizerStatus = "no";
				field.textboxType = 'normal';
				field.desPlacement = 'above';
				field.iconPlacement = 'beginning';
			}
			function SetDefaultValues_textarea(field){
				field.gravitizerStatus = "no";
				field.desPlacement = 'above';
			}
			//adding setting to fields of type "text"
			fieldSettings.text += ', gravitizer_on_off_setting';
	 
			//binding to the load field settings event to initialize the values
			jQuery(document).on('gform_load_field_settings', function(event, field, form){

				//Display previously saved values
				jQuery('#gravitizer_on_off_setting').val(field['gravitizerStatus']);
				jQuery('#description_placement_setting').val(field['desPlacement']);
				jQuery('#icon_placement_setting').val(field['iconPlacement']);
				jQuery('#input_icon_setting').val(field['iconText']);
				jQuery('#checkbox_type_setting').val(field['checkboxType']);
				jQuery('#textbox_type_setting').val(field['textboxType']);
				jQuery('#date_appearance_setting').val(field['dateAppearance']);

				//construct parent id
				var parentId = "#field_"+field.id;
				setTimeout(() => {
					perform_gravitizer(field.type, field.gravitizerStatus, parentId);
				}, 500);
				

				//Show the gravitizer on/off switch
				if(field.type === 'select') {
					jQuery('.gravitizer_pro_setting.gravitizer_pro_select.field_setting').show();
					jQuery('.gravitizer_on_off_setting.field_setting').hide();
				}
				else if(field.type === 'date') {
					jQuery('.gravitizer_pro_setting.gravitizer_pro_date.field_setting').show();
					jQuery('.gravitizer_on_off_setting.field_setting').hide();
				}
				else {
					jQuery('.gravitizer_on_off_setting.field_setting').show();
					jQuery('.gravitizer_pro_setting.field_setting').hide();
				}
				
				jQuery('#gravitizer_on_off_setting').on("change", function(){
					perform_gravitizer(field.type, jQuery(this).val(), parentId);
				});

				function perform_gravitizer(fieldType, status, parent) {
					if(fieldType === 'text') {
						if(status === 'yes') {
							jQuery(parent+' .textbox_type_setting.field_setting').show();
							jQuery(parent+' .description_placement_setting.field_setting').show();
							jQuery(parent+' .input_icon_setting.field_setting').show();
							jQuery(parent+' .icon_placement_setting.field_setting').show();
							
							jQuery(parent+' .label_placement_setting.field_setting').hide();
							jQuery(parent+' .placeholder_setting.field_setting').hide();

							
						}
						else {
							jQuery(parent+' .textbox_type_setting.field_setting').hide();
							jQuery(parent+' .description_placement_setting.field_setting').hide();
							jQuery(parent+' .input_icon_setting.field_setting').hide();
							jQuery(parent+' .icon_placement_setting.field_setting').hide();

							jQuery(parent+' .label_placement_setting.field_setting').show();
							jQuery(parent+' .placeholder_setting.field_setting').show();
						}
					}
					else if(fieldType === 'checkbox') {
						if(status === 'yes') {
							jQuery(parent+' .checkbox_type_setting.field_setting').show();
						}
						else {
							jQuery(parent+' .checkbox_type_setting.field_setting').hide();
						}
					}
					else if(fieldType === 'address') {
						if(status === 'yes') {
							jQuery(parent+' .textbox_type_setting.field_setting').show();
							jQuery(parent+' .sub_label_placement_setting.field_setting').hide();
							
						}
						else {
							jQuery(parent+' .textbox_type_setting.field_setting').hide();
							jQuery(parent+' .sub_label_placement_setting.field_setting').show();
						}
					}
					else if(fieldType === 'name') {
						if(status === 'yes') {
							jQuery(parent+' .textbox_type_setting.field_setting').show();
							jQuery(parent+' .sub_label_placement_setting.field_setting').hide();
						}
						else {
							jQuery(parent+' .textbox_type_setting.field_setting').hide();
							jQuery(parent+' .sub_label_placement_setting.field_setting').show();
						}
					}
					else if(fieldType === 'number') {
						if(status === 'yes') {
							jQuery(parent+' .textbox_type_setting.field_setting').show();
							jQuery(parent+' .description_placement_setting.field_setting').show();
							jQuery(parent+' .input_icon_setting.field_setting').show();
							jQuery(parent+' .icon_placement_setting.field_setting').show();
							
							jQuery(parent+' .label_placement_setting.field_setting').hide();
							jQuery(parent+' .placeholder_setting.field_setting').hide();
						}
						else {
							jQuery(parent+' .textbox_type_setting.field_setting').hide();
							jQuery(parent+' .description_placement_setting.field_setting').hide();
							jQuery(parent+' .input_icon_setting.field_setting').hide();
							jQuery(parent+' .icon_placement_setting.field_setting').hide();

							jQuery(parent+' .label_placement_setting.field_setting').show();
							jQuery(parent+' .placeholder_setting.field_setting').show();
						}
					}
					else if(fieldType === 'website') {
						if(status === 'yes') {
							jQuery(parent+' .textbox_type_setting.field_setting').show();
							jQuery(parent+' .description_placement_setting.field_setting').show();
							jQuery(parent+' .input_icon_setting.field_setting').show();
							jQuery(parent+' .icon_placement_setting.field_setting').show();
							
							jQuery(parent+' .label_placement_setting.field_setting').hide();
							jQuery(parent+' .placeholder_setting.field_setting').hide();
						}
						else {
							jQuery(parent+' .textbox_type_setting.field_setting').hide();
							jQuery(parent+' .description_placement_setting.field_setting').hide();
							jQuery(parent+' .input_icon_setting.field_setting').hide();
							jQuery(parent+' .icon_placement_setting.field_setting').hide();

							jQuery(parent+' .label_placement_setting.field_setting').show();
							jQuery(parent+' .placeholder_setting.field_setting').show();
						}
					}
					else if(fieldType === 'phone') {
						if(status === 'yes') {
							jQuery(parent+' .textbox_type_setting.field_setting').show();
							jQuery(parent+' .description_placement_setting.field_setting').show();
							jQuery(parent+' .input_icon_setting.field_setting').show();
							jQuery(parent+' .icon_placement_setting.field_setting').show();
							
							jQuery(parent+' .label_placement_setting.field_setting').hide();
							jQuery(parent+' .placeholder_setting.field_setting').hide();
						}
						else {
							jQuery(parent+' .textbox_type_setting.field_setting').hide();
							jQuery(parent+' .description_placement_setting.field_setting').hide();
							jQuery(parent+' .input_icon_setting.field_setting').hide();
							jQuery(parent+' .icon_placement_setting.field_setting').hide();

							jQuery(parent+' .label_placement_setting.field_setting').show();
							jQuery(parent+' .placeholder_setting.field_setting').show();
						}
					}
					else if(fieldType === 'email') {
						if(status === 'yes') {
							jQuery(parent+' .textbox_type_setting.field_setting').show();
							jQuery(parent+' .placeholder_setting.field_setting').hide();
						}
						else {
							jQuery(parent+' .textbox_type_setting.field_setting').hide();
							jQuery(parent+' .placeholder_setting.field_setting').show();
						}
					}
					else if(fieldType === 'textarea') {
						if(status === 'yes') {
							jQuery(parent+' .placeholder_textarea_setting.field_setting').hide();
						}
						else {
							jQuery(parent+' .placeholder_textarea_setting.field_setting').show();
						}
					}
				}
			});
		</script>
		<?php
	}


	// All field settings markup
	public function gravitizer_field_settings_items($position, $form_id) {
		if($position === 0) {
		?>
			<li class="gravitizer_on_off_setting field_setting">
				<label for="gravitizer_on_off_setting" class="section_label">
				<?php esc_html_e( 'Enable Material UI for this field', 'gravitizer-lite' ); ?>
				</label>
				<select id="gravitizer_on_off_setting" onchange="SetFieldProperty('gravitizerStatus', this.value);">
					<option value="yes">Yes</option>
					<option value="no">No</option>
				</select>
			</li>
			<li class="gravitizer_pro_setting gravitizer_pro_select field_setting">
				<label class="section_label">
				<?php echo esc_html__( 'Upgrade to ', 'gravitizer-lite').'<span class="gravitizer-pro-branding"><a target="_blank" href="https://codecanyon.net/item/gravitizer-gravity-forms-material-ui-styler/26570055">Gravitizer Pro</a></span> '.esc_html__('to use Material UI for Dropdown field', 'gravitizer-lite' ); ?>
				</label>
				<div class="gravitizer-pro-demo">
					<img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ).'admin/img/dropdown.gif'; ?>">
				</div>
			</li>
			<li class="gravitizer_pro_setting gravitizer_pro_date field_setting">
				<label class="section_label">
				<?php echo esc_html__( 'Upgrade to ', 'gravitizer-lite').'<span class="gravitizer-pro-branding"><a target="_blank" href="https://codecanyon.net/item/gravitizer-gravity-forms-material-ui-styler/26570055">Gravitizer Pro</a></span> '.esc_html__('to use Material UI for Date field', 'gravitizer-lite' ); ?>
				</label>
				<div class="gravitizer-pro-demo">
					<img src="<?php echo plugin_dir_url( dirname( __FILE__ ) ).'admin/img/date.gif'; ?>">
				</div>
			</li>
			<li class="date_appearance_setting field_setting">
				<label for="date_appearance_setting" class="section_label">
				<?php esc_html_e( 'Appearance', 'gravitizer-lite' ); ?>
				</label>
				<select id="date_appearance_setting" onchange="SetFieldProperty('dateAppearance', this.value);">
					<option value="false">Below Field</option>
					<option value="true">Modal</option>
				</select>
			</li>
			<li class="textbox_type_setting field_setting">
				<label for="textbox_type_setting" class="section_label">
				<?php esc_html_e( 'Layout', 'gravitizer-lite' ); ?>
				</label>
				<select id="textbox_type_setting" onchange="SetFieldProperty('textboxType', this.value);">
					<option value="normal">Material Normal</option>
					<option value="outlined">Material Outlined</option>
				</select>
			</li>
			<li class="checkbox_type_setting field_setting">
				<label for="checkbox_type_setting" class="section_label">
				<?php esc_html_e( 'Checkbox Type', 'gravitizer-lite' ); ?>
				</label>
				<select id="checkbox_type_setting" onchange="SetFieldProperty('checkboxType', this.value);">
					<option value="switch">Switch</option>
					<option value="tick">Tick</option>
				</select>
			</li>
			<li class="color_theme_setting field_setting">
				<label for="color_theme_setting" class="section_label">
					<?php esc_html_e( 'Theme color', 'gravitizer-lite' ); ?>
				</label>
				<input id="color_theme_setting" type="text" class="color-picker" onkeyup="SetFieldProperty('colorTheme', this.value);" onchange="SetFieldProperty('colorTheme', this.value);"/>
				<div class="pickr"></div>
			</li>
			<li class="description_placement_setting field_setting">
				<label for="description_placement_setting" class="section_label">
				<?php esc_html_e( 'Description Placement', 'gravitizer-lite' ); ?>
				</label>
				<select id="description_placement_setting" onchange="SetFieldProperty('desPlacement', this.value);">
					<option value="below">Below inputs</option>
					<option value="above">Above inputs</option>
				</select>
			</li>
			<li class="primary_color_setting field_setting">
				<label for="primary_color_setting" class="section_label">
					<?php esc_html_e( 'Border primary color', 'gravitizer-lite' ); ?>
				</label>
				<input id="primary_color_setting" type="text" class="color-picker" onkeyup="SetFieldProperty('primaryColor', this.value);" onchange="SetFieldProperty('primaryColor', this.value);"/>
				<div class="pickr"></div>
			</li>
			<li class="input_color_setting field_setting">
				<label for="input_color_setting" class="section_label">
					<?php esc_html_e( 'Border focus color', 'gravitizer-lite' ); ?>
					<?php gform_tooltip( 'input_color_setting' ) ?>
				</label>
				<input id="input_color_setting" type="text" class="color-picker" onkeyup="SetFieldProperty('inputColor', this.value);" onchange="SetFieldProperty('inputColor', this.value);"/>
				<div class="pickr"></div>
			</li>
			<br>
			<li class="input_icon_setting field_setting">
				<label for="input_icon_setting" class="section_label">
					<?php esc_html_e( 'Icon name', 'gravitizer-lite' ); ?>
				</label>
				<br>
				<?php esc_html_e( 'Icon color is set to primary border color.All available icon names will be found ', 'gravitizer-lite' ); ?>
				<a href="https://material.io/resources/icons/?style=baseline" target="_blank"><?php esc_html_e( 'Here.', 'gravitizer-lite' ); ?></a><br>
				<input id="input_icon_setting" type="text"  onkeyup="SetFieldProperty('iconText', this.value);" onchange="SetFieldProperty('iconText', this.value);"/>
			</li>
			<li class="icon_placement_setting field_setting">
				<label for="icon_placement_setting" class="section_label">
				<?php esc_html_e( 'Icon Placement', 'gravitizer-lite' ); ?>
				</label>
				<select id="icon_placement_setting" onchange="SetFieldProperty('iconPlacement', this.value);">
					<option value="beginning">At the beginning</option>
					<option value="end">At the end</option>
				</select>
			</li>
		<?php
		}
	}
	
	//For modifying checkbox and radio buttons
	public function gravitizer_choices_markup($choice_markup, $choice, $field, $value) {
		
		if($field->gravitizerStatus === 'yes') {

			//In case of radio field
			if($field->type === 'radio') {
				$choice_markup = preg_replace('/<input/i', '<input class="mdc-radio__native-control"', $choice_markup, 1);
				$choice_markup = preg_replace('/<li([^>]*)>/i', '', $choice_markup);
				$choice_markup = preg_replace('/<\/li(.*)>/i', '', $choice_markup);
				$choice_markup = preg_replace('/<label(.*)>/i', '', $choice_markup);
				$input = $choice_markup;
				preg_match('/<input id.*_other.*>/i', $input, $other_input);
				if(count($other_input) > 0) {
					$other_input = $other_input[0];
				}
				else {
					$other_input = '';
				}
				$input = preg_replace('/<input id.*_other.*>/i', '', $input);
				$formId = $field->formId;

				//Get the choice id from markup using regex
				preg_match('/<input(.*?)value=\'(.*?)id=\'(.*?)\'(.*?)>/i', $choice_markup, $matches);
				$choice_id =  $matches[3];

				$colorTheme = $field->colorTheme;

				$choice_markup = sprintf( "<div class='gravitizer-radio-wrapper'><div class=\"mdc-form-field mdc-form-field-$choice_id\">
					<div class=\"mdc-radio mdc-radio-$field->id\">
					$input
					<div class=\"mdc-radio__background\">
						<div class=\"mdc-radio__outer-circle\"></div>
						<div class=\"mdc-radio__inner-circle\"></div>
					</div>
					<div class=\"mdc-radio__ripple\"></div>
					</div>
					<label for='$choice_id'>
					".$choice["text"]."
					</label>
					$other_input
				</div></div>");
				
			}
			
			//Checkbox
			else if($field->type === 'checkbox') {
				//Place the input class
				($field->checkboxType === 'tick') ? $choice_markup = preg_replace('/<input/i', '<input class="mdc-checkbox__native-control"', $choice_markup) : $choice_markup = preg_replace('/<input/i', '<input class="mdc-switch__native-control"', $choice_markup);
				$choice_markup = preg_replace('/<li([^>]*)>/i', '', $choice_markup);
				$choice_markup = preg_replace('/<\/li(.*)>/i', '', $choice_markup);
				$choice_markup = preg_replace('/<label(.*)>/i', '', $choice_markup);
				$input = $choice_markup;
				
				//Get the choice id from markup using regex
				preg_match('/<input(.*?)value=\'(.*?)id=\'(.*?)\'(.*?)>/i', $choice_markup, $matches);
				$choice_id =  $matches[3];

				

				
				$colorTheme = $field->colorTheme;

				if($field->checkboxType === 'tick') {
					$choice_markup = '<div class="gravitizer-checkbox-wrapper">
					<div class="mdc-form-field">
                    <div class="mdc-checkbox mdc-checkbox-'.$field->id.'">
                    '.$input.'
                    <div class="mdc-checkbox__background">
                        <svg class="mdc-checkbox__checkmark" viewBox="0 0 24 24">
                        <path class="mdc-checkbox__checkmark-path" fill="none" d="M1.73,12.91 8.1,19.28 22.79,4.59" />
                        </svg>
                        <div class="mdc-checkbox__mixedmark"></div>
                    </div>
                    <div class="mdc-checkbox__ripple"></div>
                    </div>
                    <label for="'.$choice_id.'">'.$choice['text'].'</label>
					</div>
					</div>';
                }
                else if($field->checkboxType === 'switch') {
					$choice_markup = '<div class="gravitizer-checkbox-wrapper">
					<div class="gravitizer-switch-wrapper">
					<div class="mdc-switch mdc-switch-'.$field->id.' mdc-switch-'.$choice_id.'">
                    <div class="mdc-switch__track"></div>
                    <div class="mdc-switch__thumb-underlay">
                      <div class="mdc-switch__thumb"></div>
                      '.$input.'
                    </div>
                  </div>
				  <label for="'.$choice_id.'">'.$choice['text'].'</label>
				  </div>
				  </div>';
				  if(!is_admin()) {
					  $choice_markup .= '
					  <script>
						mdc.switchControl.MDCSwitch.attachTo(document.querySelector(".mdc-switch-'.$choice_id.'"));
					  </script>';
				  }
				}
			}
		}
		return $choice_markup;
	}

	//For constructing textfield
	public function construct_input($layout, $unique_id, $field_label, $input_name, $input_value, $tab_index='', $additional = '', $sizeclass='') {
		($layout === 'normal') ?
		$output = '
		<div class="ginput_container gravitizer_field">
			<label class="'.$sizeclass.' mdc-text-field mdc-text-field-'.$unique_id.' mdc-text-field--normal">
				<div class="mdc-text-field__ripple"></div>
				'."<input class='mdc-text-field__input' type='text' name='{$input_name}' id='{$unique_id}' value='{$input_value}' {$tab_index} {$additional} />".'
				<span class="mdc-floating-label" >'.esc_html($field_label).'</span>
				<div class="mdc-line-ripple"></div>
			</label>
		</div>
		<script>mdc.textField.MDCTextField.attachTo(document.querySelector(".mdc-text-field-'.$unique_id.'"));</script>' :
		$output = "
		<div class='ginput_container gravitizer_field'>
			<label class=\"$sizeclass mdc-text-field mdc-text-field-{$unique_id} mdc-text-field--outlined\">
				<input class='mdc-text-field__input' type='text' name='{$input_name}' id='{$unique_id}' value='{$input_value}' {$tab_index} {$additional} />
				<div class=\"mdc-notched-outline\">
					<div class=\"mdc-notched-outline__leading\"></div>
					<div class=\"mdc-notched-outline__notch\">
						<span class=\"mdc-floating-label\" >".esc_html($field_label)."</span>
					</div>
					<div class=\"mdc-notched-outline__trailing\"></div>
				</div>
			</label>
			
		</div>
		".'<script>mdc.textField.MDCTextField.attachTo(document.querySelector(".mdc-text-field-'.$unique_id.'"));</script>';
		return $output;
	}

	// For constructing state field
	public function get_state_field($field, $state_label, $id, $field_id, $state_value, $disabled_text, $form_id ) {

		$is_entry_detail = $field->is_entry_detail();
		$is_form_editor  = $field->is_form_editor();
		$is_admin        = $is_entry_detail || $is_form_editor;

		$required_attribute     = $field->isRequired ? 'aria-required="true"' : '';

		$state_dropdown_class = $state_text_class = $state_style = $text_style = $state_field_id = '';

		if ( empty( $state_value ) ) {
			$state_value = $field->defaultState;

			// For backwards compatibility (Canadian address type used to store the default state into the defaultProvince property).
			if ( $field->addressType == 'canadian' && ! empty( $field->defaultProvince ) ) {
				$state_value = $field->defaultProvince;
			}
		}

		$address_type        = empty( $field->addressType ) ? $field->get_default_address_type( $form_id ) : $field->addressType;
		$address_types       = $field->get_address_types( $form_id );
		$has_state_drop_down = isset( $address_types[ $address_type ]['states'] ) && is_array( $address_types[ $address_type ]['states'] );

		if ( $is_admin && rgget('view') != 'entry' ) {
			$state_dropdown_class = "class='state_dropdown'";
			$state_text_class     = "class='state_text'";
			$state_style          = ! $has_state_drop_down ? "style='display:none;'" : '';
			$text_style           = $has_state_drop_down ? "style='display:none;'" : '';
			$state_field_id       = '';
		} else {
			// ID only displayed on front end.
			$state_field_id = $field_id . "_4";
		}

		$tabindex         = $field->get_tabindex();
		$state_input      = GFFormsModel::get_input( $field, $field->id . '.4' );
		$sate_placeholder = GFCommon::get_input_placeholder_value( $state_input );
		
		$states           = empty( $address_types[ $address_type ]['states'] ) ? array() : $address_types[ $address_type ]['states'];

		//Get all the values
		$temp_list = $field->get_state_dropdown( $states, $state_value, $sate_placeholder );
		preg_match_all('/value=\'([^\']*)\'/i', $temp_list, $list_matches);
		$list_matches = $list_matches[1];
		$list = '';

		//construct list using all the values
		foreach($list_matches as $value) {
			$list .= '<li class="mdc-list-item" data-value="'.$value.'">'.$value.'</li>';
		}
		
		
		$state_dropdown   = sprintf( "<select name='input_%d.4' id='%s' {$tabindex} %s {$state_dropdown_class} {$state_style} {$required_attribute}>%s</select>", $id, $state_field_id, $disabled_text, $field->get_state_dropdown( $states, $state_value, $sate_placeholder ) );
		
		

		$tabindex                    = $field->get_tabindex();
		$state_placeholder_attribute = GFCommon::get_input_placeholder_attribute( $state_input );
		$state_text = $this->construct_input($field->textboxType, $state_field_id, $state_label, 'input_'.$id.'.4', $state_value, $tabindex);

		if ( $is_admin && rgget('view') != 'entry' ) {
			return $state_dropdown . $state_text;
		} elseif ( $has_state_drop_down ) {
			return $state_dropdown;
		} else {
			return $state_text;
		}
	}

	// Custom input
	public function gravitizer_custom_input($input, $field, $value, $lead_id, $form_id ) {
		if($field->gravitizerStatus === 'yes') {
			//For text field
			if($field->type === 'text') {
				$id              = absint( $field->id );
				$is_entry_detail = $field->is_entry_detail();
				$is_form_editor  = $field->is_form_editor();

				// Prepare the value of the input ID attribute.
				$field_id = $is_entry_detail || $is_form_editor || $form_id == 0 ? "input_$id" : 'input_' . $form_id . "_$id";

				$value = esc_attr( $value );

				// Prepare the input classes.
				$size         = $field->size;
				$class_suffix = $is_entry_detail ? '_admin' : '';
				$class        = $size . $class_suffix;
				

				// Prepare the other input attributes.
				$tabindex              = $field->get_tabindex();
				$placeholder_attribute = $field->get_field_placeholder_attribute();
				$required_attribute    = $field->isRequired ? 'aria-required="true"' : '';
				$invalid_attribute     = $field->failed_validation ? 'aria-invalid="true"' : 'aria-invalid="false"';
				$disabled_text         = $is_form_editor ? 'disabled="disabled"' : '';

				// Prepare the input tag for this field.
				$input = "
				<input name='input_{$id}' id='{$field_id}' type='text' value='{$value}' class='{$class} mdc-text-field__input' {$tabindex} {$placeholder_attribute} {$required_attribute} {$invalid_attribute} {$disabled_text}/>";

				return sprintf( "%s", $input);
			}

			// For website field
			else if($field->type === 'website') {
				$is_entry_detail = $field->is_entry_detail();
				$is_form_editor  = $field->is_form_editor();

				
				$id       = intval( $field->id );
				$field_id = $is_entry_detail || $is_form_editor || $form_id == 0 ? "input_$id" : 'input_' . $form_id . "_$id";

				$size            = $field->size;
				$disabled_text   = $is_form_editor ? "disabled='disabled'" : '';
				$class_suffix    = $is_entry_detail ? '_admin' : '';
				$class           = $size . $class_suffix;
				$is_html5        = RGFormsModel::is_html5_enabled();
				$html_input_type = $is_html5 ? 'url' : 'text';

				$placeholder_attribute = $field->get_field_placeholder_attribute();
				$required_attribute    = $field->isRequired ? 'aria-required="true"' : '';
				$invalid_attribute     = $field->failed_validation ? 'aria-invalid="true"' : 'aria-invalid="false"';
				$aria_describedby      = $field->get_aria_describedby();

				$tabindex = $field->get_tabindex();
				$value    = esc_attr( $value );
				$class    = esc_attr( $class );

				$input = "
				<input name='input_{$id}' id='{$field_id}' type='text' value='{$value}' class='{$class} mdc-text-field__input' {$tabindex} {$placeholder_attribute} {$required_attribute} {$invalid_attribute} {$disabled_text}/>";

				return sprintf( "%s", $input);
			}

			// For phone field
			else if($field->type === 'phone') {
				if ( is_array( $value ) ) {
					$value = '';
				}
		
				$is_entry_detail = $field->is_entry_detail();
				$is_form_editor  = $field->is_form_editor();
		
				
				$id       = intval( $field->id );
				$field_id = $is_entry_detail || $is_form_editor || $form_id == 0 ? "input_$id" : 'input_' . $form_id . "_$id";
		
				$size          = $field->size;
				$disabled_text = $is_form_editor ? "disabled='disabled'" : '';
				$class_suffix  = $is_entry_detail ? '_admin' : '';
				$class         = $size . $class_suffix;
		
				$instruction_div = '';
				if ( $field->failed_validation ) {
					$phone_format = $field->get_phone_format();
					if ( rgar( $phone_format, 'instruction' ) ) {
						$instruction_div = sprintf( "<div class='instruction validation_message'>%s %s</div>", esc_html__( 'Phone format:', 'gravityforms' ), $phone_format['instruction'] );
					}
				}
		
				$html_input_type       = RGFormsModel::is_html5_enabled() ? 'tel' : 'text';
				$placeholder_attribute = $field->get_field_placeholder_attribute();
				$required_attribute    = $field->isRequired ? 'aria-required="true"' : '';
				$invalid_attribute     = $field->failed_validation ? 'aria-invalid="true"' : 'aria-invalid="false"';
				$aria_describedby      = $field->get_aria_describedby();
		
				$tabindex = $field->get_tabindex();
		
				
				$input = "
				<input name='input_{$id}' id='{$field_id}' type='text' value='{$value}' class='{$class} mdc-text-field__input' {$tabindex} {$placeholder_attribute} {$required_attribute} {$invalid_attribute} {$disabled_text}/>{$instruction_div}";

				return sprintf( "%s", $input);
			}


			//For name
			else if($field->type === 'name') {
				if(!is_admin()) {
					
					$is_entry_detail = $field->is_entry_detail();
					$is_form_editor  = $field->is_form_editor();
					$is_admin = $is_entry_detail || $is_form_editor;

					
					$id       = intval( $field->id );
					$field_id = $is_entry_detail || $is_form_editor || $form_id == 0 ? "input_$id" : 'input_' . $form_id . "_$id";
					$form_id  = ( $is_entry_detail || $is_form_editor ) && empty( $form_id ) ? rgget( 'id' ) : $form_id;

					$size         = $field->size;
					$class_suffix = rgget('view') == 'entry' ? '_admin' : '';
					$class        = $size . $class_suffix;

					$disabled_text = $is_form_editor ? "disabled='disabled'" : '';
					$class_suffix  = $is_entry_detail ? '_admin' : '';

					$form_sub_label_placement  = '';
					$field_sub_label_placement = $field->subLabelPlacement;
					$is_sub_label_above        = $field_sub_label_placement == 'above' || ( empty( $field_sub_label_placement ) && $form_sub_label_placement == 'above' );
					$sub_label_class_attribute = $field_sub_label_placement == 'hidden_label' ? "class='hidden_sub_label screen-reader-text'" : '';

					$prefix = '';
					$first  = '';
					$middle = '';
					$last   = '';
					$suffix = '';

					if ( is_array( $value ) ) {
						$prefix = esc_attr( GFForms::get( $field->id . '.2', $value ) );
						$first  = esc_attr( GFForms::get( $field->id . '.3', $value ) );
						$middle = esc_attr( GFForms::get( $field->id . '.4', $value ) );
						$last   = esc_attr( GFForms::get( $field->id . '.6', $value ) );
						$suffix = esc_attr( GFForms::get( $field->id . '.8', $value ) );
					}

					$prefix_input = GFFormsModel::get_input( $field, $field->id . '.2' );
					$first_input  = GFFormsModel::get_input( $field, $field->id . '.3' );
					$middle_input = GFFormsModel::get_input( $field, $field->id . '.4' );
					$last_input   = GFFormsModel::get_input( $field, $field->id . '.6' );
					$suffix_input = GFFormsModel::get_input( $field, $field->id . '.8' );

					$first_placeholder_attribute  = GFCommon::get_input_placeholder_attribute( $first_input );
					$middle_placeholder_attribute = GFCommon::get_input_placeholder_attribute( $middle_input );
					$last_placeholder_attribute   = GFCommon::get_input_placeholder_attribute( $last_input );
					$suffix_placeholder_attribute = GFCommon::get_input_placeholder_attribute( $suffix_input );

					// ARIA labels. Prefix is handled in self::get_name_prefix_field().
					$first_name_aria_label  = esc_attr__( 'First name', 'gravityforms' );
					$middle_name_aria_label = esc_attr__( 'Middle name', 'gravityforms' );
					$last_name_aria_label   = esc_attr__( 'Last name', 'gravityforms' );
					$suffix_aria_label      = esc_attr__( 'Name suffix', 'gravityforms' );
					$required_attribute     = $field->isRequired ? 'aria-required="true"' : '';
					$invalid_attribute      = $field->failed_validation ? 'aria-invalid="true"' : 'aria-invalid="false"';
					

					switch ( $field->nameFormat ) {

						case 'advanced' :
						case 'extended' :
							$prefix_tabindex = GFCommon::get_tabindex();
							$first_tabindex  = GFCommon::get_tabindex();
							$middle_tabindex = GFCommon::get_tabindex();
							$last_tabindex   = GFCommon::get_tabindex();
							$suffix_tabindex = GFCommon::get_tabindex();

							$prefix_sub_label      = rgar( $prefix_input, 'customLabel' ) != '' ? $prefix_input['customLabel'] : gf_apply_filters( array( 'gform_name_prefix', $form_id ), esc_html__( 'Prefix', 'gravityforms' ), $form_id );
							$first_name_sub_label  = rgar( $first_input, 'customLabel' ) != '' ? $first_input['customLabel'] : gf_apply_filters( array( 'gform_name_first', $form_id ), esc_html__( 'First', 'gravityforms' ), $form_id );
							$middle_name_sub_label = rgar( $middle_input, 'customLabel' ) != '' ? $middle_input['customLabel'] : gf_apply_filters( array( 'gform_name_middle', $form_id ), esc_html__( 'Middle', 'gravityforms' ), $form_id );
							$last_name_sub_label   = rgar( $last_input, 'customLabel' ) != '' ? $last_input['customLabel'] : gf_apply_filters( array( 'gform_name_last', $form_id ), esc_html__( 'Last', 'gravityforms' ), $form_id );
							$suffix_sub_label      = rgar( $suffix_input, 'customLabel' ) != '' ? $suffix_input['customLabel'] : gf_apply_filters( array( 'gform_name_suffix', $form_id ), esc_html__( 'Suffix', 'gravityforms' ), $form_id );

							$prefix_markup = '';
							$first_markup  = '';
							$middle_markup = '';
							$last_markup   = '';
							$suffix_markup = '';

							
							$style = ( $is_admin && rgar( $prefix_input, 'isHidden' ) ) ? "style='display:none;'" : '';
							if ( $is_admin || ! rgar( $prefix_input, 'isHidden' ) ) {
								$prefix_select_class = isset( $prefix_input['choices'] ) && is_array( $prefix_input['choices'] ) ? 'name_prefix_select' : '';
								$prefix_markup       = $field::get_name_prefix_field( $prefix_input, $id, $field_id, $prefix, $disabled_text, $prefix_tabindex );
								$prefix_markup       = "<span id='{$field_id}_2_container' class='name_prefix {$prefix_select_class}' {$style}>
															{$prefix_markup}
															<label for='{$field_id}_2' {$sub_label_class_attribute}>{$prefix_sub_label}</label>
														  </span>";
							}

							$style = ( $is_admin && rgar( $first_input, 'isHidden' ) ) ? "style='display:none;'" : '';
							if ( $is_admin || ! rgar( $first_input, 'isHidden' ) ) {
								$first_markup = "<span id='{$field_id}_3_container' class='has_gravitizer name_first' {$style}>
															".$this->construct_input($field->textboxType, $field_id.'_3', $first_name_sub_label, 'input_'.$id.'.3', $first, $first_tabindex)."
														</span>";
							}

							$style = ( $is_admin && ( ! isset( $middle_input['isHidden'] ) || rgar( $middle_input, 'isHidden' ) ) ) ? "style='display:none;'" : '';
							if ( $is_admin || ( isset( $middle_input['isHidden'] ) && $middle_input['isHidden'] == false ) ) {
								$middle_markup = "<span id='{$field_id}_4_container' class='has_gravitizer name_middle' {$style}>
															".$this->construct_input($field->textboxType, $field_id.'_4', $middle_name_sub_label, 'input_'.$id.'.4', $middle,  $middle_tabindex)."
														</span>";
							}

							$style = ( $is_admin && rgar( $last_input, 'isHidden' ) ) ? "style='display:none;'" : '';
							if ( $is_admin || ! rgar( $last_input, 'isHidden' ) ) {
								$last_markup = "<span id='{$field_id}_6_container' class='has_gravitizer name_last' {$style}>
															".$this->construct_input($field->textboxType, $field_id.'_6', $last_name_sub_label, 'input_'.$id.'.6', $last,  $last_tabindex)."
														</span>";
							}

							$style = ( $is_admin && rgar( $suffix_input, 'isHidden' ) ) ? "style='display:none;'" : '';
							if ( $is_admin || ! rgar( $suffix_input, 'isHidden' ) ) {
								$suffix_select_class = isset( $suffix_input['choices'] ) && is_array( $suffix_input['choices'] ) ? 'name_suffix_select' : '';
								$suffix_markup       = "<span id='{$field_id}_8_container' class='has_gravitizer name_suffix {$suffix_select_class}' {$style}>
															".$this->construct_input($field->textboxType, $field_id.'_8', $suffix_sub_label, 'input_'.$id.'.8', $suffix,  $suffix_tabindex)."
														</span>";
							}
							
							$css_class = $field->get_css_class();


							return "<div class='ginput_complex{$class_suffix} ginput_container {$css_class}' id='{$field_id}'>
										{$prefix_markup}
										{$first_markup}
										{$middle_markup}
										{$last_markup}
										{$suffix_markup}
									</div>";
						case 'simple' :
							$value                 = esc_attr( $value );
							$class                 = esc_attr( $class );
							$tabindex              = GFCommon::get_tabindex();
							$placeholder_attribute = GFCommon::get_field_placeholder_attribute( $field );

							return "<div class='ginput_container ginput_container_name'>
												".$this->construct_input($field->textboxType, $field_id, $field->label, 'input_'.$id, $value,  $tabindex)."
											</div>";
						default :
							$first_tabindex       = GFCommon::get_tabindex();
							$last_tabindex        = GFCommon::get_tabindex();
							$first_name_sub_label = rgar( $first_input, 'customLabel' ) != '' ? $first_input['customLabel'] : gf_apply_filters( array( 'gform_name_first', $form_id ), esc_html__( 'First', 'gravityforms' ), $form_id );
							$last_name_sub_label  = rgar( $last_input, 'customLabel' ) != '' ? $last_input['customLabel'] : gf_apply_filters( array( 'gform_name_last', $form_id ), esc_html__( 'Last', 'gravityforms' ), $form_id );
							
							$first_markup = '';
							$style        = ( $is_admin && rgar( $first_input, 'isHidden' ) ) ? "style='display:none;'" : '';
							if ( $is_admin || ! rgar( $first_input, 'isHidden' ) ) {
								$first_markup = "<span id='{$field_id}_3_container' class='has_gravitizer name_first' {$style}>
															".$this->construct_input($field->textboxType, $field_id.'_3', $first_name_sub_label, 'input_'.$id.'.3', $first,  $first_tabindex)."
														</span>";
							}

							$last_markup = '';
							$style       = ( $is_admin && rgar( $last_input, 'isHidden' ) ) ? "style='display:none;'" : '';
							if ( $is_admin || ! rgar( $last_input, 'isHidden' ) ) {
								$last_markup = "<span id='{$field_id}_6_container' class='has_gravitizer name_last' {$style}>
														".$this->construct_input($field->textboxType, $field_id.'_6', $last_name_sub_label, 'input_'.$id.'.6', $last,  $last_tabindex)."
													</span>";
							}
							

							$css_class = $field->get_css_class();

							return "<div class='ginput_complex{$class_suffix} ginput_container {$css_class}' id='{$field_id}'>
										{$first_markup}
										{$last_markup}
										<div class='gf_clear gf_clear_complex'></div>
									</div>";
					}
				}
				
			}

			//For number
			else if($field->type === 'number') {
				$is_entry_detail = $field->is_entry_detail();
				$is_form_editor  = $field->is_form_editor();

				
				$id       = intval( $field->id );
				$field_id = $is_entry_detail || $is_form_editor || $form_id == 0 ? "input_$id" : 'input_' . $form_id . "_$id";

				$size          = $field->size;
				$disabled_text = $is_form_editor ? "disabled='disabled'" : '';
				$class_suffix  = $is_entry_detail ? '_admin' : '';
				$class         = $size . $class_suffix;

				$instruction = '';
				$read_only   = '';
				$entry = [];
				if ( ! $is_entry_detail && ! $is_form_editor ) {

					if ( $field->has_calculation() ) {

						// calculation-enabled fields should be read only
						$read_only = 'readonly="readonly"';

					} else {

						$message          = $field->get_range_message();
						$validation_class = $field->failed_validation ? 'validation_message' : '';

						if ( ! $field->failed_validation && ! empty( $message ) && empty( $field->errorMessage ) ) {
							$instruction = "<div class='instruction $validation_class'>" . $message . '</div>';
						}
					}
				} elseif ( rgget('view') == 'entry' ) {
					$value = GFCommon::format_number( $value, $field->numberFormat, rgar( $entry, 'currency' ) );
				}

				$is_html5        = RGFormsModel::is_html5_enabled();
				$html_input_type = $is_html5 && ! $field->has_calculation() && ( $field->numberFormat != 'currency' && $field->numberFormat != 'decimal_comma' ) ? 'number' : 'text'; // chrome does not allow number fields to have commas, calculations and currency values display numbers with commas
				$step_attr       = $is_html5 ? "step='any'" : '';

				$min = $field->rangeMin;
				$max = $field->rangeMax;

				$min_attr = $is_html5 && is_numeric( $min ) ? "min='{$min}'" : '';
				$max_attr = $is_html5 && is_numeric( $max ) ? "max='{$max}'" : '';

				$include_thousands_sep = apply_filters( 'gform_include_thousands_sep_pre_format_number', $html_input_type == 'text', $field );
				
				$value                 = GFCommon::format_number( $value, $field->numberFormat, rgar( $entry, 'currency' ), $include_thousands_sep );

				$placeholder_attribute = $field->get_field_placeholder_attribute();
				$required_attribute    = $field->isRequired ? 'aria-required="true"' : '';
				$invalid_attribute     = $field->failed_validation ? 'aria-invalid="true"' : 'aria-invalid="false"';
				$aria_describedby      = $field->get_aria_describedby();

				$tabindex = $field->get_tabindex();

				$input = sprintf( "<input name='input_%d' id='%s' type='{$html_input_type}' {$step_attr} {$min_attr} {$max_attr} value='%s' class='%s  mdc-text-field__input' {$tabindex} {$read_only} %s %s %s %s %s/>%s", $id, $field_id, esc_attr( $value ), esc_attr( $class ), $disabled_text, $placeholder_attribute, $required_attribute, $invalid_attribute, $aria_describedby, $instruction );
				return $input;
			}

			//For address field
			else if($field->type === 'address') {
				if(!is_admin()) {
					$is_entry_detail = $field->is_entry_detail();
					$is_form_editor  = $field->is_form_editor();
					$is_admin        = $is_entry_detail || $is_form_editor;

					
					$id       = intval( $field->id );
					$field_id = $is_entry_detail || $is_form_editor || $form_id == 0 ? "input_$id" : 'input_' . $form_id . "_$id";
					$form_id  = ( $is_entry_detail || $is_form_editor ) && empty( $form_id ) ? rgget( 'id' ) : $form_id;

					$disabled_text      = $is_form_editor ? "disabled='disabled'" : '';
					$class_suffix       = $is_entry_detail ? '_admin' : '';
					$required_attribute = $field->isRequired ? 'aria-required="true"' : '';

					$form_sub_label_placement  = '';
					$field_sub_label_placement = $field->subLabelPlacement;
					$is_sub_label_above        = $field_sub_label_placement == 'above' || ( empty( $field_sub_label_placement ) && $form_sub_label_placement == 'above' );
					$sub_label_class_attribute = $field_sub_label_placement == 'hidden_label' ? "class='hidden_sub_label screen-reader-text'" : '';

					$street_value  = '';
					$street2_value = '';
					$city_value    = '';
					$state_value   = '';
					$zip_value     = '';
					$country_value = '';

					if ( is_array( $value ) ) {
						$street_value  = esc_attr( rgget( $field->id . '.1', $value ) );
						$street2_value = esc_attr( rgget( $field->id . '.2', $value ) );
						$city_value    = esc_attr( rgget( $field->id . '.3', $value ) );
						$state_value   = esc_attr( rgget( $field->id . '.4', $value ) );
						$zip_value     = esc_attr( rgget( $field->id . '.5', $value ) );
						$country_value = esc_attr( rgget( $field->id . '.6', $value ) );
					}

					// Inputs.
					$address_street_field_input  = GFFormsModel::get_input( $field, $field->id . '.1' );
					$address_street2_field_input = GFFormsModel::get_input( $field, $field->id . '.2' );
					$address_city_field_input    = GFFormsModel::get_input( $field, $field->id . '.3' );
					$address_state_field_input   = GFFormsModel::get_input( $field, $field->id . '.4' );
					$address_zip_field_input     = GFFormsModel::get_input( $field, $field->id . '.5' );
					$address_country_field_input = GFFormsModel::get_input( $field, $field->id . '.6' );

					// Placeholders.
					$street_placeholder_attribute  = GFCommon::get_input_placeholder_attribute( $address_street_field_input );
					$street2_placeholder_attribute = GFCommon::get_input_placeholder_attribute( $address_street2_field_input );
					$city_placeholder_attribute    = GFCommon::get_input_placeholder_attribute( $address_city_field_input );
					$zip_placeholder_attribute     = GFCommon::get_input_placeholder_attribute( $address_zip_field_input );

					$address_types = $field->get_address_types( $form_id );
					$addr_type     = empty( $field->addressType ) ? $field->get_default_address_type( $form_id ) : $field->addressType;
					$address_type  = rgar( $address_types, $addr_type );

					$state_label  = empty( $address_type['state_label'] ) ? esc_html__( 'State', 'gravityforms' ) : $address_type['state_label'];
					$zip_label    = empty( $address_type['zip_label'] ) ? esc_html__( 'Zip Code', 'gravityforms' ) : $address_type['zip_label'];
					$hide_country = ! empty( $address_type['country'] ) || $field->hideCountry || rgar( $address_country_field_input, 'isHidden' );

					if ( empty( $country_value ) ) {
						$country_value = $field->defaultCountry;
					}

					if ( empty( $state_value ) ) {
						$state_value = $field->defaultState;
					}

					$country_placeholder = GFCommon::get_input_placeholder_value( $address_country_field_input );
					$country_list        = $field->get_country_dropdown( $country_value, $country_placeholder );

					// Changing css classes based on field format to ensure proper display.
					$address_display_format = apply_filters( 'gform_address_display_format', 'default', $field );
					$city_location          = $address_display_format == 'zip_before_city' ? 'right' : 'left';
					$zip_location           = $address_display_format != 'zip_before_city' && ( $field->hideState || rgar( $address_state_field_input, 'isHidden' ) ) ? 'right' : 'left'; // support for $this->hideState legacy property
					$state_location         = $address_display_format == 'zip_before_city' ? 'left' : 'right';
					$country_location       = $field->hideState || rgar( $address_state_field_input, 'isHidden' ) ? 'left' : 'right'; // support for $this->hideState legacy property

					// Labels.
					$address_street_sub_label  = rgar( $address_street_field_input, 'customLabel' ) != '' ? $address_street_field_input['customLabel'] : esc_html__( 'Street Address', 'gravityforms' );
					$address_street_sub_label  = gf_apply_filters( array( 'gform_address_street', $form_id, $field->id ), $address_street_sub_label, $form_id );
					$address_street2_sub_label = rgar( $address_street2_field_input, 'customLabel' ) != '' ? $address_street2_field_input['customLabel'] : esc_html__( 'Address Line 2', 'gravityforms' );
					$address_street2_sub_label = gf_apply_filters( array( 'gform_address_street2', $form_id, $field->id ), $address_street2_sub_label, $form_id );
					$address_zip_sub_label     = rgar( $address_zip_field_input, 'customLabel' ) != '' ? $address_zip_field_input['customLabel'] : $zip_label;
					$address_zip_sub_label     = gf_apply_filters( array( 'gform_address_zip', $form_id, $field->id ), $address_zip_sub_label, $form_id );
					$address_city_sub_label    = rgar( $address_city_field_input, 'customLabel' ) != '' ? $address_city_field_input['customLabel'] : esc_html__( 'City', 'gravityforms' );
					$address_city_sub_label    = gf_apply_filters( array( 'gform_address_city', $form_id, $field->id ), $address_city_sub_label, $form_id );
					$address_state_sub_label   = rgar( $address_state_field_input, 'customLabel' ) != '' ? $address_state_field_input['customLabel'] : $state_label;
					$address_state_sub_label   = gf_apply_filters( array( 'gform_address_state', $form_id, $field->id ), $address_state_sub_label, $form_id );
					$address_country_sub_label = rgar( $address_country_field_input, 'customLabel' ) != '' ? $address_country_field_input['customLabel'] : esc_html__( 'Country', 'gravityforms' );
					$address_country_sub_label = gf_apply_filters( array( 'gform_address_country', $form_id, $field->id ), $address_country_sub_label, $form_id );

					// Address field.
					$street_address = '';
					$tabindex       = $field->get_tabindex();
					$style          = ( $is_admin && rgar( $address_street_field_input, 'isHidden' ) ) ? "style='display:none;'" : '';
					if ( $is_admin || ! rgar( $address_street_field_input, 'isHidden' ) ) {
							$street_address = " <span class='ginput_full{$class_suffix} address_line_1' id='{$field_id}_1_container' {$style}>
													".$this->construct_input($field->textboxType, $field_id.'_1', $address_street_sub_label, 'input_'.$id.'.1', $street_value, $tabindex)."
												</span>";
					}

					// Address line 2 field.
					$street_address2 = '';
					$style           = ( $is_admin && ( $field->hideAddress2 || rgar( $address_street2_field_input, 'isHidden' ) ) ) ? "style='display:none;'" : ''; // support for $this->hideAddress2 legacy property
					if ( $is_admin || ( ! $field->hideAddress2 && ! rgar( $address_street2_field_input, 'isHidden' ) ) ) {
						$tabindex = $field->get_tabindex();
							$street_address2 = "<span class='ginput_full{$class_suffix} address_line_2' id='{$field_id}_2_container' {$style}>
													".$this->construct_input($field->textboxType, $field_id.'_2', $address_street2_sub_label, 'input_'.$id.'.2', $street2_value, $tabindex)."
												</span>";
					}

					if ( $address_display_format == 'zip_before_city' ) {
						// Zip field.
						$zip      = '';
						$tabindex = $field->get_tabindex();
						$style    = ( $is_admin && rgar( $address_zip_field_input, 'isHidden' ) ) ? "style='display:none;'" : '';
						if ( $is_admin || ! rgar( $address_zip_field_input, 'isHidden' ) ) {
								$zip = "<span class='ginput_{$zip_location}{$class_suffix} address_zip' id='{$field_id}_5_container' {$style}>
												".$this->construct_input($field->textboxType, $field_id.'_5', $address_zip_sub_label, 'input_'.$id.'.5', $zip_value, $tabindex)."
											</span>";
						}

						// City field.
						$city     = '';
						$tabindex = $field->get_tabindex();
						$style    = ( $is_admin && rgar( $address_city_field_input, 'isHidden' ) ) ? "style='display:none;'" : '';
						if ( $is_admin || ! rgar( $address_city_field_input, 'isHidden' ) ) {
								$city = "<span class='ginput_{$city_location}{$class_suffix} address_city' id='{$field_id}_3_container' {$style}>
												".$this->construct_input($field->textboxType, $field_id.'_3', $address_city_sub_label, 'input_'.$id.'.3', $city_value, $tabindex)."
										</span>";
						}

						// State field.
						$style = ( $is_admin && ( $field->hideState || rgar( $address_state_field_input, 'isHidden' ) ) ) ? "style='display:none;'" : ''; // support for $this->hideState legacy property
						if ( $is_admin || ( ! $field->hideState && ! rgar( $address_state_field_input, 'isHidden' ) ) ) {
							$state_field = $this->get_state_field( $field, $address_state_sub_label, $id, $field_id, $state_value, $disabled_text, $form_id );
							
								$state = "<span class='ginput_{$state_location}{$class_suffix} address_state' id='{$field_id}_4_container' {$style}>
													$state_field
												</span>";
						} else {
							$state = sprintf( "<input type='hidden' class='gform_hidden' name='input_%d.4' id='%s_4' value='%s'/>", $id, $field_id, $state_value );
						}
					} else {

						// City field.
						$city     = '';
						$tabindex = $field->get_tabindex();
						$style    = ( $is_admin && rgar( $address_city_field_input, 'isHidden' ) ) ? "style='display:none;'" : '';
						if ( $is_admin || ! rgar( $address_city_field_input, 'isHidden' ) ) {
							
								$city = "<span class='ginput_{$city_location}{$class_suffix} address_city' id='{$field_id}_3_container' {$style}>
												".$this->construct_input($field->textboxType, $field_id.'_3', $address_city_sub_label, 'input_'.$id.'.3', $city_value, $tabindex)."
											</span>";
						}

						// State field.
						$style = ( $is_admin && ( $field->hideState || rgar( $address_state_field_input, 'isHidden' ) ) ) ? "style='display:none;'" : ''; // support for $this->hideState legacy property
						if ( $is_admin || ( ! $field->hideState && ! rgar( $address_state_field_input, 'isHidden' ) ) ) {
							$state_field = $this->get_state_field( $field, $address_state_sub_label, $id, $field_id, $state_value, $disabled_text, $form_id );
							
								$state = "<span class='ginput_{$state_location}{$class_suffix} address_state' id='{$field_id}_4_container' {$style}>
													$state_field
												</span>";
						} else {
							$state = sprintf( "<input type='hidden' class='gform_hidden' name='input_%d.4' id='%s_4' value='%s'/>", $id, $field_id, $state_value );
						}

						// Zip field.
						$zip      = '';
						$tabindex = GFCommon::get_tabindex();
						$style    = ( $is_admin && rgar( $address_zip_field_input, 'isHidden' ) ) ? "style='display:none;'" : '';
						if ( $is_admin || ! rgar( $address_zip_field_input, 'isHidden' ) ) {
								$zip = "<span class='ginput_{$zip_location}{$class_suffix} address_zip' id='{$field_id}_5_container' {$style}>
												".$this->construct_input($field->textboxType, $field_id.'_5', $address_zip_sub_label, 'input_'.$id.'.5', $zip_value, $tabindex)."
											</span>";
						}
					}



					//Country field
					if ( $is_admin || ! $hide_country ) {
						$style    = $hide_country ? "style='display:none;'" : '';
						$tabindex = $field->get_tabindex();
						if ( $is_sub_label_above ) {
							$country = "<span class='ginput_{$country_location}{$class_suffix} address_country' id='{$field_id}_6_container' {$style}>
													<label for='{$field_id}_6' id='{$field_id}_6_label' {$sub_label_class_attribute}>{$address_country_sub_label}</label>
													<select name='input_{$id}.6' id='{$field_id}_6' {$tabindex} {$disabled_text} {$required_attribute}>{$country_list}</select>
												</span>";
						} else {
							$country = "<span class='ginput_{$country_location}{$class_suffix} address_country' id='{$field_id}_6_container' {$style}>
													<select name='input_{$id}.6' id='{$field_id}_6' {$tabindex} {$disabled_text} {$required_attribute}>{$country_list}</select>
													<label for='{$field_id}_6' id='{$field_id}_6_label' {$sub_label_class_attribute}>{$address_country_sub_label}</label>
												</span>";
						}
					} else {
						$country = sprintf( "<input type='hidden' class='gform_hidden' name='input_%d.6' id='%s_6' value='%s'/>", $id, $field_id, $country_value );
					}

					$inputs = $address_display_format == 'zip_before_city' ? $street_address . $street_address2 . $zip . $city . $state . $country : $street_address . $street_address2 . $city . $state . $zip . $country;

					$copy_values_option = '';
					$input_style        = '';
					if ( ( $field->enableCopyValuesOption || $is_form_editor ) && ! $is_entry_detail ) {
						$copy_values_style      = $is_form_editor && ! $field->enableCopyValuesOption ? "style='display:none;'" : '';
						$copy_values_is_checked = isset( $value[$field->id . '_copy_values_activated'] ) ? $value[$field->id . '_copy_values_activated'] == true : $field->copyValuesOptionDefault == true;
						$copy_values_checked    = checked( true, $copy_values_is_checked, false );
						$copy_values_option     = "<div id='{$field_id}_copy_values_option_container' class='copy_values_option_container' {$copy_values_style}>
													<input type='checkbox' id='{$field_id}_copy_values_activated' class='copy_values_activated' value='1' name='input_{$id}_copy_values_activated' {$disabled_text} {$copy_values_checked}/>
													<label for='{$field_id}_copy_values_activated' id='{$field_id}_copy_values_option_label' class='copy_values_option_label inline'>{$field->copyValuesOptionLabel}</label>
												</div>";
						if ( $copy_values_is_checked ) {
							$input_style = "style='display:none;'";
						}
					}

					$css_class = $field->get_css_class();

					return "    {$copy_values_option}
								<div class='ginput_complex{$class_suffix} ginput_container {$css_class}' id='$field_id' {$input_style}>
									{$inputs}
								<div class='gf_clear gf_clear_complex'></div>
							</div>";
				}
				
			}

			//For email field
			else if($field->type === 'email') {
				$is_entry_detail = $field->is_entry_detail();
				$is_form_editor  = $field->is_form_editor();

				if ( is_array( $value ) ) {
					$value = array_values( $value );
				}

				
				$id       = absint( $field->id );
				$field_id = $is_entry_detail || $is_form_editor || $form_id == 0 ? "input_$id" : 'input_' . $form_id . "_$id";
				$form_id  = ( $is_entry_detail || $is_form_editor ) && empty( $form_id ) ? rgget( 'id' ) : $form_id;

				$size          = $field->size;
				$disabled_text = $is_form_editor ? "disabled='disabled'" : '';
				$class_suffix  = $is_entry_detail ? '_admin' : '';

				$class         = $field->emailConfirmEnabled ? '' : $size . $class_suffix; //Size only applies when confirmation is disabled

				$form_sub_label_placement  = '';
				$field_sub_label_placement = $field->subLabelPlacement;
				$is_sub_label_above        = $field_sub_label_placement == 'above' || ( empty( $field_sub_label_placement ) && $form_sub_label_placement == 'above' );
				$sub_label_class_attribute = $field_sub_label_placement == 'hidden_label' ? "class='hidden_sub_label screen-reader-text'" : '';

				$html_input_type = RGFormsModel::is_html5_enabled() ? 'email' : 'text';

				$required_attribute    = $field->isRequired ? 'aria-required="true"' : '';
				$invalid_attribute     = $field->failed_validation ? 'aria-invalid="true"' : 'aria-invalid="false"';
				$aria_describedby      = $field->get_aria_describedby();

				$enter_email_field_input = GFFormsModel::get_input( $field, $field->id . '' );
				$confirm_field_input     = GFFormsModel::get_input( $field, $field->id . '.2' );

				$enter_email_label   = rgar( $enter_email_field_input, 'customLabel' ) != '' ? $enter_email_field_input['customLabel'] : esc_html__( 'Enter Email', 'gravityforms' );
				$enter_email_label   = gf_apply_filters( array( 'gform_email', $form_id ), $enter_email_label, $form_id );
				$confirm_email_label = rgar( $confirm_field_input, 'customLabel' ) != '' ? $confirm_field_input['customLabel'] : esc_html__( 'Confirm Email', 'gravityforms' );
				$confirm_email_label = gf_apply_filters( array( 'gform_email_confirm', $form_id ), $confirm_email_label, $form_id );

				$single_placeholder_attribute        = $field->get_field_placeholder_attribute();
				$enter_email_placeholder_attribute   = $field->get_input_placeholder_attribute( $enter_email_field_input );
				$confirm_email_placeholder_attribute = $field->get_input_placeholder_attribute( $confirm_field_input );

				if ( $is_form_editor ) {
					$single_style  = $field->emailConfirmEnabled ? "style='display:none;'" : '';
					$confirm_style = $field->emailConfirmEnabled ? '' : "style='display:none;'";

					if ( $is_sub_label_above ) {
						return "<div class='ginput_container ginput_container_email ginput_single_email' {$single_style}>
									<input name='input_{$id}' type='{$html_input_type}' class='" . esc_attr( $class ) . "' disabled='disabled' {$single_placeholder_attribute} {$required_attribute} {$invalid_attribute} />
									<div class='gf_clear gf_clear_complex'></div>
								</div>
								<div class='ginput_complex ginput_container ginput_container_email ginput_confirm_email' {$confirm_style} id='{$field_id}_container'>
									<span id='{$field_id}_1_container' class='ginput_left'>
										<label for='{$field_id}' {$sub_label_class_attribute}>{$enter_email_label}</label>
										<input class='{$class}' type='text' name='input_{$id}' id='{$field_id}' disabled='disabled' {$enter_email_placeholder_attribute} {$required_attribute} {$invalid_attribute} />
									</span>
									<span id='{$field_id}_2_container' class='ginput_right'>
										<label for='{$field_id}_2' {$sub_label_class_attribute}>{$confirm_email_label}</label>
										<input class='{$class}' type='text' name='input_{$id}_2' id='{$field_id}_2' disabled='disabled' {$confirm_email_placeholder_attribute} {$required_attribute} {$invalid_attribute} />
									</span>
									<div class='gf_clear gf_clear_complex'></div>
								</div>";
					} else {
						return "<div class='ginput_container ginput_container_email ginput_single_email' {$single_style}>
									<input class='{$class}' name='input_{$id}' type='{$html_input_type}' class='" . esc_attr( $class ) . "' disabled='disabled' {$single_placeholder_attribute} {$required_attribute} {$invalid_attribute} />
									<div class='gf_clear gf_clear_complex'></div>
								</div>
								<div class='ginput_complex ginput_container ginput_container_email ginput_confirm_email' {$confirm_style} id='{$field_id}_container'>
									<span id='{$field_id}_1_container' class='ginput_left'>
										<input class='{$class}' type='text' name='input_{$id}' id='{$field_id}' disabled='disabled' {$enter_email_placeholder_attribute} {$required_attribute} {$invalid_attribute} />
										<label for='{$field_id}' {$sub_label_class_attribute}>{$enter_email_label}</label>
									</span>
									<span id='{$field_id}_2_container' class='ginput_right'>
										<input class='{$class}' type='text' name='input_{$id}_2' id='{$field_id}_2' disabled='disabled' {$confirm_email_placeholder_attribute} {$required_attribute} {$invalid_attribute} />
										<label for='{$field_id}_2' {$sub_label_class_attribute}>{$confirm_email_label}</label>
									</span>
									<div class='gf_clear gf_clear_complex'></div>
								</div>";
					}
				} else {

					if ( $field->emailConfirmEnabled && ! $is_entry_detail ) {
						$first_tabindex        = $field->get_tabindex();
						$last_tabindex         = $field->get_tabindex();
						$email_value           = is_array( $value ) ? rgar( $value, 0 ) : $value;
						$email_value = esc_attr( $email_value );
						$confirmation_value    = is_array( $value ) ? rgar( $value, 1 ) : rgpost( 'input_' . $field->id . '_2' );
						$confirmation_value = esc_attr( $confirmation_value );
						$confirmation_disabled = $is_entry_detail ? "disabled='disabled'" : $disabled_text;
						
						return "<div class='ginput_complex ginput_container ginput_container_email' id='{$field_id}_container'>
									<span id='{$field_id}_1_container' class='ginput_left'>
										".$this->construct_input($field->textboxType, $field_id, $enter_email_label, 'input_'.$id, $email_value, $first_tabindex, $disabled_text.' '.$required_attribute.' '.$invalid_attribute)."
									</span>
									<span id='{$field_id}_2_container' class='ginput_right'>
										".$this->construct_input($field->textboxType, $field_id.'_2', $confirm_email_label, 'input_'.$id.'_2', $confirmation_value, $last_tabindex, $confirmation_disabled.' '.$required_attribute.' '.$invalid_attribute)."
									</span>
									<div class='gf_clear gf_clear_complex'></div>
								</div>";
					} else {
						$tabindex = $field->get_tabindex();
						$value    = esc_attr( $value );
						$class    = esc_attr( $class );
						$size = $field->size;
						$sizeclass = '';
						if($size === 'small') {
							$sizeclass = 'gravitizer-small';
						}
						else if($size === 'medium') {
							$sizeclass = 'gravitizer-medium';
						}
						else if($size === 'large') {
							$sizeclass = 'gravitizer-large';
						}
						return "<div class='ginput_container ginput_container_email'>
									".$this->construct_input($field->textboxType, $field_id, $field->label, 'input_'.$id, $value, $tabindex, $disabled_text.' '.$required_attribute.' '.$invalid_attribute, $sizeclass)."
								</div>";
					}
				}
			}

			//For textarea field
			else if($field->type === 'textarea') {
				global $current_screen;

				
				$is_entry_detail = $field->is_entry_detail();
				$is_form_editor  = $field->is_form_editor();

				$is_admin = $is_entry_detail || $is_form_editor;

				$id            = intval( $field->id );
				$field_id      = $is_entry_detail || $is_form_editor || $form_id == 0 ? "input_$id" : 'input_' . $form_id . "_$id";
				$size          = $field->size;
				$class_suffix  = $is_entry_detail ? '_admin' : '';
				$class         = $size . $class_suffix;
				$class         = esc_attr( $class );
				$disabled_text = $is_form_editor ? 'disabled="disabled"' : '';

				$maxlength_attribute   = is_numeric( $field->maxLength ) ? "maxlength='{$field->maxLength}'" : '';
				$placeholder_attribute = $field->get_field_placeholder_attribute();
				$required_attribute    = $field->isRequired ? 'aria-required="true"' : '';
				$invalid_attribute     = $field->failed_validation ? 'aria-invalid="true"' : 'aria-invalid="false"';
				$aria_describedby      = $field->get_aria_describedby();

				$tabindex = $field->get_tabindex();

				if ( $field->get_allowable_tags() === false ) {
					$value = esc_textarea( $value );
				} else {
					$value = wp_kses_post( $value );
				}

				//see if the field is set to use the rich text editor
				if ( ! $is_admin && $field->is_rich_edit_enabled() && ( ! $current_screen || ( $current_screen && ! rgobj( $current_screen, 'is_block_editor' ) ) ) ) {
					//placeholders cannot be used with the rte; message displayed in admin when this occurs
					//field cannot be used in conditional logic by another field; message displayed in admin and field removed from conditional logic drop down
					$tabindex = GFCommon::$tab_index > 0 ? GFCommon::$tab_index ++ : '';

					add_filter( 'mce_buttons', array( $field, 'filter_mce_buttons' ), 10, 2 );

					/**
					 * Filters the field options for the rich text editor.
					 *
					 * @since 2.0.0
					 *
					 * @param array  $editor_settings Array of settings that can be changed.
					 * @param object $this            The field object
					 * @param array  $form            Current form object
					 * @param array  $entry           Current entry object, if available
					 *
					 * Additional filters for specific form and fields IDs.
					 */
					$editor_settings = array(
						'textarea_name' => 'input_' . $id,
						'wpautop' 		=> true,
						'editor_class' 	=> $class,
						'editor_height' => rgar( array( 'small' => 110, 'medium' => 180, 'large' => 280 ), $field->size ? $field->size : 'medium' ),
						'tabindex' 		=> $tabindex,
						'media_buttons' => false,
						'quicktags'     => false,
						'tinymce'		=> array( 'init_instance_callback' =>  "function (editor) {
														editor.on( 'keyup paste mouseover', function (e) {
															var content = editor.getContent( { format: 'text' } ).trim();													
															var textarea = jQuery( '#' + editor.id ); 
															textarea.val( content ).trigger( 'keyup' ).trigger( 'paste' ).trigger( 'mouseover' );													
														
															
														});}" ),
						);

					if ( ! has_action( 'wp_tiny_mce_init', array( __class__, 'start_wp_tiny_mce_init_buffer' ) ) ) {
						add_action( 'wp_tiny_mce_init', array( __class__, 'start_wp_tiny_mce_init_buffer' ) );
					}

					ob_start();
					wp_editor( $value, $field_id, $editor_settings );
					$input = ob_get_clean();

					remove_filter( 'mce_buttons', array( $field, 'filter_mce_buttons' ), 10 );
				} else {

					$input       = '';
					$input_style = '';

					// RTE preview
					if ( $field->is_form_editor() ) {
						$display     = $field->useRichTextEditor ? 'block' : 'none';
						$input_style = $field->useRichTextEditor ? 'style="display:none;"' : '';
						$size        = $field->size ? $field->size : 'medium';
						$input       = sprintf( '<div id="%s_rte_preview" class="gform-rte-preview %s" style="display:%s"></div>', $field_id, $size, $display );
					}
					$size = $field->size;
					$sizeclass = '';
					if($size === 'small') {
						$sizeclass = 'gravitizer-small';
					}
					else if($size === 'medium') {
						$sizeclass = 'gravitizer-medium';
					}
					else if($size === 'large') {
						$sizeclass = 'gravitizer-large';
					}
					$input .= "<div class='textarea'>
						".'<label class="'.$sizeclass.' mdc-text-field--textarea mdc-text-field--textarea-'.$field_id.'">'."
							<textarea name='input_{$id}' id='{$field_id}' class='textarea {$class} mdc-text-field__input' {$tabindex} {$aria_describedby} {$maxlength_attribute} {$placeholder_attribute} {$required_attribute} {$invalid_attribute} {$disabled_text} {$input_style} rows='10' cols='50'>{$value}</textarea>
							".'<div class="mdc-notched-outline">
							<div class="mdc-notched-outline__leading"></div>
							<div class="mdc-notched-outline__notch">
							  <label class="mdc-floating-label" id="my-label-id">'.esc_html($field->label).'</label>
							</div>
							<div class="mdc-notched-outline__trailing"></div>
						  </div>'."
							</label>
					</div>";

				}
				if(is_admin()) {
					return sprintf( "<div class='ginput_container gravitizer_field ginput_container_textarea'>%s</div>", $input );
				}
				return sprintf( "<div class='ginput_container gravitizer_field ginput_container_textarea'>%s</div><script>mdc.textField.MDCTextField.attachTo(document.querySelector('.mdc-text-field--textarea-{$field_id}'));</script>", $input );
			}
		}
		return $input;
	}

	//Custom input wrapper markup
	public function gravitizer_custom_input_content($content, $field, $value, $lead_id, $form_id) {
		if($field->gravitizerStatus === 'yes') {
			if($field->type === 'text'){
				$id              = absint( $field->id );
				$admin_buttons   = $field->get_admin_buttons();
				$is_entry_detail = $field->is_entry_detail();
				$is_form_editor  = $field->is_form_editor();
				$is_admin        = $is_entry_detail || $is_form_editor;
				$field_label     = $field->get_field_label( '', $value );
				$field_id        = $is_admin || $form_id == 0 ? "input_{$field->id}" : 'input_' . $form_id . "_{$field->id}";
				$size            = $field->size;
				$validation_message_id = 'validation_message_' . $form_id . '_' . $field->id;
				$validation_message = ( $field->failed_validation && ! empty( $field->validation_message ) ) ? sprintf( "<div id='%s' class='gfield_description validation_message' aria-live='polite'>%s</div>", $validation_message_id, $field->validation_message ) : '';


				// Get the value of the inputClass property for the current field.
				$sizeclass = '';
				if($size === 'small') {
					$sizeclass = 'gravitizer-small';
				}
				else if($size === 'medium') {
					$sizeclass = 'gravitizer-medium';
				}
				else if($size === 'large') {
					$sizeclass = 'gravitizer-large';
				}
				$placement = $field->desPlacement;
				$description = $field->get_description( $field->description, 'gfield_description' );

				$desAbove = '';
				$desBelow = '';
				if($placement === 'below') {
					$desAbove = '';
					$desBelow = $description;
				}
				else if($placement === 'above') {
					$desAbove = $description;
					$desBelow = '';
				}
				$iconText = esc_html($field->iconText);
				$iconPlacement = $field->iconPlacement;
				$iconClass = '';
				$begin_iconText = '';
				$end_iconText = '';
				if($iconPlacement === '') {
					$iconPlacement = 'beginning';
				}
				if($iconText === '') {
					$iconClass = '';
				}
				else {
					if($iconPlacement === 'beginning') {
						$iconClass = 'mdc-text-field--with-leading-icon';
						$begin_iconText = "<i class='material-icons mdc-text-field__icon'>$iconText</i>";
						$end_iconText = '';
					}
					else if($iconPlacement === 'end') {
						$iconClass = 'mdc-text-field--with-trailing-icon';
						$begin_iconText = "";
						$end_iconText = "<i class='material-icons mdc-text-field__icon'>$iconText</i>";
					}
					
				}

				//Decide the layout type
				($field->textboxType === 'outlined') ? $temp_content = "
				<div class='ginput_container gravitizer_field ginput_container_{$field->type}'>
					
					<label class=\"{$sizeclass} mdc-text-field mdc-text-field-{$id} mdc-text-field--outlined {$iconClass}\">
							{$begin_iconText}".GFCommon::get_field_input($field, $value, $lead_id, $form_id)."{$end_iconText}
						<div class=\"mdc-notched-outline\">
							<div class=\"mdc-notched-outline__leading\"></div>
							<div class=\"mdc-notched-outline__notch\">
							<span class=\"mdc-floating-label\" >".esc_html($field_label)."</span>
						</div>
						<div class=\"mdc-notched-outline__trailing\"></div>
						</div>
					</label>
					
				</div>" : $temp_content = '
				<div class="ginput_container gravitizer_field ginput_container_'.$field->type.'">
					<label class="'.$sizeclass.' mdc-text-field mdc-text-field--normal mdc-text-field-'.$id.' '.$iconClass.'">
						<div class="mdc-text-field__ripple"></div>
						'.$begin_iconText.GFCommon::get_field_input($field, $value, $lead_id, $form_id).$end_iconText.'
						<span class="mdc-floating-label" >'.esc_html($field_label).'</span>
						<div class="mdc-line-ripple"></div>
					</label>
				</div>';


				$field_content   = ! $is_admin ? "{$desAbove}
				{$temp_content}
				{$desBelow}
				{$validation_message}
				
				<script>mdc.textField.MDCTextField.attachTo(document.querySelector('.mdc-text-field-{$id}'));</script>" : $field_content = sprintf( "%s<label class='gfield_label' for='%s'>%s</label>".GFCommon::get_field_input($field, $value, $lead_id, $form_id)."", $admin_buttons, $field_id, esc_html( $field_label ) );
				
				if(!$is_entry_detail) {
					return $field_content;
				}
			}

			else if($field->type === 'number'){
				$id              = absint( $field->id );
				$admin_buttons   = $field->get_admin_buttons();
				$is_entry_detail = $field->is_entry_detail();
				$is_form_editor  = $field->is_form_editor();
				$is_admin        = $is_entry_detail || $is_form_editor;
				$field_label     = $field->get_field_label( '', $value );
				$field_id        = $is_admin || $form_id == 0 ? "input_{$field->id}" : 'input_' . $form_id . "_{$field->id}";
				$size            = $field->size;
				$validation_message_id = 'validation_message_' . $form_id . '_' . $field->id;
				$validation_message = ( $field->failed_validation && ! empty( $field->validation_message ) ) ? sprintf( "<div id='%s' class='gfield_description validation_message' aria-live='polite'>%s</div>", $validation_message_id, $field->validation_message ) : '';



				// Get the value of the inputClass property for the current field.
				$inputColor = $field->inputColor;
				$primaryColor = $field->primaryColor;
				$sizeclass = '';
				if($size === 'small') {
					$sizeclass = 'gravitizer-small';
				}
				else if($size === 'medium') {
					$sizeclass = 'gravitizer-medium';
				}
				else if($size === 'large') {
					$sizeclass = 'gravitizer-large';
				}
				$placement = $field->desPlacement;
				$description = $field->get_description( $field->description, 'gfield_description' );
				$desAbove = '';
				$desBelow = '';
				if($placement === 'below') {
					$desAbove = '';
					$desBelow = $description;
				}
				else if($placement === 'above') {
					$desAbove = $description;
					$desBelow = '';
				}
				$iconText = esc_html($field->iconText);
				$iconPlacement = $field->iconPlacement;
				$iconClass = '';
				$begin_iconText = '';
				$end_iconText = '';
				if($iconPlacement === '') {
					$iconPlacement = 'beginning';
				}
				if($iconText === '') {
					$iconClass = '';
				}
				else {
					if($iconPlacement === 'beginning') {
						$iconClass = 'mdc-text-field--with-leading-icon';
						$begin_iconText = "<i class='material-icons mdc-text-field__icon'>$iconText</i>";
						$end_iconText = '';
					}
					else if($iconPlacement === 'end') {
						$iconClass = 'mdc-text-field--with-trailing-icon';
						$begin_iconText = "";
						$end_iconText = "<i class='material-icons mdc-text-field__icon'>$iconText</i>";
					}
					
				}

				

				//Decide the layout type
				($field->textboxType === 'outlined') ? $temp_content = "
				<div class='ginput_container gravitizer_field ginput_container_{$field->type}'>
					<label class=\"{$sizeclass} mdc-text-field mdc-text-field-{$id} mdc-text-field--outlined {$iconClass}\">
							{$begin_iconText}".GFCommon::get_field_input($field, $value, $lead_id, $form_id)."{$end_iconText}
						<div class=\"mdc-notched-outline\">
							<div class=\"mdc-notched-outline__leading\"></div>
							<div class=\"mdc-notched-outline__notch\">
							<span class=\"mdc-floating-label\" >".esc_html($field_label)."</span>
						</div>
						<div class=\"mdc-notched-outline__trailing\"></div>
						</div>
					</label>
				</div>" : $temp_content = '
				<div class="ginput_container gravitizer_field ginput_container_'.$field->type.'">
					<label class="'.$sizeclass.' mdc-text-field mdc-text-field--normal mdc-text-field-'.$id.' '.$iconClass.'">
						<div class="mdc-text-field__ripple"></div>
						'.$begin_iconText.GFCommon::get_field_input($field, $value, $lead_id, $form_id).$end_iconText.'
						<span class="mdc-floating-label" >'.esc_html($field_label).'</span>
						<div class="mdc-line-ripple"></div>
					</label>
				</div>';
				$field_content   = ! $is_admin ? "{$desAbove}
				{$temp_content}
				{$desBelow}
				{$validation_message}
				<script>mdc.textField.MDCTextField.attachTo(document.querySelector('.mdc-text-field-{$id}'));</script>" : $field_content = sprintf( "%s<label class='gfield_label' for='%s'>%s</label>".GFCommon::get_field_input($field, $value, $lead_id, $form_id)."", $admin_buttons, $field_id, esc_html( $field_label ) );
			
				if(!$is_entry_detail) {
					return $field_content;
				}
			}
			
			else if($field->type === 'website'){
				$id              = absint( $field->id );
				$admin_buttons   = $field->get_admin_buttons();
				$is_entry_detail = $field->is_entry_detail();
				$is_form_editor  = $field->is_form_editor();
				$is_admin        = $is_entry_detail || $is_form_editor;
				$field_label     = $field->get_field_label( '', $value );
				$field_id        = $is_admin || $form_id == 0 ? "input_{$field->id}" : 'input_' . $form_id . "_{$field->id}";
				$size            = $field->size;
				$validation_message_id = 'validation_message_' . $form_id . '_' . $field->id;
				$validation_message = ( $field->failed_validation && ! empty( $field->validation_message ) ) ? sprintf( "<div id='%s' class='gfield_description validation_message' aria-live='polite'>%s</div>", $validation_message_id, $field->validation_message ) : '';



				// Get the value of the inputClass property for the current field.
				$sizeclass = '';
				if($size === 'small') {
					$sizeclass = 'gravitizer-small';
				}
				else if($size === 'medium') {
					$sizeclass = 'gravitizer-medium';
				}
				else if($size === 'large') {
					$sizeclass = 'gravitizer-large';
				}
				$placement = $field->desPlacement;
				$description = $field->get_description( $field->description, 'gfield_description' );
				$desAbove = '';
				$desBelow = '';
				if($placement === 'below') {
					$desAbove = '';
					$desBelow = $description;
				}
				else if($placement === 'above') {
					$desAbove = $description;
					$desBelow = '';
				}
				$iconText = esc_html($field->iconText);
				$iconPlacement = $field->iconPlacement;
				$iconClass = '';
				$begin_iconText = '';
				$end_iconText = '';
				if($iconPlacement === '') {
					$iconPlacement = 'beginning';
				}
				if($iconText === '') {
					$iconClass = '';
				}
				else {
					if($iconPlacement === 'beginning') {
						$iconClass = 'mdc-text-field--with-leading-icon';
						$begin_iconText = "<i class='material-icons mdc-text-field__icon'>$iconText</i>";
						$end_iconText = '';
					}
					else if($iconPlacement === 'end') {
						$iconClass = 'mdc-text-field--with-trailing-icon';
						$begin_iconText = "";
						$end_iconText = "<i class='material-icons mdc-text-field__icon'>$iconText</i>";
					}
					
				}

				


			

				//Decide the layout type
				($field->textboxType === 'outlined') ? $temp_content = "
				<div class='ginput_container gravitizer_field ginput_container_{$field->type}'>
					<label class=\"{$sizeclass} mdc-text-field mdc-text-field-{$id} mdc-text-field--outlined {$iconClass}\">
							{$begin_iconText}".GFCommon::get_field_input($field, $value, $lead_id, $form_id)."{$end_iconText}
						<div class=\"mdc-notched-outline\">
							<div class=\"mdc-notched-outline__leading\"></div>
							<div class=\"mdc-notched-outline__notch\">
							<span class=\"mdc-floating-label\" >".esc_html($field_label)."</span>
						</div>
						<div class=\"mdc-notched-outline__trailing\"></div>
						</div>
					</label>
				</div>" : $temp_content = '
				<div class="ginput_container gravitizer_field ginput_container_'.$field->type.'">
					<label class="'.$sizeclass.' mdc-text-field mdc-text-field--normal mdc-text-field-'.$id.' '.$iconClass.'">
						<div class="mdc-text-field__ripple"></div>
						'.$begin_iconText.GFCommon::get_field_input($field, $value, $lead_id, $form_id).$end_iconText.'
						<span class="mdc-floating-label" >'.esc_html($field_label).'</span>
						<div class="mdc-line-ripple"></div>
					</label>
				</div>';
				$field_content   = ! $is_admin ? "{$desAbove}
				{$temp_content}
				{$desBelow}
				{$validation_message}
				<script>mdc.textField.MDCTextField.attachTo(document.querySelector('.mdc-text-field-{$id}'));</script>" : $field_content = sprintf( "%s<label class='gfield_label' for='%s'>%s</label>".GFCommon::get_field_input($field, $value, $lead_id, $form_id)."", $admin_buttons, $field_id, esc_html( $field_label ) );
				if(!$is_entry_detail) {
					return $field_content;
				}
			}

			else if($field->type === 'phone'){
				$id              = absint( $field->id );
				$admin_buttons   = $field->get_admin_buttons();
				$is_entry_detail = $field->is_entry_detail();
				$is_form_editor  = $field->is_form_editor();
				$is_admin        = $is_entry_detail || $is_form_editor;
				$field_label     = $field->get_field_label( '', $value );
				$field_id        = $is_admin || $form_id == 0 ? "input_{$field->id}" : 'input_' . $form_id . "_{$field->id}";
				$size            = $field->size;
				$validation_message_id = 'validation_message_' . $form_id . '_' . $field->id;
				$validation_message = ( $field->failed_validation && ! empty( $field->validation_message ) ) ? sprintf( "<div id='%s' class='gfield_description validation_message' aria-live='polite'>%s</div>", $validation_message_id, $field->validation_message ) : '';



				// Get the value of the inputClass property for the current field.
				$sizeclass = '';
				if($size === 'small') {
					$sizeclass = 'gravitizer-small';
				}
				else if($size === 'medium') {
					$sizeclass = 'gravitizer-medium';
				}
				else if($size === 'large') {
					$sizeclass = 'gravitizer-large';
				}
				$placement = $field->desPlacement;
				$description = $field->get_description( $field->description, 'gfield_description' );
				$desAbove = '';
				$desBelow = '';
				if($placement === 'below') {
					$desAbove = '';
					$desBelow = $description;
				}
				else if($placement === 'above') {
					$desAbove = $description;
					$desBelow = '';
				}
				$iconText = esc_html($field->iconText);
				$iconPlacement = $field->iconPlacement;
				$iconClass = '';
				$begin_iconText = '';
				$end_iconText = '';
				if($iconPlacement === '') {
					$iconPlacement = 'beginning';
				}
				if($iconText === '') {
					$iconClass = '';
				}
				else {
					if($iconPlacement === 'beginning') {
						$iconClass = 'mdc-text-field--with-leading-icon';
						$begin_iconText = "<i class='material-icons mdc-text-field__icon'>$iconText</i>";
						$end_iconText = '';
					}
					else if($iconPlacement === 'end') {
						$iconClass = 'mdc-text-field--with-trailing-icon';
						$begin_iconText = "";
						$end_iconText = "<i class='material-icons mdc-text-field__icon'>$iconText</i>";
					}
					
				}

				


			

				//Decide the layout type
				($field->textboxType === 'outlined') ? $temp_content = "
				<div class='ginput_container gravitizer_field ginput_container_{$field->type}'>
					<label class=\"{$sizeclass} mdc-text-field mdc-text-field-{$id} mdc-text-field--outlined {$iconClass}\">
							{$begin_iconText}".GFCommon::get_field_input($field, $value, $lead_id, $form_id)."{$end_iconText}
						<div class=\"mdc-notched-outline\">
							<div class=\"mdc-notched-outline__leading\"></div>
							<div class=\"mdc-notched-outline__notch\">
							<span class=\"mdc-floating-label\" >".esc_html($field_label)."</span>
						</div>
						<div class=\"mdc-notched-outline__trailing\"></div>
						</div>
					</label>
				</div>" : $temp_content = '
				<div class="ginput_container gravitizer_field ginput_container_'.$field->type.'">
					<label class="'.$sizeclass.' mdc-text-field mdc-text-field--normal mdc-text-field-'.$id.' '.$iconClass.'">
						<div class="mdc-text-field__ripple"></div>
						'.$begin_iconText.GFCommon::get_field_input($field, $value, $lead_id, $form_id).$end_iconText.'
						<span class="mdc-floating-label" >'.esc_html($field_label).'</span>
						<div class="mdc-line-ripple"></div>
					</label>
				</div>';
				$field_content   = ! $is_admin ? "{$desAbove}
				{$temp_content}
				{$desBelow}
				{$validation_message}
				<script>mdc.textField.MDCTextField.attachTo(document.querySelector('.mdc-text-field-{$id}'));</script>" : $field_content = sprintf( "%s<label class='gfield_label' for='%s'>%s</label>".GFCommon::get_field_input($field, $value, $lead_id, $form_id)."", $admin_buttons, $field_id, esc_html( $field_label ) );
				if(!$is_entry_detail) {
					return $field_content;
				}
			}
		}
		return $content;
	}




	//For sanitizing number fields of wp customizer
	public function gravitizer_sanitize_number($input, $setting) {
		return (is_numeric($input)) ? $input : $setting->default;
	}

	//Sanitize select field of wp customizer
	public function gravitizer_sanitize_select( $input, $setting ){
		//get the list of possible select options 
		$choices = array('yes' => 'Yes', 'no' => 'No');

						  
		//return input if valid or return default option
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );   
	}




	//Customizer settings and controls are defined here
	public function gravitizer_visual_customizer($wp_customize) {
		//Construct the select form field
		$forms = GFAPI::get_forms();
		$choice_list = array('-1' => '--Select one--');
		foreach($forms as $form) {
			$choice_list[$form['id']] = $form['title'];
		}
		
		$current_form_id = get_option('current_form_id');

		//Main panel
		$wp_customize->add_panel('gravitizer_panel',array(
			'title'=>'Material UI',
			'description'=> esc_html__('Visually customize Material UI items', 'gravitizer-lite'),
			'priority'=> 10,
		));


		//Section for selecting form
		$wp_customize->add_section("current_form_section", array(
			"title" => esc_html__("Select Form", 'gravitizer-lite'),
			"priority" => 10,
			'panel' => 'gravitizer_panel',
		));
		$wp_customize->add_setting("current_form_id", array(
			"default" => '-1',
			"transport" => "postMessage",
			"type" => 'option',
			'sanitize_callback' => array($this, 'gravitizer_sanitize_number')
		));
		//For setting the current form
		$wp_customize->add_control(new WP_Customize_Control(
			$wp_customize,
			"gravitizer_current_form",
			array(
				"label" => esc_html__("Choose form", 'gravitizer-lite'),
				"section" => "current_form_section",
				"settings" => "current_form_id",
				"type" => "select",
				'choices' => $choice_list,
			)
		));

		if ( ! array_key_exists( 'autofocus', $_GET ) || ( array_key_exists( 'autofocus', $_GET ) && $_GET['autofocus']['panel'] !== 'gravitizer_panel' ) ) {
			//Hidden field
			$wp_customize->add_setting(
				'gravitizer_hidden_for_form_id', array(
					'default'   => $current_form_id,
					'transport' => 'postMessage',
					'type'      => 'option',
					'sanitize_callback' => array($this, 'gravitizer_sanitize_number')
				)
			);
			$wp_customize->add_control(
				'gravitizer_hidden_for_form_id', array(
					'type'        => 'hidden',
					'priority'    => 10, // Within the section.
					'section'     => 'current_form_section', // Required, core or custom.
					'input_attrs' => array(
						'value' => $current_form_id,
						'id'    => 'gravitizer_hidden_for_form_id',
					),
				)
			);
		}


		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/gravitizer-radio-customizer.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/gravitizer-text-customizer.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/gravitizer-switch-customizer.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/gravitizer-checkbox-customizer.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/gravitizer-dropdown-customizer.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/gravitizer-date-customizer.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/gravitizer-wrapper-customizer.php';
	}

	
		
	//Javascript for customizer live preview
	public function gravitizer_customizer_live_preview() {
		wp_enqueue_script( 
			'gravitzer-customizer-js',			
			plugin_dir_url( __FILE__ ) . 'js/gravitzer-lite-customizer.js',
			array( 'jquery','customize-preview' ),
			true						
		);
	}

	//Javascript for customizer controls
	public function gravitizer_customizer_control_scripts() {
		wp_enqueue_script( 
			'gravitzer-customizer-control-js',			
			plugin_dir_url( __FILE__ ) . 'js/gravitzer-lite-customizer-control.js',
			array( 'jquery','customize-preview' ),
			true						
		);
		wp_localize_script( 'gravitzer-customizer-control-js', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	}


	//For adding customizer css in wp_head
	public function gravitizer_customizer_css() {
		$forms = GFAPI::get_forms();
		foreach($forms as $form) {
			$form_id = $form['id'];
			echo "
			<style>
				#gform_wrapper_$form_id span.name_prefix.name_prefix_select {
					margin-top: 8px;
				}
				#gform_wrapper_$form_id span.address_country {
					margin-top: 18px;
				}
				#gform_wrapper_$form_id .mdc-radio .mdc-radio__background::before {
					background-color:".get_option('gravitizer_radio_field_color_'.$form_id, '#111111').";
				}
				#gform_wrapper_$form_id .mdc-radio .mdc-radio__native-control:enabled:checked+.mdc-radio__background .mdc-radio__outer-circle {
					border-color: ".get_option('gravitizer_radio_field_color_'.$form_id, '#111111').";
				}
				#gform_wrapper_$form_id .mdc-radio .mdc-radio__native-control:enabled+.mdc-radio__background .mdc-radio__inner-circle {
					border-color:".get_option('gravitizer_radio_field_color_'.$form_id, '#111111').";
				}
				#gform_wrapper_$form_id .gravitizer-radio-wrapper .mdc-form-field {
					margin-bottom : ".get_option('gravitizer_radio_field_margin_'.$form_id, '15')."px;
				}
				#gform_wrapper_$form_id .gravitizer-radio-wrapper .mdc-form-field>label {
					margin-top : ".get_option('gravitizer_radio_label_placement_'.$form_id, '-22')."px;
					color : ".get_option('gravitizer_radio_label_color_'.$form_id, 'inherit').";
					font-size : ".get_option('gravitizer_radio_label_size_'.$form_id, '16')."px;
				}
				#gform_wrapper_$form_id .mdc-text-field:not(.mdc-text-field--disabled):not(.mdc-text-field--outlined):not(.mdc-text-field--textarea) .mdc-text-field__input {
					border-bottom-color : ".get_option('gravitizer_text_border_primary_color_'.$form_id, '#ddd').";
				}
				#gform_wrapper_$form_id .mdc-text-field--outlined:not(.mdc-text-field--disabled) .mdc-notched-outline__leading, 
				#gform_wrapper_$form_id .mdc-text-field--outlined:not(.mdc-text-field--disabled) .mdc-notched-outline__notch, 
				#gform_wrapper_$form_id .mdc-text-field--outlined:not(.mdc-text-field--disabled) .mdc-notched-outline__trailing {
					border-color: ".get_option('gravitizer_text_border_primary_color_'.$form_id, '#ddd').";
				}
				#gform_wrapper_$form_id .mdc-text-field .mdc-line-ripple {
					background-color: ".get_option('gravitizer_text_border_focus_color_'.$form_id, '#111').";
				}
				#gform_wrapper_$form_id .mdc-text-field--focused:not(.mdc-text-field--disabled) .mdc-floating-label {
					color: ".get_option('gravitizer_text_border_focus_color_'.$form_id, '#111').";
				}
				#gform_wrapper_$form_id .mdc-text-field--outlined:not(.mdc-text-field--disabled).mdc-text-field--focused .mdc-notched-outline__leading, 
				#gform_wrapper_$form_id .mdc-text-field--outlined:not(.mdc-text-field--disabled).mdc-text-field--focused .mdc-notched-outline__notch, 
				#gform_wrapper_$form_id .mdc-text-field--outlined:not(.mdc-text-field--disabled).mdc-text-field--focused .mdc-notched-outline__trailing,
				#gform_wrapper_$form_id .mdc-text-field--textarea:not(.mdc-text-field--disabled).mdc-text-field--focused .mdc-notched-outline__leading, 
				#gform_wrapper_$form_id .mdc-text-field--textarea:not(.mdc-text-field--disabled).mdc-text-field--focused .mdc-notched-outline__notch, 
				#gform_wrapper_$form_id .mdc-text-field--textarea:not(.mdc-text-field--disabled).mdc-text-field--focused .mdc-notched-outline__trailing {
					border-color: ".get_option('gravitizer_text_border_focus_color_'.$form_id, '#111').";
				}
				#gform_wrapper_$form_id .mdc-text-field:not(.mdc-text-field--disabled):not(.mdc-text-field--focused) .mdc-floating-label,
				#gform_wrapper_$form_id .mdc-text-field--textarea .mdc-floating-label {
					color: ".get_option('gravitizer_text_placeholder_color_'.$form_id, '#111').";
				}
				#gform_wrapper_$form_id .mdc-floating-label,
				#gform_wrapper_$form_id .mdc-text-field--textarea .mdc-floating-label {
					font-size: ".get_option('gravitizer_textfield_placeholder_size_'.$form_id, '16')."px;
				}
				#gform_wrapper_$form_id .mdc-text-field:not(.mdc-text-field--disabled):not(.mdc-text-field--focused) .mdc-floating-label {
					font-size: ".get_option('gravitizer_textfield_placeholder_size_'.$form_id, '16')."px;
				}
				#gform_wrapper_$form_id .mdc-text-field:not(.mdc-text-field--disabled) .mdc-text-field__icon {
					color : ".get_option('gravitizer_text_icon_color_'.$form_id, '#111').";
				}
				#gform_wrapper_$form_id .mdc-text-field.mdc-text-field--outlined {
					height:auto;
				}
				#gform_wrapper_$form_id .mdc-text-field--normal input {
					height:".get_option('gravitizer_textfield_height_'.$form_id, '39')."px;
				}
				#gform_wrapper_$form_id .mdc-text-field--outlined input {
					height:".(get_option('gravitizer_textfield_height_'.$form_id, '39')+11)."px;
				}
				#gform_wrapper_$form_id .mdc-text-field {
					background:".get_option('gravitizer_text_background_color_'.$form_id, '#fff').";
					transition:background 0.3s;
				}
				#gform_wrapper_$form_id .mdc-text-field.mdc-text-field--focused {
					background:".get_option('gravitizer_text_focus_background_color_'.$form_id, '#fff').";
					transition:background 0.3s;
				}
				#gform_wrapper_$form_id .mdc-text-field--outlined .mdc-notched-outline--upgraded .mdc-floating-label--float-above {
					transform: translateY(".get_option('gravitizer_textfield_placeholder_floating_position_'.$form_id, '-34.75')."px) scale(0.75);
					-webkit-transform: translateY(".get_option('gravitizer_textfield_placeholder_floating_position_'.$form_id, '-34.75')."px) scale(0.75);
				}
				#gform_wrapper_$form_id .mdc-text-field--outlined.mdc-text-field--with-leading-icon .mdc-notched-outline--upgraded .mdc-floating-label--float-above {
					-webkit-transform: translateY(".get_option('gravitizer_textfield_placeholder_floating_position_'.$form_id, '-34.75')."px) translateX(-32px) scale(0.75);
    				transform: translateY(".get_option('gravitizer_textfield_placeholder_floating_position_'.$form_id, '-34.75')."px) translateX(-32px) scale(0.75);
				}
				#gform_wrapper_$form_id .mdc-text-field:not(.mdc-text-field--outlined) .mdc-floating-label--float-above {
					-webkit-transform: translateY(".get_option('gravitizer_normal_textfield_placeholder_floating_position_'.$form_id, '-27')."px) translateX(0px) scale(0.75);
					transform: translateY(".get_option('gravitizer_normal_textfield_placeholder_floating_position_'.$form_id, '-27')."px) translateX(0px) scale(0.75);
				}
				#gform_wrapper_$form_id .mdc-text-field:not(.mdc-text-field--outlined).mdc-text-field--with-leading-icon .mdc-floating-label--float-above {
					-webkit-transform: translateY(".get_option('gravitizer_normal_textfield_placeholder_floating_position_'.$form_id, '-27')."px) translateX(0px) scale(0.75);
					transform: translateY(".get_option('gravitizer_normal_textfield_placeholder_floating_position_'.$form_id, '-27')."px) translateX(0px) scale(0.75);
				}
				";
				if(get_option('gravitizer_textfield_enable_radius_'.$form_id) === 'yes') {
					echo "#gform_wrapper_$form_id .mdc-text-field--outlined .mdc-notched-outline .mdc-notched-outline__leading {
						border-radius:4px 0px 0px 4px;
					}
					#gform_wrapper_$form_id .mdc-text-field--outlined .mdc-notched-outline .mdc-notched-outline__trailing{
						border-radius:0px 4px 4px 0px;
					}";
				}
				else {
					echo "#gform_wrapper_$form_id .mdc-text-field--outlined .mdc-notched-outline .mdc-notched-outline__leading {
						border-radius:0px 0px 0px 0px;
					}
					#gform_wrapper_$form_id .mdc-text-field--outlined .mdc-notched-outline .mdc-notched-outline__trailing {
						border-radius:0px 0px 0px 0px;
					}";
				}
				echo "
				#gform_wrapper_$form_id .mdc-text-field--textarea:not(.mdc-text-field--disabled) .mdc-notched-outline__leading, 
				#gform_wrapper_$form_id .mdc-text-field--textarea:not(.mdc-text-field--disabled) .mdc-notched-outline__notch, 
				#gform_wrapper_$form_id .mdc-text-field--textarea:not(.mdc-text-field--disabled) .mdc-notched-outline__trailing {
					border-color: ".get_option('gravitizer_text_border_primary_color_'.$form_id, '#ddd').";
				}
				#gform_wrapper_$form_id .mdc-switch.mdc-switch--checked .mdc-switch__thumb {
					border-color: ".get_option('gravitizer_switch_field_color_'.$form_id, '#111').";
					background-color: ".get_option('gravitizer_switch_field_color_'.$form_id, '#111').";
				}
				#gform_wrapper_$form_id .mdc-switch__thumb-underlay::before, .mdc-switch__thumb-underlay::after {
					background-color: ".get_option('gravitizer_switch_field_color_'.$form_id, '#111').";
				}
				#gform_wrapper_$form_id .mdc-switch.mdc-switch--checked .mdc-switch__track {
					border-color: ".get_option('gravitizer_switch_field_color_'.$form_id, '#111').";
					background-color: ".get_option('gravitizer_switch_field_color_'.$form_id, '#111').";
				}
				#gform_wrapper_$form_id .gravitizer-switch-wrapper {
					margin-bottom: ".get_option('gravitizer_switch_field_margin_'.$form_id, '20')."px;
				}
				#gform_wrapper_$form_id .gravitizer-switch-wrapper label {
					margin-top: ".get_option('gravitizer_switch_label_placement_'.$form_id, '-22')."px;
				}
				#gform_wrapper_$form_id .gravitizer-switch-wrapper label {
					color: ".get_option('gravitizer_switch_label_color_'.$form_id, '#111').";
				}
				#gform_wrapper_$form_id .gravitizer-switch-wrapper label {
					font-size: ".get_option('gravitizer_switch_label_size_'.$form_id, '16')."px;
				}
				#gform_wrapper_$form_id .mdc-checkbox__native-control:enabled:checked~.mdc-checkbox__background,
				#gform_wrapper_$form_id .mdc-checkbox__native-control:enabled:indeterminate~.mdc-checkbox__background {
					border-color: ".get_option('gravitizer_checkbox_field_color_'.$form_id, '#111').";
					background-color: ".get_option('gravitizer_checkbox_field_color_'.$form_id, '#111').";
				}
				#gform_wrapper_$form_id .mdc-checkbox .mdc-checkbox__native-control:checked~.mdc-checkbox__background::before,
				#gform_wrapper_$form_id .mdc-checkbox .mdc-checkbox__native-control:indeterminate~.mdc-checkbox__background::before {
					background-color: ".get_option('gravitizer_checkbox_field_color_'.$form_id, '#111').";
				}
				#gform_wrapper_$form_id .gravitizer-checkbox-wrapper .mdc-form-field {
					margin-bottom: ".get_option('gravitizer_checkbox_field_margin_'.$form_id, '6')."px;
				}
				#gform_wrapper_$form_id .gravitizer-checkbox-wrapper .mdc-form-field>label {
					margin-top: ".get_option('gravitizer_checkbox_label_placement_'.$form_id, '-23')."px;
					color: ".get_option('gravitizer_checkbox_label_color_'.$form_id, '#111').";
					font-size: ".get_option('gravitizer_checkbox_label_size_'.$form_id, '16')."px;
				}
				";
				
				echo "
				#gform_wrapper_$form_id {
					padding: ".get_option('gravitizer_wrapper_padding_'.$form_id, '0')."px;
					background-color: ".get_option('gravitizer_form_wrapper_color_'.$form_id, '#fff').";
				}
				#gform_wrapper_$form_id .mdc-radio .mdc-radio__native-control:enabled:not(:checked)+.mdc-radio__background .mdc-radio__outer-circle {
					border-color: ".get_option('gravitizer_radio_field_initial_color_'.$form_id, '#111').";
				}
				#gform_wrapper_$form_id .mdc-checkbox__native-control:enabled:not(:checked):not(:indeterminate)~.mdc-checkbox__background {
					border-color: ".get_option('gravitizer_checkbox_field_initial_color_'.$form_id, '#111').";
				}
				#gform_wrapper_$form_id textarea {
					color: ".get_option('gravitizer_field_value_color_'.$form_id, '#111').";
				}
				#gform_wrapper_$form_id .mdc-text-field:not(.mdc-text-field--disabled) .mdc-text-field__input {
					color: ".get_option('gravitizer_field_value_color_'.$form_id, '#111').";
				}
				";
			echo "</style>";
		}
	}

}
