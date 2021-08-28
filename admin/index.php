<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
    include '../partials/dbcon.php';
    $adminusername = $_POST['adminusername'];
    $adminpassword = $_POST['adminpassword'];

    $sql = "SELECT * FROM `admin_login` WHERE `password` = '$adminpassword' ";
    $result = mysqli_query($dbcon, $sql);
    $num = mysqli_num_rows($result);
    if($num==1){
        while($row=mysqli_fetch_assoc($result)){
                $login = true;
                session_start();
                $_SESSION['loggedin']=true;
                $_SESSION['studentid'] = $studentid;
                header("location: dashboard.php");
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
    <div class="container" id="adminlogin">
        <h1 class="text-center pb-3">Admin Login</h1>
        <hr>
        <form action="index.php" method="post" class="pt-5">
            <div class="mb-3">
                <label for="adminusername" class="form-label">Username</label>
                <input type="text" class="form-control" id="adminusername" name="adminusername">
            </div>
            <div class="mb-3">
                <label for="adminpassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="adminpassword" name="adminpassword">
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