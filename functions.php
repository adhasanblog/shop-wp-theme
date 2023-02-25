<?php

function shop_style()
{
	wp_enqueue_style('bootstrap', get_theme_file_uri('/css/bootstrap.css'));
	wp_enqueue_style('main', get_theme_file_uri('/css/style.css'));
	wp_enqueue_style('swiper', get_theme_file_uri('/css/swiper.css'));



	wp_enqueue_style('dark', get_theme_file_uri('/css/dark.css'));
	wp_enqueue_style('font-icons', get_theme_file_uri('/css/font-icons.css'));
	wp_enqueue_style('animate', get_theme_file_uri('/css/animate.css'));
	wp_enqueue_style('magnific-popup', get_theme_file_uri('/css/magnific-popup.css'));
	wp_enqueue_style('custom', get_theme_file_uri('/css/custom.css'));

	wp_enqueue_style( 'setting-slider', get_theme_file_uri( '/include/rs-plugin/css/settings.css' ) );
	wp_enqueue_style( 'layer-slider', get_theme_file_uri( '/include/rs-plugin/css/layers.css' ) );
	wp_enqueue_style( 'navigation-slider', get_theme_file_uri( '/include/rs-plugin/css/navigation.css' ) );


	wp_enqueue_script('jquery-theme', get_theme_file_uri('/js/jquery.js'), [], '', true);
	wp_enqueue_script('plugins', get_theme_file_uri('/js/plugins.min.js'), [], '', true);
	wp_enqueue_script('functions', get_theme_file_uri('/js/functions.js'), [], '', true);

	wp_enqueue_script( 'tools', get_theme_file_uri( '/include/rs-plugin/js/jquery.themepunch.tools.min.js' ), [ 'jquery', 'plugins' ], '', true );
	wp_enqueue_script( 'revolution', get_theme_file_uri( '/include/rs-plugin/js/jquery.themepunch.revolution.min.js' ), [ 'jquery', 'plugins' ], '', true );
	wp_enqueue_script( 'video', get_theme_file_uri( '/include/rs-plugin/js/extensions/revolution.extension.video.min.js' ), [ 'jquery', 'plugins' ], '', true );
	wp_enqueue_script( 'slideanims', get_theme_file_uri( '/include/rs-plugin/js/extensions/revolution.extension.slideanims.min.js' ), [ 'jquery', 'plugins' ], '', true );
	wp_enqueue_script( 'actions', get_theme_file_uri( '/include/rs-plugin/js/extensions/revolution.extension.actions.min.js' ), [ 'jquery', 'plugins' ], '', true );
	wp_enqueue_script( 'layeranimation', get_theme_file_uri( '/include/rs-plugin/js/extensions/revolution.extension.layeranimation.min.js' ), [ 'jquery', 'plugins' ], '', true );
	wp_enqueue_script( 'kenburn', get_theme_file_uri( '/include/rs-plugin/js/extensions/revolution.extension.kenburn.min.js' ), [ 'jquery', 'plugins' ], '', true );
	wp_enqueue_script( 'navigation', get_theme_file_uri( '/include/rs-plugin/js/extensions/revolution.extension.navigation.min.js' ), [ 'jquery', 'plugins' ], '', true );
	wp_enqueue_script( 'migration', get_theme_file_uri( '/include/rs-plugin/js/extensions/revolution.extension.migration.min.js' ), [ 'jquery', 'plugins' ], '', true );
	wp_enqueue_script( 'parallax', get_theme_file_uri( '/include/rs-plugin/js/extensions/revolution.extension.parallax.min.js' ), [ 'jquery', 'plugins' ], '', true );

	wp_enqueue_script('sliderset', get_theme_file_uri('/js/sliders-setting.js'), [], '', true);

}

add_action('wp_enqueue_scripts',  'shop_style');

function add_jquery() {
	wp_enqueue_script('jquery');
}
add_action('init', 'add_jquery');

function shop_customize($wp_customize)
{
	$wp_customize->add_setting('logo_shop', array(
		'default' => esc_url(get_theme_file_uri('/images/logo.png')),
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'logo_control', array(
		'label' => 'Upload Logo',
		'section' => 'title_tagline',
		'settings' => 'logo_shop',
		'button_labels' => array(
			'select' => 'Select Logo',
			'remove' => 'Remove Logo',
			'change' => 'Change Logo'
		)
	)));

	$wp_customize->add_setting('telp_shop', array(
		'default' => esc_html('(62) 21 1111 1111'),
	));

	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'telp_control', array(
		'label' => 'Telepon',
		'section' => 'title_tagline',
		'settings' => 'telp_shop',
		'type' => 'tel',
	)));

	$wp_customize->add_setting('email_shop', array(
		'default' => esc_html('fuad@inginjadiprogrammer.com'),
	));

	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'email_control', array(
		'label' => 'Email',
		'section' => 'title_tagline',
		'settings' => 'email_shop',
		'type' => 'email',
	)));

}

add_action('customize_register', 'shop_customize');



function add_additional_class_on_a($classes, $item, $args)
{
	if (isset($args->add_a_class)) {
		$classes['class'] = $args->add_a_class;
	}
	return $classes;
}

add_filter('nav_menu_link_attributes', 'add_additional_class_on_a', 1, 3);


function shop_post_type() {
	register_post_type( 'slider', array(
		'public'    => true,
		'supports'  => array( 'title' ),
		'labels'    => array(
			'name'         => 'Sliders',
			'add_new_item' => 'Add New Slider',
			'edit_item'    => 'Edit Slider',
			'all_items'    => 'All Sliders'
		),
		'menu_icon' => 'dashicons-images-alt'

	) );
}


add_action( 'init', 'shop_post_type' );


function shop_ijp_support()
{
	add_theme_support('post-thumbnails');
}


add_action('after_setup_theme', 'shop_ijp_support');

function menu_register()
{
	register_nav_menu('primary', 'Primary Navigation');
}

add_action('init', 'menu_register');



?>