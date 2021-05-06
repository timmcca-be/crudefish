<?php
session_start();
include "include/mysqli.php";

// Make sure this page is being accessed with appropriate parameters
// TODO: check for all parameters
if(!isset($_GET["user"])) {
    session_start();
    $_SESSION["error"] = "confirm.php accessed with invalid parameters. If you are looking to create an account, please go <a href='/logInSignUp.php'>here</a>.";
    echo "<script>window.location.href = '/error.php';</script>";
    exit();
}

// Get safe strings
$user = mysqli_real_escape_string($conn, $_GET["user"]);
$confirmation = mysqli_real_escape_string($conn, $_GET["confirmation"]);

// Get hashed confirmation
$sql = "SELECT confirmation FROM users WHERE user='" . $user . "';";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$hash = $row["confirmation"];

// If confirmation succeeds, make the confirmation code "." and tell
// the user
// "." means confirmed
if(mysqli_num_rows($result) != 0 && password_verify($confirmation, $hash)) {
    $sql = "UPDATE users SET confirmation='.' WHERE  user='" . $user . "';";
    // TODO: make this check for SQL errors (see SignUpAjax.php)
    mysqli_query($conn, $sql);
    echo "<script>alert('Confirmed!'); window.location.href = '/';</script>";
} else {
    // Otherwise, tell the user there's an issue
    session_start();
    $_SESSION["error"] = "confirm.php accessed with invalid parameters. Either the URL is invalid or the associated account has already been confirmed";
    echo "<script>window.location.href = '/error.php';</script>";
}
?>
