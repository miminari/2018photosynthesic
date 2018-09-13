<?php get_header(); ?>
<div class="l-contanier--home">
<main class="l-main" id="app">
    <div class="m-box--fit" v-bind:class="{ 'is-loading' : isLoading, 'is-loaded' : isLoaded }">
        <article class="m-card" id="post-" v-for="post in posts">
        	<div class="m-media">

                <a v-bind:href="post.link" class="a-color__container">
        		    <span class="a-color"></span>
                    <span v-if="post._embedded['wp:featuredmedia']">
        		    <img :src="post._embedded['wp:featuredmedia'][0].source_url" alt=""></span>
                </a>
            </div>
            <div class="m-card__body">
        		<a href="<?php the_permalink(); ?>">
        			<h3 class="m-ttl">{{post.title.rendered}}</h3>
        			<div class="m-txt" v-html="post.excerpt.rendered"></div>
        		</a>
        		<div class="m-musthead">
        			<span class="m-date">{{post.date}}</span>
        			<span class="m-tag__container">
                        <span v-if="post.terms['タグ']">
                            <span class="m-tag" v-for="(tag) in post.terms['タグ']">{{tag.name}}</span>
                        </span>
                    </span>
        		</div>
            </div>
        </article>
    </div>
        <!-- 一覧ページへのリンク -->
        <div class="m-btn"><a href="#" class="m-btn__link">記事一覧</a></div>
</main>
<aside class="l-aside">

    <?php if ( is_active_sidebar( 'sidebar02' ) ) : ?>
    	<?php dynamic_sidebar( 'sidebar02' ); ?>
    <?php endif;?>
    <div class="m-box">
    <?php if ( is_active_sidebar( 'sidebar01' ) ) : ?>
    	<?php dynamic_sidebar( 'sidebar01' ); ?>
    <?php endif;?>
    </div>
</aside>
</div>
<?php get_footer(); ?>
