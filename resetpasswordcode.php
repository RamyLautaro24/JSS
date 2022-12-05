<?php
if (isset($_POST["password_reset"])) {
    //creating two tokens to avoid timing attack

    $select = bin2hex(random_bytes(8)); // from binary to hexadecimal 
    $token = random_bytes(32); // longer to be secure

    $url = "http://localhost:8888/createnewpassword.php?select=" . $select . "&validator" . bin2hex($token);

    // creating desactivating time for the token

    $expires = date("U") + 1800; // one hour to reset the password

    $mysqli = require __DIR__ . "/database.php";

    $userEmail = $_POST["email"];

    $sql = "DELETE FROM pwdReset WHERE pwdResetEmail=?";
    $stmt = $mysqli->stmt_init();

    //maybe error on top

    if (!$stmt->prepare("$sql")) {
        // header('Location :resetpassword.php');
        echo "wesh";
        exit();
    } else {
        $stmt->bind_param("s", $userEmail);
        $stmt->execute();
    }

    $sql = "INSERT INTO pwdReset(pwdResetEmail, pwdResetSelector, pwdResetToken, pwdResetExpires) VALUES (?,?,?,?);";
    if (!$stmt->prepare("$sql")) {
        // header('Location :resetpassword.php');
        echo "laeziz";
        exit();
    } else {
        $HashedToken = password_hash($token, PASSWORD_DEFAULT);

        $stmt->bind_param("ssss", $userEmail, $select, $HashedToken, $expires);
        $stmt->execute();
    }
    $stmt->close();
    //close the connection

    //let's send the email

    $to = $userEmail;
    $subject = 'Reset your password';
    $message = '<p> Hello, We received a password reset request. The link to reset your password is below. If you did not ask to reset your password you can ignore this email. ';
    $message .= '<p> Your password reset link is: </br>';
    $message .= '<a href="' . $url . '">' . $url . '</a></p>';

    $headers = "From: Ramy's App <localhost:8888/index.php>\r\n";
    $headers .= "Reply-To: ramyrouighi@city.ac.uk\r\n";
    $headers .= "Content-type: text/html\r\n";


    mail($to, $subject, $message, $headers);
    //header('Location: randompassword.html');
    echo "tonton";
    exit();
} else {
    header('Location: randompassword.html');
}
