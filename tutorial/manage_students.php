<?php
require_once('php/dbhelp.php');

$sql = 'SELECT * FROM users';
$usersList = executeResult($sql);
$index = 1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sinh viên</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>

<div class="container">
    <h2 class="mt-4">Quản lý Sinh viên</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>Họ & Tên</th>
                <th>Email</th>
                <th>CCCD</th>
                <th>Tuổi</th>
                <th width="60px"></th>
                <th width="60px"></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($usersList as $std): ?>
            <tr>
                <td><?= $index++ ?></td>
                <td><?= htmlspecialchars($std['Username']) ?></td>
                <td><?= htmlspecialchars($std['Email']) ?></td>
                <td><?= htmlspecialchars($std['CCCD']) ?></td>
                <td><?= htmlspecialchars($std['Age']) ?></td>
                <td>
                    <button class="btn btn-warning" onclick="showEditModal(<?= $std['Id'] ?>, '<?= htmlspecialchars($std['Username']) ?>', '<?= htmlspecialchars($std['Email']) ?>', '<?= htmlspecialchars($std['CCCD']) ?>', <?= $std['Age'] ?>)">Edit</button>
                </td>
                <td>
                    <button class="btn btn-danger" onclick="deleteStudent(<?= $std['Id'] ?>)">Delete</button>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <a href="input.php" class="btn btn-success">Add Student</a>
</div>

<div class="modal" id="editStudentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Chỉnh sửa Sinh viên</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editStudentForm">
                    <input type="hidden" id="studentId" name="studentId">
                    <div class="form-group">
                        <label for="studentName">Họ & Tên:</label>
                        <input type="text" class="form-control" id="studentName" name="studentName" required>
                    </div>
                    <div class="form-group">
                        <label for="studentEmail">Email:</label>
                        <input type="email" class="form-control" id="studentEmail" name="studentEmail" required>
                    </div>
                    <div class="form-group">
                        <label for="studentCCCD">CCCD:</label>
                        <input type="text" class="form-control" id="studentCCCD" name="studentCCCD" required>
                    </div>
                    <div class="form-group">
                        <label for="studentAge">Tuổi:</label>
                        <input type="number" class="form-control" id="studentAge" name="studentAge" required>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="updateStudent()">Lưu Thay đổi</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function deleteStudent(Id) {
        const option = confirm('Bạn có muốn xoá sinh viên này không?');
        if (!option) {
            return;
        }

        $.post('delete_student.php', {
            'Id': Id
        }, function(data) {
            alert(data);
            location.reload();
        });
    }

    function showEditModal(id, name, email, cccd, age) {
        $('#studentId').val(id);
        $('#studentName').val(name);
        $('#studentEmail').val(email);
        $('#studentCCCD').val(cccd);
        $('#studentAge').val(age);
        $('#editStudentModal').modal('show');
    }

    function updateStudent() {
        const id = $('#studentId').val();
        const name = $('#studentName').val();
        const email = $('#studentEmail').val();
        const cccd = $('#studentCCCD').val();
        const age = $('#studentAge').val();

        $.post('update_student.php', {
            'Id': id,
            'Username': name,
            'Email': email,
            'CCCD': cccd,
            'Age': age
        }, function(data) {
            alert(data);
            location.reload();
        });
    }
</script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
