<?php



if (strlen($_POST["Password"]) < 8) {

    header('Location: badpassword.html');
}

if (!preg_match("/[a-z]/", $_POST["Password"])) {

    header('Location: badpassword.html');
}

if (!preg_match("/[A-Z]/i", $_POST["Password"])) {

    header('Location: badpassword.html');
}

if (!preg_match("/[0-9]/i", $_POST["Password"])) {

    header('Location: badpassword.html');
}
/*
        if(! preg_match("/[a-z]/i", $_POST["Password"])){
            die ("Your Password must contain at least 1 Lowercase");
            }
*/
if ($_POST["Password"] !== $_POST["password_confirmation"]) {

    header('Location: passwordmatch.html');
}

$password_hash = password_hash($_POST["Password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";

$FirstName = $_POST['firstname'];
$LastName = $_POST['lastname'];
$Email = $_POST['email'];

$sql = "INSERT 
INTO User 
(First_Name, Last_Name, Email, Password_Hash)
 VALUES (?,?,?,?)";



$stmt = $mysqli->stmt_init();


if (!$stmt->prepare("$sql")) {
    die("SQL error:" . $mysqli->error);
}

$stmt->bind_param("ssss", $FirstName, $LastName, $Email, $password_hash);

if ($stmt->execute()) {
    header("Location: created.html");
} else if ($mysqli->errno === 1062) {

    header('Location: emailtaken.html');
} else {
    die($mysqli->error . " " . $mysqli->errno);
}
