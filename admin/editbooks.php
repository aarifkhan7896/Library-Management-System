<?php
include '../partials/dbcon.php';
$id = $_GET['id'];
if($_SERVER['REQUEST_METHOD']=="POST"){

    $bookid = $_POST['book_id'];
    $bookname = $_POST['book_name'];
    $category = $_POST['book_category'];
    $author = $_POST['book_author'];
    $isbn = $_POST['book_isbn'];
    $price = $_POST['book_price'];
   
    $sql = "UPDATE `books` SET `book_id` = '$bookid', `book_name` = '$bookname', `book_category` = '$category', 
    `book_author` = '$author', `book_isbn` = '$isbn', `book_price` = '$price' WHERE `books`.`id` = '$id'";
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
        <h1>Edit Book Details</h1>
    </div>
    <div class="container">
        <form action="editbooks.php" method="post">
            <div class="mb-3">
                <label for="book_id" class="form-label">Book ID</label>
                <input type="text" class="form-control" id="book_id" name="book_id" required>
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
                <label for="book_author" class="form-label">Book Author</label>
                <input type="text" class="form-control" id="book_author" name="book_author" required>
            </div>
            <div class="mb-3">
                <label for="book_isbn" class="form-label">Book ISBN</label>
                <input type="text" class="form-control" id="book_isbn" name="book_isbn" required>
            </div>
            <div class="mb-3">
                <label for="book_price" class="form-label">Book Price</label>
                <input type="text" class="form-control" id="book_price" name="book_price" required>
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