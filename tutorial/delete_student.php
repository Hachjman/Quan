<?php
require_once('php/dbhelp.php');

if (isset($_POST['Id'])) {
    $id = $_POST['Id'];
    $conn = getDbConnection();

    if ($conn) {
        $stmt = $conn->prepare("DELETE FROM users WHERE Id = ?");
        if ($stmt) {
            $stmt->bind_param("i", $id); 

            if ($stmt->execute()) {
                echo 'success';
            } else {
                echo 'error: ' . $stmt->error;
            }

            $stmt->close();
        } else {
            echo 'error: ' . $conn->error;
        }

        mysqli_close($conn);
    } else {
        echo 'error: Could not connect to the database'; 
    }
} else {
    echo 'error: Invalid request';
}
