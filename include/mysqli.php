<?php
$config = parse_ini_file('config.ini')
// Get connection to SQL database
// This gives the rest of the page access to $conn, which is the connection
if(!isset($conn)) {
    $hostName = $config['db_host'];
    $mysqliUsername = $config['db_user'];
    $mysqliPassword = $config['db_password'];
    $databaseName = $config['db_name'];

    $conn = new mysqli($hostName, $mysqliUsername, $mysqliPassword, $databaseName);
    if(mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }
}
?>
