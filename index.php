<?php get_header(); ?>
<div class="l-contanier">
    <main class="l-main">
    	<?php
    	if ( have_posts() ) :

    		while ( have_posts() ) : the_post();

    			get_template_part( 'template-parts/post/content', get_post_format() );

    		endwhile;?>
            <div class="m-pagination">
    		<?php the_posts_pagination(); ?>
            </div>
    	<?php endif;?>

    </main>
    <aside class="l-aside">
        <?php get_sidebar(); ?>
    </aside>
</div>
<?php get_footer(); ?>
