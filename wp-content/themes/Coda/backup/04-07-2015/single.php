<?php get_header(); ?>

<div id="content-cd">
<?php get_sidebar('left'); ?>
		
		<div class="col2-cd">
		<?php 
                
			if (have_posts()) : while (have_posts()) : the_post(); 
			
					// The following determines what the post format is and shows the correct file accordingly
					$format = get_post_format();
					get_template_part( 'includes/post-formats/'.$format );
					
					if($format == '')
					get_template_part( 'includes/post-formats/standard' ); ?>
					
					
		<?php get_template_part( 'includes/post-formats/related-posts' ); ?>

					
    
		<?php //comments_template('', true); ?>
		
		
		<?php endwhile; endif; ?>
    
<nav class="oldernewer">
    <div class="older"><?php previous_post_link('%link', __('Previous post', 'theme1669')) ?></div><!--.older-->
    <div class="newer"><?php next_post_link('%link', __('Next Post', 'theme1669')) ?></div><!--.newer-->
  </nav><!--.oldernewer-->
  
	</div> <!--col2-cd end-->                           
<?php get_footer(); ?>