<!DOCTYPE html>
<html>
    <head>
<?php
include "include/head.php";
include "include/mysqli.php";
// Make sure this page is being accessed with appropriate parameters
// TODO: check for all parameters
if(!isset($_GET["number"])) {
    $_SESSION["error"] = "article.php accessed with invalid parameters. If you are looking to browse through articles, please go <a href='/articles.php'>here</a>.";
    echo
"        <script>window.location.href = '/error.php';</script>";
    exit();
}

// Get post number
$number = $_GET["number"];
// Get post from post number
$sql = "SELECT * FROM posts WHERE number=" . mysqli_real_escape_string($conn, $number) . ";";
$result = mysqli_query($conn, $sql);
// Check for validity
if(mysqli_num_rows($result) != 1) {
    $_SESSION["error"] = "aricle.php accessed with invalid parameters. Either the link is broken or this article no longer exists. If you are looking to browse through articles, please go <a href='/articles.php'>here</a>.";
    echo "<script>window.location.href = '/error.php';</script>";
    exit();
}
$row = mysqli_fetch_assoc($result);

// If the viewer is not the author, increment view count
if(!isset($_SESSION["user"]) || $_SESSION["user"] != $row["author"]) {
    $sql = "UPDATE posts SET views=views+1 WHERE number=" . $row["number"] . ";";
    mysqli_query($conn, $sql);
    // Increment locally so display is accurate
    $row["views"]++;
}
?>
        <title>CrudeFish | <?php echo $row["title"];?></title>
    </head>
    <body>
<?php include "include/navbar.php";?>
        <h1><?php echo $row["title"];?></h1>
        <div class="contentDisplay">
            <p><?php
// Replace new lines with new <p> elements
$content = preg_replace('/
/', '</p>
            <p>', $row["content"]);
// Display content
echo $content;
?></p>
        </div>
        <p id="views">Views: <?php echo $row["views"];?></p>
        <p><?php
// Link to author's profile
echo "<a href='/profile.php?user=" . $row["author"] . "'>-" . $row["author"] . "</a>";
?></p>
        <br>
        <p><?php echo $row["description"];?></p>
<?php include "include/footer.php";?>
    </body>
</html>
