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
        
<?php 
	$cats = get_the_category();
	$cat_id = $cats[0]->term_id;	
?>

<?php if($cat_id == 5) { ?>
<p>&nbsp;</p>
  <div class="digest_post">  
        <?php $the_query = new WP_Query( 'cat=5&posts_per_page=5' ); ?>

<?php if ( $the_query -> have_posts() ) : ?>
  <?php while ( $the_query -> have_posts() ) : $the_query -> the_post(); ?>
  <div class="blog_post2">
  		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	</div>
	<?php endwhile; endif; ?>
    <div class="blog_post2" style="visibility:hidden;">Memebers</div>
</div>  

<?php } ?>


<?php if($cat_id != 5) { ?>
      <div class="digest_post">  
        <?php $the_query = new WP_Query( 'cat=1&posts_per_page=5' ); ?>


<?php if ( $the_query -> have_posts() ) : ?>
  <?php while ( $the_query -> have_posts() ) : $the_query -> the_post(); ?>
  <div class="blog_post">
<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

<?php 
	$content = get_the_content();
  	$trimmed_content = wp_trim_words( $content, 30, '...<a href="'. get_permalink() .'">Read More</a>' ); ?>
  <?php echo $trimmed_content; ?>
</div>
<?php endwhile; endif; ?>
</div>
<?php } ?>
 <br /><br />  
  
<nav class="oldernewer">
    <div class="older"><?php previous_post_link('%link', __('Previous post', 'theme1669')) ?></div><!--.older-->
    <div class="newer"><?php next_post_link('%link', __('Next Post', 'theme1669')) ?></div><!--.newer-->
  </nav><!--.oldernewer-->
  
	</div> <!--col2-cd end--> 



<script type="text/javascript">  
  function InOut(elem){
elem.delay()
 .fadeIn(2000)
 .delay(5000)
 .fadeOut(2000,
     function(){
        if(elem.next().length > 0) 
          { InOut(elem.next()); }
        else { InOut(elem.siblings(':first')); }
      });
 }
jQuery('.blog_post').hide();
InOut(jQuery('.blog_post:first'));
jQuery('.blog_post2').hide();
InOut(jQuery('.blog_post2:first'));
</script>                          
<?php get_footer(); ?>