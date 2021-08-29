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
        <h1>Issued Books</h1>
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
                    $sql = "SELECT bookissue.id, books.book_id, student.name, books.book_name, books.book_category, books.book_isbn, bookissue.issue_date, bookissue.return_date from bookissue JOIN books on bookissue.book_id = books.book_id JOIN student on student.student_id = bookissue.student_id";
                    $result = mysqli_query($dbcon, $sql);
                    $sno = 0;
                    while($row = mysqli_fetch_assoc($result)){
                        $sno = $sno + 1;
                        $id = $row['id'];
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
                        <td><a href='returnbook.php?book_id=".$id."' class='btn btn-primary'>Edit</a></td>
                </tr>";
                }
                ?>

            </tbody>
        </table>
    </div>



    <div class="container" id="addcategory">
        <abbr title="Add New Book"><a href="addbook.php">
                <i class="fas fa-plus"></i></a></abbr>
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