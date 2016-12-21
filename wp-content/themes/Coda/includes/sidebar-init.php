<?php
function elegance_widgets_init() {
	// Before Content Area
	// Location: at the top of the content
	register_sidebar(array(
		'name'					=> 'Before Content Area',
		'id' 						=> 'before-content-area',
		'description'   => __( 'Located at the top of the content.'),
		'before_widget' => '<div id="%1$s" class="before-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	
	register_sidebar(array(
		'name'					=> 'Events Sidebar',
		'id' 						=> 'events-sidebar',		
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	// Primary Content Area
	// Location: at the middle of the content
	register_sidebar(array(
		'name'					=> 'Primary Content Area',
		'id' 						=> 'primary-content-area',
		'description'   => __( 'Located at the middle of the content.'),
		'before_widget' => '<div id="%1$s" class="prim-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
	// Secondary Content Area
	// Location: at the bottom left side of the content
	register_sidebar(array(
		'name'					=> 'Secondary Content Area',
		'id' 						=> 'secondary-content-area',
		'description'   => __( 'Located at the bottom left side of the content.'),
		'before_widget' => '<div id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
	// Third Content Area
	// Location: at the bottom middle side of the content
	register_sidebar(array(
		'name'					=> 'Third Content Area',
		'id' 						=> 'third-content-area',
		'description'   => __( 'Located at the bottom middle side of the content.'),
		'before_widget' => '<div id="%1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
	// Fourth Content Area
	// Location: at the bottom right side of the content
	register_sidebar(array(
		'name'					=> 'Fourth Content Area',
		'id' 						=> 'fourth-content-area',
		'description'   => __( 'Located at the bottom right side of the content.'),
		'before_widget' => '<div id="%1$s" class="fourth-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
	// Sidebar Widget
	// Location: the sidebar
	register_sidebar(array(
		'name'					=> 'Sidebar',
		'id' 						=> 'main-sidebar',
		'description'   => __( 'Located at the right side of pages.'),
		'before_widget' => '<div id="%1$s" class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));

}
/** Register sidebars by running elegance_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'elegance_widgets_init' );
?>