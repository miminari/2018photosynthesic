<?php
/*
npm-script for wordpress
Theme Name: 2018 Photosynthesic
Version: 0.2
*/
// ================================ remove form header emoji etc.
function disable_emoji() {
     remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
     remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
     remove_action( 'wp_print_styles', 'print_emoji_styles' );
     remove_action( 'admin_print_styles', 'print_emoji_styles' );
     remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
     remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
     remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
     add_filter( 'emoji_svg_url', '__return_false' );
}
add_action( 'init', 'disable_emoji' );
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'show_admin_bar', '__return_false' );

//add title tag
add_theme_support( 'title-tag' );
//add feed link tag
add_theme_support( 'automatic-feed-links' );
//add html5 tags
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
/* アイキャッチ画像を使う */
add_theme_support( 'post-thumbnails' );

// ================================ widgetsの設定
function myTemplate_widgets_init() {
	register_sidebar( array(
		'name' => 'sidebar01',
		'id' => 'sidebar01',
		'before_widget' => '<div class="m-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="m-ttl">',
		'after_title' => '</h2>',
	) );
	register_sidebar( array(
		'name' => 'sidebar02',
		'id' => 'sidebar02',
		'before_widget' => '<div class="m-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="m-ttl">',
		'after_title' => '</h2>',
	) );
	register_sidebar( array(
		'name' => 'search sidebar',
		'id' => 'search_sidebar',
		'before_widget' => '<div class="m-search">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="m-ttl">',
		'after_title' => '</h2>',
	) );
	register_sidebar( array(
		'name' => 'archives sidebar',
		'id' => 'archives_sidebar',
		'before_widget' => '<div class="m-archives">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="m-ttl">',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'myTemplate_widgets_init' );

// ================================ menuの追加
function register_my_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'ヘッダーメニュー' ),
      'extra-menu' => __( '追加メニュー' )
    )
  );
}
add_action( 'init', 'register_my_menus' );

// ================================ css,jsの読み込み
function myTemplate_scripts() {
    //デバックでも本番でも読み込むもの
    //wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/vender/modernizr-2.8.3.min.js', array(),'2.8.3',false);
    wp_enqueue_script( 'vue', get_template_directory_uri() . '/js/vender/vue.js', array(), '2.5.16', true);
    wp_enqueue_script( 'axios', 'https://unpkg.com/axios/dist/axios.min.js', array(), '', true);
    //wp_enqueue_script( 'rgbaster', get_template_directory_uri() . '/js/vender/rgbaster.min.js', array(), '1.0.0', false);
    //デバック時と本番で切り替えるもの
    if(SCRIPT_DEBUG) {
        //css
        wp_enqueue_style( 'myTemplate-style', get_stylesheet_uri(), false, filemtime( get_stylesheet_directory() . '/style.css') );
        //js
        wp_enqueue_script( 'myTemplate-script', get_template_directory_uri() . '/js/main.js', array(), '1.0.0', true);
    } else {
        //css
        wp_enqueue_style('myTemplate-style', get_stylesheet_directory_uri() . '/style.min.css' );
        //js
        wp_enqueue_script( 'myTemplate-script', get_template_directory_uri() . '/js/main.min.js', array(), '1.0.0', true);
    }
}
add_action( 'wp_enqueue_scripts', 'myTemplate_scripts' );

// ================================  REST API にtag情報追加
function wp_rest_api_terms() {

  $params = array(
    'get_callback'    => function($data, $field, $request, $type) {

      if (function_exists('get_the_terms')) {

        $post = get_post( $data['id'] );
        $post_type = $post->post_type;
        $taxonomies = get_object_taxonomies( $post_type, 'objects' );
        $terms = array();
        foreach ( $taxonomies as $taxonomy_slug => $taxonomy ) {

          $terms[$taxonomy->label] = get_the_terms( $data['id'], $taxonomy_slug );

        }
        return $terms;

      }

      return [];

      },
    'update_callback' => null,
    'schema'          => null,
  );

  $post_types = get_post_types( '', 'names' );

  foreach ( $post_types as $post_type ) {

    register_rest_field( $post_type, 'terms', $params );

  }

}
add_action( 'rest_api_init', 'wp_rest_api_terms');

// ================================  excerpt の末尾変更
function new_excerpt_more($more) {
    return ' ... <a class="m-read-more" href="'. get_permalink( get_the_ID() ) . '">続きを読む</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');


// ================================  shortcode
function svg_func( $atts, $content = "" )  {
    return '<span class="m-svg--'.$content.'"><svg><use xlink:href="#'.$content.'"></use></svg></span>';
}
add_shortcode( 'svg', 'svg_func' );
?>
