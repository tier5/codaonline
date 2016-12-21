<?php
/**
 * Template Name: Register Page
 */

use Coda\PaymentGateway\PaymentGateway;

$pgAssociationJoin = null;
$pgDealerJoin = null;

$join_type = $_GET['join'];

if ($_REQUEST['mode'] == 'demo') {
    if($join_type == 'association'){
    $pgAssociationJoin = new PaymentGateway("HCO-ADAMK-298", "QVDLoxLOWByNENQ~o9bw", "350.00", "USD", "https://demo.globalgatewaye4.firstdata.com/payment");
    }
    if($join_type == 'dealer'){
    $pgDealerJoin = new PaymentGateway("HCO-ADAMK-298", "QVDLoxLOWByNENQ~o9bw", "99.00", "USD", "https://demo.globalgatewaye4.firstdata.com/payment");
    }  
} else {
    if($join_type == 'association'){
    $pgAssociationJoin = new PaymentGateway("WSP-CODA-idcz1gBUSA", "acQiXrq_rSjRdFCuMtKy", "350.00", "USD", "https://globalgatewaye4.firstdata.com/pay");
    }
    if($join_type == 'dealer'){
    $pgDealerJoin = new PaymentGateway("WSP-CODA-@ETVrQBUSQ", "WIF1qCLdY96n46jXSkse", "99.00", "USD", "https://globalgatewaye4.firstdata.com/pay");
    }
}


get_header();

?>
<div id="content-cd">
    <?php get_sidebar('left'); ?>

    <div class="col2-cd">
    <?php echo do_shortcode('[wp_payeezy_payment_form]');?>
    <?php if($join_type == 'association'){?>  
    <?php echo do_shortcode('[contact-form-7 id="1762" title="CODA Associates/Manufacturer Registration"]');?>
    <?php }?>
    <?php if($join_type == 'dealer'){?> 
     <?php echo do_shortcode('[contact-form-7 id="1765" title="Dealer Registration"]');?>
    <?php }?>

    </div>

           

    </div> <!--col2-cd end-->
    <?php get_footer(); ?>
