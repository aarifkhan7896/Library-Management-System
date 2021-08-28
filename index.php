<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
    include 'partials/dbcon.php';
    $studentid = $_POST['studentid'];
    $studentname = $_POST['studentname'];
    $studentclass = $_POST['studentclass'];
    $studentsection = $_POST['studentsection'];
    $studentemail = $_POST['studentemail'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    $sql = "SELECT * FROM `student` WHERE student_id = '$studentid' ";
    $result = mysqli_query($dbcon, $sql);
    $num = mysqli_num_rows($result);
    if($num>0){
        $message = "Already registered.";
        echo '<script language="javascript">';
        echo 'alert("'.$message.'");';
        echo '</script>';
    }
    else{
        if($password == $confirmpassword){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `student` (`student_id`, `name`, `class`, `section`, `email`, `password`) VALUES ('$studentid', '$studentname', '$studentclass', '$studentsection', '$studentemail', '$hash')";
            $result = mysqli_query($dbcon, $sql);
            if($result){
                $message = "Your account has been created successfully.";
                echo '<script language="javascript">';
                echo 'alert("'.$message.'");';
                echo '</script>';
            }
        } 
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
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <?php require 'partials/header.php'; ?>

    <div class="container" id="loginbtn">
        <ul>
            <li><a href="admin/index.php" class="btn btn-primary">Admin Login</a></li>
            <li><a href="student/studentlogin.php" class="btn btn-success">Student
                    Login</a></li>
        </ul>
    </div>
    <div class="container" id="registrationform">
        <div class="row">
            <div class="col-sm-7" id="col7">
                <h1>Student Registration</h1>
                <p>
                    <strong>
                        Instructions : <br />

                        This form is applicable only for Students. <br />
                        All columns are mandatory.
                    </strong>
                </p>
                <p>
                    Characteristics of strong passwords:- <br />
                    1. At least 8 characters—the more characters, the better.<br />
                    2. A mixture of both uppercase and lowercase letters.<br />
                    3. A mixture of letters and numbers.<br />
                    4. Inclusion of at least one special character, e.g., ! @ # ? ] Note: do not use < or> in your
                        &nbsp;&nbsp;&nbsp;password, as both can cause problems in Web browsers.
                </p>
            </div>
            <div class="col-sm-5" id="col5">
                <form action="index.php" method="post">
                    <h1 style="border-bottom: 1px solid lavender; color:#39a7a7; text-align:center; margin: 1.5rem 0;">
                        Create an account
                    </h1>
                    <div class="mb-3">
                        <label for="studentid" class="form-label">Student ID</label>
                        <input type="text" class="form-control" id="studentid" name="studentid" required>
                    </div>
                    <div class="mb-3">
                        <label for="studentname" class="form-label">Student Name</label>
                        <input type="text" class="form-control" id="studentname" name="studentname" required>
                    </div>
                    <div class="mb-3">
                        <label for="studentclass" class="form-label">Class</label>
                        <input type="text" class="form-control" id="studentclass" name="studentclass" required>
                    </div>
                    <div class="mb-3">
                        <label for="studentsection" class="form-label">Section</label>
                        <input type="text" class="form-control" id="studentsection" name="studentsection" required>
                    </div>
                    <div class="mb-3">
                        <label for="studentemail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="studentemail" name="studentemail" required>
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmpassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmpassword" name="confirmpassword"
                            required>
                    </div>
                    <button type="submit" class="btn btn-primary formbtn">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <?php require 'partials/footer.php'; ?>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/all.min.js"></script>
</body>

</html>