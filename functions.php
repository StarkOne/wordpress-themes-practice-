<?php
	add_action( 'wp_enqueue_scripts', 'wpCourse_srcripts' );
	add_action( 'after_setup_theme', 'test_after_setup' );
	add_action( 'widgets_init', 'test_widgets' );

	function wpCourse_srcripts() {
		wp_enqueue_style('main-style', get_stylesheet_uri() );
		wp_enqueue_script( 'main-js', get_template_directory_uri() . '/assets/js/script.js' , [], null , true);
	}


	function test_after_setup() {
		register_nav_menu( 'top', 'Шапка' );
		register_nav_menu( 'footer', 'Подвал' );

		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
	}

	function test_widgets() {
		$args = array(
			'name'          => 'Sidebar right',
			'id'            => 'sidebar-right',
			'description'   => 'правая колонка',
			'class'         => '',
			'before_widget' => '<div class="widget %2$s">',
			'after_widget'  => '</div>',
		);
		$args1 = array(
			'name'          => 'Странный пример',
			'id'            => 'sidebar-top',
			'description'   => 'вверх бар',
			'class'         => '',
			'before_widget' => '<div class="widget %2$s">',
			'after_widget'  => '</div>',
		);
		
		register_sidebar( $args );
		register_sidebar( $args1 );
		
	}