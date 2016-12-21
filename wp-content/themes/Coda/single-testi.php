<?php get_header(); ?>
<div id="content" class="grid_9 <?php echo of_get_option('blog_sidebar_pos') ?>">
	<h2><?php the_title(); ?></h2>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php 
    $custom = get_post_custom($post->ID);
    $testiname = $custom["testimonial-name"][0];
    $testiurl = $custom["testimonial-url"][0];
    ?>
    <blockquote class="testi-single" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
        <span class="name-testi single-testi">
          <span class="user"><?php echo $testiname; ?></span><br />
          <a href="<?php echo $testiurl; ?>"><?php echo $testiurl; ?></a>
        </span>
      </div>
    </blockquote>
    
  <?php endwhile; else: ?>
    <div class="no-results">
    	<?php echo '<p><strong>' . __('There has been an error.', 'theme1669') . '</strong></p>'; ?>
      <p><?php _e('We apologize for any inconvenience, please', 'theme1669'); ?> <a href="<?php bloginfo('url'); ?>/" title="<?php bloginfo('description'); ?>"><?php _e('return to the home page', 'theme1669'); ?></a> <?php _e('or use the search form below.', 'theme1669'); ?></p>
      <?php get_search_form(); /* outputs the default Wordpress search form */ ?>
    </div><!--no-results-->
  <?php endif; ?>
  <nav class="oldernewer">
    <div class="older">
      <?php previous_post_link('%link', __('Previous post', 'theme1669')) ?>
    </div><!--.older-->
    <div class="newer">
      <?php next_post_link('%link', __('Next Post', 'theme1669')) ?>
    </div><!--.newer-->
  </nav><!--.oldernewer-->
</div><!--#content-->
&nbsp;
                                   
                                </div><!--box-padding2-->
                            </div><!--bg-5-->
                       </div><!--box-->
                   </article>
<?php get_footer(); ?>
