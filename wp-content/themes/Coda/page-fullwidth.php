<?php
/**
 * Template Name: Fullwidth Page
 */

get_header(); ?>

<div id="content-cd">

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
   
       
        <?php //if(has_post_thumbnail()) {
					//echo '<a href="'; the_permalink(); echo '">';
					//echo '<figure class="featured-thumbnail"><span class="img-wrap">'; the_post_thumbnail(); echo '</span></figure>';
					//echo '</a>';
					//}
				?>
        <div class="entry_title"><h1><?php the_title(); ?></h1></div>
          <?php the_content(); ?>
          

  <?php endwhile; ?>
                          

<?php get_footer(); ?>
