<?php $limittext = $limit;?>
<?php global $more;    $more = 0; $counter=1;?>
<?php query_posts("posts_per_page=5&post_type=slider");?>
<ul class="kwicks horizontal">
<?php while (have_posts()) : the_post(); ?>
 
<?php
$custom = get_post_custom($post->ID);
$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'slider-post-thumbnail' );
$url = $thumb['0'];
$sliderurl = $custom["slider-url"][0];
$hoverimage = $custom["hover-image"][0];
?>

<li id="kwick_<?php echo $counter; ?>" style="background-image:url(<?php echo $url; ?>)">

<span style="background-image:url(<?php echo $hoverimage; ?>)"></span>

<div class="kwicks-caption">
	<div class="kwicks-caption-inner">
		<div class="fleft"><?php the_title(); ?></div>
		<div class="fright"><a href="<?php echo $sliderurl; ?>"><?php _e('Read More','theme1669'); ?></a></div>
	</div>
</div>

</li>
<?php $counter++; endwhile; ?>
<?php wp_reset_query(); ?>
</ul>