<?php get_header(); ?>
<div class="container">
    <div class="row justify-content-between mt-5">		
        <div class="col-md-8">
		<h1 class="font-weight-bold spanborder">
					<?php
					printf( esc_html__( 'Search Results for: %s', '_s' ), '<span>' . get_search_query() . '</span>' );
					?></h1>
		<?php if( have_posts() ) : 
				while( have_posts() ) :
					the_post();
				get_template_part('template-parts/loop-content');					
		?>     
		<?php endwhile;
        muna_pagination();
        else : ?>
			<h2> <?php esc_html_e('There are no post', THEME_NAME); ?></h2>
		<?php endif; ?>	       
        </div>
        <?php if(is_active_sidebar( 'muna_right_sidebar' )) : ?>            
            <?php get_sidebar('right'); ?>            
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>