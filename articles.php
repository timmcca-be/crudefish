<!DOCTYPE html>
<html>
    <head>
<?php
include "include/head.php";
include "include/mysqli.php";
// Page can be displayed by showing newest (highest post number) or most
// popular - if orderBy is not set or not set correctly, default to newest
if(isset($_GET["orderBy"])) {
    $orderBy = mysqli_real_escape_string($conn, $_GET["orderBy"]);
} else {
    $orderBy = "number";
}
if(!($orderBy === "number" || $orderBy === "views")) {
    $orderBy = "number";
}
// If page is not set or not set correctly, default to 1
if(isset($_GET["page"])) {
    $page = mysqli_real_escape_string($conn, $_GET["page"]);
} else {
    $page = 1;
}
if(!ctype_digit($page)) {
    $page = 1;
}
?>
        <script src="/js/previews.js"></script>
        <title>CrudeFish | Articles</title>
    </head>
    <body>
<?php include "include/navbar.php";?>
        <h1>Articles<?php if($orderBy === "number") echo ": New"; else if($orderBy === "views") echo ": Popular";?></h1>
        <div class="articlesNav">
<?php
// Give option to view by other sort method
if($orderBy != "number") {
    echo
"            <a href='/articles.php?orderBy=number&page=1'><div class='navButton'><h2>View NEW</h2></div></a>
";
} if($orderBy != "views") {
    echo
"            <a href='/articles.php?orderBy=views&page=1'><div class='navButton'><h2>View POPULAR</h2></div></a>
";
}
?>
        </div>
        <div id="previews">
<?php
$start = ($page - 1) * 12;
include "include/displayPreviews.php";
// displayPreviews makes the previews, and if there are any previews that
// would appear on the next page returns true; otherwise, it returns false
$nextPage = displayPreviews($conn, $start, 12, $orderBy, 200);
?>
        </div>
<?php
// Base URL for page links
$base = "/articles.php?orderBy=" . $orderBy . "&";
// If pages exist in either direction, display buttons to go to them
if($page != 1 || $nextPage) {
    echo
"        <div class='articlesNav'>
";
    if($page != 1) {
        echo
"            <a href='" . $base . "page=" . ($page - 1) . "'><div class='navButton'><h2>Previous</h2></div></a>
";
    }
    if($nextPage) {
        echo
"            <a href='" . $base . "page=" . ($page + 1) . "'><div class='navButton'><h2>Next</h2></div></a>
";
    }
    echo
"        </div>
";
}
include "include/footer.php";
?>
    </body>
</html>
