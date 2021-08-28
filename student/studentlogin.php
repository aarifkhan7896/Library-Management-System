<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
    include '../partials/dbcon.php';
    $studentid = $_POST['studentid'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `student` WHERE student_id = '$studentid'";
    $result = mysqli_query($dbcon, $sql);
    $num = mysqli_num_rows($result);
    if($num==1){
        while($row=mysqli_fetch_assoc($result)){
            if(password_verify($password, $row['password'])){
                $login = true;
                session_start();
                $_SESSION['loggedin']=true;
                $_SESSION['studentid'] = $studentid;
                header("location: studentdashboard.php");
            }else{
                echo "invalid credentials";
            }
        }
    }else{
        echo "invalid credentials";
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

    <div class="container" id="studentlogin">
        <h1>Student Login</h1>
        <form action="studentlogin.php" method="post" id="studentloginform">
            <div class="mb-3">
                <label for="studentid" class="form-label">Student ID</label>
                <input type="text" class="form-control" id="studentid" name="studentid">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <?php
                include '../partials/dbcon.php';

                $sql = "SELECT * FROM `student`";
                $result = mysqli_query($dbcon, $sql);
                while($row = mysqli_fetch_assoc($result)){
                    $id = $row['student_id'];
                    echo "<a href='studentdashboard.php?id=".$id."' class='btn btn-primary formbtn'>Submit</a>";
                }
                
            ?>
        </form>
    </div>

    <?php require '../partials/footer.php'; ?>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/all.min.js"></script>
</body>

</html>