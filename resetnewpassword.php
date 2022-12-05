<?php

if (isset($_POST["resetpasswordsubmit"])) {
    $select = $_POST["select"];
    $validator = $_POST["validator"];
    $password = $_POST["pwd"];
    $password2 = $_POST["pwd2"];

    if (empty($password) || empty($password2)) {
        header('Location: createnewpassword.php?newpwd=empty');
        exit();
    } else if ($password != $password2) {
        header('Location: createnewpassword.php?newpwd=passwordsnotmatching');
        exit();
    }

    $currentDate = date("U");
    $mysqli = require __DIR__ . "/database.php";

    $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector=? AND pwdResetExpires >= ?";
    $stmt = $mysqli->stmt_init();



    if (!$stmt->prepare("$sql")) {
        header('Location :resetpassword.php');
        exit();
    } else {
        $stmt->bind_param("s", $select);
        $stmt->execute();

        $result = $stmt->get_result();
        if (!$row = $result->fetch_array()) {
            echo "You need to re-submit your reset request";
            exit();
        } else {
            $TokenBin = hex2bin($validator);
            $TokenCheck = password_verify($TokenBin, $row["pwdResetToken"]);

            if ($TokenCheck === false) {
                echo "You need to resubmit the resquest";
                exit();
            } elseif ($TokenCheck === true) {
                $TokenEmail = $row['pwdResetEmail'];
                $sql = "SELECT * FROM User WHERE Email=?;";
                $stmt = $mysqli->stmt_init();

                if (!$stmt->prepare("$sql")) {
                    echo "Error!";
                    exit();
                } else {
                    $stmt->bind_param("s", $TokenEmail);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if (!$row = $result->fetch_array()) {

                        echo "There was an error !!";
                        exit();
                    } else {
                        $sql = " UPDATE User SET Password_Hash=? WHERE Email=?";
                        $stmt = $mysqli->stmt_init();



                        if (!$stmt->prepare("$sql")) {
                            header('Location :resetpassword.php');
                            exit();
                        } else {
                            $newpwdhashed = password_hash($password, PASSWORD_DEFAULT);

                            $stmt->bind_param("ss", $newpwdhashed, $TokenEmail);
                            $stmt->execute();

                            $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
                            $stmt = $mysqli->stmt_init();
                            if (!$stmt->prepare("$sql")) {
                                echo ('There was an error bro!');
                                exit();
                            } else {
                                $stmt->bind_param("s", $TokenEmail);
                                $stmt->execute();
                                header('Location: randompassword.html');
                            }
                        }
                    }
                }
            }
        }
    }
} else {
    header('Location: randompassword.html');
}
