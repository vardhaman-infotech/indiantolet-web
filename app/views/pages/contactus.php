<!----------------------cunnect Data in Form-------------------->


<?php

if (isset($data)) {
    $data = (array) $data;
    extract($data);
}
?>
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

<!-------------------------------------->



 <!--AboutUs Form Start-->

<section class="full header-inner">
            <div class="container">
                <div class="col-sm-12">
                    <h1>Contact us</h1><hr><hr>
                </div>
            </div>
        </section>
        <!--breadcrumb-->
       
<!---------------------------- //breadcrumb---------------------------->
<section class="full about-page" style="margin-left:100px;">
    
    Mobile Number:-<?php echo $about_us->contact; ?> <br>
    Email-Id:-<?php echo $about_us->email_id; ?> 

</section>
       

<!--------------End Form---------------------->

