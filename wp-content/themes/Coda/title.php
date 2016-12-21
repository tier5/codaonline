<div class="header-title">
	<?php if(is_home()){ ?>
    <?php $blog_text = of_get_option('blog_text'); ?>
		<?php if($blog_text){?>
      <h2><?php echo of_get_option('blog_text'); ?></h2>
    <?php } else { ?>
      <h2><?php _e('Blog','theme1669');?></h2>
    <?php } ?>
		
	<?php } else { ?>
	
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php $pagetitle = get_post_custom_values("page-title");?>
		<?php $pagedesc = get_post_custom_values("page-desc");?>
				<?php if($pagetitle == ""){ ?>
				<h2><?php the_title(); ?></h2>
				<?php } else { ?>
				<h2><?php echo $pagetitle[0]; ?></h2>
				<?php } ?>
				<?php if($pagedesc != ""){ ?>
				<span class="page-desc"><?php echo $pagedesc[0];?></span>
				<?php } ?>
		<?php endwhile; endif; ?>
		<?php wp_reset_query();?>
		
	
	<?php } ?>
</div>