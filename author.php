<?php get_header(); ?>
<div class="container">
    <div class="row justify-content-between mt-5">		
        <div class="col-md-12 pt-8">
	<div class="author-bio <?php echo get_option( 'show_avatars' ) ? 'show-avatars' : ''; ?>">
		<?php echo get_avatar( get_the_author_meta( 'ID' ), '85' ); ?>
		<div class="author-bio-content">
			<h2 class="author-title"><?php echo get_the_author(); ?></h2>
			<p class="author-description"> <?php the_author_meta( 'description' ); ?></p><!-- .author-description -->
			<?php
				get_the_author();
			?>
		</div><!-- .author-bio-content -->
	</div><!-- .author-bio -->
	    <?php
    $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
    ?>

    <h2>About: <?php echo $curauth->nickname; ?></h2>
    <dl>
        <dt>Website</dt>
        <dd><a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a></dd>
        <dt>Profile</dt>
        <dd><?php echo $curauth->user_description; ?></dd>
    </dl>

    <h2><?php echo $curauth->nickname; ?>:</h2>

    <ul>
<!-- The Loop -->

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <li>
            <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link: <?php the_title(); ?>">
            <?php the_title(); ?></a>,
            <?php the_time('d M Y'); ?> in <?php the_category('&');?>
        </li>

    <?php endwhile; else: ?>
        <p><?php _e('No posts by this author.'); ?></p>

    <?php endif; ?>

<!-- End Loop -->

    </ul>
    </div>
</div>

<?php get_footer(); ?>