<?php
require('../connect.php');

if(isset($_POST['formdata'])){
    $handle = fopen($_FILES['PreRegCSV']['tmp_name'], "r");
    $count = 0;
    $error = false;

    while(($row = fgetcsv($handle, 1000, ",")) !==FALSE){
        if($count == 0){
            $count++;
            continue;
        }
        $ImportName = $row[0];
        $nname = $row[1];
        $bday = $row[3];
        $contact = $row[2];
        $circuit = $row[5];
        $Church = $row[4];
        $deltype = 'Young People';

        $YouthNames = explode(', ', $ImportName);

        try{

            foreach($YouthNames as $FullName){
                $FullName = trim($FullName);
                $NameParts = explode(' ', $FullName);

                $fname = '';
                $lname = '';

                if (count($NameParts) > 1) {
                    // If there are multiple parts, build the first name
                    $fname = implode(' ', array_slice($NameParts, 0, -1));
                    $lname = end($NameParts);
                } else {
                    // If only one part, consider it as the first name
                    $fname = $NameParts[0];
                }

                //Check if the Church is existing in the db.
                $getChurch = "SELECT COUNT(*) ChurchCount FROM tbl_church WHERE tbl_church.Church = '$Church';";
                $ChurchCount = $con -> query($getChurch);

                if($ChurchCount -> num_rows > 0){
                    $ChurchC = $ChurchCount -> fetch_assoc();
                    $ExistChurch = $ChurchC['ChurchCount'];
                }

                if($ExistChurch == 0){
                    $insert = "INSERT INTO `tbl_church`( `Church`, `circuit_id`) VALUES ('$Church', 
                    (SELECT tbl_circuit.circuit_id FROM tbl_circuit WHERE tbl_circuit.Circuit = '$circuit'))";
                    $insertChurch = $con-> query($insert);
                }

                //Check if the yp is already registered
                $CheckRegistered = "SELECT COUNT(tbl_delegate.delegate_id) AS registered FROM tbl_delegate 
                INNER JOIN tbl_yp ON tbl_yp.yp_id = tbl_delegate.yp_id WHERE tbl_delegate.yp_id = 
                (SELECT tbl_yp.yp_id FROM tbl_yp WHERE tbl_yp.fname = '$fname' AND tbl_yp.lname = '$lname');";
                $resultReg = $con-> query($CheckRegistered);

                //Check if the yp is registered in the database;
                $CheckExistYP = "SELECT COUNT(tbl_yp.yp_id) AS CheckExist FROM tbl_yp WHERE tbl_yp.fname = '$fname' AND tbl_yp.lname ='$lname';";
                $resultYP = $con-> query($CheckExistYP);

                if($resultReg -> num_rows > 0){
                    $checkRes = $resultReg->fetch_assoc();
                    $ExistReg = $checkRes['registered'];
                }

                if($resultYP -> num_rows > 0){
                    $check = $resultYP-> fetch_assoc();
                    $Exist = $check['CheckExist'];
                }

                //Check if registered in the system and registered to the duyog
                if($Exist == 0){
                    //register if not...
                    $InsertYP = "INSERT INTO tbl_yp (tbl_yp.fname, tbl_yp.lname, tbl_yp.nickname, tbl_yp.Bday, 
                    tbl_yp.del_type_id, tbl_yp.contact_num, tbl_yp.church_id) VALUES ('$fname', '$lname', '$nname', STR_TO_DATE('$bday', '%m/%d/%Y'), (SELECT tbl_delegatetype.del_type_id FROM tbl_delegatetype WHERE tbl_delegatetype.delegate_type = '$deltype'), 
                    '$contact', (SELECT tbl_church.church_id FROM tbl_church WHERE tbl_church.Church = '$Church'))";
                    $YP = $con -> query($InsertYP);
                }
                
                //Check if the yp is registered in the system
                if($ExistReg == 0){

                    //register it!
                    $register = "INSERT INTO tbl_delegate (tbl_delegate.yp_id, tbl_delegate.RegTime, tbl_delegate.RegType_id)
                    VALUES ((SELECT tbl_yp.yp_id FROM tbl_yp WHERE tbl_yp.fname = '$fname' AND tbl_yp.lname = '$lname'), NOW(), 4);";
                    $registered = $con -> query($register);
                    
                }
            }

        }catch(Exception $e){
            echo "<script>alert($e)</script>";
            $error = true;
            
        }
        $count++;
    }   
    fclose($handle);

    if($error){
        echo "<script>Swal.fire({
          icon: 'error',
          title: 'ON GOING BUG',
          text: 'Do not worry, the YP is registered as PreReg!, just double check the Registered Profile Module, if not contact the developer',
        })</script>"; 
    }else{
        echo "<script>Swal.fire({
            icon: 'success',
            title: 'Successfully Imported',
            showConfirmButton: false,
            timer: 1500
        })</script>";
    }
}


?>