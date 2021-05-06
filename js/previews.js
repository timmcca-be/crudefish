$(document).ready(function() {
    function size() {
        var number = document.getElementsByClassName("preview").length;
        var i;
        for(i = 0; i < number; i++) {
            $preview = $(".preview:eq(" + i + ")");
            $preview.height("auto");
        }
        var maxSize = 0;
        for(i = 0; i < number; i++) {
            $preview = $(".preview:eq(" + i + ")");
            if($preview.height() > maxSize) {
                maxSize = $preview.height();
            }
        }
        for(i = 0; i < number; i++) {
            $preview = $(".preview:eq(" + i + ")");
            $preview.height(maxSize);
        }
    }
    size();
    $("html").resize(function() {
        size();
    });
    $(window).resize(function() {
        size();
    });
});
