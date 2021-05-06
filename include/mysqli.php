<?php
// Get connection to SQL database
// This gives the rest of the page access to $conn, which is the connection
if(!isset($conn)) {
    $hostName = "localhost";
    $mysqliUsername = "root";
    $mysqliPassword = '<password>';
    $databaseName = "crudefish";

    $conn = new mysqli($hostName, $mysqliUsername, $mysqliPassword, $databaseName);
    if(mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }
}
?>
