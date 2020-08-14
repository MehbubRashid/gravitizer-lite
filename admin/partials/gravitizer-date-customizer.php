<?php
    $wp_customize->add_section("gravitizer_date_field", array(
        "title" => esc_html__("Date Fields", "gravitizer-lite"),
        "priority" => 30,
        'panel' => 'gravitizer_panel',
    ));


    $wp_customize->add_setting("gravitizer_date_field_color_pro", array(
        "default" => '#fd4741',
        "transport" => "postMessage",
        "type" => 'option',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        "gravitizer_date_field_color",
        array(
            "label" => '<h2 class="gravitizer-pro-branding">'.esc_html__("Upgrade to ", "gravitizer-lite")."<a target='_blank' href='https://codecanyon.net/item/gravitizer-gravity-forms-material-ui-styler/26570055'>Gravitizer Pro</a>".esc_html__(" to access these features below", 'gravitizer-lite').'</h2>'.esc_html__("Theme Color", "gravitizer-lite"),
            "section" => "gravitizer_date_field",
            "settings" => "gravitizer_date_field_color_pro",
        )
    ));

?>