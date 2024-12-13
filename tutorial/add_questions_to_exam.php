<?php
session_start();
if (!isset($_SESSION['valid'])) {
    header("Location: admin_login.php");
    exit();
}

require_once('php/dbhelp.php');

$exam_id = $_GET['exam_id'];
$questions = [];

if (isset($_POST['add_question'])) {
    $question_text = $_POST['question_text'];
    $correct_answer = $_POST['correct_answer'];
    $wrong_answer1 = $_POST['wrong_answer1'];
    $wrong_answer2 = $_POST['wrong_answer2'];
    $wrong_answer3 = $_POST['wrong_answer3'];
    $sql = "INSERT INTO questions (exam_id, question_text, correct_answer, wrong_answer1, wrong_answer2, wrong_answer3) 
            VALUES ('$exam_id', '$question_text', '$correct_answer', '$wrong_answer1', '$wrong_answer2', '$wrong_answer3')";
    execute($sql);

    echo "<script>alert('Câu hỏi đã được thêm thành công!');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style4.css">
    <title>Thêm Câu Hỏi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Thêm Câu Hỏi vào Bài Thi</h2>
    <form method="post">
        <div class="form-group">
            <label for="question_text">Câu Hỏi:</label>
            <input type="text" class="form-control" id="question_text" name="question_text" required>
        </div>
        <div class="form-group">
            <label for="correct_answer">Đáp Án Đúng:</label>
            <input type="text" class="form-control" id="correct_answer" name="correct_answer" required>
        </div>
        <div class="form-group">
            <label for="wrong_answer1">Đáp Án Sai 1:</label>
            <input type="text" class="form-control" id="wrong_answer1" name="wrong_answer1" required>
        </div>
        <div class="form-group">
            <label for="wrong_answer2">Đáp Án Sai 2:</label>
            <input type="text" class="form-control" id="wrong_answer2" name="wrong_answer2" required>
        </div>
        <div class="form-group">
            <label for="wrong_answer3">Đáp Án Sai 3:</label>
            <input type="text" class="form-control" id="wrong_answer3" name="wrong_answer3" required>
        </div>
        <button type="submit" class="btn btn-success" name="add_question">Thêm Câu Hỏi</button>
    </form>
</div>
</body>
</html>
