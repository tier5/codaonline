<?php
/**
 * Template Name: Home Page
 */
?>

<?php get_header(); ?>
<div id="content-cd">

<?php get_sidebar('left'); ?>

<div class="col2-cd">
	<img class="bnr" src="<?php echo get_template_directory_uri(); ?>/images/bnr.jpg" alt="banner" />
    
    <div id="blocks">
	<ul>
     <?php query_posts('cat=2&posts_per_page=6'); ?>
     <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<li>
        <?php if ( has_post_thumbnail() ) { ?>
			<a href="<?php the_permalink(); ?>"><img width="212" height="174" src="<?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); ?>" alt="image" border="0" /></a><?php } ?>
		<div class="block-text">
			<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
			<?php echo substr(($post->post_content), 0, 30); ?>
		</div>
	</li>
    <?php endwhile; endif; ?>
	</ul>
</div><!--blocks end-->

</div><!--col2-cd end-->

	


<?php get_footer(); ?>
