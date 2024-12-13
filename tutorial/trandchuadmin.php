<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style4.css">
    <title>Trang Chủ Quản Lý Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="sidenav">
    <div class="title">ADMIN</div>
    <a href="trangchuadmin.php">Trang chủ</a> 
    <a href="javascript:void(0)" onclick="loadStudentManagement()">Quản lý sinh viên</a>
    <a href="#exam">Bài Thi</a>
    <a href="javascript:void(0)" onclick="loadAddQuestion()">Thêm câu hỏi</a>
    <a href="javascript:void(0)" onclick="loadManageQuestions()">Bộ câu hỏi</a>
    <a href="javascript:void(0)" onclick="loadQuizHistory()">Lịch sử thi</a>
    <a href="javascript:void(0)" onclick="loadUserChanges()">Lịch sử thay đổi</a>
    <a href="admin_login.php">Đăng xuất</a>
</div>

<div class="main" id="main-content">
    <h2>Chào mừng đến với Quản Lý Admin</h2>
    <p>Dưới đây là các hướng dẫn để bạn thực hiện các thao tác:</p>
    <ul>
        <li><strong>Quản lý sinh viên:</strong> Nhấn vào "Quản lý sinh viên" để xem danh sách sinh viên hiện tại.</li>
        <li><strong>Thêm câu hỏi:</strong> Nhấn vào "Thêm câu hỏi" để thêm các câu hỏi mới vào hệ thống.</li>
        <li><strong>Bộ câu hỏi:</strong> Nhấn vào "Bộ câu hỏi" để xem và quản lý các câu hỏi đã được thêm.</li>
        <li><strong>Lịch sử thi:</strong> Nhấn vào "Lịch sử thi" để xem kết quả các bài thi đã thực hiện.</li>
        <li><strong>Lịch sử thay đổi:</strong> Nhấn vào "Lịch sử thay đổi" để theo dõi các thay đổi được thực hiện trong hệ thống.</li>
    </ul>
    <p>Vui lòng chọn một trong các tùy chọn ở phía bên trái để bắt đầu thao tác!</p>
</div>

</body>
</html>
