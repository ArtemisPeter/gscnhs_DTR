<?php 
    require('../connect.php');   
    $Fname = $_POST['Fname'];
    $Lname = $_POST['Lname'];
    $Officehrs = $_POST['OfficeHrs'];
    $teacher_id = $_POST['teacher_id'];

    $updateInfo = "UPDATE tbl_teacher AS A SET A.fname = '$Fname', A.lname = '$Lname', A.timeInOut_id = $Officehrs WHERE A.teacher_id = $teacher_id";
    $result = mysqli_query($con, $updateInfo);

    if($result){
        echo 'success';
    }else{
        echo 'error';
    }


?>