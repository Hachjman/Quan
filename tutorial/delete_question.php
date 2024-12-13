<?php
require_once('php/dbhelp.php');

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM questions WHERE id = $id";
    if (execute($sql)) {
        echo json_encode(['success' => true, 'message' => 'Câu hỏi đã được xóa thành công!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi xóa câu hỏi.']);
    }
    exit();
}
?>
