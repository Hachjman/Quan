<?php 
session_start();
include("php/config.php");

if(!isset($_SESSION['valid'])){
    header("Location: index1.php");
}

$successMessage = '';
$res_Uname = '';
$res_Email = '';
$res_Age = '';
$res_cccd = '';

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $cccd = $_POST['cccd'];
    $id = $_SESSION['id'];
    
    $query = mysqli_query($con, "SELECT * FROM users WHERE Id = $id");
    if ($query) {
        $result = mysqli_fetch_assoc($query);
        
        $oldUsername = $result['Username'];
        $oldEmail = $result['Email'];
        $oldAge = $result['Age'];
        $oldCccd = $result['CCCD'];

        $edit_query = mysqli_query($con, "UPDATE users SET Username='$username', Email='$email', Age='$age', CCCD='$cccd' WHERE Id = $id") or die("Error occurred");

        if ($edit_query) {
            if ($username !== $oldUsername) {
                mysqli_query($con, "INSERT INTO user_changes (user_id, change_type, old_value, new_value, change_time) VALUES ($id, 'username', '$oldUsername', '$username', NOW())");
            }
            if ($email !== $oldEmail) {
                mysqli_query($con, "INSERT INTO user_changes (user_id, change_type, old_value, new_value, change_time) VALUES ($id, 'email', '$oldEmail', '$email', NOW())");
            }
            if ($age != $oldAge) {
                mysqli_query($con, "INSERT INTO user_changes (user_id, change_type, old_value, new_value, change_time) VALUES ($id, 'age', '$oldAge', '$age', NOW())");
            }
            if ($cccd !== $oldCccd) {
                mysqli_query($con, "INSERT INTO user_changes (user_id, change_type, old_value, new_value, change_time) VALUES ($id, 'cccd', '$oldCccd', '$cccd', NOW())");
            }
            $successMessage = "Cập nhật thành công!";
        }
    }
} else {
    $id = $_SESSION['id'];
    $query = mysqli_query($con, "SELECT * FROM users WHERE Id = $id");

    if ($query) {
        while($result = mysqli_fetch_assoc($query)){
            $res_Uname = $result['Username'];
            $res_Email = $result['Email'];
            $res_Age = $result['Age'];
            $res_cccd = $result['CCCD'];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <form action="" method="post" enctype="multipart/form-data">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Thay đổi hồ sơ</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            transition: background-color 0.5s;
        }

        .nav {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            animation: slideDown 0.5s;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            animation: fadeIn 1s;
        }

        .right-links {
            display: flex;
            align-items: center;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Center vertically */
            padding: 20px;
        }

        .form-box {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            animation: zoomIn 0.5s;
            width: 100%;
            max-width: 500px; /* Set a max-width for form box */
        }

        header {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
            animation: fadeIn 0.5s;
        }

        .field {
            margin-bottom: 15px;
        }

        .field input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border-color 0.3s;
        }

        .field input:focus {
            border-color: #4CAF50; /* Change border color on focus */
        }

        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #45a049; /* Darker green on hover */
        }

        /* Keyframes for animations */
        @keyframes slideDown {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes zoomIn {
            from {
                transform: scale(0.95);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>
    <script>
        function complexEncodeFunction($data) {
            return base64_encode($data);
        }
        function redirectHome() {
            window.location.href = "home.php";
        }
    </script>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php" style="color: white; text-decoration: none;">HOME</a></p>
        </div>
        <div class="right-links">
            <a href="home.php" style="color: white;">Trở về</a>
            <a href="php/logout.php"> <button class="btn">Đăng xuất</button> </a>
        </div>
    </div>
    <div class="container">
        <div class="box form-box">
            <header>Thay đổi hồ sơ</header>
            <?php if (!empty($successMessage)) : ?>
                <p style="color: green; font-weight: bold; text-align: center;"><?php echo $successMessage; ?></p>
                <script>
                    setTimeout(redirectHome, 3000);
                </script>
            <?php endif; ?>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($res_Uname); ?>" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php echo htmlspecialchars($res_Email); ?>" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="age">Tuổi</label>
                    <input type="number" name="age" id="age" value="<?php echo htmlspecialchars($res_Age); ?>" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="cccd">CCCD</label>
                    <input type="text" name="cccd" id="cccd" value="<?php echo htmlspecialchars($res_cccd); ?>" autocomplete="off" required>
                </div>
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="CẬP NHẬT" required>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
