<?php
    $orderid =$_GET['ORDER_ID'];  
     $cusid =$_GET['CUSTOMER_ID'];  
      $cusmobile =$_GET['CUSTOMER_MOBILE']; 
       $cusemail =$_GET['CUSTOMER_EMAIL']; 
        $amount =$_GET['AMOUNT']; 
    require_once("lib/encdec_paytm.php");
    //define("merchantMid", "SAHASR23471049882126");
    define("merchantMid", "SAHASR99232185007592");
    // Key in your staging and production MID available in your dashboard
    define("merchantKey", "mIGCSve5561!ojoX");
    //define("merchantKey", "5bXRhGZJG#QunE2A");
    // Key in your staging and production MID available in your dashboard
    define("orderId", $orderid);
    define("channelId", "WAP");
    define("custId", $cusid);
    define("mobileNo", $cusmobile);
    define("email", $cusemail);
    define("txnAmount",$amount);
   // define("website", "APPSTAGING");
   define("website", "APPPROD");
    // This is the staging value. Production value is available in your dashboard
    define("industryTypeId", "Retail109");
    // This is the staging value. Production value is available in your dashboard
     define("callbackUrl", "https://securegw.paytm.in/theia/paytmCallback?ORDER_ID=$orderid");
    //define("callbackUrl", "https://securegw-stage.paytm.in/theia/paytmCallback?ORDER_ID=$orderid");
    $paytmParams = array();
    $paytmParams["MID"] = merchantMid;
    $paytmParams["ORDER_ID"] = orderId;
    $paytmParams["CUST_ID"] = custId;
    $paytmParams["MOBILE_NO"] = mobileNo;
    $paytmParams["EMAIL"] = email;
    $paytmParams["CHANNEL_ID"] = channelId;
    $paytmParams["TXN_AMOUNT"] = txnAmount;
    $paytmParams["WEBSITE"] = website;
    $paytmParams["INDUSTRY_TYPE_ID"] = industryTypeId;
    $paytmParams["CALLBACK_URL"] = callbackUrl;
    $paytmChecksum = getChecksumFromArray($paytmParams, merchantKey);
    
     $error_array = array('CHECKSUMHASH' => $paytmChecksum);
                echo json_encode($error_array);
?>