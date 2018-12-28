<article id="post-<?php the_ID(); ?>" <?php post_class('m-article'); ?>>
	<header class="m-article__header">
		<div class="m-tags">
			<?php
			// echo do_shortcode('[svg]tags[/svg]') ;
			the_tags( '<span class="m-tag">', '</span><span class="m-tag">', '</span>' );
			?>
		</div>
		<?php
			if ( is_single() || is_page() ) {
				the_title( '<h1 class="m-ttl">', '</h1>' );
			} else {
				the_title( '<h2 class="m-ttl"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
		?>
		<div class="m-musthead">
			<div class="m-date"><?php the_date('Y-m-d'); ?></div>
		</div>
	</header>
	<?php /* if (has_post_thumbnail())://画像がある場合　?>
		<div class="m-media"><?php the_post_thumbnail('large');?></div>
	<?php endif; */ ?>

	<div class="m-article__body">
		<?php if ( is_single() ){
			$date = get_the_date("Y-m-d H:i:s");
			if (strtotime($date) < strtotime(date("Y-m-d H:i:s",strtotime("-3 year")))) {
				echo '<div class="m-alert"><p>この記事は3年以上前のものです。</p></div>';
			}
		}
		/*
		$content_arr = get_extended (get_the_content() );
		if($content_arr['extended']) {
			//moreタグ前
			echo $content_arr['main'];
			//広告
			get_template_part( 'template-parts/post/adsence', get_post_format() );
			//moreタグ後
			echo $content_arr['extended'];
		}else{
			//広告
			get_template_part( 'template-parts/post/adsence', get_post_format() );
			//moreタグ後
			echo $content_arr['main'];
		}*/
		//広告
		//get_template_part( 'template-parts/post/adsence', get_post_format() );
		//コンテンツ
		the_content() ?>
	</div>
	<?php //ページ送り
		wp_link_pages( array(
		'before'      => '<div class="m-pagination"><h2 class="is-hide">ページ送り</h2>',
		'after'       => '</div>',
		'link_before' => '<span class="m-pagination__number">',
		'link_after'  => '</span>',
		) );
	?>
</article><!-- #post-## -->
