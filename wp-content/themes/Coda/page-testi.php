<?php
/**
 * Template Name: Testimonials
 */

get_header(); ?>
	<div id="content" class="grid_9 <?php echo of_get_option('blog_sidebar_pos') ?>">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <h2><?php the_title(); ?></h2>
    <div id="page-content"><?php the_content(); ?></div>
    <?php endwhile; endif; ?>
    <?php
    $temp = $wp_query;
    $wp_query= null;
    $wp_query = new WP_Query();
    $wp_query->query('post_type=testi&showposts=4&paged='.$paged);
    ?>
    <?php if (have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
      <?php 
      $custom = get_post_custom($post->ID);
      //$testiname = $custom["testimonial-name"][0];
      //$testiurl = $custom["testimonial-url"][0];
      ?>
      <article id="post-<?php the_ID(); ?>" class="testimonial post-holder">
        <div class="post-content">
					<?php if(has_post_thumbnail()) { ?>
						<?php
						$thumb = get_post_thumbnail_id();
						$img_url = wp_get_attachment_url( $thumb,'full'); //get img URL
						$image = aq_resize( $img_url, 120, 120, true ); //resize & crop img
						?>
						<figure class="featured-thumbnail">
							<img src="<?php echo $image ?>" alt="<?php the_title(); ?>" />
						</figure>
          <?php } ?>
          <?php the_content(); ?>
          <span class="name-testi">
            <span class="user"><?php echo $testiname; ?></span><br />
            <a href="<?php echo $testiurl; ?>"><?php echo $testiurl; ?></a>
          </span>
        </div>
      </article>
      
    <?php endwhile; else: ?>
      <div class="no-results">
				<?php echo '<p><strong>' . __('There has been an error.', 'theme1669') . '</strong></p>'; ?>
        <p><?php _e('We apologize for any inconvenience, please', 'theme1669'); ?> <a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('description'); ?>"><?php _e('return to the home page', 'theme1669'); ?></a> <?php _e('or use the search form below.', 'theme1669'); ?></p>
        <?php get_search_form(); /* outputs the default Wordpress search form */ ?>
      </div><!--no-results-->
    <?php endif; ?>
    
    <?php if ( $wp_query->max_num_pages > 1 ) : ?>
        <nav class="oldernewer">
          <div class="older">
            <?php next_posts_link( __('&laquo; Older Testimonials', 'theme1669')) ?>
          </div><!--.older-->
          <div class="newer">
            <?php previous_posts_link(__('Newer Testimonials &raquo;', 'theme1669')) ?>
          </div><!--.newer-->
        </nav><!--.oldernewer-->
      <?php endif; ?>
    
    <?php $wp_query = null; $wp_query = $temp;?>
	</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>