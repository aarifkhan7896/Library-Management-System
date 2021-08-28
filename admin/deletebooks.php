<?php
include '../partials/dbcon.php';
$id = $_GET['id'];

$sql = "DELETE FROM `books` WHERE `books`.`id` = '$id'";
$result = mysqli_query($dbcon,$sql);
if($result){
    mysqli_close($dbcon);
    header("location: managebooks.php");
    exit();
}else{
    echo "unable to delete".mysqli_error($dbcon);
}
?>