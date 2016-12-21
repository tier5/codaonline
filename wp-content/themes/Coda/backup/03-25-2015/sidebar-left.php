<?php
/* We add some JavaScript to pages with the comment form
		 * to support sites with threaded comments (when in use).
		 */
	
		/* Always have wp_head() just before the closing </head>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to add elements to <head> such
		 * as styles, scripts, and meta tags.
		 */
?>

<div class="col1-cd">

<div id="post-box">
<h2>Upcoming Events</h2>			
     			<?php $the_query = new WP_Query( 'cat=3&posts_per_page=8' ); ?>
				<?php if ( $the_query -> have_posts() ) : ?>
 				<?php while ( $the_query -> have_posts() ) : $the_query -> the_post(); ?>
				<div class="bos-event-listing">
					<div class="bos-event-date"> <?php echo get_the_date('F j, Y'); ?> </div>
					<div class="bos-event-title"><?php the_title(); ?></div>
				<div class="bos-event-summary">
					<a href="<?php the_permalink(); ?>"><?php echo substr(($post->post_content), 0, 80); ?></a>
				</div>                                      
				</div>
 			<?php endwhile; endif; ?>   
 <div class="bos-event-title">Sponsored by :</div>
 <a href="http://doorking.com/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/dks.png"/></a>
    
</div>

</div>