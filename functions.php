<?php

	include_once(__DIR__ . '/inc/test-recent-posts.php');

	add_action( 'wp_enqueue_scripts', 'wpCourse_srcripts' );
	add_action( 'after_setup_theme', 'test_after_setup' );
	add_action( 'widgets_init', 'test_widgets' );
	add_filter( 'widget_text', 'do_shortcode' );

	add_action('init', 'test_register_post_types');
	add_action('wp_head', 'test_js_vars');
	add_shortcode('test_recent', 'test_recent');
	
	add_filter( 'the_content', 'conts' );
	function conts( $cont ){
		// filter...
		return $cont;
	}

	add_filter( 'wp_title_parts', 'filter_function_name_2589' );
	function filter_function_name_2589( $title_array ){
		// filter...
		echo $title_array;
		return $title_array;
	}

	function test_recent($attr) {
		// параметры по умолчанию
		$str = '';
		$args = array(
			'numberposts' => 5,
			'post_type' => 'post',
			'orderby'     => 'date',
			'order'       => 'DESC',
		);

		$posts = get_posts( $args );


		foreach($posts as $post){ 
			global $post;
			setup_postdata($post);

			$link = get_the_permalink();
			$title = get_the_title();
			$date = get_the_date();
			$sc = CFS()->get('intro');

			$str .= "<div>
				<div><em>$title</em></div>
				<div><em>$date</em></div>
				<div><strong>$sc</strong></div>
				<a href=\"$link\">Читать далее</a>
			</div>";
		}
		wp_reset_postdata();
		return $str;
	}

	function wpCourse_srcripts() {
		wp_enqueue_style('main-style', get_stylesheet_uri() );
		wp_enqueue_script( 'main-js', get_template_directory_uri() . '/assets/js/script.js' , ['jq'], null , true);
		wp_enqueue_script( 'jq', 'https://code.jquery.com/jquery-3.3.1.min.js' , [], null , true);
	}

	function test_after_setup() {
		register_nav_menu( 'top', 'Шапка' );
		register_nav_menu( 'footer', 'Подвал' );
		register_nav_menu( 'land', 'лендинг' );


		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-formats', array( 'aside', 'quote' ) );
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
		
		register_widget('Test_Recent_Posts');
	}


function test_register_post_types(){
	register_post_type('reviews', array(
		'label'  => null,
		'labels' => array(
			'name'               => 'Отзывы', // основное название для типа записи
			'singular_name'      => 'Отзыв', // название для одной записи этого типа
			'add_new'            => 'Добавить Отзыв', // для добавления новой записи
			'add_new_item'       => 'Добавление Отзывы', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование Отзывы', // для редактирования типа записи
			'new_item'           => 'Новое Отзывы', // текст новой записи
			'view_item'          => 'Смотреть Отзывы', // для просмотра записи этого типа.
			'search_items'       => 'Искать Отзывы', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Отзывы', // название меню
		),
		'description'         => '',
		'public'              => true,
		'publicly_queryable'  => null, // зависит от public
		'exclude_from_search' => null, // зависит от public
		'show_ui'             => null, // зависит от public
		'show_in_menu'        => null, // показывать ли в меню адмнки
		'show_in_admin_bar'   => null, // по умолчанию значение show_in_menu
		'show_in_nav_menus'   => null, // зависит от public
		'show_in_rest'        => null, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => null,
		'menu_icon'           => null, 
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => false,
		'supports'            => array('title','editor', 'thumbnail'), // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => array(),
		'has_archive'         => false,
		'rewrite'             => true,
		'query_var'           => true,
	) );

	register_post_type('flats', array(
		'label'  => null,
		'labels' => array(
			'name'               => 'Квартиры', // основное название для типа записи
			'singular_name'      => 'Квартира', // название для одной записи этого типа
			'add_new'            => 'Добавить Квартиру', // для добавления новой записи
			'add_new_item'       => 'Добавление Квартиры', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование Квартиры', // для редактирования типа записи
			'new_item'           => 'Новое Квартиры', // текст новой записи
			'view_item'          => 'Смотреть Квартиры', // для просмотра записи этого типа.
			'search_items'       => 'Искать Квартиры', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'parent_item_colon'  => '', // для родителей (у древовидных типов)
			'menu_name'          => 'Квартиры', // название меню
		),
		'description'         => '',
		'public'              => true,
		'publicly_queryable'  => null, // зависит от public
		'exclude_from_search' => null, // зависит от public
		'show_ui'             => null, // зависит от public
		'show_in_menu'        => null, // показывать ли в меню адмнки
		'show_in_admin_bar'   => null, // по умолчанию значение show_in_menu
		'show_in_nav_menus'   => null, // зависит от public
		'show_in_rest'        => null, // добавить в REST API. C WP 4.7
		'rest_base'           => null, // $post_type. C WP 4.7
		'menu_position'       => null,
		'menu_icon'           => null, 
		//'capability_type'   => 'post',
		//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
		//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'        => false,
		'supports'            => array('title','editor', 'thumbnail'), // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'          => array(),
		'has_archive'         => true,
		'rewrite'             => true,//array('slag' => '%city%'),
		'query_var'           => true,
	) );

	register_taxonomy( 'city', array('flats'), array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => array(
			'name'              => 'Города',
			'singular_name'     => 'Город',
			'search_items'      => 'Search Город',
			'all_items'         => 'All Города',
			'view_item '        => 'View Город',
			'parent_item'       => 'Parent Город',
			'parent_item_colon' => 'Parent Город:',
			'edit_item'         => 'Edit Город',
			'update_item'       => 'Update Город',
			'add_new_item'      => 'Add New Город',
			'new_item_name'     => 'New Город Name',
			'menu_name'         => 'Города',
		),
		'description'           => '', // описание таксономии
		'public'                => true,
		'hierarchical'          => false
	));

	register_taxonomy( 'rooms', array('flats'), array(
		'label'                 => '', // определяется параметром $labels->name
		'labels'                => array(
			'name'              => 'кол-во комнат',
			'singular_name'     => 'кол-во комнат',
			'search_items'      => 'кол-во комнат',
			'all_items'         => 'All комнаты',
			'view_item '        => 'View комнату',
			'edit_item'         => 'Edit комнату',
			'update_item'       => 'Update комнату',
			'add_new_item'      => 'Add New Город',
			'new_item_name'     => 'New комнат Name',
			'menu_name'         => 'комнаты',
		),
		'description'           => '', // описание таксономии
		'public'                => true,
		'hierarchical'          => false
	));
}
	function test_js_vars() {
		$vars = [
			'ajax_url' => admin_url('admin-ajax.php')
		];

		echo "<script>window.wp = ". json_encode($vars) ."</script>";
	}
	add_action( 'wp_ajax_flatapp', 'text_ajax_flatapp' );
	add_action( 'wp_ajax_nopriv_flatapp', 'text_ajax_flatapp' );

	function text_ajax_flatapp() {
		/*
		AJAX запрос обратка(добавить в базу, отправить на почту)
		*/
		$res = array('success' => mt_rand(0, 1) ? true : false, 
						'err' => '123');
		echo json_encode($res);

		wp_die();
	}
	function test_weds() {
		// параметры по умолчанию
		$str = '';
		$args = array(
			'post_type' => 'reviews',
			'orderby'     => 'date',
			'order'       => 'DESC',
		);

		//$posts = get_posts( $args );

		//var_dump($posts);

		return get_posts( $args );
	}

	add_image_size('flats-thumb', 400 , 300 , true );