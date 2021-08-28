<?php
include '../partials/dbcon.php';
$id = $_GET['id'];
if($_SERVER['REQUEST_METHOD']=="POST"){
    
    $sid = $_POST['editstudentid'];
    $name = $_POST['editstudentname'];
    $class = $_POST['editstudentclass'];
    $section = $_POST['editstudentsection'];
    $email = $_POST['editstudentemail'];
   
    $sql = "UPDATE `student` SET `student_id` = '$sid', `name` = '$name', `class` = '$class', `section` = '$section', `email` = '$email' WHERE `student`.`id` = '$id'";
    $result = mysqli_query($dbcon, $sql);
    if($result){
        // mysqli_close($dbcon);
        // header("location: registeredusers.php");
        // exit();
    }else{
        echo "error->".mysqli_error($dbcon);
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
    <div id="admindashboard">
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="../index.php">Register Student</a></li>
            <li><a href="#" data-bs-toggle="modal" data-bs-target="#modal">Change Password</a></li>
        </ul>
    </div>
    <div id="admindash">
        <h1>Edit Student Details</h1>
    </div>
    <div class="container">
        <form action="edituser.php" method="post">
            <div class="mb-3">
                <label for="studentid" class="form-label">Student ID</label>
                <input type="text" class="form-control" id="studentid" name="editstudentid" required>
            </div>
            <div class="mb-3">
                <label for="studentname" class="form-label">Student Name</label>
                <input type="text" class="form-control" id="studentname" name="editstudentname" required>
            </div>
            <div class="mb-3">
                <label for="studentclass" class="form-label">Class</label>
                <input type="text" class="form-control" id="studentclass" name="editstudentclass" required>
            </div>
            <div class="mb-3">
                <label for="studentsection" class="form-label">Section</label>
                <input type="text" class="form-control" id="studentsection" name="editstudentsection" required>
            </div>
            <div class="mb-3">
                <label for="studentemail" class="form-label">Email address</label>
                <input type="email" class="form-control" id="studentemail" name="editstudentemail" required>
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <button type="submit" class="btn btn-primary formbtn">Submit</button>
        </form>
    </div>

    <?php require '../partials/footer.php'; ?>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/all.min.js"></script>
</body>

</html>