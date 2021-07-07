<?php
    $paytmParams = $_POST;
  //  $merchantKey="5bXRhGZJG#QunE2A";
  $merchantKey="mIGCSve5561!ojoX";
    $paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : "";
    $isValidChecksum = verifychecksum_e($paytmParams, $merchantKey, $paytmChecksum);
    if($isValidChecksum == "TRUE") {
        echo "<b>Checksum Matched</b>";
    } else {
        echo "<b>Checksum MisMatch</b>";
    }
?>
<html>
<head>
     <meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-I">
     <title>Paytm</title>
     <script type="text/javascript">
            function response(){
                    return document.getElementById('response').value;
            }
     </script>
</head>
<body>
  Redirect back to the app<br>
  <form name="frm" method="post">
    <input type="hidden" id="response" name="responseField" value='<?php echo $encoded_json?>'>
  </form>
</body>
</html>