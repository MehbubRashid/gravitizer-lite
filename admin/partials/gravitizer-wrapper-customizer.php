<?php
    $wp_customize->add_section("gravitizer_form_wrapper", array(
        "title" => esc_html__("Form Global Style", "gravitizer-lite"),
        "priority" => 30,
        'panel' => 'gravitizer_panel',
    ));


    $wp_customize->add_setting("gravitizer_wrapper_padding_$current_form_id", array(
        "default" => '0',
        "transport" => "postMessage",
        "type" => 'option',
        'sanitize_callback' => array($this, 'gravitizer_sanitize_number')
    ));
    $wp_customize->add_control(new WP_Customize_Control(
        $wp_customize,
        "gravitizer_wrapper_padding",
        array(
            "label" => esc_html__("Form Padding", "gravitizer-lite"),
            "section" => "gravitizer_form_wrapper",
            "settings" => "gravitizer_wrapper_padding_$current_form_id",
            "type" => "number",
        )
    ));

    $wp_customize->add_setting("gravitizer_field_value_color_$current_form_id", array(
        "default" => '#111',
        "transport" => "postMessage",
        "type" => 'option',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        "gravitizer_field_value_color",
        array(
            "label" => esc_html__("Field Value Text Color", "gravitizer-lite"),
            "section" => "gravitizer_form_wrapper",
            "settings" => "gravitizer_field_value_color_$current_form_id",
        )
    ));



    $wp_customize->add_setting("gravitizer_form_wrapper_color_$current_form_id", array(
        "default" => '#fff',
        "transport" => "postMessage",
        "type" => 'option',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        "gravitizer_form_wrapper_color",
        array(
            "label" => esc_html__("Form Background Color", "gravitizer-lite"),
            "section" => "gravitizer_form_wrapper",
            "settings" => "gravitizer_form_wrapper_color_$current_form_id",
        )
    ));


    

?>