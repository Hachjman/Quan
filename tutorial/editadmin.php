<?php
require_once('php/dbhelp.php');

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $age = $_POST['age'];
    $cccd = $_POST['cccd'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "UPDATE users SET Username='$username', Age='$age', CCCD='$cccd', Password='$password' WHERE Id='$id'";
    $result = execute($sql);

    if (!$result) {
        echo "Lỗi: " . mysqli_error($conn); 
        exit();
    }

    header('Location: manage_students.php');
    exit();
}

$id = '';
$username = '';
$age = '';
$cccd = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE Id='$id'";
    $user = executeSingleResult($sql);
    if ($user != null) {
        $username = $user['Username'];
        $age = $user['Age'];
        $cccd = $user['CCCD'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style4.css">
    <title>Edit Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            margin-top: 50px;
            max-width: 600px;
        }
        .panel {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .panel-heading {
            background-color: #007bff;
            color: white;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-success {
            background-color: #28a745;
            border: none;
            border-radius: 5px;
        }
        .btn-success:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="panel panel-primary">
        <div class="panel-heading text-center">
            <h4>Chỉnh sửa thông tin Admin</h4>
        </div>
        <div class="panel-body">
            <form method="post">
                <div class="form-group">
                    <label for="username">Họ & Tên:</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= htmlspecialchars($username) ?>" required>
                </div>
                <div class="form-group">
                    <label for="age">Tuổi:</label>
                    <input type="number" class="form-control" id="age" name="age" value="<?= htmlspecialchars($age) ?>" required>
                </div>
                <div class="form-group">
                    <label for="cccd">CCCD:</label>
                    <input type="text" class="form-control" id="cccd" name="cccd" value="<?= htmlspecialchars($cccd) ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
                <button type="submit" class="btn btn-success btn-block" name="update">Cập nhật</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
