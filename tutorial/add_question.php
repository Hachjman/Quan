<?php
require_once('php/dbhelp.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question = $_POST['question'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];
    $correctOption = $_POST['correct_option'];

    if (empty($question) || empty($option1) || empty($option2) || empty($option3) || empty($option4) || empty($correctOption)) {
        echo json_encode(['success' => false, 'message' => 'Vui lòng điền đầy đủ thông tin.']);
        exit();
    }
    $sql = "INSERT INTO questions (question, option1, option2, option3, option4, correct_option) VALUES ('$question', '$option1', '$option2', '$option3', '$option4', '$correctOption')";
    if (execute($sql)) {
        echo json_encode(['success' => true, 'message' => 'Câu hỏi đã được thêm thành công!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi thêm câu hỏi.']);
    }
    exit();
}
?>
