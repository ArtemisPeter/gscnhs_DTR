<?php
session_start();
require('../connect.php');

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $stmt = $con->prepare("SELECT useraccount_id FROM tbl_account WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        // Fetch the user account id
        $row = $result->fetch_assoc();
        $userId = $row['useraccount_id'];
        $_SESSION['userId'] = $userId;

        // Fetch the user's name
        $stmt = $con->prepare("SELECT CONCAT(fname, ' ', lname) AS name FROM tbl_teacher WHERE teacher_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $ResultUserName = $stmt->get_result();

        if ($ResultUserName->num_rows > 0) {
            $name = $ResultUserName->fetch_assoc();
            $_SESSION['name'] = $name['name'];
        }

        // Fetch the user's type
        $stmt = $con->prepare("SELECT user_setup_id FROM tbl_account WHERE useraccount_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $ResultUserType = $stmt->get_result();

        if ($ResultUserType->num_rows > 0) {
            $type = $ResultUserType->fetch_assoc();
            $_SESSION['usertype'] = $type['user_setup_id'];
        }

        echo 'success';
    } else {
        echo '1';
    }
} else {
    echo 'there is an error';
}
?>
