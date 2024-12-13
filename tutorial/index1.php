<?php
session_start();
include("php/config.php");

$error_message = "";
$success_message = "";

// Xử lý đăng nhập
if (isset($_POST['login_submit'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $result = mysqli_query($con, "SELECT * FROM users WHERE Email='$email'") or die("Select Error");
    $row = mysqli_fetch_assoc($result);
    if (is_array($row) && !empty($row)) {
        if (password_verify($password, $row['Password'])) {
            $_SESSION['valid'] = $row['Email'];
            $_SESSION['username'] = $row['Username'];
            $_SESSION['age'] = $row['Age'];
            $_SESSION['id'] = $row['Id'];
            header("Location: home.php");
            exit();
        } else {
            $error_message = "Email hoặc mật khẩu không đúng.";
        }
    } else {
        $error_message = "Email không tồn tại.";
    }
}

// Xử lý đăng ký
if (isset($_POST['register_submit'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $cccd = mysqli_real_escape_string($con, $_POST['cccd']);
    $age = mysqli_real_escape_string($con, $_POST['age']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($con, $_POST['confirmPassword']);
    
    // Kiểm tra email đã tồn tại
    $result = mysqli_query($con, "SELECT * FROM users WHERE Email='$email'") or die("Select Error");
    if (mysqli_num_rows($result) > 0) {
        $error_message = "Email đã tồn tại.";
    } elseif ($password !== $confirmPassword) {
        $error_message = "Bạn đã nhập sai vui lòng nhập lại.";
    } else {
        // Thêm người dùng mới vào database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $insertQuery = "INSERT INTO users (Username, Email, CCCD, Age, Password) VALUES ('$username', '$email', '$cccd', '$age', '$hashedPassword')";
        if (mysqli_query($con, $insertQuery)) {
            $success_message = "Tạo tài khoản thành công!";
        } else {
            $error_message = "Đã có lỗi xảy ra. Vui lòng thử lại.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>Đăng nhập và Đăng ký</title>
    <style>
        .error {
            color: red;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <svg class="login__blob" viewBox="0 0 566 840" xmlns="http://www.w3.org/2000/svg">
        <mask id="mask0" mask-type="alpha">
            <path d="M342.407 73.6315C388.53 56.4007 394.378 17.3643 391.538 0H566V840H0C14.5385 834.991 100.266 804.436 77.2046 707.263C49.6393 
            591.11 115.306 518.927 176.468 488.873C363.385 397.026 156.98 302.824 
            167.945 179.32C173.46 117.209 284.755 95.1699 342.407 73.6315Z"/>
        </mask>
        <g mask="url(#mask0)">
            <path d="M342.407 73.6315C388.53 56.4007 394.378 17.3643 391.538 
            0H566V840H0C14.5385 834.991 100.266 804.436 77.2046 707.263C49.6393 
            591.11 115.306 518.927 176.468 488.873C363.385 397.026 156.98 302.824 
            167.945 179.32C173.46 117.209 284.755 95.1699 342.407 73.6315Z"/>
            <image class="login__img" href="assets/img/bg-img.jpg"/>
        </g>
    </svg>

    <div class="login container grid" id="loginAccessRegister">
        <!-- Form đăng nhập -->
        <div class="login__access">
            <h1 class="login__title">Đăng nhập vào tài khoản của bạn.</h1>
            <div class="login__area">
                <form action="" method="post">
                    <?php if (!empty($error_message)) { ?>
                        <div class="error-message error"><?php echo $error_message; ?></div>
                    <?php } ?>
                    <div class="login__content grid">
                        <div class="login__box">
                            <input type="text" name="email" id="email" required placeholder=" " class="login__input">
                            <label for="email" class="login__label">Email</label>
                            <i class="ri-mail-fill login__icon"></i>
                        </div>
                        <div class="login__box">
                            <input type="password" name="password" id="password" required placeholder=" " class="login__input">
                            <label for="password" class="login__label">Mật khẩu</label>
                            <i class="ri-eye-off-fill login__icon login__password" id="loginPassword"></i>
                        </div>
                    </div>
                    <button type="submit" class="login__button" name="login_submit">Đăng nhập</button>
                </form>
                <p class="login__switch">
                    Chưa có tài khoản? 
                    <button id="loginButtonRegister">Tạo tài khoản</button>
                </p>
            </div>
        </div>

        <!-- Form đăng ký -->
        <div class="login__register">
            <h1 class="login__title">Tạo tài khoản mới.</h1>
            <div class="login__area">
                <form action="" method="post" class="login__form">
                    <?php if (!empty($error_message)) { ?>
                        <div class="error-message error"><?php echo $error_message; ?></div>
                    <?php } ?>
                    <?php if (!empty($success_message)) { ?>
                        <div class="success-message"><?php echo $success_message; ?></div>
                    <?php } ?>
                    <div class="login__content grid">
                        <div class="login__box">
                            <input type="text" name="username" id="username" required placeholder=" " class="login__input">
                            <label for="username" class="login__label">Họ và Tên</label>
                            <i class="ri-user-fill login__icon"></i>
                        </div>
                        <div class="login__box">
                            <input type="email" name="email" id="emailCreate" required placeholder=" " class="login__input">
                            <label for="emailCreate" class="login__label">Email</label>
                            <i class="ri-mail-fill login__icon"></i>
                        </div>
                        <div class="login__box">
                            <input type="text" name="cccd" id="cccd" required placeholder=" " class="login__input">
                            <label for="cccd" class="login__label">CCCD</label>
                            <i class="ri-id-card-fill login__icon"></i>
                        </div>
                        <div class="login__box">
                            <input type="number" name="age" id="age" required placeholder=" " class="login__input">
                            <label for="age" class="login__label">Tuổi</label>
                            <i class="ri-calendar-fill login__icon"></i>
                        </div>
                        <div class="login__box">
                            <input type="password" name="password" id="passwordCreate" required placeholder=" " class="login__input">
                            <label for="passwordCreate" class="login__label">Mật khẩu</label>
                            <i class="ri-eye-off-fill login__icon login__password" id="loginPasswordCreate"></i>
                        </div>
                        <div class="login__box">
                            <input type="password" name="confirmPassword" id="confirmPassword" required placeholder=" " class="login__input">
                            <label for="confirmPassword" class="login__label">Nhập lại mật khẩu</label
                            <label for="confirmPassword" class="login__label">Nhập lại mật khẩu</label>
                            <i class="ri-eye-off-fill login__icon login__password" id="loginPasswordConfirm"></i>
                        </div>
                    </div>
                    <button type="submit" class="login__button" name="register_submit">Tạo tài khoản</button>
                </form>
                <p class="login__switch">
                    Đã có tài khoản? 
                    <button id="loginButtonAccess">Đăng nhập</button>
                </p>
            </div>
        </div>
    </div>

    <script src="assets/js/main.js"></script>
    <script>
        function validateForm() {
            let password = document.getElementById("passwordCreate").value;
            let confirmPassword = document.getElementById("confirmPassword").value;
            let email = document.getElementById("emailCreate").value;
            let passwordError = document.getElementById("passwordError");
            let confirmPasswordError = document.getElementById("confirmPasswordError");
            let confirmEmail = document.getElementById("confirmEmail");

            passwordError.innerHTML = "";
            confirmPasswordError.innerHTML = "";
            confirmEmail.innerHTML = "";

            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                confirmEmail.innerHTML = "Địa chỉ email không hợp lệ.";
                return false;
            }

            if (password.length < 8) {
                passwordError.innerHTML = "Mật khẩu phải có ít nhất 8 ký tự.";
                return false;
            }
            if (!/[A-Z]/.test(password)) {
                passwordError.innerHTML = "Mật khẩu phải chứa ít nhất một chữ cái viết hoa.";
                return false;
            }
            if (!/[0-9]/.test(password)) {
                passwordError.innerHTML = "Mật khẩu phải chứa ít nhất một chữ số.";
                return false;
            }
            if (!/[!@#$%^&*]/.test(password)) {
                passwordError.innerHTML = "Mật khẩu phải chứa ít nhất một ký tự đặc biệt.";
                return false;
            }

            if (password !== confirmPassword) {
                confirmPasswordError.innerHTML = "Mật khẩu xác nhận không khớp.";
                return false;
            }

            return true;
        }

        // Gọi validateForm trước khi gửi form
        document.querySelector(".login__form").addEventListener("submit", function(event) {
            if (!validateForm()) {
                event.preventDefault(); // Ngăn gửi form nếu có lỗi
            }
        });
    </script>
</body>
</html>
