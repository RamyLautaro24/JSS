<?php
require "header.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Generate Password</title>
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <link rel="stylesheet" href="stylerandompassword.css" />
    <link href="https://css.gg/smile-mouth-open.css" rel="stylesheet" />
    <script src="/js/validation.js" defer></script>
</head>

<body>
    <div class="aboutsection">
        <h1>Easy to remember password</h1>
        <div class="topnav">
            <a class="active" href="index.php">Home</a><i class="fa fa-home"></i>
        </div>
        <hr />
    </div>

    <div class="wrapper">
        <div class="title-text">
            <div class="title login">Reset Password</div>
        </div>

        <?php
        $select = $_GET["select"];
        $validator = $_GET["validator"];

        if (empty($select) || empty($validator)) {
            echo "Sorry, we could not validate your identity";
        } else {
            // see if $select is in hexa format
            if (ctype_xdigit($select) !== false && ctype_xdigit($validator) !== false) {
        ?>
                <form action="/resetnewpassword.php" method="post">
                    <input type="hidden" name="select" value="<?php echo $select ?>">
                    <input type="hidden" name="validator" value="<?php echo $validator ?>">
                    <input type="password" name="pwd" placeholder="Enter your new password">
                    <input type="password" name="pwd2" placeholder="Re-type your password">
                    <button type="submit" name="resetpasswordsubmit"> Reset Password </button>
                </form>
        <?php

            }
        }

        ?>




    </div>



</body>

</html>