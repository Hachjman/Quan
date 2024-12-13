<?php
require_once('php/dbhelp.php');

$sql = "SELECT * FROM questions";
$questions = executeResult($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Questions</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <style>
        .table {
            opacity: 0;
            animation: fadeIn 1s forwards; 
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .modal {
            transition: transform 0.3s ease, opacity 0.3s ease;
            transform: translateY(-100px);
            opacity: 0;
        }

        .modal.show {
            transform: translateY(0);
            opacity: 1;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="mt-4">Quản lý Câu hỏi</h2>

    <button class="btn btn-success mb-3" onclick="showAddQuestionModal()">Thêm Câu hỏi</button>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Câu hỏi</th>
                <th>Tuỳ chọn</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($questions as $question): ?>
                <tr>
                    <td><?= $question['id'] ?></td>
                    <td><?= $question['question'] ?></td>
                    <td>
                        <button class="btn btn-warning" onclick="loadEditQuestion(<?= $question['id'] ?>)">Edit</button>
                        <button class="btn btn-danger" onclick="deleteQuestion(<?= $question['id'] ?>)">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="modal" id="addQuestionModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thêm Câu hỏi Mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addQuestionForm">
                    <div class="form-group">
                        <label for="question">Câu hỏi:</label>
                        <textarea class="form-control" id="question" name="question" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="option1">Tùy chọn 1:</label>
                        <input type="text" class="form-control" id="option1" name="option1" required>
                    </div>
                    <div class="form-group">
                        <label for="option2">Tùy chọn 2:</label>
                        <input type="text" class="form-control" id="option2" name="option2" required>
                    </div>
                    <div class="form-group">
                        <label for="option3">Tùy chọn 3:</label>
                        <input type="text" class="form-control" id="option3" name="option3" required>
                    </div>
                    <div class="form-group">
                        <label for="option4">Tùy chọn 4:</label>
                        <input type="text" class="form-control" id="option4" name="option4" required>
                    </div>
                    <div class="form-group">
                        <label>Đáp án đúng:</label>
                        <select class="form-control" id="correct_option" name="correct_option" required>
                            <option value="1">Tùy chọn 1</option>
                            <option value="2">Tùy chọn 2</option>
                            <option value="3">Tùy chọn 3</option>
                            <option value="4">Tùy chọn 4</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="addQuestion()">Lưu Câu hỏi</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
       
        $('.table').css('opacity', 1);
    });

    function showAddQuestionModal() {
        $('#addQuestionModal').modal('show');
    }

    function addQuestion() {
        const question = $('#question').val();
        const option1 = $('#option1').val();
        const option2 = $('#option2').val();
        const option3 = $('#option3').val();
        const option4 = $('#option4').val();
        const correctOption = $('#correct_option').val();

        if (!question || !option1 || !option2 || !option3 || !option4 || !correctOption) {
            alert('Vui lòng điền đầy đủ thông tin.');
            return;
        }

        $.post('add_question.php', {
            question: question,
            option1: option1,
            option2: option2,
            option3: option3,
            option4: option4,
            correct_option: correctOption
        })
        .done(function(response) {
            const result = JSON.parse(response);
            alert(result.message);
            if (result.success) {
                $('#addQuestionModal').modal('hide');
                location.reload(); 
            }
        })
        .fail(function() {
            alert('Có lỗi xảy ra. Vui lòng thử lại.');
        });
    }

    function deleteQuestion(id) {
        const option = confirm('Bạn có chắc chắn muốn xóa câu hỏi này không?');
        if (!option) return;

        $.post('delete_question.php', { id: id })
            .done(function(response) {
                const result = JSON.parse(response);
                alert(result.message);
                if (result.success) {
                    location.reload();
                }
            })
            .fail(function() {
                alert('Xóa không thành công. Vui lòng thử lại.');
            });
    }

    function loadEditQuestion(id) {
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
