<?php
    $wp_customize->add_section("gravitizer_text_field", array(
        "title" => __("Text Fields", "gravitizer-lite"),
        "priority" => 30,
        'panel' => 'gravitizer_panel',
    ));
    
    $wp_customize->add_setting("gravitizer_textfield_placeholder_size_$current_form_id", array(
        "default" => '16',
        "transport" => "postMessage",
        "type" => 'option',
        'sanitize_callback' => array($this, 'gravitizer_sanitize_number')
    ));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "gravitizer_textfield_placeholder_size",
        array(
            "label" => esc_html__("Placeholder font size", "gravitizer-lite"),
            "section" => "gravitizer_text_field",
            "settings" => "gravitizer_textfield_placeholder_size_$current_form_id",
            "type" => "number",
        )
    ));

    $wp_customize->add_setting("gravitizer_textfield_placeholder_floating_position_$current_form_id", array(
        "default" => '-34.75',
        "transport" => "postMessage",
        "type" => 'option',
        'sanitize_callback' => array($this, 'gravitizer_sanitize_number')
    ));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "gravitizer_textfield_placeholder_floating_position",
        array(
            "label" => esc_html__("Placeholder floating position (Outlined layout)", "gravitizer-lite"),
            "section" => "gravitizer_text_field",
            "settings" => "gravitizer_textfield_placeholder_floating_position_$current_form_id",
            "type" => "number",
        )
    ));
    $wp_customize->add_setting("gravitizer_normal_textfield_placeholder_floating_position_$current_form_id", array(
        "default" => '-27',
        "transport" => "postMessage",
        "type" => 'option',
        'sanitize_callback' => array($this, 'gravitizer_sanitize_number')
    ));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "gravitizer_normal_textfield_placeholder_floating_position",
        array(
            "label" => esc_html__("Placeholder floating position (Normal layout)", "gravitizer-lite"),
            "section" => "gravitizer_text_field",
            "settings" => "gravitizer_normal_textfield_placeholder_floating_position_$current_form_id",
            "type" => "number",
        )
    ));

    $wp_customize->add_setting("gravitizer_textfield_enable_radius_$current_form_id", array(
        "default" => 'no',
        "transport" => "postMessage",
        "type" => 'option',
        'sanitize_callback' => array($this, 'gravitizer_sanitize_select')
    ));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "gravitizer_textfield_enable_radius",
        array(
            "label" => esc_html__("Enable border radius", "gravitizer-lite"),
            "section" => "gravitizer_text_field",
            "settings" => "gravitizer_textfield_enable_radius_$current_form_id",
            "type" => "select",
            "choices" => array("yes"=>"Yes", "no" => "No"),
        )
    ));


    // Pro features

    $wp_customize->add_setting("gravitizer_text_background_color_pro", array(
        "default" => '#fff',
        "transport" => "postMessage",
        "type" => 'option',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        "gravitizer_text_background_color",
        array(
            "label" => '<h2 class="gravitizer-pro-branding">'.esc_html__("Upgrade to ", "gravitizer-lite")."<a target='_blank' href='https://codecanyon.net/item/gravitizer-gravity-forms-material-ui-styler/26570055'>Gravitizer Pro</a>".esc_html__(" to access these features below", 'gravitizer-lite').'</h2>'.esc_html__("Primary background color", "gravitizer-lite"),
            "section" => "gravitizer_text_field",
            "settings" => "gravitizer_text_background_color_pro",
        )
    ));

    
    $wp_customize->add_setting("gravitizer_textfield_height_pro", array(
        "default" => '39',
        "transport" => "postMessage",
        "type" => 'option',
        'sanitize_callback' => array($this, 'gravitizer_sanitize_number')
    ));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "gravitizer_textfield_height",
        array(
            "label" => esc_html__("Height", "gravitizer-lite"),
            "section" => "gravitizer_text_field",
            "settings" => "gravitizer_textfield_height_pro",
            "type" => "number",
        )
    ));

    
    $wp_customize->add_setting("gravitizer_text_focus_background_color_pro", array(
        "default" => '#fff',
        "transport" => "postMessage",
        "type" => 'option',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        "gravitizer_text_focus_background_color",
        array(
            "label" => esc_html__("Focus background color", "gravitizer-lite"),
            "section" => "gravitizer_text_field",
            "settings" => "gravitizer_text_focus_background_color_pro",
        )
    ));
    
    $wp_customize->add_setting("gravitizer_text_border_primary_color_pro", array(
        "default" => '#ddd',
        "transport" => "postMessage",
        "type" => 'option',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        "gravitizer_text_border_primary_color",
        array(
            "label" => esc_html__("Border primary color", "gravitizer-lite"),
            "section" => "gravitizer_text_field",
            "settings" => "gravitizer_text_border_primary_color_pro",
        )
    ));
    $wp_customize->add_setting("gravitizer_text_border_focus_color_pro", array(
        "default" => '#111',
        "transport" => "postMessage",
        "type" => 'option',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        "gravitizer_text_border_focus_color",
        array(
            "label" => esc_html__("Border focus color", "gravitizer-lite"),
            "section" => "gravitizer_text_field",
            "settings" => "gravitizer_text_border_focus_color_pro",
        )
    ));
    $wp_customize->add_setting("gravitizer_text_placeholder_color_pro", array(
        "default" => '#111',
        "transport" => "postMessage",
        "type" => 'option',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        "gravitizer_text_placeholder_color",
        array(
            "label" => esc_html__("Placeholder color", "gravitizer-lite"),
            "section" => "gravitizer_text_field",
            "settings" => "gravitizer_text_placeholder_color_pro",
        )
    ));
    
    
    $wp_customize->add_setting("gravitizer_text_icon_color_pro", array(
        "default" => '#111',
        "transport" => "postMessage",
        "type" => 'option',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        "gravitizer_text_icon_color",
        array(
            "label" => esc_html__("Icon color", "gravitizer-lite"),
            "section" => "gravitizer_text_field",
            "settings" => "gravitizer_text_icon_color_pro",
        )
    ));

?>