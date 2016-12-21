<?php
/* We add some JavaScript to pages with the comment form
		 * to support sites with threaded comments (when in use).
		 */

/* Always have wp_head() just before the closing </head>
 * tag of your theme, or you will break many plugins, which
 * generally use this hook to add elements to <head> such
 * as styles, scripts, and meta tags.
 */
?>

<div class="col1-cd">

    <?php if (0) { ?>
        <div id="post-box">
            <h2>Upcoming Events</h2>
            <?php $the_query = new WP_Query('cat=3&posts_per_page=12'); ?>
            <?php if ($the_query->have_posts()) : ?>
                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                    <div class="bos-event-listing">
                        <div class="bos-event-date"><?php the_title(); ?></div>
                        <div class="bos-event-summary">
                            <?php //echo substr(($post->post_content), 0, 80); ?>
                        </div>
                    </div>
                <?php endwhile; endif; ?>
            <div class="bos-event-title">Sponsored by :</div>
            <a href="http://doorking.com/" target="_blank"><img
                    src="<?php echo get_template_directory_uri(); ?>/images/dks.png"/></a>

        </div>
    <?php } ?>
    <div class="spacer"></div>
    <div class="spacer"></div>
    <div id="post-box">
        <?php if (!dynamic_sidebar('Events Sidebar')) : endif; ?>
    </div>

    <div id="post-box">
        <a href="<?php echo site_url() . '/dealer-services' ?>"><img width="212" height="174"
                                                                     src="<?php
                                                                     echo wp_get_attachment_url(get_post_thumbnail_id(url_to_postid('/dealer-services'))); ?>"
                                                                     alt="image" border="0"/></a>
        <h3><a href="<?php echo site_url() . '/dealer-services' ?>"><?php echo get_the_title(url_to_postid('/dealer-services')); ?></a></h3>
    </div>

    <div id="post-box">
        <a href="<?php echo site_url() . '/coda-news' ?>"><img width="212" height="174"
                                                                     src="<?php
                                                                     echo wp_get_attachment_url(get_post_thumbnail_id(url_to_postid('coda-news'))); ?>"
                                                                     alt="image" border="0"/></a>
        <h3><a href="<?php echo site_url() . '/coda-news' ?>"><?php echo get_the_title(url_to_postid('coda-news')); ?></a></h3>
    </div>


</div>