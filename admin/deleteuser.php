<?php
include '../partials/dbcon.php';
$id = $_GET['id'];

$sql = "DELETE FROM `student` WHERE `student`.`id` = '$id'";
$result = mysqli_query($dbcon, $sql);
if($result){
    mysqli_close($dbcon); // Close connection
    header("location: registeredusers.php"); // redirects to all records page
    exit();
}else{
    echo 'error->'.mysqli_error($dbcon);
}
?>