<?php 
    require('../connect.php');   
    $AMIN = $_POST['AMIN'];
    $AMOUT = $_POST['AMOUT'];
    $PMIN = $_POST['PMIN'];
    $PMOUT = $_POST['PMOUT'];
    $OfficeHrID = $_POST['OfficeHrID'];
    $option = $_POST['option'];

    switch($option){
        case 1:
            $updateInfo = "UPDATE tbl_timeinout AS A SET A.timeIn_Morning = '$AMIN', A.timeOut_Morning = '$AMOUT', A.timeIn_Afternoon = '$PMIN', A.timeOut_Afternoon = '$PMOUT' WHERE A.timeInOut_id = $OfficeHrID";
            $result = mysqli_query($con, $updateInfo);
        
            if($result){
                echo 'success';
            }else{
                echo 'error';
            }
        break;

        case 2:
            $InsertInfo = "INSERT INTO tbl_timeinout (timeIn_Morning, timeOut_Morning, timeIn_Afternoon, timeOut_Afternoon) VALUES ('$AMIN', '$AMOUT', '$PMIN', '$PMOUT')";
            $result = mysqli_query($con, $InsertInfo);

            if($result){
                echo 'success';
            }else{
                echo 'error';
            }

        break;
    }

    


?>