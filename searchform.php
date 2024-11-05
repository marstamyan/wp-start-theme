<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" class="search-field form-control input-round" value="<?php echo get_search_query(); ?>" name="s" /> 
	<input type="submit" class="search-submit btn btn-primary btn-round" value="<?php echo esc_attr_x( 'Search', 'submit button', 'THEME_NAME' ); ?>" />    
</form>