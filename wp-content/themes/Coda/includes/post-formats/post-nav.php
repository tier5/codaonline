<?php if(function_exists('wp_pagenavi')) : ?>
	<?php wp_pagenavi(); ?>
<?php else : ?>
	<?php if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav class="oldernewer">
			<div class="older">
				<?php next_posts_link( __('&laquo; Older Entries', 'theme1669')) ?>
			</div><!--.older-->
			<div class="newer">
				<?php previous_posts_link(__('Newer Entries &raquo;', 'theme1669')) ?>
			</div><!--.newer-->
		</nav><!--.oldernewer-->
	<?php endif; ?>
<?php endif; ?>
<!-- Page navigation -->