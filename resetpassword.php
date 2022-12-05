<?php
session_start();

$page_title = "Password Reset Form";
include('includes/header.php');
include('includes/navbar.php');
?>





<?php
if (isset($_SESSION['status'])) {
?>
    <div class="alert alert-success">
        <h5><?= $_SESSION['status']; ?></h5>
    </div>
<?php
    unset($_SESSION['status']);
}
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
        <div class="form-container">

            <div class="slide-controls">
                <label class="slide reset" style="background-image: linear-gradient(144deg, #af40ff, #5b42f3 50%, #00ddeb) ;">Email Address</label>

            </div>

            <div class="form-inner">
                <form action="/resetpasswordcode.php" method="post" class="login">
                    <div class="field">

                        <input type="email" name="email" placeholder="Enter your email address">
                    </div>

                    <div class="field"><input type="submit" name="password_reset" value="Send Link by email" /></div>

                </form>
            </div>
        </div>



</body>

</html>