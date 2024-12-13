<?php
require_once ('php/dbhelp.php');

$s_Username = $s_Email = $s_CCCD = $s_Age = $s_Password ='';

if (!empty($_POST)) {
	$s_Id = '';

	if (isset($_POST['Username'])) {
		$s_Username = $_POST['Username'];
	}

	if (isset($_POST['Email'])) {
		$s_Email = $_POST['Email'];
	}

	if (isset($_POST['CCCD'])) {
		$s_CCCD = $_POST['CCCD'];
	}

    if (isset($_POST['Age'])) {
		$s_Age = $_POST['Age'];
	}
	if (isset($_POST['Password'])) {
		$s_Password = $_POST['Password'];
	}

	if (isset($_POST['id'])) {
		$s_Id = $_POST['id'];
	}

	$s_Username = str_replace('\'', '\\\'', $s_Username);
	$s_Email    = str_replace('\'', '\\\'', $s_Email);
	$s_CCCD     = str_replace('\'', '\\\'', $s_CCCD);
    $s_Age      = str_replace('\'', '\\\'', $s_Age);
	$s_Password = str_replace('\'', '\\\'', $s_Password);
	$s_Id       = str_replace('\'', '\\\'', $s_Id);

	if ($s_Id != '') {
		//update
		$sql = "UPDATE users SET Username = '$s_Username', Email = '$s_Email', CCCD = '$s_CCCD', Age = '$s_Age', Password = '$s_Password' WHERE id = $s_Id";
	} else {
		//insert
		$sql = "INSERT INTO users (Username, Email, CCCD, Age, Password) VALUES ('$s_Username', '$s_Email', '$s_CCCD', '$s_Age', '$s_Password')";
	}

	execute($sql);

	header('Location: index.php');
	die();
}

$Id = '';
if (isset($_GET['id'])) {
	$Id = $_GET['id'];
	$sql = 'SELECT * FROM student WHERE id = '.$Id;
	$studentList = executeResult($sql);
	if ($studentList != null && count($studentList) > 0) {
		$std = $studentList[0];
		$s_Username = $std['Username'];
		$s_Email    = $std['Email'];
		$s_CCCD     = $std['CCCD'];
        $s_Age      = $std['Age'];
		$s_Password = $std['Password'];
	} else {
		$Id = '';
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration Form * Form Tutorial</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h2 class="text-center">Add Student</h2>
			</div>
			<div class="panel-body">
				<form method="post">
					<div class="form-group">
					  <label for="username">Name:</label>
					  <input type="number" name="id" value="<?=$Id?>" style="display: none;">
					  <input required="true" type="text" class="form-control" id="username" name="Username" value="<?=$s_Username?>">
					</div>
					<div class="form-group">
					  <label for="email">Email:</label>
					  <input type="text" class="form-control" id="Email" name="Email" value="<?=$s_Email?>">
					</div>
					<div class="form-group">
					  <label for="CCCD">CCCD:</label>
					  <input type="text" class="form-control" id="CCCD" name="CCCD" value="<?=$s_CCCD?>">
					</div>
                    <div class="form-group">
					  <label for="age">Age:</label>
					  <input type="number" class="form-control" id="Age" name="Age" value="<?=$s_Age?>">
					</div>
					<div class="form-group">
					  <label for="Password">Password:</label>
					  <input type="password" class="form-control" id="Password" name="Password" value="<?=$s_Password?>">
					</div>
					<button class="btn btn-success">Save</button>
                    <a href="index.php" class="btn btn-warning">Back</a>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
