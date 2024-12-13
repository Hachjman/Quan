<?php
require_once('php/config.php');
session_start();

if (!isset($_SESSION['valid'])) {
    header("Location: admin_login/admin_login.php");
    exit();
}

// Get the list of pending requests from the quest table
$sql = "SELECT q.id, u.Username, u.Email, q.request_time, u.otp, q.appr, u.Req
        FROM quest q 
        JOIN users u ON q.user_id = u.Id 
        ORDER BY q.request_time DESC";

$requestsList = mysqli_query($con, $sql);

echo '<h2>Danh sách yêu cầu phê duyệt</h2>';

if (mysqli_num_rows($requestsList) > 0) {
    while ($request = mysqli_fetch_assoc($requestsList)) {
        $buttonText = $request['appr'] == 1 ? 'Đã phê duyệt' : 'Phê duyệt';
        $buttonClass = $request['appr'] == 1 ? 'btn-danger' : 'btn-success';
        $buttonDisabled = $request['appr'] == 1 ? 'disabled' : '';
        
        echo '<div class="card mb-3" id="request-' . htmlspecialchars($request['id']) . '">
                <div class="card-body">
                    <h5 class="card-title">Yêu cầu từ: ' . htmlspecialchars($request['Username']) . '</h5>
                    <p><strong>Mã yêu cầu:</strong> ' . htmlspecialchars($request['id']) . '</p>
                    <p><strong>Email:</strong> ' . htmlspecialchars($request['Email']) . '</p>
                    <p><strong>Thời gian yêu cầu:</strong> ' . htmlspecialchars($request['request_time']) . '</p>
                    <button onclick="approveRequest(' . htmlspecialchars($request['id']) . ')" 
                            class="btn ' . $buttonClass . '" 
                            id="approve-button-' . htmlspecialchars($request['id']) . '" 
                            ' . $buttonDisabled . '>' . $buttonText . '</button>
                </div>
              </div>';
    }
} else {
    echo '<div class="alert alert-info">Không có yêu cầu nào được ghi nhận.</div>';
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    function approveRequest(requestId) {
        const approveButton = document.getElementById('approve-button-' + requestId);

        // Immediately change button text, color, and disable it
        approveButton.textContent = 'Đã phê duyệt';
        approveButton.classList.remove('btn-success');
        approveButton.classList.add('btn-danger');
        approveButton.disabled = true;

        $.post('quest.php', { 
            'approve': true,
            'request_id': requestId 
        }, function(data) {
            const response = JSON.parse(data);
            if (response.status !== 'success') {
                alert(response.message);
                
                // If an error occurs, revert the button back to original state
                approveButton.textContent = 'Phê duyệt';
                approveButton.classList.remove('btn-danger');
                approveButton.classList.add('btn-success');
                approveButton.disabled = false;
            }
        }).fail(function() {
            alert('Có lỗi xảy ra. Vui lòng kiểm tra lại.');
            
            // Revert button if request fails
            approveButton.textContent = 'Phê duyệt';
            approveButton.classList.remove('btn-danger');
            approveButton.classList.add('btn-success');
            approveButton.disabled = false;
        });
    }
</script>

<?php
// Process approval request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['approve']) && isset($_POST['request_id'])) {
    $requestId = (int) $_POST['request_id'];

    // Get the user_id associated with this request
    $userQuery = "SELECT user_id FROM quest WHERE id = $requestId";
    $userResult = mysqli_query($con, $userQuery);
    $user = mysqli_fetch_assoc($userResult);
    $userId = $user['user_id'];

    // Set otp to NULL and Req to 0 for this user, and update appr to 1 for this request
    $updateSql = "UPDATE users SET otp = NULL, Req = 0 WHERE Id = $userId";
    mysqli_query($con, $updateSql);
    
    // Update appr to 1 for this request
    $approveSql = "UPDATE quest SET appr = 1 WHERE id = $requestId";
    if (mysqli_query($con, $approveSql)) {
        echo json_encode(['status' => 'success', 'message' => 'Yêu cầu đã được phê duyệt và cập nhật.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Có lỗi xảy ra khi cập nhật yêu cầu.']);
    }
    exit();
}
?>
