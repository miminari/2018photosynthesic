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
    wp_enqueue_script( 'moment', 'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/locale/ja.js', array(), '', true);
    //wp_enqueue_script( 'rgbaster', get_template_directory_uri() . '/js/vender/rgbaster.js', array(), '1.1.0', true);
    wp_enqueue_script( 'rgbaster', get_template_directory_uri() . '/js/vender/rgbaster.min.js', array(), '1.0.0', false);
    //デバック時と本番で切り替えるもの
    if(SCRIPT_DEBUG) {
        //css
        wp_enqueue_style( 'photosynthesic-style', get_stylesheet_uri(), false, filemtime( get_stylesheet_directory() . '/style.css') );
        //js
        wp_enqueue_script( 'photosynthesic-script', get_template_directory_uri() . '/js/main.js', array(),false, true);
    } else {
        //css
        wp_enqueue_style('photosynthesic-style', get_stylesheet_directory_uri() . '/style.min.css',false, filemtime( get_stylesheet_directory() . '/style.min.css') );
        //js
        wp_enqueue_script( 'photosynthesic-script', get_template_directory_uri() . '/js/main.min.js', array(), false, true);
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

/*********************
OGPタグ/Twitterカード設定を出力
*********************/
function my_meta_ogp() {
  if( is_front_page() || is_home() || is_singular() ){
    global $post;
    $ogp_title = '';
    $ogp_descr = '';
    $ogp_url = '';
    $ogp_img = '';
    $insert = '';

    if( is_singular() ) { //記事＆固定ページ
       setup_postdata($post);
       $ogp_title = $post->post_title;
       $ogp_descr = mb_substr(get_the_excerpt(), 0, 100);
       $ogp_url = get_permalink();
       wp_reset_postdata();
    } elseif ( is_front_page() || is_home() ) { //トップページ
       $ogp_title = get_bloginfo('name');
       $ogp_descr = get_bloginfo('description');
       $ogp_url = home_url();
    }

    //og:type
    $ogp_type = ( is_front_page() || is_home() ) ? 'website' : 'article';

    //og:image
    if ( is_singular() && has_post_thumbnail() ) {
       $ps_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
       $ogp_img = $ps_thumb[0];
    } else {
     $ogp_img = 'http://blog.photosynthesic.jp/wordpress/wp-content/uploads/2017/01/top_photo-3-768x432.jpg';
    }

    //出力するOGPタグをまとめる
    $insert .= '<meta property="og:title" content="'.esc_attr($ogp_title).'" />' . "\n";
    $insert .= '<meta property="og:description" content="'.esc_attr($ogp_descr).'" />' . "\n";
    $insert .= '<meta property="og:type" content="'.$ogp_type.'" />' . "\n";
    $insert .= '<meta property="og:url" content="'.esc_url($ogp_url).'" />' . "\n";
    $insert .= '<meta property="og:image" content="'.esc_url($ogp_img).'" />' . "\n";
    $insert .= '<meta property="og:site_name" content="'.esc_attr(get_bloginfo('name')).'" />' . "\n";
    $insert .= '<meta name="twitter:card" content="summary_large_image" />' . "\n";
    $insert .= '<meta name="twitter:site" content="photosynthesic" />' . "\n";
    $insert .= '<meta property="og:locale" content="ja_JP" />' . "\n";

    //facebookのapp_id（設定する場合）
    $insert .= '<meta property="fb:app_id" content="450826578664610">' . "\n";
    
    // google thumbnail 
	  $insert .= '<meta name="thumbnail" content="'.esc_url($ogp_img).'" />' . "\n";

    echo $insert;
  }
} //END my_meta_ogp

add_action('wp_head','my_meta_ogp');//headにOGPを出力

?>
