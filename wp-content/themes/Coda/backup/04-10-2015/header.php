<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" <?php language_attributes();?>> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" <?php language_attributes();?>> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" <?php language_attributes();?>> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" <?php language_attributes();?>> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes();?>> <!--<![endif]--><head>
	<title><?php if ( is_category() ) {
		echo __('Category Archive for &quot;', 'theme1669'); single_cat_title(); echo __('&quot; | ', 'theme1669'); bloginfo( 'name' );
	} elseif ( is_tag() ) {
		echo __('Tag Archive for &quot;', 'theme1669'); single_tag_title(); echo __('&quot; | ', 'theme1669'); bloginfo( 'name' );
	} elseif ( is_archive() ) {
		wp_title(''); echo __(' Archive | ', 'theme1669'); bloginfo( 'name' );
	} elseif ( is_search() ) {
		echo __('Search for &quot;', 'theme1669').wp_specialchars($s).__('&quot; | ', 'theme1669'); bloginfo( 'name' );
	} elseif ( is_home() || is_front_page()) {
		bloginfo( 'name' ); echo ' | '; bloginfo( 'description' );
	}  elseif ( is_404() ) {
		echo __('Error 404 Not Found | ', 'theme1669'); bloginfo( 'name' );
	} elseif ( is_single() ) {
		wp_title('');
	} else {
		echo wp_title( ' | ', false, right ); bloginfo( 'name' );
	} ?></title>
	<meta name="description" content="<?php wp_title(); echo ' | '; bloginfo( 'description' ); ?>" />
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">	  
	
	<?php /* The HTML5 Shim is required for older browsers, mainly older versions IE */ ?>  
  <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" /> 
  <script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/jquery.js'></script>
  
    
  
	<?php
		/* We add some JavaScript to pages with the comment form
		 * to support sites with threaded comments (when in use).
		 */
		if ( is_singular() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );
	
		/* Always have wp_head() just before the closing </head>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to add elements to <head> such
		 * as styles, scripts, and meta tags.
		 */
		wp_head();
	?>
  
</head>
<body>
<div>
	<div id="wrapper-cd">
		<div id="container-cd">
        
<div id="header-cd">
<div id="logo-cd"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="logo" width="412" height="130" border="0" /></a></div>
<div id="global-cd">
<div class="global-links"><a href="<?php echo site_url('/membership-login/'); ?>">Sign In</a> &nbsp;&nbsp;|  &nbsp;&nbsp;<a href="<?php echo site_url('/members/'); ?>">Join CODA</a>&nbsp;&nbsp; |&nbsp;&nbsp;  <a href="<?php echo site_url('/dealer-map/'); ?>">Dealer Locator</a>&nbsp;&nbsp; | &nbsp;&nbsp; <a href="#">Subscribe to our Newsletter</a></div>

<div class="social-links"> 
<?php if ( ! dynamic_sidebar( 'Secondary Content Area' ) ) : endif; ?>
<a href="https://www.facebook.com/CODAOnline" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/social-001.gif" alt="social" width="39" height="39" border="0" /></a>
<a href="https://twitter.com/_CODA" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/social-002.gif" alt="social" width="39" height="39" border="0" /></a>
<a href="https://www.linkedin.com/company/c-o-d-a-the-california-operator-&-door-association-" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/social-003.gif" alt="social" width="39" height="39" border="0" /></a>
<a href="https://www.youtube.com/channel/UCi4A65WlLkz_3FHHIgs5dLQ/feed" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/images/social-006.png" alt="social" width="39" height="39" border="0" /></a>
<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/social-005.gif" alt="social" width="39" height="39" border="0" /></a>
</div>
</div>
<div class="statement">CODA's mission is to promote the integrity and professionalism of the garage door and gate industry through consumer awareness and the use of licensed contractors.</div>
</div><!--header-cd end-->

  <div id="nav-cd">
  <?php wp_nav_menu( array('theme_location' => 'header_menu'));   ?>

</div><!--nav-cd end-->
