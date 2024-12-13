<?php
require_once('php/dbhelp.php');

// Lấy danh sách thay đổi người dùng từ cơ sở dữ liệu
$sql = "SELECT uc.id, u.Username, uc.change_type, uc.old_value, uc.new_value, uc.change_time 
        FROM user_changes uc 
        JOIN users u ON uc.user_id = u.Id 
        ORDER BY uc.change_time DESC";

$changesList = executeResult($sql);

echo '<h2>Thông báo thay đổi của người dùng</h2>';
echo '<table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên người dùng</th>
                <th>Loại thay đổi</th>
                <th>Giá trị cũ</th>
                <th>Giá trị mới</th>
                <th>Thời gian thay đổi</th>
            </tr>
        </thead>
        <tbody>';

// Kiểm tra nếu có thay đổi
if (count($changesList) > 0) {
    foreach ($changesList as $change) {
        echo '<tr>
                <td>' . htmlspecialchars($change['id']) . '</td>
                <td>' . htmlspecialchars($change['Username']) . '</td>
                <td>' . htmlspecialchars($change['change_type']) . '</td>
                <td>' . htmlspecialchars($change['old_value']) . '</td>
                <td>' . htmlspecialchars($change['new_value']) . '</td>
                <td>' . htmlspecialchars($change['change_time']) . '</td>
            </tr>';
    }
} else {
    echo '<tr><td colspan="6">Không có thay đổi nào được ghi nhận.</td></tr>';
}

echo '  </tbody>
      </table>';
?>
