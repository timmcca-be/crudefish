<?php
include "include/mysqli.php";
include "include/checkCondition.php";

// Make sure this page is being accessed with appropriate parameters
// TODO: check for all parameters
if(!isset($_POST["user"])) {
    $_SESSION["error"] = "signUpAjax.php accessed with invalid parameters. If you are looking to create an account, please go <a href='/logInSignUp.php'>here</a>.";
    echo "<script>window.location.href = '/error.php';</script>";
    exit();
}

// Make raw strings safe and hash password
$user = mysqli_real_escape_string($conn, $_POST["user"]);
$pass = password_hash($_POST["pass"], PASSWORD_BCRYPT);
$email = mysqli_real_escape_string($conn, $_POST["email"]);
// The confirmation code is generated, hashed, and stored, and the unhashed code
// will be sent in a link to the user for verification (see below)
$confirmation = rand(1000000000, 9999999999);
$confirmationEncoded = password_hash($confirmation, PASSWORD_BCRYPT);

// $values[0] contains the variable labels and $values[1] contains their values
$values = array(array("user", "pass", "email", "confirmation"), array($user, $pass, $email, $confirmationEncoded));

// Look for user with this username
$sql = "SELECT * FROM users WHERE user='" . $user . "';";
$result = mysqli_query($conn, $sql);
// Check if there is such a user
$userExists = mysqli_num_rows($result) != 0;
// Same thing but with email
$sql = "SELECT * FROM users WHERE email='" . $email . "';";
$result = mysqli_query($conn, $sql);
$emailUsed = mysqli_num_rows($result) != 0;

// Check if username is reserved - if it is, an error message will be generated
// below
$usernameReserved = false;
$reservedUsernames = array("tim", "administrator", "staff", "crudefish", "awesome8x");
for($i = 0; $i < count($reservedUsernames); $i++) {
    if(checkCondition(strtolower($user) === $reservedUsernames[$i], "This username is reserved")) {
        $usernameReserved = true;
        break;
    }
}

// All applicable error messages will be displayed, and if any are displayed $triggered will become true, preventing account creation
$triggered = checkCondition($user === "" || $pass === "" || $email === "", "All fields must be filled in") ||
             checkCondition(!filter_var(($user . "@example.com"), FILTER_VALIDATE_EMAIL), "Username must follow standard email address conventions") ||
             checkCondition(strlen($user) > 20, "Username must be under 20 characters") ||
             checkCondition(!filter_var($email, FILTER_VALIDATE_EMAIL), "Email address must be valid") ||
             checkCondition($userExists, "A user with this username already exists") ||
             checkCondition($usernameReserved, "This username is reserved") ||
             checkCondition($emailUsed, "This email address is already in use");

// If no errors, create account
if(!$triggered) {
    // This is so similar to PostAjax.php's mechanism to do the same thing
    // with new posts that it should probably be its own function
    // TODO: move this into its own function
    // SQL statement creation
    $sql = "INSERT INTO users (";
    // Add row names from $values[0]
    for($i = 0; $i < count($values[0]); $i++) {
        $sql = $sql . $values[0][$i];
        if($i != count($values[0]) - 1) {
            $sql = $sql . ", ";
        }
    }
    $sql = $sql . ") VALUES (";
    // Add values from $values[1]
    for($i = 0; $i < count($values[1]); $i++) {
        if(is_string($values[1][$i])) {
            $sql = $sql .  "'" . $values[1][$i] .  "'";
        } else {
            $sql = $sql . $values[1][$i];
        }
        if($i != count($values[1]) - 1) {
            $sql = $sql . ", ";
        }
    }
    $sql = $sql . ");";
    // Try the query and display the issue then stop if it fails and show the SQL error
    if(!mysqli_query($conn, $sql)) {
        echo("Error description: " . mysqli_error($conn) . "

SQL code: '" . $sql);
        exit();
    }
    echo "New account created successfully";
    // TODO: send email to $email containing link:
    // "http://www." . $website . ".com/confirm.php?user=" . $user . "&confirmation=" . $confirmation
    // to confirm account. Once this is done, set account restrictions before confirmation.
    // $website will be the name of the website once the domain is bought, hopefully just "crudefish"
    // Maybe use PHPMailer
}
// End SQL connection
$conn->close();
?>
