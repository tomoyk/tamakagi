<?php

/*
 * Enbale widget
 * * * * * * * * * * * * * * * * * * * * * * */
function left_widgets_init() {
  register_sidebar(array(
    'name' => 'Site Left Sidebar',
    'id' => 'site_left',
    'before_widget' => '<div class="container widget">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgetTitle">',
    'after_title' => '</h4>',
  ));
}
add_action( 'widgets_init', 'left_widgets_init' );

/*
 * Add theme-customizer
 * * * * * * * * * * * * * * * * * * * * * * */
function theme_customizer_register($wp_customize){

	$wp_customize->add_section('tamakagi_theme_scheme', array(
		'title' => '項目名',
		'priority' => 200,
	));

	$wp_customize->add_setting('tamakagi_theme_option_text', array(
		'default' => '',
		'type'    => 'option',
		'transport'=> 'refresh',
	));

	$wp_customize->add_control('tamakagi_theme_origin_text', array(
		'settings' => 'tamakagi_theme_option_text',
		'label'    => 'テキスト入力',
		'section'  => 'tamakagi_theme_scheme',
		'type'     => 'text',
	));

}
add_action('cutomize_register', theme_customizer_register);

function themeCustom(){
	?>

	<style type="text/css">
		h1{
			color: red;
		}
	</style>

	<?php
}
add_action('wp_head', 'themeCustom');


?>