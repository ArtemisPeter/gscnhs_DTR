<?php
$servername = "localhost";
$database = "dtr";
$username = "root";
$password = "";
 
// Create connection
 
$con = mysqli_connect($servername, $username, $password, $database);
 
if (!$con) {
 
    die("Connection failed: " . mysqli_connect_error());
 
};

?>