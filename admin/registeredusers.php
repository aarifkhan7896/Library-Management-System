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
    <div id="admindashboard">
        <ul>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="../index.php">Register Student</a></li>
            <li><a href="#" data-bs-toggle="modal" data-bs-target="#modal">Change Password</a></li>
        </ul>
    </div>
    <div id="admindash">
        <h1>Registered Students</h1>
    </div>
    <div class="container py-5" id="userstable">
        <table class="table display" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S. No.</th>
                    <th scope="col">Student ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Class</th>
                    <th scope="col">Section</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include '../partials/dbcon.php';
                    $sql = "SELECT * FROM `student`";
                    $result = mysqli_query($dbcon, $sql);
                    $sno = 0;
                    while($row = mysqli_fetch_assoc($result)){
                        $sno = $sno + 1;
                        $studentid = $row['student_id'];
                        $name = $row['name'];
                        $class = $row['class'];
                        $section = $row['section'];
                        $email = $row['email'];
                        $id = $row['id'];
                        echo "<tr>
                        <th scope='row'>".$sno."</th>
                        <td>".$studentid."</td>
                        <td>".$name."</td>
                        <td>".$class."</td>
                        <td>".$section."</td>
                        <td>".$email."</td>
                        <td><a href='edituser.php?id=".$id."' class='btn btn-primary'>Edit</a> 
                        <a href='deleteuser.php?id=".$id."' class='btn btn-danger'>Delete</a></td>
                </tr>";
                }
                ?>

            </tbody>
        </table>
    </div>
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