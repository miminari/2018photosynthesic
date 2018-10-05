<article id="post-<?php the_ID(); ?>" <?php post_class('m-article'); ?>>
	<header class="m-article__header">
		<div class="m-musthead">
			<div class="m-date"><?php the_date('Y-m-d'); ?></div>
		</div>
		<?php
			the_title( '<h2 class="m-ttl"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		?>
	</header>

	<div class="m-article__body">
		<?php the_excerpt() ?>
	</div>
</article><!-- #post-## -->
