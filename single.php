<?php get_header(); ?>
<div class="l-contanier">
    <main class="l-main">
    	<?php
    	if ( have_posts() ) :

            while ( have_posts() ) : the_post();
                //タグ情報取得
                $current_id = get_the_id();
                get_template_part( 'template-parts/post/content', get_post_format() );
                //筆者情報
                get_template_part( 'template-parts/post/author', get_post_format() );
                //Share
                get_template_part( 'template-parts/post/share', get_post_format() );
    		endwhile;

    	else :

//    		get_template_part( 'template-parts/post/content', 'none' );

        endif;
        
        //relative posts
        // 関連する記事取得 同じタグの記事を取得
        $current_tags = get_the_tags($current_id);
        if($current_tags){
            $tag_ids = array();
            foreach($current_tags as $tag) {
                $tag_ids[]=$tag->term_id;
            }
            $args = array(
                'post_status' => 'publish',
                'posts_per_page' => 4,
                'orderby' => 'rand',
                'post__not_in' => array($current_id),
                'tag__in' => $tag_ids,
                'date_query' => array(
                        array(
                            'column' => 'post_date_gmt',
                            'after' => '3 year ago',
                        )
                    )
            );
            $related_posts = new WP_Query($args);
        }
    	?>
        <nav class="l-bottom__nav">
            <?php if ( $current_tags && $related_posts->have_posts() ) :?>
            <h2 class="m-ttl">関連する記事</h2>
            <ul class="m-list--relative">
                <?php while ( $related_posts->have_posts() ) : $related_posts->the_post();
                    get_template_part( 'template-parts/post/relative', get_post_format() );
                endwhile; wp_reset_postdata(); ?>
            </ul>
            <?php endif; ?>
            <h2 class="is-hide">次の記事・前の記事</h2>
            <div class="m-nav--prev-next">
                <?php previous_post_link('<div class="m-prev">%link</div>');
                next_post_link('<div class="m-next">%link</div>'); ?>
            </div>
        </nav>
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
