<?php
session_start();
// Redirect to "redirect" from session or to the homepage if it's not set
// TODO: implement this more widely to allow users to go back to the pages
// they came from
if(isset($_SESSION["redirect"])) {
    $location = $_SESSION["redirect"];
} else {
    $location = "/";
}
echo "<script>window.location.href = '" . $location . "';</script>";
?>
