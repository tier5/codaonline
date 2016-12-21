<?php get_header(); ?>
<?php get_sidebar('testi'); ?>
<div id="content" class="grid_9 <?php echo of_get_option('blog_sidebar_pos') ?>">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class('post client-post'); ?>>
      <article class="single-post">
        	<header class="entry-header">
				
				 <?php $post_meta = of_get_option('post_meta'); ?>
				<?php if ($post_meta=='true' || $post_meta=='') { ?>
					<div class="post-meta">
							<time datetime="<?php the_time('Y-m-d\TH:i'); ?>"><?php the_time('j'); ?><br /><?php the_time('F'); ?></time>
					</div><!--.post-meta-->	
				<?php } ?>
	
				<div class="fleft">
				
				<h4 class="entry-title"><?php the_title(); ?></h4>
				
				<?php if ($post_meta=='true' || $post_meta=='') { ?>
					<div class="post-author">
						<?php _e('Posted by:', 'theme1669'); ?> <?php the_author_posts_link() ?>
					</div><!--.post-author-->	
				<?php } ?>	
				
				</div>
				
				<?php if ($post_meta=='true' || $post_meta=='') { ?>
				<div class="fright"><?php comments_popup_link('No comments', '1 Comment', '% Comments', 'comments-link', 'Comments are closed'); ?></div>
				<?php } ?>
		
		</header>
		
		
		<?php if(has_post_thumbnail()) { ?>
			<figure class="featured-thumbnail"><?php the_post_thumbnail(); ?></figure>
		<?php } ?>
		
		<div class="content">
		
			<?php the_content(''); ?>
			
		<!--// .content -->
		</div>

    </div><!-- #post-## -->

  <?php endwhile; /* end loop */ ?>
&nbsp;
                                   
                                </div><!--box-padding2-->
                            </div><!--bg-5-->
                       </div><!--box-->
                   </article>
<?php get_footer(); ?>