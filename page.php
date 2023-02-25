<?php

get_header();

/* Start the Loop */
while ( have_posts() ) :
	the_post();

?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php the_content(); ?>
	</article>


<?php

endwhile; // End of the loop.
?>
<?php
get_footer();
?>