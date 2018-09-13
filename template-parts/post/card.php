<article class="m-card" id="post-<?php the_ID(); ?>" <?php post_class('m-article'); ?>>
	<div class="m-media">
<?php if (has_post_thumbnail())://画像がある場合　?>

<!--script type="text/javascript">//画像から色を取得して表示
	var img = "<?php the_post_thumbnail_url( 'thumbnail' ) ?>";
	var color = "#eee";
	RGBaster.colors(img, {
		paletteSize: 3,
		exclude: [ 'rgb(255,255,255)','rgb(0,0,0)' ],
		success: function(payload) {
			color = payload.secondary;
			var app = new Vue({
				el: '.a-color--<?php the_ID()?>',
				data: {
					'activeColor' : color
				}
			})
			//is-loaded
			var app = new Vue({
				el: '.a-color__container--<?php the_ID()?>',
				data: { "isLoaded" : true }
			})
		}
	});
</script -->

		<a href="<?php the_permalink(); ?>" class="a-color__container a-color__container--<?php the_ID()?>" v-bind:class="{ 'is-loaded': isLoaded }">
		<span class="a-color a-color--<?php the_ID()?>" v-bind:style="{ backgroundColor: activeColor }"></span>
		<?php the_post_thumbnail('large');?></a>
<?php else: //画像がない場合 ?>
		<a href="<?php the_permalink(); ?>" class="a-color__container">
			<span class="a-color"></span>
		</a>
<?php endif; ?>
	</div>
	<div class="m-card__body">
		<a href="<?php the_permalink(); ?>">
			<h3 class="m-ttl"><?php the_title();?></h3>
			<div class="m-txt"><?php the_excerpt(); ?></div>
		</a>
		<div class="m-musthead">
			<!-- span class="m-category"><?php
			$category = get_the_category();
			echo $category[0]->cat_name;
			?></span -->
			<span class="m-date"><?php the_modified_date('Y-m-d'); ?></span>
			<span class="m-tag__container"><?php the_tags( '<span class="m-tag">', '</span><span class="m-tag">', '</span>' ); ?></span>
		</div>

	</div>
</article>
