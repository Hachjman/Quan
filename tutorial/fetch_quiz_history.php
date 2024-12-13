<?php
require_once('php/dbhelp.php');

$sql = 'SELECT * FROM quiz_history'; 
$historyList = executeResult($sql);

if (count($historyList) > 0) {
    echo '<table class="table table-bordered">';
    echo '<thead>
            <tr>
                <th>STT</th>
                <th>Họ & Tên</th>
                <th>Thời gian</th>
                <th>Điểm số</th>
                <th>Câu trả lời</th>
            </tr>
          </thead>';
    echo '<tbody>';
    
    $index = 1;
    foreach ($historyList as $history) {
        echo '<tr>
                <td>' . ($index++) . '</td>
                <td>' . htmlspecialchars($history['Username']) . '</td>
                <td>' . htmlspecialchars($history['QuizDate']) . '</td>
                <td>' . htmlspecialchars($history['Score']) . '</td>
                <td>' . htmlspecialchars($history['Answers']) . '</td>
              </tr>';
    }
    
    echo '</tbody>';
    echo '</table>';
} else {
    echo 'Không có dữ liệu lịch sử thi.';
}
?>
