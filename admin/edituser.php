<?php 
session_start();
if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin']!=true){
header("location: index.php");
exit;
}
?>
<?php
include '../partials/dbcon.php';
$id = $_GET['id'];
$showquery = "SELECT * FROM `student` WHERE `id` = $id";

$showdata = mysqli_query($dbcon, $showquery);
$arrdata = mysqli_fetch_array($showdata);

if($_SERVER['REQUEST_METHOD']=="POST"){
    $idu = $_GET['id'];
    $sid = $_POST['editstudentid'];
    $name = $_POST['editstudentname'];
    $class = $_POST['editstudentclass'];
    $section = $_POST['editstudentsection'];
    $email = $_POST['editstudentemail'];
   
    $sql = "UPDATE `student` SET `student_id` = '$sid', `name` = '$name', `class` = '$class', `section` = '$section', `email` = '$email' WHERE `student`.`id` = $idu";
    $result = mysqli_query($dbcon, $sql);
    if($result){
        mysqli_close($dbcon);
        header("location: registeredusers.php");
        exit();
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
        <form action="edituser.php?id=<?php echo $id;?>" method="post">
            <div class="mb-3">
                <label for="studentid" class="form-label">Student ID</label>
                <input type="text" class="form-control" id="studentid" name="editstudentid" value="<?php echo
                $arrdata['student_id']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="studentname" class="form-label">Student Name</label>
                <input type="text" class="form-control" id="studentname" name="editstudentname" value="<?php echo
                $arrdata['name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="studentclass" class="form-label">Class</label>
                <input type="text" class="form-control" id="studentclass" name="editstudentclass" value="<?php echo
                $arrdata['class']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="studentsection" class="form-label">Section</label>
                <input type="text" class="form-control" id="studentsection" name="editstudentsection" value="<?php echo
                $arrdata['section']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="studentemail" class="form-label">Email address</label>
                <input type="email" class="form-control" id="studentemail" name="editstudentemail" value="<?php echo
                $arrdata['email']; ?>" required>
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