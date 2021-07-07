<link href="<?php echo CSS_DIR; ?>/style.css" rel="stylesheet" type="text/css" media="screen" charset="utf-8">
<?php include(VAC_ROOT . '/app/views/layout/header.php'); ?>
<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: grey;
display:none;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover {
    background-color: white;
}
</style>
</head>
<body>

<ul>
  <li><a class="active" href="home"><img src="package/images/logo.png" style="width:200px;height:80px"></a></li>

<li><a class="active" href="home">About Us</a></li>  

  <li><a href="contactus">Contact Us</a></li>
  <li><a href="terms">Terms & Conditions</a></li>
   <li><a href="privacy">Privacy Policy</a></li>
    <li><a href="refundandcancellation"> Return, Refund, & Cancellation policy</a></li>
</ul>


<?php
if (isset($data)) {
    $data = (array) $data;
    extract($data);
}
?>

<section class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="container">
                <div class="policy-text">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3>Refund and Cancellation Policy</h3>
<hr><hr>
                            <p>Our focus is complete customer satisfaction. In the event, if you are displeased with the services provided, we will refund back the money, provided the reasons are genuine and proved after investigation. Please read the fine prints of each deal before buying it, it provides all the details about the services or the product you purchase.</p>
                            
                            <p>In case of dissatisfaction from our services, clients have the liberty to cancel their projects and request a refund from us. Our Policy for the cancellation and refund will be as follows:</p>
                               </div>
                    </div>
                </div>

                <div class="policy-text">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4>Cancellation Policy</h4>

                             <p>For Cancellations please contact the us via contact us link. </p>
                        <p>Requests received later than 2 business days prior to the end of the current service period will be treated as cancellation of services for the next service period.</p>
                        </div>
                    </div>
                </div>

                <div class="policy-text">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4>Refund Policy</h4>

                              <p>We will try our best to create the suitable design concepts for our clients.</p>
                              <p>In case any client is not completely satisfied with our products we can provide a refund.</p>
                              <p>If paid by credit card, refunds will be issued to the original credit card provided at the time of purchase and in case of payment gateway name payments refund will be made to the same account.</p>

                        </div>
                    </div>
                </div>

                

               


                

                
               
            </div>

        </div>
    </div>

</section>


