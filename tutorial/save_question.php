<!-- 
<?php
session_start();
session_destroy(); 
header('Location: admin_login.php');
exit();
?>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question = $_POST['question'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $option4 = $_POST['option4'];

    // Thực hiện chèn câu hỏi vào cơ sở dữ liệu
    $sql = "INSERT INTO questions (question, option1, option2, option3, option4) VALUES ('$question', '$option1', '$option2', '$option3', '$option4')";
    execute($sql);

    // Trả về kết quả để hiển thị
    echo "Câu hỏi: $question <br>Tuỳ chọn 1: $option1 <br>Tuỳ chọn 2: $option2";
}
?> -->
