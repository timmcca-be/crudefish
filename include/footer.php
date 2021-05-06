<?php
if(session_status() != 2) {
    // If the session has not been started yet, this page is being loaded
    // independently, which we don't want. Stop that with includeAccessError
    session_start();
    include "includeAccessError.php";
    includeAccessError("include/footer.php");
}
echo
"        <div id='footer'>
            <!-- This will be a footer, if the need for one arises; otherwise, it is a placeholder to maintain the height of the body without removing my float properties from the left and right front page divs. -->
        </div>
";
?>
