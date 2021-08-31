<?php 
session_start();
if(!isset($_SESSION['loggedin']) && $_SESSION['loggedin']!=true){
header("location: index.php");
exit;
}
?>
<?php
include '../partials/dbcon.php';
$id = $_GET['book_id'];

$showquery = "SELECT * FROM `bookissue` WHERE `id` = $id";
$showdata = mysqli_query($dbcon, $showquery);
$arrdata = mysqli_fetch_array($showdata);

        if($_SERVER['REQUEST_METHOD']=="POST"){
            
            $bkid = $_GET['book_id'];
             
            $bookid = $_POST['bookid'];
            $bookname = $_POST['bookname'];
            $student = $_POST['studentid'];
            $category = $_POST['bookcategory'];
            $isbn = $_POST['bookisbn'];
            $return = $_POST['return'];

            $sql = "UPDATE `bookissue` SET `book_id` = $bookid, `student_id` = $student, `book_name` = '$bookname', 
            `book_category` = '$category', `book_isbn` = $isbn, `return_date` = '$return'
            WHERE `bookissue`.`id` = $bkid";
            $query = mysqli_query($dbcon, $sql);
            if($query){
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
        <form action="returnbook.php?book_id=<?php echo $id; ?>" method="post">
            <div class="mb-3">
                <label for="book_id" class="form-label">Book ID</label>
                <input type="text" class="form-control" id="book_id" name="bookid" value="<?php echo
                $arrdata['book_id']; ?>">
            </div>
            <div class=" mb-3">
                <label for="student_id" class="form-label">Student ID</label>
                <input type="text" class="form-control" id="student_id" name="studentid" value="<?php echo
                $arrdata['student_id']; ?>">
            </div>
            <div class="mb-3">
                <label for="book_name" class="form-label">Book Name</label>
                <input type="text" class="form-control" id="book_name" name="bookname" value="<?php echo
                $arrdata['book_name']; ?>">
            </div>
            <div class="mb-3">
                <label for="book_category" class="form-label">Book Category</label>
                <input type="text" class="form-control" id="book_category" name="bookcategory" value="<?php echo
                $arrdata['book_category']; ?>">
            </div>
            <div class="mb-3">
                <label for="book_isbn" class="form-label">Book ISBN</label>
                <input type="text" class="form-control" id="book_isbn" name="bookisbn" value="<?php echo
                $arrdata['book_isbn']; ?>">
            </div>
            <div class="mb-3">
                <label for="return" class="form-label">Return Date</label>
                <input type="text" class="form-control" id="return" name="return" value="<?php echo
                $arrdata['return_date']; ?>">
            </div>
            <button type="submit" name="submit" class="btn btn-primary formbtn">Submit</button>
        </form>
    </div>

    <?php require '../partials/footer.php'; ?>
    <script src=" ../assets/js/jquery.min.js"></script>
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