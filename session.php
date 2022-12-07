<?php

session_start();


if (!isset($_SESSION['user_id'])) {
    header('Location: invalidlogin.html');
} else {
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

    <link rel="stylesheet" href="dashboard.css" />
    <link href="https://css.gg/smile-mouth-open.css" rel="stylesheet" />
    <script src="/js/validation.js" defer></script>
</head>

<body>



    <div class="topnav">
        <a href="logout.php">Logout</a><i class="fa fa-sign-out" aria-hidden="true"></i>
        <a class="active" href="index.php">Home</a><i class="fa fa-home"></i>
    </div>
    <h1><i class="fa fa-lock"></i> Easy to remember password</h1>
    <hr />
    <div>
        <?php if ($user) : ?>
            <h1> Hello <?= htmlspecialchars($user["First_Name"])  ?> </h1>
        <?php else : ?>
        <?php endif ?>
    </div>
    <div class="container">
        <div class="wrapper">

            <div class="title-text">
                <div class="title-login">Generate the password</div>

            </div>
            <hr>
            <div class="slider-main">
                <label>Password length</label>
                <input type="range" value="8" min="8" max="30" class="slider" oninput="this.nextElementSibling.value = this.value" id="slider" />
                <output>8</output>
                <br>

                <label>How many upper cases:
                    <input type="number" value="0" min="0" id="UCnum" />
                    <span class="checkmark"></span>
                </label><br>
                <label>How many lower cases:
                    <input type="number" value="0" min="0" id="LCnum" />
                    <span class="checkmark"></span>
                </label><br>
                <label>How many numbers:
                    <input type="number" value="0" min="0" id="NUMnum" />
                    <span class="checkmark"></span>
                </label><br>
                <label>How many symbols:
                    <input type="number" value="0" min="0" id="SCnum" />
                    <span class="checkmark"></span>
                </label><br>
                <label>Enter a word:
                    <input type="text" id="WORD" />
                    <span class="checkmark"></span>
                </label><br>
                <label> Used for:
                    <input list="browsers" name="browser" id="browser">
                    <datalist id="browsers">
                        <option value="Bank website">
                        <option value="Gmail">
                        <option value="Facebook">
                        <option value="Instagram">
                        <option value="Other">
                    </datalist>
                    <span class="checkmark"></span>
                </label><br>

            </div>


            <div class="wrapper-main">
                <h3 id="pwd_txt"></h3>
                <button id="clipboard" class="clipboard">
                    <i class="fas fa-clipboard"></i>
                </button><br>

            </div>
            <button id="generate" class="action-btn">
                Generate Password
            </button>
            <script src="generaterememberpassword.js"></script>
        </div>


        <div class="wrapper">
            <div class="title-text">
                <div class="title-login"> Access the vault</div>
            </div>
        </div>
        <div class="wrapper">
            <div class="title-text">
                <div class="title-login">Check password strength</div>

            </div>
            <hr>
            <div class="slider-main">
                <form action="" method="post">

                    <div class="password-container">
                        <label>Enter Password</label>
                        <input type="password" name="password" id="password-field">

                        <div class="strength-container">
                            <p class="title">
                                Password strength:
                                <span class="strength-text"></span>
                            </p>

                            <div class="strength-bar-wrapper">
                                <div id="strength-bar"></div>
                            </div>
                            <p class="strength-description">
                                Passwords should contain at least min <i>8</i>
                                characters and max <i>30</i> characters <br>
                                It is recommanded to insert <strong>lowercases</strong> and <strong>uppercases</strong>,
                                <strong>numbers</strong> and <strong>special characters</strong>.
                            </p>

                        </div>
                    </div>


                </form>
            </div>
            <script src="passstrong.js"></script>
        </div>
    </div>

</body>

</html>