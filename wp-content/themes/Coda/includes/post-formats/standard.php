			<article id="post-<?php the_ID(); ?>" <?php post_class('post-holder'); ?>>
					
				<header class="entry-header">
				
					 <?php $post_meta = of_get_option('post_meta'); ?>
					<?php if ($post_meta=='true' || $post_meta=='') { ?>
						<div class="post-meta">
								<time datetime="<?php the_time('Y-m-d\TH:i'); ?>"><?php the_time('j'); ?><br /><?php the_time('F'); ?></time>
						</div><!--.post-meta-->	
					<?php } ?>
	
					<div class="fleft">
					
					<?php if(!is_singular()) : ?>
					
					<h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php _e('Permalink to:', 'theme1669');?> <?php the_title(); ?>"><?php the_title(); ?></a></h3>
					
					<?php if ($post_meta=='true' || $post_meta=='') { ?>
						<div class="post-author">
						
						</div><!--.post-author-->	
					<?php } ?>	
					
					<?php else :?>
					
					<h4 class="entry-title"><?php the_title(); ?></h4>
					
					<?php if ($post_meta=='true' || $post_meta=='') { ?>
						<div class="post-author">
							<?php _e('Posted by:', 'theme1669'); ?> <?php the_author_posts_link() ?>
						</div><!--.post-author-->	
					<?php } ?>	
					
					<?php endif; ?>
					
					</div>				
				
				</header>
				
				
				<?php get_template_part('includes/post-formats/post-thumb'); ?>
				
				
				<?php if(!is_singular()) : ?>
				
				<div class="post-content">
					<?php $post_excerpt = of_get_option('post_excerpt'); ?>
					<?php if ($post_excerpt=='true' || $post_excerpt=='') { ?>
					
						<div class="excerpt">
						
						
						<?php the_advanced_excerpt(); ?>
                        
                        
						
						</div>
						
						
					<?php } ?>
					<a href="<?php the_permalink() ?>" class="button"><?php _e('Read more', 'theme1669'); ?></a>
				</div>
				
				<?php else :?>
				
				<div class="content">
				
					<?php the_content(''); ?>
					
				<!--// .content -->
				</div>
				
				<?php endif; ?>
						 
			</article>