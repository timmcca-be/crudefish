$(document).ready(function() {
    function logIn(user, pass) {
        // If fields are empty, tell the user and don't submit the request
        if(user == "" || pass == "") {
            alert("Please fill in all fields");
        } else {
            // Otherwise, send the username and password to the server
            $.post("logInAjax.php",
                   { user: user, pass: pass },
                   function(data) {
                        // If login was successful, go back to home page
                        // TODO: redirect to last page
                        if(data === "Successfully logged in") {
                            window.location.href = "/";
                        } else {
                            // Otherwise, tell the user what happened and
                            // clear the password fields
                            $("#passLogIn").val("");
                            $("#passSignUp").val("");
                            alert(data);
                        }
                    }
            );
        }
    }
    function logInCall() {
        // Shorthand, as this is called twice. It gets the username and
        // password from the fields. However, after signing up, the logIn
        // function must be called without reading from these fields,
        // so the functions must be separate
        logIn($("#userLogIn").val(), $("#passLogIn").val());
    }
    function signUpCall() {
        var user = $("#userSignUp").val();
        var pass = $("#passSignUp").val();
        var email = $("#email").val();
        var send;
        if($("#send").is(":checked")) {
            send = 1;
        } else {
            send = 0;
        }
        // If fields are empty, tell the user and don't submit the request
        if(user == "" || pass == "" || email == "") {
            alert("Please fill in all fields");
        } else {
            // Otherwise, send the data to the server
            $.post("signUpAjax.php",
                    { user: user, pass: pass, email: email, send: send },
                    function(data) {
                        // Show response
                        alert(data);
                        // If login was successful, go back to home page
                        // TODO: redirect to last page
                        if(data == "New account created successfully") {
                            logIn(user, pass);
                        } else {
                            $("#passLogIn").val("");
                            $("#passSignUp").val("");
                        }
                    }
            );
        }
    }
    // Accept clicks or enter presses for log in and sign up
    // TODO: use form action?
    $("#logIn").click(function() {
        logInCall();
    });
    $("#logInForm input").keyup(function (e) {
        if (e.keyCode == 13) {
            logInCall();
        }
    });
    $("#signUp").click(function() {
        signUpCall();
    });
    $("#signUpForm input").keyup(function (e) {
        if (e.keyCode == 13) {
            signUpCall();
        }
    });
});
