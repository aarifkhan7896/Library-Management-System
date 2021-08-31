<?php 
session_start();
if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin']!=true){
header("location: index.php");
exit;
}
?>
<?php
    $update = false;
        if($_SERVER['REQUEST_METHOD']=="POST"){
            include '../partials/dbcon.php';
            $adminpassword = $_POST['adminpassword'];
            $adminconfirmpassword = $_POST['adminconfirmpassword'];
            
            if($adminpassword==$adminconfirmpassword){
                $sql = "UPDATE `admin_login` SET `password` = '$adminpassword' WHERE `admin_login`.`sno` = 1";
            $result = mysqli_query($dbcon, $sql);
            if($result){
                $update = true;
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
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div id="admindash">
        <h1>Admin Dashboard</h1>
    </div>
    <?php
    if($update){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your Password has been changed.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div> ';
    }
    ?>
    <div class="container" id="admincard">
        <div class="card bg-info">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-book fa-4x"></i></h5>
                <p class="card-text"><a href="managebooks.php">Books</a></p>
            </div>
        </div>
        <div class="card bg-warning">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-user fa-4x"></i></h5>
                <p class="card-text"><a href="registeredusers.php">Registered Users</a></p>
            </div>
        </div>
        <div class="card bg-success">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-book-open fa-4x"></i></h5>
                <p class="card-text"><a href="issuebooks.php">Issue Books</a></p>
            </div>
        </div>
    </div>


    <!-- Change Password Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="dashboard.php" method="post">
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="password" name="adminpassword">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirmpassword"
                                name="adminconfirmpassword">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php require '../partials/footer.php'; ?>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/all.min.js"></script>
</body>

</html>