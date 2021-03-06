<?php
    $wp_customize->add_section("gravitizer_switch_field", array(
        "title" => esc_html__("Switch Fields", "gravitizer-lite"),
        "priority" => 30,
        'panel' => 'gravitizer_panel',
    ));


    $wp_customize->add_setting("gravitizer_switch_field_margin_$current_form_id", array(
        "default" => '20',
        "transport" => "postMessage",
        "type" => 'option',
        'sanitize_callback' => array($this, 'gravitizer_sanitize_number')
    ));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "gravitizer_switch_margin",
        array(
            "label" => esc_html__("Margin bottom", "gravitizer-lite"),
            "section" => "gravitizer_switch_field",
            "settings" => "gravitizer_switch_field_margin_$current_form_id",
            "type" => "number",
        )
    ));


    $wp_customize->add_setting("gravitizer_switch_label_placement_$current_form_id", array(
        "default" => '-22',
        "transport" => "postMessage",
        "type" => 'option',
        'sanitize_callback' => array($this, 'gravitizer_sanitize_number')
    ));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "gravitizer_switch_label_placement",
        array(
            "label" => esc_html__("Choice label placement", "gravitizer-lite"),
            "section" => "gravitizer_switch_field",
            "settings" => "gravitizer_switch_label_placement_$current_form_id",
            "type" => "number",
        )
    ));


    $wp_customize->add_setting("gravitizer_switch_label_size_$current_form_id", array(
        "default" => '16',
        "transport" => "postMessage",
        "type" => 'option',
        'sanitize_callback' => array($this, 'gravitizer_sanitize_number')
    ));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "gravitizer_switch_label_size",
        array(
            "label" => esc_html__("Label font size", "gravitizer-lite"),
            "section" => "gravitizer_switch_field",
            "settings" => "gravitizer_switch_label_size_$current_form_id",
            "type" => "number",
        )
    ));




    // Pro features
    $wp_customize->add_setting("gravitizer_switch_field_color_pro", array(
        "default" => '#111111',
        "transport" => "postMessage",
        "type" => 'option',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        "gravitizer_switch_color",
        array(
            "label" => '<h2 class="gravitizer-pro-branding">'.esc_html__("Upgrade to ", "gravitizer-lite")."<a target='_blank' href='https://codecanyon.net/item/gravitizer-gravity-forms-material-ui-styler/26570055'>Gravitizer Pro</a>".esc_html__(" to access these features below", 'gravitizer-lite').'</h2>'.esc_html__("Button color", "gravitizer-lite"),
            "section" => "gravitizer_switch_field",
            "settings" => "gravitizer_switch_field_color_pro",
        )
    ));


    $wp_customize->add_setting("gravitizer_switch_label_color_pro", array(
        "default" => '#111',
        "transport" => "postMessage",
        "type" => 'option',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        "gravitizer_switch_label_color",
        array(
            "label" => esc_html__("Label color", "gravitizer-lite"),
            "section" => "gravitizer_switch_field",
            "settings" => "gravitizer_switch_label_color_pro",
        )
    ));


    

?>