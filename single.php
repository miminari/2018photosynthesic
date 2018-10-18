<?php get_header(); ?>
<div class="l-contanier">
    <main class="l-main">
    	<?php
    	if ( have_posts() ) :

    		while ( have_posts() ) : the_post();
                get_template_part( 'template-parts/post/content', get_post_format() );
                //筆者情報
                get_template_part( 'template-parts/post/author', get_post_format() );
                //Share
                get_template_part( 'template-parts/post/share', get_post_format() );
    		endwhile;

    	else :

//    		get_template_part( 'template-parts/post/content', 'none' );

    	endif;
    	?>
        <nav class="l-bottom__nav">
            <h2 class="is-hide">次の記事・前の記事</h2>
            <div class="m-nav--prev-next">
                <?php previous_post_link('<div class="m-prev">%link</div>');
                next_post_link('<div class="m-next">%link</div>'); ?>
            </div>
        </nav>
    </main>
    <aside class="l-aside">
        <?php get_sidebar(); ?>
    </aside>
</div>

<?php get_footer(); ?>
