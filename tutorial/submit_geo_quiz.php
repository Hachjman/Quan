<?php
session_start();
include("php/config.php");


if (!isset($_SESSION['valid'])) {
    header("Location: index1.php");
    exit;
}

$user_id = $_SESSION['id']; 
$question1_answer = $_POST['question1']; 
$question2_answer = $_POST['question2']; 
$time_taken = $_POST['timeTaken']; 


$query = "INSERT INTO geo_quiz_results (user_id, question1_answer, question2_answer, time_taken) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, 'isss', $user_id, $question1_answer, $question2_answer, $time_taken);
mysqli_stmt_execute($stmt);


if (mysqli_stmt_affected_rows($stmt) > 0) {
    echo "Kết quả đã được lưu thành công!";
} else {
    echo "Có lỗi xảy ra khi lưu kết quả.";
}


mysqli_stmt_close($stmt);
mysqli_close($con);
?>
