<form role="search" method="get" class="m-search__form" action="<?php echo home_url( '/' ); ?>">
	<label>
		<input type="search" class="m-search__field" placeholder="何かお探しですか？" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
	</label>
	<!-- input type="submit" class="m-search__submit" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" / -->
</form>
