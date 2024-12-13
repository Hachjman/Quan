<?php
session_start();
include("php/config.php");

if (!isset($_SESSION['valid'])) {
    header("Location: index1.php");
    exit();
}

$id = $_SESSION['id'];
$query = mysqli_query($con, "SELECT * FROM users WHERE Id=$id");
$result = mysqli_fetch_assoc($query);
$res_Uname = $result['Username'];


$sql = 'SELECT * FROM questions';
$questionsList = executeResult($sql);

$score = 0;
$message = "";
$isSubmitted = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_quiz'])) {
    $totalQuestions = count($questionsList);

    foreach ($questionsList as $q) {
        $userAnswer = $_POST['question_' . $q['id']] ?? '';

        if ($userAnswer == $q['correct_option']) {
            $score++;
        }
    }

    $message = "$res_Uname, bạn đã trả lời đúng $score/$totalQuestions câu hỏi.";
    $isSubmitted = true; 
    $subject = 'TOÁN'; 
    $dateTaken = date('Y-m-d H:i:s'); 

    $insertQuery = "INSERT INTO quiz_history (user_id, subject, score, date_taken) VALUES ($id, '$subject', $score, '$dateTaken')";
    mysqli_query($con, $insertQuery);
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="style/style1.css">
    <link rel="stylesheet" href="style/style2.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #A8E0D5 0%, #B0E1FF 100%);
            color: #333;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 2.5rem;
            font-weight: bold;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }

        .card {
            width: 100%;
            max-width: 600px;
            background: rgba(255, 255, 255, 0.8);
            border: none;
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 15px;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.03);
        }

        .form-check {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .form-check-input {
            margin-right: 10px;
        }

        .btn {
            width: 100%;
            margin-top: 20px;
            padding: 10px;
            font-size: 1.2rem;
        }

        .alert {
            margin-top: 20px;
            font-size: 1.2rem;
        }

        .timer {
            font-size: 1.5rem;
            color: red;
            margin-bottom: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Quiz - Chọn đáp án đúng</h2>

        <div class="timer" id="timer">Thời gian còn lại: 05:00</div>

        <?php if ($isSubmitted) { ?>
            <div class="alert alert-info" role="alert">
                <?= htmlspecialchars($message) ?>
            </div>
            <a href="trangchu.php" class="btn btn-secondary">Trở về Trang Chủ</a>
        <?php } else { ?>
            <form method="POST" action="" id="quizForm">
                <?php foreach ($questionsList as $q) { ?>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($q['question']) ?></h5>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question_<?= $q['id'] ?>" id="option1_<?= $q['id'] ?>" value="1" required>
                                <label class="form-check-label" for="option1_<?= $q['id'] ?>">
                                    <?= htmlspecialchars($q['option1']) ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question_<?= $q['id'] ?>" id="option2_<?= $q['id'] ?>" value="2" required>
                                <label class="form-check-label" for="option2_<?= $q['id'] ?>">
                                    <?= htmlspecialchars($q['option2']) ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question_<?= $q['id'] ?>" id="option3_<?= $q['id'] ?>" value="3" required>
                                <label class="form-check-label" for="option3_<?= $q['id'] ?>">
                                    <?= htmlspecialchars($q['option3']) ?>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question_<?= $q['id'] ?>" id="option4_<?= $q['id'] ?>" value="4" required>
                                <label class="form-check-label" for="option4_<?= $q['id'] ?>">
                                    <?= htmlspecialchars($q['option4']) ?>
                                </label>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <button type="submit" name="submit_quiz" class="btn btn-primary">Nộp bài</button>
            </form>
        <?php } ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script>
        
        var timeLeft = 300; 
        var timerElement = document.getElementById("timer");
        var quizForm = document.getElementById("quizForm");

        var countdownTimer = setInterval(function() {
            var minutes = Math.floor(timeLeft / 60);
            var seconds = timeLeft % 60;

           
            seconds = seconds < 10 ? "0" + seconds : seconds;

            timerElement.textContent = "Thời gian còn lại: " + minutes + ":" + seconds;

            if (timeLeft <= 0) {
                clearInterval(countdownTimer);
                alert("Thời gian làm bài đã hết! Bài làm sẽ được nộp tự động.");
                quizForm.submit(); 
            timeLeft--;
        }, 1000);
    </script>
</body>
</html>y