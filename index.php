<!DOCTYPE html>
<html>
    <head>
        <title>CrudeFish | Bringing Funny Back</title>
<?php include "include/head.php";?>
        <script src="/js/previews.js"></script>
    </head>
    <body>
<?php include "include/navbar.php";?>
        <div class="siteDescription">
            <img id='bigLogo' src='/img/bigLogo.svg' />
            <p>CrudeFish - filling the void in high quality internet comedy since 2015.</p>
            <br />
            <p>This site is still under active construction, so more features are on the way! If there is some server downtime, please have some patience; it is because we are working to improve your experience.</p>
        </div>
        <div class="frontPageDiv">
            <h3>Popular</h3>
            <br />
<?php
include "include/mysqli.php";
include "include/displayPreviews.php";
displayPreviews($conn, 0, 6, "views", 100);
?>
        </div>
<?php include "include/footer.php";?>
    </body>
</html>
