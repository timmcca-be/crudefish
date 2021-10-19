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
            <h4>CrudeFish - filling the void in high quality internet comedy since 2015.</h4>
            <br />
            <p>
                Well, okay, not really. But I really thought it would when I built the site in 2015,
                and it feels right to keep it there now.
            </p>
            <p>
                Hi, I'm Tim! I'm the developer of this site, and of
                <a href="https://timmcca.be">a lot more things</a> since.
                I got into programming a few years before this project,
                making little arcade-style video games and utility programs,
                but this project marked my first real foray into full-stack web dev.
                I have learned a lot since (such as how to indent code properly... yikes),
                but I like to share this site because it's fun to look back,
                and I'm very proud of what I was able to accomplish at the time
                with the tools at my disposal. I hope it's fun for you too!
            </p>
            <p>
                While you're here, I'd love it if you would create an account and make a post!
                It doesn't have to be funny&#8212;why you're here, what you had for breakfast,
                what kinds of pets you have, anything really. Just please don't reuse a password
                from any other site; I rolled the authentication myself six years ago (at time of writing)
                and I don't have a lot of confidence in it. But I know it would make a certain teenager
                in 2015 very happy to see this site get some love.
            </p>
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
