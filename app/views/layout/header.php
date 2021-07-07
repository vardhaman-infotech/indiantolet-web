<!DOCTYPE html>
<html>
<head>  
    <!-- // Css -->
</head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <title>INDIAN TO-LET</title>       
        <?php
        $protocol = str_replace('http://', '', DEFAULT_URL);
        $protocol = str_replace('https://', '', $protocol);
        $actual_link = basename("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        if (isset($_SESSION['site_lang'])) {
            $language = $_SESSION['site_lang'];
        } else {
            $language = 'en';
        }
        // echo $language;
        define('LANGUAGEMULTI', $language);
        $_SESSION['site_lang'] = 'zh'
        ?>

        <script>
            baseUrl = "<?php echo DEFAULT_URL; ?>";
            jsurl = "<?php echo JS_DIR; ?>";
            csurl = "<?php echo CSS_DIR; ?>";
            language_multi = "<?php echo $language; ?>";
        </script>
        <!--        For include the All css -->
        <script type="text/javascript">
            var protocol = (
                    ("https:" == document.location.protocol)
                    ? "https"
                    : "http"
                    );
            document.write(
                    unescape(
                            "%3Cscript"
                            + " src='"
                            + protocol
                            + "://"
                            + "<?php echo $protocol; ?>"
                            + "/package/css/include_css.js"
                            + "'"
                            + "type='text/javascript'"
                            + "%3E"
                            + "%3C/script%3E"
                            )
                    );
        </script>
        <!--        For include the All js -->
        <script type="text/javascript">
            var protocol = (
                    ("https:" == document.location.protocol)
                    ? "https"
                    : "http"
                    );
            document.write(
                    unescape(
                            "%3Cscript"
                            + " src='"
                            + protocol
                            + "://"
                            + "<?php echo $protocol; ?>"
                            + "/package/js/include_js.js"
                            + "'"
                            + "type='text/javascript'"
                            + "%3E"
                            + "%3C/script%3E"
                            ) // this HAS to be escaped, otherwise it would 
                    // close the actual (not injected) <script> element
                    );
        </script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
        <style>
            .box { height: 1500px; }
            .slideout-menu { left: auto; }
            .btn-hamburger { left: auto; right: 12px;}
        </style>
    </head>
    <body>

      