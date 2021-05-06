<?php
if(session_status() != 2) {
    // If the session has not been started yet, this page is being loaded
    // independently, which we don't want. Stop that with includeAccessError
    session_start();
    include "includeAccessError.php";
    includeAccessError("/include/navbar.php");
}
echo
"        <div id='navbar'>
            <a href='/'><img id='logo' src='/img/logo.svg' /></a>
            <a href='/'><div class='navButton'><h2>Home</h2></div></a>
            <a href='/articles.php?orderBy=number&page=1'><div class='navButton'><h2>Articles</h2></div></a>
            <a href='/post.php'><div class='navButton'><h2>Post</h2></div></a>";
if(isset($_SESSION["user"])) {
    echo
"
            <a href='/logout.php'><div class='navButton' id='profileButton'><h2>Log Out</h2></div></a>
            <a href='/profile.php?user=" . $_SESSION["user"] . "'><div class='navButton' id='profileButton'><h2>" . $_SESSION["user"] . "</h2></div></a>";
} else {
    echo
"
            <a href='/logInSignUp.php'><div class='navButton' id='logInSignUp'><h2>Log In</h2></div></a>";
}
echo
"
        </div>
";
?>
