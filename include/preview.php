<?php
if(session_status() != 2) {
    // If the session has not been started yet, this page is being loaded
    // independently, which we don't want. Stop that with includeAccessError
    session_start();
    include "includeAccessError.php";
    includeAccessError("/include/preview.php");
}
function preview($conn, $row, $characters) {
    // Replace all new lines with <p> elements to fix line breaks, then cut
    // down to $characters characters
    $content = preg_replace("/
/", "</p>
                <p>", substr($row["content"], 0, $characters));
    // If we cut off characters, add ... to the end
    if(strlen($row["content"]) > $characters) {
        $content .= "...";
    }
    // Generate HTML preview
    echo
"            <div class='preview'>
                <h3><a href='/article.php?number=" . $row["number"] . "'>" . $row["title"] . "</a></h3>
                <p>" . $content . "</p>
                <p><a href='/profile.php?user=" . $row["author"] . "'>-" . $row["author"] . "</a><p>
            </div>
";
}
?>
