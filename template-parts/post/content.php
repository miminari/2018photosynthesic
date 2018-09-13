<article id="post-<?php the_ID(); ?>" <?php post_class('m-article'); ?>>
	<header class="m-article__header">
		<div class="m-musthead">
			<div class="m-date"><?php the_modified_date('Y-m-d'); ?></div>
		</div>
		<?php
			if ( is_single() || is_page() ) {
				the_title( '<h1 class="m-ttl">', '</h1>' );
			} else {
				the_title( '<h2 class="m-ttl"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
		?>
	</header>
	<?php if (has_post_thumbnail())://画像がある場合　?>
		<div class="m-media"><?php the_post_thumbnail('large');?></div>
	<?php endif; ?>

	<div class="m-article__body">
		<?php the_content() ?>
	</div>

	<div class="m-tags">
		<?php
		echo do_shortcode('[svg]tags[/svg]') ;
		the_tags( '<span class="m-tag">', '</span><span class="m-tag">', '</span>' );
		?>
	</div>
</article><!-- #post-## -->
