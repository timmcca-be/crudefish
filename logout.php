<?php
// Logs out user
session_start();
if(isset($_SESSION["user"])) {
    session_destroy();
    echo "<script>window.location.href = '/';</script>";
} else {
    $_SESSION["error"] = "logout.php accessed while not logged in.";
    echo "<script>window.location.href = '/error.php';</script>";
}
?>
