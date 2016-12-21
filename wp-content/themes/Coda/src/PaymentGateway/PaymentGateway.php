<?php namespace Coda\PaymentGateway;

/**
 * Created by PhpStorm.
 * User: kleinada
 * Date: 8/21/2016
 * Time: 9:00 PM
 */
class PaymentGateway
{

    protected $pageId;
    protected $transactionKey;
    protected $amount;
    protected $currencyCode;

    protected $timeStamp;
    protected $fpSequence;

    protected $hmacData;
    protected $fpHash;
    protected $postRequestURL;

    /**
     * PaymentGateway constructor.
     * @param $pageId
     * @param $transactionKey
     * @param $amount
     * @param $currencyCode
     * @param $postRequestURL
     */
    public function __construct($pageId, $transactionKey, $amount, $currencyCode, $postRequestURL)
    {
        $this->pageId = $pageId; //  Take from Payment Page ID in Payment Pages interface
        $this->transactionKey = $transactionKey; // Take from Payment Pages configuration interface
        $this->amount = $amount;
        $this->currencyCode = $currencyCode; // Needs to agree with the currency of the payment page


        srand(time()); // initialize random generator for x_fp_sequence
        $this->fpSequence = rand(1000, 100000) + 123456;
        date_default_timezone_set("UTC");
        $this->timeStamp = time(); // needs to be in UTC. Make sure webserver produces UTC

        // The values that contribute to x_fp_hash
        $this->hmacData = $this->pageId . "^" . $this->fpSequence . "^" . $this->timeStamp . "^" . $this->amount . "^" . $this->currencyCode;
        $this->fpHash = hash_hmac('MD5', $this->hmacData, $this->transactionKey);

        $this->postRequestURL = $postRequestURL; //toggle this to the demo page
    }

    public function generateFormHTML()
    {
        return <<<HTML
               <form id="" method="post" action="{$this->postRequestURL}">
                   <input type="hidden" name="x_login" value="{$this->pageId}" /> <!-- Payment Page ID located in the Payeezy Gateway Payment Pages administration interface -->
                   <input type="hidden" name="x_fp_sequence" value="{$this->fpSequence}" /> <!-- Random number used in the x_fp_hash calculation -->
                   <input type="hidden" name="x_fp_timestamp" value="{$this->timeStamp}" /> <!-- Current UTC timestamp -->
                   <input type="hidden" name="x_currency_code" value="{$this->currencyCode}" />
                   <!--
                       The x_currency_code field isn’t actually required, but is here for clarity.
                       By default, the currency defined in the Payeezy Gateway Payment Page administration interface will be used.
                       If you are specifying a currency code, it must also be used in the x_fp_hash calculation (see the PHP example below).
                   -->
                   <input type="hidden" name="x_amount" value="{$this->amount}" /> <!-- Order amount -->
                   <input type="hidden" name="x_fp_hash" value="{$this->fpHash}" /> <!-- Calculated hash value -->
                   <input type="hidden" name="x_show_form" value="PAYMENT_FORM" /> <!-- Required to stay compatible with the Authorize.net protocol -->
                   <input type="submit" name="checkout" value="Pay Now  $ {$this->amount}" />
               </form>
HTML;
    }


}