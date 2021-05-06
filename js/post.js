$(document).ready(function() {
    function postCall() {
        var title = $("#title").val();
        var content = $("#contentInput").val();
        var description = $("#descriptionInput").val();
        // If fields are empty, tell the user and don't submit the request
        if(title == "" || content == "" || description == "") {
            alert("Please fill in all fields");
        } else {
            // Otherwise, submit the data to the server
            $.post("postAjax.php",
                    { title: title, content: content, description: description },
                    function(data) {
                        // If the string contains a valid redirect URL, go there
                        if(data.indexOf("/article.php?number=") !== -1) {
                            alert("Post submitted successfully");
                            window.location.href = data;
                        } else {
                            // Otherwise, alert the error message
                            alert(data);
                        }
                    }
            );
        }
    }
    // On click or enter press, submit
    // TODO: use form action
    $("#post").click(function() {
        postCall();
    });
    $("input").keyup(function (e) {
        if (e.keyCode == 13) {
            postCall();
        }
    });
});
