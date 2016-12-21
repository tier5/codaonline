<?php if(0) { ?>
<aside id="sidebar" class="grid_3">
	<?php if ( ! dynamic_sidebar( 'Sidebar' )) : ?>
  <div id="sidebar-search" class="widget">
  	<?php echo '<h2>' . __('Search', 'theme1669') . '</h2>'; ?>
    <?php get_search_form(); ?> <!-- outputs the default Wordpress search form-->
  </div>
  
  <div id="sidebar-nav" class="widget menu">
    <?php echo '<h2>' . __('Navigation', 'theme1669') . '</h2>'; ?>
    <?php wp_nav_menu( array('menu' => 'Sidebar Menu' )); ?> <!-- editable within the Wordpress backend -->
  </div>
  
  <div id="sidebar-archives" class="widget">
    <?php echo '<h2>' . __('Archives', 'theme1669') . '</h2>'; ?>
    <ul>
      <?php wp_get_archives( 'type=monthly' ); ?>
    </ul>
  </div>

  <div id="sidebar-meta" class="widget">
    <?php echo '<h2>' . __('Meta', 'theme1669') . '</h2>'; ?>
    <ul>
      <?php wp_register(); ?>
      <li><?php wp_loginout(); ?></li>
      <?php wp_meta(); ?>
    </ul>
  </div>
	<?php endif; ?>
</aside><!--sidebar-->
<?php } ?>

<article class="grid_8 alpha">
                       <div class="box">
                            <div class="bg-4">
                                <div class="box-padding"> 
                                <h2 class="prev-indent-bot"><?php the_title(); ?></h2>                                   
                                    <figure class="title"><img src="images/page2-img1.jpg" alt=""></figure>
                                    <div class="extra-box">
                                      <?php if ( ! dynamic_sidebar( 'Sidebar' ) ) : ?>
		  <!--Widgetized 'Third Content Area' for the home page-->
		<?php endif ?>
                                    
                                    </div>
                                </div>
                            </div>
                       </div>
                   </article>