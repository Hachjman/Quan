<?php
session_start();
if (!isset($_SESSION['valid'])) {
    header("Location: index1.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bắt Đầu Quiz</title>
    <link rel="stylesheet" href="style/style1.css">
    <link rel="stylesheet" href="style/style2.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        body {
            background: radial-gradient(ellipse at bottom, #1b2735 0%, #090a0f 100%);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden;
            color: white; 
        }

        .container {
            position: relative;
            z-index: 10; 
            text-align: center;
        }

        h2 {
            animation: fadeIn 1s ease-in-out; 
        }

        p {
            animation: fadeIn 2s ease-in-out;
        }

        .btn {
            margin-top: 20px;
            transition: transform 0.2s;
        }

        .btn:hover {
            transform: scale(1.1);
        }

        .night {
            position: absolute;
            width: 100%;
            height: 100%;
            background: url('path_to_your_star_background_image.jpg') no-repeat center center fixed;
            background-size: cover;
            opacity: 0.7; 
            z-index: 1;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="night"></div> 
    <div class="container mt-5">
        <h2>Chào mừng đến với Quiz!</h2>
        <p>Nhấn nút bên dưới để bắt đầu làm bài quiz.</p>
        <a href="quiz.php" class="btn btn-primary">Bắt Đầu</a>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script>
        // Sound effect on button click
        const button = document.querySelector('.btn');
        button.addEventListener('click', function() {
            const audio = new Audio('path_to_your_sound_effect.mp3');
            audio.play();
        });
    </script>
</body>
</html>
