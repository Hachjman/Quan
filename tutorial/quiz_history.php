<?php 
session_start();
include("php/config.php"); 

if (!isset($_SESSION['valid'])) {
    header("Location: index1.php");
    exit();
}

$query = "SELECT qh.id, qh.user_id, qh.subject, qh.score, qh.date_taken, u.Username 
          FROM quiz_history qh 
          JOIN users u ON qh.user_id = u.Id 
          ORDER BY qh.date_taken DESC";
$result = mysqli_query($con, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style4.css">
    <title>Lịch Sử Thi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <h2>Lịch Sử Thi</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Tên Người Dùng</th>
                <th>Đề Thi</th>
                <th>Điểm</th>
                <th>Ngày Làm Bài</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['user_id']}</td>
                            <td>{$row['Username']}</td>
                            <td>{$row['subject']}</td>
                            <td>{$row['score']}</td>
                            <td>{$row['date_taken']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center'>Không có lịch sử thi nào</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
