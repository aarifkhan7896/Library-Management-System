<?php include '../partials/dbcon.php'; ?>

<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
    $newpassword = $_POST['newpassword'];
    $confirmpassword = $_POST['confirmpassword'];

    if($newpassword==$confirmpassword){
        $hash = password_hash($newpassword, PASSWORD_DEFAULT);
        $sql = "UPDATE `student` SET `password` = '$hash' WHERE `student`.`id` = 2";
        $result = mysqli_query($dbcon, $sql);
        if($result){
            echo "yes";
        }else{
            echo "error->".mysqli_error($dbcon);
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
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
</head>

<body>
    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="studentdashboard.php" method="post">
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="password" name="newpassword">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password" name="confirmpassword">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php require '../partials/header.php'; ?>
    <div class="container" id="studentdashboard">
        <div class="left">
            <h1>Student Dashboard</h1>
        </div>
        <div id="studentpanel">
            <ul>
                <?php
                $sql = "SELECT * FROM `student`";
                $result = mysqli_query($dbcon, $sql);
                while($row = mysqli_fetch_assoc($result)){

                    $id = $row['student_id'];
                }
                echo "<li><a href='editprofile.php?id=".$id."'>Edit Profile</a></li>
                <li><a href='viewissuedbooks.php?id=".$id."'>View issued books</a></li>
                <li><a href='#' data-bs-toggle='modal' data-bs-target='#modal'>Change Password</a>
                </li>";

                ?>
            </ul>
        </div>
    </div>

    <div class="container py-5" id="userdetails">
        <table class="table display" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.No.</th>
                    <th scope="col">Student ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Class</th>
                    <th scope="col">Section</th>
                    <th scope="col">Email</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM `student` WHERE student_id = '$id' ";
                    $result = mysqli_query($dbcon, $sql);
                    $sno = 0;
                    while($row=mysqli_fetch_assoc($result)){
                        $sno = $sno + 1;
                        $studentid = $row['student_id'];
                        $name = $row['name'];
                        $class = $row['class'];
                        $section = $row['section'];
                        $email = $row['email'];
                        echo "<tr>
                        <th scope='row'>".$sno."</th>
                        <td>".$studentid."</td>
                        <td>".$name."</td>
                        <td>".$class."</td>
                        <td>".$section."</td>
                        <td>".$email."</td>
                </tr>";
                }
                ?>

            </tbody>
        </table>
    </div>
    <a href="logout.php">logout</a>
    <?php require '../partials/footer.php'; ?>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/all.min.js"></script>
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
    $(document).ready(function() {
        responsive: true
        $('#myTable').DataTable();
    });
    </script>
</body>

</html>