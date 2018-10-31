<?php get_header(); ?>
<div class="l-contanier--home">
<main class="l-main" id="app">
    <div class="m-box--fit" v-bind:class="{ 'is-loading' : isLoading, 'is-loaded' : isLoaded }">
        <article class="m-card" v-bind:id="'post-' + post.id" v-for="(post,index) in posts">
        	<div class="m-media">
                <a v-bind:href="post.link" class="a-color__container" v-bind:class="{'is-colored' : post.isColored }">
                    <span class="m-loading--circle"></span>
        		    <span class="a-color" v-bind:class="'a-color--' + post.id" v-bind:style="{ background: post.dcolor }"></span>
                    <span v-if="post._embedded['wp:featuredmedia']">
                    <img :src="post._embedded['wp:featuredmedia'][0].source_url" alt="">
                    <!-- img :width="post._embedded['wp:featuredmedia'][0].media_details.sizes.large.width" :height="post._embedded['wp:featuredmedia'][0].media_details.sizes.large.height" :src="post._embedded['wp:featuredmedia'][0].media_details.sizes.large.source_url" :srcset="post._embedded['wp:featuredmedia'][0].media_details.sizes.large.source_url +' 1024w, ' + post._embedded['wp:featuredmedia'][0].media_details.sizes.medium_large.source_url +' 768w'" sizes="(max-width: 1024px) 100vw, 1024px" :alt="post.title.rendered + 'のイメージ'"-->
                   </span>
                </a>
            </div>
            <div class="m-card__body">
        		<a v-bind:href="post.link">
                    <h3 class="m-ttl">{{post.title.rendered}}</h3>
                    <!-- div v-if="index == 0">
                        <div class="m-txt" v-html="post.content.rendered"></div>
                    </div>
                    <div v-else -->
                        <div class="m-txt" v-html="post.excerpt.rendered"></div>
                    <!-- /div -->
        		</a>
        		<div class="m-musthead">
        			<span class="m-date">{{post.date| moment}}</span>
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
        <!-- div class="m-btn"><a href="#" class="m-btn__link">記事一覧</a></div -->
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
