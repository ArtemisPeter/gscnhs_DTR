<?php
require('../connect.php');

    $handle = fopen($_FILES['dtr_']['tmp_name'], "r");
    $count = 0;
    $error = false;

    while(($row = fgetcsv($handle, 1000, ",")) !==FALSE){
        if($count == 0){
            $count++;
            continue;
        }
        $ImportName = $row[2];
        $time = $row[3];
        $state = $row[4];
 
        $formattedDateTime = date('Y-m-d H:i:s', strtotime($time));

        $TeacherNames = explode(', ', $ImportName);

        try{

            foreach($TeacherNames as $FullName){
                $FullName = trim($FullName);
                $NameParts = explode(' ', $FullName);

                $lname = '';
                $fname = '';

                if (count($NameParts) > 1) {
                    // If there are multiple parts, build the first name
                    $fname = implode(' ', array_slice($NameParts, 0, -1));
                    $lname = end($NameParts);
                } else {
                    // If only one part, consider it as the first name
                    $fname = $NameParts[0];
                }
                //Check if the teacher is existing
                $CheckTeacher = "SELECT A.teacher_id FROM tbl_teacher AS A WHERE A.fname = '$fname' AND A.lname = '$lname'";
                $ResultTeacher = mysqli_query($con, $CheckTeacher);

                //Insert if teacher is not found
                if($ResultTeacher->num_rows <= 0){
                    $InsertNewTeacher = "INSERT INTO tbl_teacher (tbl_teacher.fname, tbl_teacher.lname, tbl_teacher.role_id, tbl_teacher.timeInOut_id) VALUES ('$fname', '$lname', 1, 2)";
                    $Res = mysqli_query($con, $InsertNewTeacher);
                }

                    //Insert if teacher is found:
                    $InsertDTR = "INSERT INTO tbl_dtr (teacher_id, recordedTime, state_id) VALUES ((SELECT tbl_teacher.teacher_id FROM tbl_teacher WHERE tbl_teacher.fname = '$fname' AND tbl_teacher.lname = '$lname'), '$formattedDateTime', (SELECT tbl_state.state_id FROM tbl_state WHERE tbl_state.state = '$state'))";
                    $resultDTR = mysqli_query($con, $InsertDTR);
                
            }

        }catch(Exception $e){
            echo "<script>alert($e)</script>";
            $error = true;
            
        }
        $count++;
    }   
    fclose($handle);
    if($error){
        echo 'error';
    }else{
        echo 'success';
    }


?>