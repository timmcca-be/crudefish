<?php
if(session_status() != 2) {
    // If the session has not been started yet, this page is being loaded
    // independently, which we don't want. Stop that with includeAccessError
    session_start();
    include "includeAccessError.php";
    includeAccessError("include/displayPreviews.php");
}
include "include/preview.php";
function displayPreviews($conn, $start, $quantity, $orderBy, $chars) {
    // Take all entries from $start to $quantity as sorted by $sortedBy,
    // make previews of them up to $chars characters, and return true if
    // there are more posts after the end of the ones displayed and false
    // otherwise

    // Get numbers in order of $orderBy
    $sql = "SELECT * FROM posts ORDER BY " . $orderBy . " DESC;";
    $result = mysqli_query($conn, $sql);
    for($i = 0; $i < $start; $i++) {
        // Ignore the rows up to $start
        // TODO: make sure there's not a better way to do this (I'm sure there
        // is)
        mysqli_fetch_row($result);
    }
    for($i = 0; $i < $quantity; $i++) {
        // For each row from $start to $quantity
        // Get row
        $row = mysqli_fetch_assoc($result);
        // If empty row...
        if($row === NULL) {
            // If we haven't displayed any previews yet...
            if($i === 0) {
                // If this is the first page...
                if($start === 0) {
                    // No posts
                    echo
"            <p>No content has been submitted yet! <a href='/post.php'>Be the first?</a></p>
";
                } else {
                    // If it's not the first page, this is just an empty page
                    // Go back to a valid page
                    echo "<script>window.location.href = '/articles.php?orderBy=" . $orderBy . "&page=1';</script>";
                }
            }
            break;
        }
        preview($conn, $row, $chars);
    }
    // If there are more rows after the posts displayed, return true
    if(mysqli_num_rows($result) > $start + $quantity) {
        return true;
    }
    // Otherwise, return false
    return false;
}
?>
