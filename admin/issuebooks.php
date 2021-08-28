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
        <h1>Issue Books</h1>
    </div>
    <div class="container py-5" id="userstable">
        <table class="table display" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.No.</th>
                    <th scope="col">Book ID</th>
                    <th scope="col">Student Name</th>
                    <th scope="col">Book Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">ISBN</th>
                    <th scope="col">Issue Date</th>
                    <th scope="col">Return Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include '../partials/dbcon.php';
                    $sql = "SELECT books.book_id, student.name, books.book_name, books.book_category, books.book_isbn, bookissue.issue_date, bookissue.return_date from bookissue JOIN books on bookissue.book_id = books.book_id JOIN student on student.student_id = bookissue.student_id";
                    $result = mysqli_query($dbcon, $sql);
                    $sno = 0;
                    while($row = mysqli_fetch_assoc($result)){
                        $sno = $sno + 1;
                        $bookid = $row['book_id'];
                        $studentname = $row['name'];
                        $bookname = $row['book_name'];
                        $category = $row['book_category'];
                        $isbn = $row['book_isbn'];
                        $issuedate = $row['issue_date'];
                        $returndate = $row['return_date'];
                        echo "<tr>
                        <th scope='row'>".$sno."</th>
                        <td>".$bookid."</td>
                        <td>".$studentname."</td>
                        <td>".$bookname."</td>
                        <td>".$category."</td>
                        <td>".$isbn."</td>
                        <td>".$issuedate."</td>
                        <td>".$returndate."</td>
                        <td><a href='issuebooks.php?id=".$bookid."' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#editdate'>Edit</a></td>
                </tr>";
                }
                ?>

            </tbody>
        </table>
    </div>

    <?php
    if($_SERVER['REQUEST_METHOD']=="POST"){
        $returnedbook = $_POST['date'];
        
        $sql2 = "UPDATE `bookissue` SET `return_date` = '$returnedbook' WHERE `bookissue`.`book_id` = '$bookid'";
        $result2 = mysqli_query($dbcon, $sql2);
        if($result2){
            echo "updated ";
        }else{
            echo "error to update";
        }
    }
    ?>


    <!-- Edit Modal -->
    <div class="modal fade" id="editdate" tabindex="-1" aria-labelledby="datelabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="datelabel">Update Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="issuebooks.php" method="post">
                        <div class="mb-3">
                            <label for="date" class="form-label">Return Date</label>
                            <input type="text" class="form-control" id="date" name="date">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div class="container" id="addcategory">
        <abbr title="Add New Book"><a href="#" data-bs-toggle="modal" data-bs-target="#addmodal">
                <i class="fas fa-plus"></i></a></abbr>
    </div>

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

    <!-- Add Category Modal -->
    <div class="modal fade" id="addmodal" tabindex="-1" aria-labelledby="addmodalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addmodalLabel">Issue Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="issuebooks.php" method="post">
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
            </div>
        </div>
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