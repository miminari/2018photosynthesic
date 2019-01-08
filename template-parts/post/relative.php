<li class="m-list__item">
    <div class="m-media"><a href="<?php the_permalink() ;?>"><?php if ( has_post_thumbnail() ) :  the_post_thumbnail('medium'); else: echo '<span class="m-media--none">no image</span>'; endif; ?></a></div>
    <div class="m-txts">
        <?php the_title( '<div class="m-ttl"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></div>' ); ?>
        <span class="m-date"><?php the_time('Y-m-d') ?></span>
    </div>
</li>