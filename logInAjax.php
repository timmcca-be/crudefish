<?php
session_start();
include "include/mysqli.php";

// Make sure this page is being accessed with appropriate parameters
// TODO: check for all parameters
if(!isset($_POST["user"])) {
    $_SESSION["error"] = "logInAjax.php accessed with invalid parameters. If you are looking to log in, please go <a href='/logInSignUp.php'>here</a>.";
    echo "<script>window.location.href = '/error.php';</script>";
    exit();
}

// Get safe strings
$user = mysqli_real_escape_string($conn, $_POST["user"]);
$pass = mysqli_real_escape_string($conn, $_POST["pass"]);

// Get hashed password and confirmation code
$sql = "SELECT pass, confirmation FROM users WHERE user='" . $user . "';";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$hash = $row["pass"];
// "." means confirmed, so this is true only if the user has confirmed
$confirmed = $row["confirmation"] === ".";
// If we're good, log in
if(mysqli_num_rows($result) != 0 && password_verify($pass, $hash)) {
    $_SESSION["user"] = $user;
    $_SESSION["confirmed"] = $confirmed;
    echo "Successfully logged in";
} else {
    // Otherwise, tell user
    echo "Incorrect username or password";
}
?>
