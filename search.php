<?php get_header(); ?>
<div class="l-contanier">
    <main class="l-main">
    	<?php
        if ( have_posts() ) : ?>
            <h1 class="m-ttl"><?php printf( __( '検索結果: %s'), '<span>' . get_search_query() . '</span>' ); ?></h1>
    	<?php	while ( have_posts() ) : the_post();

    			get_template_part( 'template-parts/post/excerpt', get_post_format() );

    		endwhile;?>
            <div class="m-pagination">
    		<?php the_posts_pagination(); ?>
            </div>
    	<?php endif;?>

    </main>
    <aside class="l-aside">
        <?php if ( is_active_sidebar( 'sidebar02' ) ) : ?>
            <?php dynamic_sidebar( 'sidebar02' ); ?>
        <?php endif;?>

        <h2 class="is-hide">関連情報</h2>
        <?php if ( is_active_sidebar( 'sidebar01' ) ) : ?>
            <div class="m-box">
                <?php dynamic_sidebar( 'sidebar01' ); ?>
            </div>
        <?php endif;?>
    </aside>
</div>
<?php get_footer(); ?>
