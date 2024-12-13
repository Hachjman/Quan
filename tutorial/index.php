<?php
session_start();
if (!isset($_SESSION['valid'])) {
    header("Location: admin_login/admin_login.php"); // Chỉnh sửa đường dẫn
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style4.css">
    <title>Quản lý Sinh viên</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <style>
        .carousel-item img {
            max-height: 500px;
            object-fit: cover; 
            filter: brightness(1) contrast(1.1); 
        }
    </style>
</head>
<body>

<div class="sidenav">
    <div class="title">ADMIN</div>
    <a href="javascript:void(0)" onclick="loadHome()">Trang chủ</a>
    <a href="javascript:void(0)" onclick="loadStudentManagement()">Quản lý sinh viên</a>
    <a href="javascript:void(0)" onclick="loadExam()">Bài Thi</a> 
    <a href="javascript:void(0)" onclick="loadManageQuestions()">Bộ câu hỏi</a>
    <a href="javascript:void(0)" onclick="loadQuizHistory()">Lịch sử thi</a>
    <a href="javascript:void(0)" onclick="loadUserChanges()">Lịch sử thay đổi</a>
    <a href="javascript:void(0)" onclick="approveRequest()">Cấp phép yêu cầu</a>
    <a href="javascript:void(0)" onclick="window.location.href='admin_login/admin_login.php'">Đăng xuất</a> 
</div>

<div class="main" id="main-content">
    <h2>Quản lý Thí sinh</h2>
    <p>Nhấn vào "Quản lý sinh viên" để xem danh sách.</p>
</div>

<div id="loading-spinner" style="display: none;">
    <div class="spinner-border text-primary"></div> 
</div>

<script type="text/javascript">
    $(document).ready(function() {
        loadHome(); 
    });

    function showSpinner() {
        $('#loading-spinner').show();
    }

    function hideSpinner() {
        $('#loading-spinner').hide();
    }

    function loadHome() {
    showSpinner();
    $('#main-content').fadeOut(300, function() {
        $(this).html(`
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="img/hocnua.jpg" alt="Slide 1">
                        <div class="carousel-caption d-none d-md-block">
                            
                            
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="img/hocmai.jpg" alt="Slide 2">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Quản lý sinh viên dễ dàng</h5>
                           
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <h2>Quản lý Thí sinh</h2>
            <p>Nhấn vào "Quản lý sinh viên" để xem danh sách.</p>
        `).fadeIn(300);

        // Khởi động lại carousel với tùy chọn interval là 3000ms
        $('.carousel').carousel({
            interval: 3000
        });

        hideSpinner();
    });
}
    function loadStudentManagement() {
        showSpinner();
        $('#main-content').fadeOut(300, function() {
            $.get('manage_students.php', function(data) {
                $('#main-content').html(data).fadeIn(300);
                hideSpinner();
            });
        });
    }

    function loadAddQuestion() {
        showSpinner();
        $('#main-content').fadeOut(300, function() {
            $.get('add_question.php', function(data) {
                $('#main-content').html(data).fadeIn(300);
                hideSpinner();
            });
        });
    }

    function loadManageQuestions() {
        showSpinner();
        $('#main-content').fadeOut(300, function() {
            $.get('manage_questions.php', function(data) {
                $('#main-content').html(data).fadeIn(300);
                hideSpinner();
            });
        });
    }

    function editQuestion(id) {
        showSpinner();
        $('#main-content').fadeOut(300, function() {
            $.get('edit_question.php', { id: id }, function(data) {
                $('#main-content').html(data).fadeIn(300);
                hideSpinner();
            });
        });
    }

    function loadQuizHistory() {
        showSpinner();
        $('#main-content').fadeOut(300, function() {
            $.get('quiz_history.php', function(data) {
                $('#main-content').html(data).fadeIn(300);
                hideSpinner();
            });
        });
    }

    function loadUserChanges() {
        showSpinner();
        $('#main-content').fadeOut(300, function() {
            $.get('user_changes.php', function(data) {
                $('#main-content').html(data).fadeIn(300);
                hideSpinner();
            });
        });
    }

    function loadExam() {
        console.log("Hàm loadExam được gọi");
        showSpinner();
        $('#main-content').fadeOut(300, function() {
            $.get('exam.php', function(data) {
                $('#main-content').html(data).fadeIn(300);
                hideSpinner();
            });
        });
    }

    function approveRequest(userId) {
        showSpinner();
        $('#main-content').fadeOut(300, function() {
            $.get('quest.php', function(data) {
                $('#main-content').html(data).fadeIn(300);
                hideSpinner();
            });
        });
    }

    function deleteStudent(Id) {
    const option = confirm('Bạn có muốn xoá sinh viên này không?');
    if (!option) {
        return;
    }

    showSpinner();
    $('#main-content').fadeOut(300, function() {
        $.get('ques.php', function(data) {
            $('#main-content').html(data).fadeIn(300);
            hideSpinner();
        });
    });

    $.post('delete_student.php', {
        'Id': Id
    }, function(data) {
        if (data === 'success') {
            alert('Xóa thành công!');
            location.reload();  
        } else if (data === 'invalid_id') {
            alert('Id không hợp lệ.');
        } else {
            alert('Xóa thất bại. Vui lòng thử lại.');
        }
    }).fail(function() {
        alert('Có lỗi xảy ra. Vui lòng kiểm tra lại.');
    });
}
</script>

</body>
</html>
