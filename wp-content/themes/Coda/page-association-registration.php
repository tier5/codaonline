<?php
/**
 * Template Name: Association Registration
 */

/*
 * we are going to check of the response of the payment was successful or not
 * if it was not we are not going to continue on.
 */
if (!($_REQUEST['x_response_code'] == '1' || $_REQUEST['x_response_code'] == '2' || $_REQUEST['x_response_code'] == '3')) {
    wp_redirect(site_url() . '/members/');
}

//dump($_REQUEST);

//if ($_REQUEST['x_response_code'] == '1') {
//    //echo '<h1>Your payment was successful</h1>';
//}


//if ($_REQUEST['x_response_code'] == '2') {
//    echo '<h1>Your payment was declined</h1>';
//} elseif ($_REQUEST['x_response_code'] == '3') {
//    echo '<h1>Your payment encountered an error</h1>';
//}


?>

<?php get_header(); ?>


<div id="content-cd">
    <?php get_sidebar('left'); ?>

    <div class="col2-cd">
        <?php if (have_posts()) while (have_posts()) : the_post(); ?>

            <div class="entry_title"><h1><?php the_title(); ?></h1></div>

            <?php if ($_REQUEST['x_response_code'] == '2') { ?>
                <h2>Payment Declined</h2>
                <p>Click <a href="/members">here</a> to go back to the member payment form.</p>
            <?php } elseif ($_REQUEST['x_response_code'] == '3') { ?>
                <h2>Your Payment Encountered An Error</h2>
                <p>Click <a href="/members">here</a> to go back to the member payment form.</p>
            <?php } elseif ($_REQUEST['x_response_code'] == '1') { ?>
                <h2>Step 2:</h2>
                <p>Please fill in the form to complete your registration process.</p>

                <?php the_content();
            } else {
                dump(site_url() . '/members/');
                wp_redirect(site_url() . '/members/');
                exit;
            }

            ?>


        <?php endwhile; ?>

    </div> <!--col2-cd end-->
    <?php get_footer(); ?>
