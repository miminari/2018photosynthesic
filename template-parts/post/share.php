<div class="l-share">
	<h2 class="is-hide">この記事を共有する</h2>
	<ul class="m-list--sns">
		<li class="m-list__item">
			<a class="m-list__link" href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank"><?php echo do_shortcode( '[svg]twitter[/svg]' ); ?></a>
		</li>
		<li class="m-list__item">
			<a class="m-list__link" href="https://www.facebook.com/dialog/share?app_id=450826578664610&display=popup&href=<?php echo urlencode(get_permalink()); ?>" target="_blank"><?php echo do_shortcode( '[svg]facebook[/svg]' ); ?></a>
		</li>
	</ul>
</div>
