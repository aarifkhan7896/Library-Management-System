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
        <h1>Manage Books</h1>
    </div>
    <div class="container py-5" id="userstable">
        <table class="table display" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.No.</th>
                    <th scope="col">ID</th>
                    <th scope="col">Book Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Author</th>
                    <th scope="col">ISBN</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include '../partials/dbcon.php';
                    $sql = "SELECT * FROM `books`";
                    $result = mysqli_query($dbcon, $sql);
                    $sno = 0;
                    while($row = mysqli_fetch_assoc($result)){
                        $sno = $sno + 1;
                        $bookid = $row['book_id'];
                        $bookname = $row['book_name'];
                        $category = $row['book_category'];
                        $author = $row['book_author'];
                        $isbn = $row['book_isbn'];
                        $price = $row['book_price'];
                        $id = $row['id'];
                        echo "<tr>
                        <th scope='row'>".$sno."</th>
                        <td>".$bookid."</td>
                        <td>".$bookname."</td>
                        <td>".$category."</td>
                        <td>".$author."</td>
                        <td>".$isbn."</td>
                        <td>".$price."</td>
                        <td><a href='editbooks.php?id=".$id."' class='btn btn-primary'>Edit</a> 
                        <a href='deletebooks.php?id=".$id."' class='btn btn-danger'>Delete</a></td>
                </tr>";
                }
                ?>

            </tbody>
        </table>
    </div>

    <div class="container" id="addcategory">
        <abbr title="Add New Book"><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fas fa-plus"></i></a></abbr>
    </div>

    <?php
        if($_SERVER['REQUEST_METHOD']=="POST"){
            include '../partials/dbcon.php';
            $bookid = $_POST['book_id'];
            $bookname = $_POST['book_name'];
            $category = $_POST['book_category'];
            $author = $_POST['book_author'];
            $isbn = $_POST['book_isbn'];
            $price = $_POST['book_price'];

            $sql = "INSERT INTO `books` (`book_id`, `book_name`, `book_category`, `book_author`, `book_isbn`, `book_price`) VALUES ('$bookid', '$bookname', '$category', '$author', '$isbn', '$price')";
            $result = mysqli_query($dbcon, $sql);
        }
    ?>

    <!-- Add Category Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="managebooks.php" method="post">
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