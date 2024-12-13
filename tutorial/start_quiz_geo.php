<?php
session_start();
include("php/config.php");

if (!isset($_SESSION['valid'])) {
    header("Location: index1.php");
    exit;
}


$time_limit = 60; 
$_SESSION['time_taken'] = $time_limit * 60; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài Kiểm Tra Địa Lý</title>
    <link rel="stylesheet" href="style/style1.css">
    <link rel="stylesheet" href="style/style2.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #2980b9;
            margin-bottom: 20px;
        }

        form {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }

        div {
            margin-bottom: 15px;
        }

        p {
            font-weight: bold;
        }

        label {
            display: block;
            margin: 10px 0;
        }

        button {
            background-color: #2980b9;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        button:hover {
            background-color: #1a6a9c;
        }

        /* Thời gian đếm ngược */
        .timer {
            font-size: 20px;
            text-align: center;
            margin-bottom: 20px;
            color: #e74c3c;
        }
    </style>
</head>
<body>
    <h1>Bài Kiểm Tra Trắc Nghiệm Địa Lý</h1>
    <div class="timer" id="timer"></div>
    <form action="submit_geo_quiz.php" method="POST" id="quizForm">
        <div>
            <p>Câu hỏi 1: Thủ đô của Việt Nam là gì?</p>
            <label>
                <input type="radio" name="question1" value="Hà Nội" required> Hà Nội
            </label>
            <label>
                <input type="radio" name="question1" value="TP. Hồ Chí Minh"> TP. Hồ Chí Minh
            </label>
            <label>
                <input type="radio" name="question1" value="Đà Nẵng"> Đà Nẵng
            </label>
            <label>
                <input type="radio" name="question1" value="Hải Phòng"> Hải Phòng
            </label>
        </div>
        
        <div>
            <p>Câu hỏi 2: Biển nào là biển lớn nhất Việt Nam?</p>
            <label>
                <input type="radio" name="question2" value="Biển Đông" required> Biển Đông
            </label>
            <label>
                <input type="radio" name="question2" value="Biển Tây"> Biển Tây
            </label>
            <label>
                <input type="radio" name="question2" value="Biển Bắc"> Biển Bắc
            </label>
            <label>
                <input type="radio" name="question2" value="Biển Nam"> Biển Nam
            </label>
        </div>

        <input type="hidden" name="timeTaken" id="timeTaken">
        
        <button type="submit">Nộp Bài</button>
    </form>

    <script>
        let timeLimit = <?php echo $_SESSION['time_taken']; ?>; 
        const timerElement = document.getElementById('timer');
        const timerInterval = setInterval(() => {
            if (timeLimit <= 0) {
                clearInterval(timerInterval);
                alert("Hết giờ!");
                document.getElementById('timeTaken').value = <?php echo $time_limit * 60; ?>; 
                document.getElementById('quizForm').submit();
            } else {
                const minutes = Math.floor(timeLimit / 60);
                const seconds = timeLimit % 60;
                timerElement.textContent = `Thời gian còn lại: ${minutes} phút ${seconds} giây`;
                timeLimit--;
            }
        }, 1000);
        
        document.getElementById('quizForm').onsubmit = function() {
            document.getElementById('timeTaken').value = <?php echo $time_limit * 60; ?> - timeLimit; 
        };
    </script>
</body>
</html>
