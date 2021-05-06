<?php
function includeAccessError($fileName) {
    // Display an error if a page that shouldn't be loaded directly is loaded
    // directly
    $_SESSION["error"] = $fileName . " was accessed directly. This file is meant for server-side access only.";
    echo "<script>window.location.href = '/error.php';</script>";
    exit();
}
if(session_status() != 2) {
    // This is one of those pages
    session_start();
    includeAccessError("include/includeAccessError.php");
}
?>
