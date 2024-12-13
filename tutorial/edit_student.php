<?php
require_once ('php/dbhelp.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE Id = $id";
    $student = executeSingleResult($sql);
}

if ($student == null) {
    echo "Không tìm thấy sinh viên!";
    exit;
}

if (!empty($_POST)) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $cccd = $_POST['cccd'];
    $age = $_POST['age'];
    $password = $_POST['password'];


    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET Username = '$username', Email = '$email', CCCD = '$cccd', Age = '$age', Password = '$hashedPassword' WHERE Id = $id";
    } else {
        $sql = "UPDATE users SET Username = '$username', Email = '$email', CCCD = '$cccd', Age = '$age' WHERE Id = $id";
    }
    execute($sql);
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sửa thông tin sinh viên</title>
</head>
<body>
    <h2>Sửa thông tin sinh viên</h2>
    <form method="POST">
        Họ & Tên: <input type="text" name="username" value="<?php echo $student['Username']; ?>" required><br>
        Email: <input type="email" name="email" value="<?php echo $student['Email']; ?>" required><br>
        CCCD: <input type="text" name="cccd" value="<?php echo $student['CCCD']; ?>" required><br>
        Tuổi: <input type="number" name="age" value="<?php echo $student['Age']; ?>" required><br>
        Mật khẩu mới (để trống nếu không muốn thay đổi): <input type="password" name="password"><br>
        Tải lên ảnh mã QR: <input type="file" name="qr_code" accept="image/png, image/jpeg" required><br>
        <button type="submit">Lưu</button>
    </form>
</body>
</html>

