<?php
/**
 * Template Name: Members Page
 */

use Coda\PaymentGateway\PaymentGateway;

$pgAssociationJoin = null;
$pgDealerJoin = null;

if ($_REQUEST['mode'] == 'demo') {
    $pgAssociationJoin = new PaymentGateway("HCO-ADAMK-298", "QVDLoxLOWByNENQ~o9bw", "350.00", "USD", "https://demo.globalgatewaye4.firstdata.com/payment");
    $pgDealerJoin = new PaymentGateway("HCO-ADAMK-298", "QVDLoxLOWByNENQ~o9bw", "99.00", "USD", "https://demo.globalgatewaye4.firstdata.com/payment");
} else {
    $pgAssociationJoin = new PaymentGateway("WSP-CODA-idcz1gBUSA", "acQiXrq_rSjRdFCuMtKy", "350.00", "USD", "https://globalgatewaye4.firstdata.com/pay");
    $pgDealerJoin = new PaymentGateway("WSP-CODA-@ETVrQBUSQ", "WIF1qCLdY96n46jXSkse", "99.00", "USD", "https://globalgatewaye4.firstdata.com/pay");
}


get_header();

?>
<div id="content-cd">
    <?php get_sidebar('left'); ?>

    <div class="col2-cd">
        <?php if (have_posts()) while (have_posts()) : the_post(); ?>


            <div class="entry_title"><h1><?php the_title(); ?></h1></div>

            <div class="member-signup">
                <h2>Associates/Manufacturers</h2>

                <p>Why join or renew CODA?</p>
                <ul>
                    <li>
                        Participate in the Largest trade show on the West Coast
                    </li>
                    <li>
                        Advertise your company to the largest market in the country
                    </li>
                    <li>
                        Great networking opportunities
                    </li>
                    <li>
                        Marketing Intelligence
                    </li>
                    <li>
                        Stay connected to your local Dealers.
                    </li>
                </ul>

                <p class="dues">Dues $350 per year</p>
                <a href="<?php echo site_url();?>/register?join=association" class="join-btn">Register Now</a>
                <?php
//                dump($pgAssociationJoin);
                //echo $pgAssociationJoin->generateFormHTML();
                ?>


            </div>

            <div class="member-signup">

                <h2>Licensed Dealers/Installers </h2>

                <p>Why should a Dealer consider joining/renewing CODA?</p>
                <ul>
                    <li>
                        CODA works to support the licensed professional.
                    </li>
                    <li>
                        Gain referrals with your posting on our Dealer Locator.
                    </li>
                    <li>
                        Receive email alerts on regulatory news &amp; economic trends.
                    </li>
                    <li>
                        Discount  opportunities from manufacturers and suppliers.
                    </li>
                    <li>
                        Trade show dinner for two at the Disneyland Hotel on 9/23
                    </li>
                </ul>

                <p class="dues">Dues $99 per year</p>
                <p>Proof of State License required</p>
                <a href="<?php echo site_url();?>/register?join=dealer" class="join-btn">Register Now</a>
                <?php
//                dump($pgDealerJoin);
                //echo $pgDealerJoin->generateFormHTML();
                ?>

            </div>

        <?php endwhile; ?>

    </div> <!--col2-cd end-->
    <?php get_footer(); ?>
