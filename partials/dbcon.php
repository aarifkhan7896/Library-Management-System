<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "library";

$dbcon = mysqli_connect($servername, $username, $password, $database);
if(!$dbcon){
    die("Unable to connect".mysqli_connect_error($dbcon));
}
?>