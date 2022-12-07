<?php
$is_invalid = false;



if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $mysqli = require __DIR__ . "/database.php";

    $sql = sprintf("SELECT * FROM User WHERE Email='%s'", $mysqli->real_escape_string($_POST["email"]));

    $result = $mysqli->query($sql);

    $User = $result->fetch_assoc();

    if ($User) {

        if (password_verify($_POST["password"], $User["Password_Hash"])) {


            session_start();

            session_regenerate_id();

            $_SESSION["user_id"] = $User["ID"];
            header("Location: session.php");
            exit;
        } else {
            header("Location: invalidlogin.html");
            exit;
        }
    } else {
        header("Location: invalidlogin.html");
    }

    $is_invalid = true;
}
