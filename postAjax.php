<?php
session_start();
include "include/mysqli.php";
include "include/checkCondition.php";

// Make sure this page is being accessed with appropriate parameters
// TODO: check for all parameters
if(!isset($_POST["title"])) {
    $_SESSION["error"] = "postAjax.php accessed with invalid parameters. If you are looking to submit a post, please go <a href='/post.php'>here</a>.";
    echo "<script>window.location.href = '/error.php';</script>";
    exit();
}

// Get all post numbers for counting purposes
// TODO: Come on 2015 Tim. There must be a better way
$sql = "SELECT number FROM posts;";
$result = mysqli_query($conn, $sql);

// Find lowest free positive/zero integer and use it as post number
if($result != NULL) {
    $number = mysqli_num_rows($result);
} else {
    $number = 0;
}
// Author is current user
$author = $_SESSION["user"];
// Get safe strings
$title = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["title"]));
$content = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["content"]));
$description = htmlspecialchars(mysqli_real_escape_string($conn, $_POST["description"]));
// $values[0] contains the variable labels and $values[1] contains their values
$values = array(array("number", "author", "title", "content", "description", "views"), array($number, $author, $title, $content, $description, 0));

// All applicable error messages will be displayed, and if any are displayed $triggered will become true, preventing account creation
$triggered = checkCondition($title === "" || $content === "" || $description === "", "All fields must be filled in") ||
             checkCondition(strlen($title) > 30, "Title must be under 30 characters") ||
             checkCondition(strlen($content) > 4294967295, "Content must be under 4294967295 characters") ||
             checkCondition(strlen($description) > 65535, "Description must be under 65535 characters");

// If all conditions cleared
if(!$triggered) {
    // This is so similar to SignUpAjax.php's mechanism to do the same thing
    // with new users that it should probably be its own function
    // TODO: move this into its own function
    // SQL statement creation
    $sql = "INSERT INTO posts (";
    // Add row names from $values[0]
    for($i = 0; $i < count($values[0]); $i++) {
        $sql = $sql . $values[0][$i];
        if($i != count($values[0]) - 1) {
            $sql = $sql . ", ";
        }
    }
    $sql = $sql . ") VALUES (";
    // Add values from $values[1]
    for($i = 0; $i < count($values[1]); $i++) {
        if(is_string($values[1][$i])) {
            $sql = $sql .  "'" . $values[1][$i] .  "'";
        } else {
            $sql = $sql . $values[1][$i];
        }
        if($i != count($values[1]) - 1) {
            $sql = $sql . ", ";
        }
    }
    $sql = $sql . ");";
    // Try the query and display the issue then stop if it fails and show the SQL error
    if(!mysqli_query($conn, $sql)) {
        echo("Error description: " . mysqli_error($conn) . "

SQL code: '" . $sql);
        exit();
    }
    echo "/article.php?number=" . $number;
}
$conn->close();
?>
