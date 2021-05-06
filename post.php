<!DOCTYPE html>
<html>
    <head>
        <title>CrudeFish | Post</title>
<?php
include "include/head.php";
// Prevent non-users from posting
if(!isset($_SESSION["user"])) {
    echo "<script>alert('Please log in or create an account to post'); window.location.href = '/logInSignUp.php';</script>";
    exit();
}
?>
    <script src="/js/post.js"></script>
    </head>
    <body>
<?php include "include/navbar.php";?>
        <h1>Post</h1>
        <form>
            <p>Title:</p>
            <input type="text" id="title" placeholder="Title"><br>
            <p>Content:</p>
            <textarea rows="10" id="contentInput" placeholder="Content"></textarea><br>
            <p>Description:</p>
            <textarea rows="4" id="descriptionInput" placeholder="Description"></textarea>
            <a href="javascript:void(0);"><div class="navButton" id="post"><h2>Submit Post</h2></div></a>
        </form>
<?php include "include/footer.php";?>
    </body>
</html>
