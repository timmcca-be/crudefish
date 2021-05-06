<!DOCTYPE html>
<!-- This page takes the value of "error" from the session and displays it on a pretty error page -->
<html>
    <head>
        <title>CrudeFish | ¿Blub?</title>
<?php include "include/head.php";?>
    </head>
    <body>
<?php include "include/navbar.php";?>
        <h1>¿Blub?</h1>
        <p>The link you tried to visit is broken, the page no longer exists, or something bugged out.</p>
        <br>
        <br>
<?php
if(isset($_SESSION["error"]) && $_SESSION["error"] != "") {
    $message = $_SESSION["error"];
    unset($_SESSION["error"]);
} else if(isset($_GET["404"])) {
    $message = "The directory you tried to access does not exist.";
} else {
    $message = "error.php accessed with invalid parameters.";
}
if(isset($message)) {
    echo
"        <h3>Message</h3>
        <p>" . $message . "</p>
";
}
?>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <h1>BUT WAIT!</h1>
        <p>While you're here, why not <a href="/">check out our site</a>?</p>
<?php include "include/footer.php";?>
    </body>
</html>
