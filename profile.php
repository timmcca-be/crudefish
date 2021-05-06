<!DOCTYPE html>
<html>
    <head>
<?php
include "include/head.php";
include "include/mysqli.php";

// Make sure this page is being accessed with appropriate parameters
if(!isset($_GET["user"])) {
    $_SESSION["error"] = "profile.php accessed with invalid parameters.";
    if(isset($_SESSION["user"])) {
        $_SESSION["error"] = $_SESSION["error"] . " If you are looking to view your own profile, please click <a href='/profile.php?user=" . $_SESSION["user"] . "'>here</a>.";
    }
    echo
"        <script>window.location.href = '/error.php'</script>";
    exit();
}

// Get safe username string
$user = mysqli_real_escape_string($conn, $_GET["user"]);
// Get user
$sql = "SELECT user FROM users WHERE user='" . $user . "';";
$result = mysqli_query($conn, $sql);

// Make sure user exists
if(mysqli_num_rows($result) === 0) {
    $_SESSION["error"] = "profile.php accessed with invalid parameters. The user " . $user . " does not exist.";
    echo "<script>window.location.href = '/error.php'</script>";
    exit();
}
?>
        <script src="js/previews.js"></script>
        <title>CrudeFish | <?php echo $user;?></title>
    </head>
    <body>
<?php include "include/navbar.php";?>
        <h1><?php echo $user;?></h1>
<?php
if(isset($_SESSION["user"]) && $_SESSION["user"] === $user) {
    echo
"
        <a href='javascript:void(0)'><div class='navButton' id='edit'><h2>Settings</h2></div></a>";
}
?>
        <div id="previews">
<?php
include "include/preview.php";
// Get user's posts and display previews
$sql = "SELECT * FROM posts WHERE author='" . $user . "';";
$result = mysqli_query($conn, $sql);
if($result === NULL || mysqli_num_rows($result) === 0) {
    echo
"            <p>This user has not submitted any content yet!</p>";
} else {
    for($i = 0; $i < mysqli_num_rows($result); $i++) {
        // Preview all posts
        // TODO: figure out a way to avoid loading all of these on the same
        // page
        $row = mysqli_fetch_assoc($result);
        preview($conn, $row, 150);
    }
}
?>
        </div>
<?php include "include/footer.php";?>
    </body>
</html>
