<!DOCTYPE html>
<html lang="en">
<head>   
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="style/style1.css">
    <link rel="stylesheet" href="style/style2.css">
</head>
<body>

<?php 
    session_start();
    include("php/config.php");
    if(!isset($_SESSION['valid'])){
        header("Location: index1.php");
    }
            
    $id = $_SESSION['id'];
    $query = mysqli_query($con,"SELECT * FROM users WHERE Id=$id");

    while($result = mysqli_fetch_assoc($query)){
        $res_Uname = $result['Username'];
    }
?>

<nav>
    <h1 class="logo">Xin Chào <?php echo $res_Uname ?></h1>
    <ul>
        <li><a href="history.php">Lịch sử</a></li>
        <li><a href="shooting start.html" target="_blank">ShopAccfree</a></li>
        <li><a href="https://www.youtube.com/@MrBeast" target="_blank">Blog</a></li>
        <li><a href="https://www.youtube.com/@minhquan3314" target="_blank">About Us</a></li>
        
        <li class="dropdown">
            <a href="#" class="dropbtn">Tài Khoản</a>
            <div class="dropdown-content">
                <a href="home.php">Hồ sơ</a>
                <a href="edit.php">Thay Đổi Hồ Sơ</a>
                <a href="index1.php">Đăng xuất</a>
            </div>
        </li>
    </ul>
</nav>

<div class="card-container">
    <div class="card">BẢNG CỬU CHƯƠNG
        <p>Thời gian làm bài: 60p</p>
        <div class="icon">
            <img src="Non_Item.png" alt="Graduation Cap Icon">
        </div>
        <div class="subject">
            <p><strong>Môn:</strong> TOÁN</p>
        </div>
        <a href="start_quiz.php" class="btn-start">Bắt Đầu</a> <!-- Đã thay đổi lớp -->
    </div>
    
    <div class="card">ĐỊA LÝ VIỆT NAM
    <p>Thời gian làm bài: 60p</p>
    <div class="icon">
        <img src="Non_Item.png" alt="Graduation Cap Icon">
    </div>
    <div class="subject">
        <p><strong>Môn:</strong> ĐỊA LÝ</p>
    </div>
    <a href="start_quiz_geo.php" class="btn-start">Bắt Đầu</a> <!-- Thay đổi nút -->
</div>

    
    <div class="card">NGƯỜI LÁI ĐÒ
        <p>Thời gian làm bài: 60p</p>
        <div class="icon">
            <img src="Non_Item.png" alt="Graduation Cap Icon">
        </div>
        <div class="subject">
            <p><strong>Môn:</strong> NGỮ VĂN</p>
        </div>
        <button>CHỌN</button>
    </div>
</div>

<script>
// Kiểm tra nếu người dùng click vào phần tài khoản
document.querySelector('.dropdown').addEventListener('click', function(event) {
    const dropdownContent = document.querySelector('.dropdown-content');
    dropdownContent.classList.toggle('show');
});

// Đóng menu khi click bên ngoài
window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        const dropdowns = document.getElementsByClassName("dropdown-content");
        for (let i = 0; i < dropdowns.length; i++) {
            const openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}
</script>
<style>

/* CSS cho phần menu thả xuống */
nav {
    display: flex;
    justify-content: space-between;
    background-color: #333;
    padding: 10px;
    animation: slideDown 1s ease-in-out;
}

nav h1.logo {
    color: white;
    transition: color 0.3s ease-in-out;
}

nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
}

nav ul li {
    margin-right: 20px;
}

nav ul li a {
    color: white;
    text-decoration: none;
    padding: 10px;
    background-color: #333;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

nav ul li a:hover, .dropbtn:hover {
    background-color: #555;
    transform: scale(1.1); /* Phóng to nhẹ khi hover */
    color: #f39c12;
}

/* Dropdown CSS */
.dropdown {
    position: relative;
    display: inline-block;
}

/* Thêm hiệu ứng chuyển đổi cho dropdown */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #2c3e50;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    border-radius: 5px;
    opacity: 0; /* Bắt đầu với độ mờ */
    transform: translateY(-10px); /* Đẩy nhẹ lên trên */
    transition: all 0.3s ease-in-out; /* Thêm chuyển đổi mượt */
}

/* Hiển thị dropdown với hiệu ứng */
.dropdown-content.show {
    display: block;
    opacity: 1;
    transform: translateY(0); /* Đưa trở lại vị trí gốc */
}

.dropdown-content a {
    color: #ecf0f1;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    font-size: 16px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.dropdown-content a:hover {
    background-color: #34495e;
    color: #f39c12;
}

/* Hiệu ứng cho card */
.card-container {
    display: flex;
    justify-content: space-around;
    margin-top: 20px;
}

.card {
    width: 30%;
    padding: 20px;
    background-color: #f4f4f4;
    border-radius: 10px;
    box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    animation: fadeIn 1s ease-out;
}

.card:hover {
    transform: translateY(-10px); /* Dịch chuyển lên trên khi hover */
    box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
}

.card img {
    width: 50px;
    height: 50px;
    margin-bottom: 10px;
}

/* Cải tiến cho nút "Bắt Đầu" */
.btn-start {
    display: inline-block;
    padding: 10px 20px;
    background-color: #28a745; /* Màu xanh lá cây */
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.btn-start:hover {
    background-color: #218838; /* Màu xanh đậm hơn khi hover */
    transform: scale(1.05); /* Phóng to nhẹ khi hover */
}

/* Animation cho việc slide down */
@keyframes slideDown {
    from {
        transform: translateY(-50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

/* Animation cho việc fade in */
@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}
</style>

</body>
</html>
