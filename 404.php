<?php get_header(); ?>
<style>
 /* 404 page */
 .not-found {
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: flex-start;
    align-items: center;
    flex-direction: column;
  }

.not-found__info {
	font-size: 55px;
	font-weight: 600;
	line-height: 3;
	text-align: center;
}

.not-found__description {
	font-size: 33px;
	text-align: center;
}

.not-found__link {
    color: inherit;
    text-decoration: underline;
}

.not-found__text {
	font-size: 26px;
	text-align: center;
}
</style>


    <div class="row justify-content-between mt-5">
        <div class="not-found">
            <h1 class="not-found__info"><?php esc_html_e('Page not found', 'gym') ?></h1>
            <p class="not-found__text"><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'gym' ); ?></p>
            <div>                    
                <?php get_search_form(); ?>
            </div>
            <div class="not-found__description"><?php esc_html_e('Return to', 'gym') ?> <a
                    href="<?php echo esc_url(home_url('/')); ?>" class="not-found__link"><?php esc_html_e('Home Page', 'gym') ?></a>
            </div>
        </div>
    </div>


<?php get_footer(); ?>