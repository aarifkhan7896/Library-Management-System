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
    <?php require '../partials/header.php'; ?>
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
                </tr>
            </thead>
            <tbody>
                <?php
                    include '../partials/dbcon.php';
                    $aid = $_GET['id'];
                    $sql = "SELECT books.book_id, student.name, books.book_name, books.book_category, books.book_isbn, bookissue.issue_date, bookissue.return_date from bookissue JOIN books on bookissue.book_id = books.book_id JOIN student on student.student_id = bookissue.student_id WHERE student.student_id = '$aid'";
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