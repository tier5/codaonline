<?php
/**
 * Template Name: Home Page
 */
?>

<?php get_header(); ?>
<div id="content-cd">

    <?php get_sidebar('left'); ?>

    <div class="col2-cd">
        <div class="front-page-disney">

            <h1>Western Regional Tradeshow
                Disneyland Hotel September 23rd & 24th
            </h1>

            <div class="">
                <img src="<?php echo site_url() . "/wp-content/uploads/2016/07/CODA_TRADESHOW_2016_PNG.png"; ?>" alt="">
            </div>
            <div>
                <ul>
                    <li>
                        <a href="<?php echo site_url('trade-show-registration'); ?>">Attendees Register</a>
                    </li>
                    <li>
                        <a href="http://www.mydisneymeetings.com/gdci16b/">Room Reservations</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('parking'); ?>">Parking</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('trade-show-seminars'); ?>">Dealer Seminars</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('agenda'); ?>">Agenda</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('floorplan'); ?>">Floorplan</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('idea-certifications'); ?>">I.D.E.A. Certification</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('golf-wounded-warrior'); ?>">Golf</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('exhibitor-packet'); ?>">Exhibitor Packets</a>
                    </li>
                    <li>
                        <a href="<?php echo site_url('exhibitor-logistics'); ?>">Exhibitor Logistics</a>
                    </li>
                </ul>
            </div>
        </div>

    </div>

    <div class="col2-cd">
        <?php if (function_exists('rslider')) {
            rslider(1);
        } ?>

        <div id="blocks">
            <ul>
                <?php query_posts('cat=2&posts_per_page=9&orderby=date&order=DESC'); ?>
                <?php $count = 0;
                if (have_posts()) : while (have_posts()) : the_post();

                    /*
                     * moved buttons out to side-bar so skip the following
                     */
                    if (url_to_postid('/dealer-services') == get_the_ID()) {
                        continue;
                    }
                    if (url_to_postid('/coda-news') == get_the_ID()) {
                        continue;
                    }
                    if (url_to_postid('/advertise-with-us') == get_the_ID()) {
                        continue;
                    }
                    $count++;

                    if ($count == 1) {
                        $style = 'box-1';
                        $count = 1;
                    } else if ($count == 2) {
                        $style = 'box-2';
                        $count = 2;
                    } else if ($count == 3) {
                        $style = 'box-3';
                        $count = 0;
                    } ?>

                    <li class="<?php echo $style; ?>">
                        <?php if (has_post_thumbnail()) { ?>
                        <a href="<?php the_permalink(); ?>"><img width="212" height="174"
                                                                 src="<?php echo wp_get_attachment_url(get_post_thumbnail_id(get_the_ID())); ?>"
                                                                 alt="image" border="0"/></a><?php } ?>
                        <div class="block-text">
                            <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                            <?php //echo substr(($post->post_content), 0, 30); ?>
                        </div>
                    </li>
                <?php endwhile; endif; ?>
            </ul>
        </div><!--blocks end-->

        <div class="col2-cd">
            <div class="bottom-logos">
                <br/>
                Proud member of:<br/>
                <div class="bottom-logo">
                    <a href="http://www.doors.org/" target="_blank"><img
                            src="<?php echo get_template_directory_uri(); ?>/images/ida.png"/></a>
                </div>
                <div class="bottom-logo">
                    <a href="http://www.dooreducation.com/" target="_blank"><img
                            src="<?php echo get_template_directory_uri(); ?>/images/IDEA.png"/></a>
                </div>
                <div class="bottom-logo">
                    <a href="http://www.aialosangeles.org/" target="_blank"><img
                            src="<?php echo get_template_directory_uri(); ?>/images/allieds.png"/></a>
                </div>
                <div class="bottom-logo">
                    <a href="http://www.woundedwarriorproject.org" target="_blank"><img
                            src="<?php echo get_template_directory_uri(); ?>/images/dav_logo_small.png"/></a>
                </div>
            </div>
        </div>

    </div><!--col2-cd end-->


    <?php get_footer(); ?>
