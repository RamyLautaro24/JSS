<?php

session_start();



if (isset($_SESSION["user_id"])) {

    $mysqli = require __DIR__ . "/database.php";

    $sql = "SELECT * FROM user
            WHERE ID = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
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
    <div class="topnav">
        <a href="logout.php">Logout</a><i class="fa fa-sign-out" aria-hidden="true"></i>
        <a class="active" href="index.php">Home</a><i class="fa fa-home"></i>
    </div>
    <h1><i class="fa fa-lock"></i> Password generator</h1>
    <hr />



    <?php if ($user) : ?>

        <p>Hello <?= htmlspecialchars($user["First_Name"]) ?></p>



    <?php else : ?>
        <div class="wrapper">
            <div class="title-text">
                <div class="title login">Not Logged in</div>
                <hr>
            </div>
            <hr>
            <div class="form-container">
                <a href="invalidlogin.html" style="color:lightgreen; font-size:20px;">Login</a> or <a href="/invalidlogin.html" style="color:lightgreen; font-size :20px;">Sign Up</a>
            </div>
        <?php endif ?>


</body>

</html>