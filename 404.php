<?php get_header(); ?>
<div class="l-contanier">
    <main class="l-main">
    	<?php get_template_part( 'template-parts/post/no', get_post_format() ); ?>
    </main>
    <aside class="l-aside">
        <?php get_sidebar(); ?>
    </aside>
</div>
<?php get_footer(); ?>
