<?php get_header(); ?>
<main>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
            <?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
            </div>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                <?php if( have_posts() ) : while ( have_posts() ) : the_post() ?>                
                    <?php get_template_part('template-parts/content', get_post_format() );
					?>
                    <?php endwhile; 
                    start_theme_pagination();
                    else: ?>
                    <h3><?php esc_html_e('There are no posts', THEME_NAME) ?></h3>
                    <?php endif; ?>                 
            </div>
        </div>
    </div>
</main>
<?php wp_footer(); ?>