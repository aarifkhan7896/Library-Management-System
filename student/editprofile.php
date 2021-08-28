<?php include '../partials/dbcon.php'; ?>
<?php
$id = $_GET['id'];
$sql = "SELECT * FROM `student` WHERE student_id = '$id'";
$result = mysqli_query($dbcon, $sql);
while($row = mysqli_fetch_assoc($result)){
    $id = $row['student_id'];
}
?>

<?php


if($_SERVER['REQUEST_METHOD']=="POST"){
    
    include '../partials/dbcon.php';
    
    $editid = $_POST['editid'];
    $editname = $_POST['editname'];
    $editclass = $_POST['editclass'];
    $editsection = $_POST['editsection'];
    $editemail = $_POST['editsection'];
    
    $sql = "UPDATE `student` SET `student_id` = '$editid', `name` = '$editname', `class` = '$editclass', `section` = '$editsection', `email` = '$editemail' WHERE `student`.`id` = '$id'";
    $result = mysqli_query($dbcon, $sql);
    if($result){
        echo "success";
    }else{
        echo "failed->".mysqli_error($dbcon);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Library</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <?php require '../partials/header.php'; ?>
    <div id="admindash">
        <h1>Edit Profile</h1>
    </div>
    <div class="container" id="editprofile">
        <form action="editprofile.php" method="post">
            <div class="mb-3">
                <label for="editid" class="form-label">Student ID</label>
                <input type="text" class="form-control" id="editid" name="editid">
            </div>
            <div class="mb-3">
                <label for="editname" class="form-label">Name</label>
                <input type="text" class="form-control" id="editname" name="editname">
            </div>
            <div class="mb-3">
                <label for="editclass" class="form-label">Class</label>
                <input type="text" class="form-control" id="editclass" name="editclass">
            </div>
            <div class="mb-3">
                <label for="editsection" class="form-label">Section</label>
                <input type="text" class="form-control" id="editsection" name="editsection">
            </div>
            <div class="mb-3">
                <label for="editemail" class="form-label">Email</label>
                <input type="email" class="form-control" id="editemail">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <?php require '../partials/footer.php'; ?>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/all.min.js"></script>
</body>

</html>