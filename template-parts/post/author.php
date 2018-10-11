<div class="m-author">
    <h2 class="m-ttl">この記事を書いた人</h2>
    <div class="m-author__icon"><?php echo get_avatar( get_the_author_meta( 'ID' ), 120 ); ?></div>
    <h3 class="m-author__name"><?php the_author(); ?></h3>
    <div class="m-author__description">
        <?php the_author_meta( 'user_description' ); ?>
    </div>
</div>