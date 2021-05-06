<!DOCTYPE html>
<html>
    <head>
        <title>CrudeFish | Log In or Sign Up</title>
<?php
include "include/head.php";
// Prevent logged-in users from getting to this page
if(isset($_SESSION["user"])) {
    echo "<script>alert('You\'re already logged in as " . $_SESSION["user"] . "'); window.location.href = '/';</script>";
    exit();
}
?>
        <script src="/js/logInSignUp.js"></script>
    </head>
    <body>
<?php include "include/navbar.php";?>
        <!-- TODO: try to make the form action call the JS -->
        <form id="logInForm">
            <h1>Log In</h1>
            <p>Username:</p>
            <input type="text" id="userLogIn" placeholder="Username"><br />
            <p>Password:</p>
            <input type="password" id="passLogIn" placeholder="Password"><br /><br />
            <a href="javascript:void(0);"><div class="navButton" id="logIn"><h2>Log In</h2></div></a>
        </form>
        <form id="signUpForm">
            <h1>Sign Up</h1>
            <p>Username:</p>
            <input type="text" id="userSignUp" placeholder="Username"><br />
            <p>Password:</p>
            <input type="password" id="passSignUp" placeholder="Password"><br />
            <p>Email:</p>
            <input type="text" id="email" placeholder="Email"><br /><br />
            <a href="javascript:void(0);"><div class="navButton" id="signUp"><h2>Sign Up</h2></div></a>
        </form>
<?php include "include/footer.php";?>
    </body>
</html>
