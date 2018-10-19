<!doctype html>
<html <?php language_attributes(); ?> prefix="og: http://ogp.me/ns#">
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-159996-6"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-159996-6');
</script>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> id="page-top">
 <!--[if lte IE 9]>
    <p style="background-color:#eee; padding: 1em;">お使いのブラウザは現在サポートされていません。より快適にご利用いただくために、 <a href="https://browsehappy.com/">ブラウザを更新</a>してください。You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->
<input class="m-btn--hamb__input" type="checkbox" />
<div class="l-wrapper">
<header class="l-global__header">
    <h1 class="m-logo"><a href="<?php echo home_url(); ?>" title="<?php bloginfo(); ?>"><span class="is-hide"><?php bloginfo(); ?></span><?php echo do_shortcode( '[svg]logo[/svg]' );?></a></h1>
    <p class="m-description"><?php echo bloginfo('description'); ?></p>
</header>
<?php if ( has_nav_menu( 'header-menu' ) ) : ?>
<nav class="l-global__nav">
    <h2 class="is-hide">グローバルメニュー</h2>
    <div class="l-icon--search"><?php echo do_shortcode( '[svg]search[/svg]' );?></div>
    <div class="l-global__nav__wrapper">
    <?php if ( is_active_sidebar( 'search_sidebar' ) ) : ?>
    <div class="l-search">
    	<?php dynamic_sidebar( 'search_sidebar' ); ?>
    </div>
    <?php endif; ?>
    <div class="m-icon--close"><span></span><span></span></div>
    <?php wp_nav_menu( array(
        'theme_location' => 'header-menu',
        'container' => false,
        'menu_class' => 'm-menu',
    ));
    if ( is_active_sidebar( 'archives_sidebar' ) ) : ?>
    <div class="l-archives">
    	<?php dynamic_sidebar( 'archives_sidebar' ); ?>
    </div>
    <?php endif; ?>
    </div>
</nav>
<?php endif; ?>
