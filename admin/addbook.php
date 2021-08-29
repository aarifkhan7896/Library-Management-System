<?php
        if($_SERVER['REQUEST_METHOD']=="POST"){
            include '../partials/dbcon.php';
            $bookid = $_POST['book_id'];
            $bookname = $_POST['book_name'];
            $student = $_POST['student_id'];
            $category = $_POST['book_category'];
            $isbn = $_POST['book_isbn'];
            $return = $_POST['return'];

            $sql = "INSERT INTO `bookissue` (`book_id`, `student_id`, `book_name`, `book_category`, `book_isbn`, `return_date`) 
            VALUES ('$bookid', '$student', '$bookname', '$category', '$isbn', '$return')";
            $result = mysqli_query($dbcon, $sql);
            if($result){
                mysqli_close($dbcon);
                header("location: issuebooks.php");
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
        <h1>Issue Book</h1>
    </div>
    <div class="container">
        <form action="addbook.php" method="post">
            <div class="mb-3">
                <label for="book_id" class="form-label">Book ID</label>
                <input type="text" class="form-control" id="book_id" name="book_id" required>
            </div>
            <div class="mb-3">
                <label for="student_id" class="form-label">Student ID</label>
                <input type="text" class="form-control" id="student_id" name="student_id" required>
            </div>
            <div class="mb-3">
                <label for="book_name" class="form-label">Book Name</label>
                <input type="text" class="form-control" id="book_name" name="book_name" required>
            </div>
            <div class="mb-3">
                <label for="book_category" class="form-label">Book Category</label>
                <input type="text" class="form-control" id="book_category" name="book_category" required>
            </div>
            <div class="mb-3">
                <label for="book_isbn" class="form-label">Book ISBN</label>
                <input type="text" class="form-control" id="book_isbn" name="book_isbn" required>
            </div>
            <div class="mb-3">
                <label for="return" class="form-label">Return Date</label>
                <input type="text" class="form-control" id="return" name="return" required>
            </div>
            <button type="submit" class="btn btn-primary formbtn">Submit</button>
        </form>
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