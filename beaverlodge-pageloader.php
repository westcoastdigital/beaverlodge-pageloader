<?php
/*
Plugin Name: Beaverlodge Pageloader
Plugin URI: https://beaverlodgehq.com
Description: Add animated pageloader to your site
Version: 1.0.0
Author: Beaverlodge HQ
Author URI: https://beaverlodgehq.com
*/

function beaverlodge_pageloader_scripts() {
    wp_enqueue_script( 'beaverlodge-pageloader', plugin_dir_url( __FILE__ ) . 'beaverlodge-pageloader.js' );
    wp_enqueue_style( 'beaverlodge-pageloader', plugin_dir_url( __FILE__ ) . 'beaverlodge-pageloader.css' );
}
add_action( 'wp_enqueue_scripts', 'beaverlodge_pageloader_scripts' );

function beaverlodge_pageloader_styles() {
        $pageloader = get_theme_mod( 'beaverlodge-pageloader', plugins_url( 'images/pageloader.gif', __FILE__ ) );
        $custom_css = "
                .bl-pageloader {
                        background: url({$pageloader}) center no-repeat #fff;
                }";
        wp_add_inline_style( 'beaverlodge-pageloader', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'beaverlodge_pageloader_styles' );


function beaverlodge_pageloader_register( $wp_customize ) {
    $wp_customize->add_section(
        'bl_pageloader',
        array(
            'title' => 'Pageloader',
            'description' => 'Add your pageloader image.',
            'priority' => 35,
        )
    );
    $wp_customize->add_setting( 
        'beaverlodge_pageloader', array(
        'default' => plugins_url( 'images/pageloader.gif', __FILE__ ),
    ) );
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'beaverlodge-pageloader',
            array(
                'label' => 'Pageloader Image',
                'section' => 'bl_pageloader',
                'settings' => 'beaverlodge_pageloader'
            )
        )
    );
}
add_action( 'customize_register', 'beaverlodge_pageloader_register' );