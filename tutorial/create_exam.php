<?php
session_start();
if (!isset($_SESSION['valid'])) {
    header("Location: admin_login.php");
    exit();
}

if (isset($_POST['create_exam'])) {
    $subject = $_POST['subject'];
    $num_questions = $_POST['num_questions'];

    require_once('php/dbhelp.php');

    $stmt = $conn->prepare("INSERT INTO test_papers (course_name, total_questions) VALUES (?, ?)");
    $stmt->bind_param("si", $subject, $num_questions);

    if ($stmt->execute()) {
        $exam_id = $stmt->insert_id;

        header("Location: add_questions_to_exam.php?exam_id=$exam_id");
        exit();
    } else {
        echo "Có lỗi xảy ra khi tạo bài thi: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style4.css">
    <title>Tạo Bài Thi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Tạo Bài Thi Mới</h2>
    <form method="post">
        <div class="form-group">
            <label for="subject">Tên Môn:</label>
            <input type="text" class="form-control" id="subject" name="subject" required>
        </div>
        <div class="form-group">
            <label for="num_questions">Số Lượng Câu Hỏi:</label>
            <input type="number" class="form-control" id="num_questions" name="num_questions" required>
        </div>
        <button type="submit" class="btn btn-success" name="create_exam">Tạo Bài Thi</button>
    </form>
</div>
</body>
</html>
