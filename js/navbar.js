$(document).ready(function() {
    $(".navButton").hover(function() {
        // When hovering, change colors
        $(this).children().css("color", "#f2fbfc");
    }, function() {
        // Once hover ends, reset
        $(this).children().css("color", "#c5ecf1");
    });
});
