<?php require('../connect.php');
    session_start();

    
    $Month = $_POST['month'];
    $Year = $_POST['year'];

   
    $dateObj = DateTime::createFromFormat('!m', $Month);
    $monthName = $dateObj->format('F'); 
    

    ?>
           <?php
                $getTeacher = "SELECT A.teacher_id, CONCAT(A.fname,' ',A.lname) AS TeacherName, B.* FROM tbl_teacher AS A
                INNER JOIN tbl_timeinout AS B ON A.timeInOut_id = B.timeInOut_id";
                $result = mysqli_query($con, $getTeacher);

                foreach($result as $teacher){
                    $teacherID = $teacher['teacher_id'];
                    $teacherName = $teacher['TeacherName'];
                    $TimeInAM = $teacher['timeIn_Morning'];
                    $TimeOutAm = $teacher['timeOut_Morning'];
                    $TimeInPM = $teacher['timeIn_Afternoon'];
                    $TimeOutPM = $teacher['timeOut_Afternoon']
            ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DTR</title>
   


    <style>
         @media print {
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            width: 8.5in;
            height: 13in;
        }
        /* Additional print styles for other elements if needed */
    }
          body {
            margin: 0;
            font-family: Arial, sans-serif; /* Define your preferred font */
        }
        .row {
            display: flex;
        }

        .column {
            flex: 50%;
            margin: 0; /* Remove default margin */
            padding: 3px; /* Add padding to create space between content and edges */
        }

        .center{
            display: flex;
            justify-content: center;
            font-size: 15px;
            font-weight: bold;
            margin: 0 0;
        }

        .footer{
            display: flex;
            justify-content: center;
            font-size: 13px;
            font-weight: bold;
            margin: 0 0;
        }

        .principal{
            display: flex;
            justify-content: center;
            font-size: 14px;
            font-weight: bold;
            margin: 0 0;
        }

        h2{
            margin: 5px 0;
        }

        .tbl-bordered{
            width: 100%;
            height: 200px;
            border-collapse: collapse;
             border: 1px solid black;
        }
        
        .tbl-bordered td{
            border: 1px solid black;
            border-collapse: collapse;
            font-size: 10px;
            padding: 2px;
           
        }

        .tbl-no-border{
            border-collapse: collapse;
        }
        .tbl-no-border th, .tbl-no-border td {
            border: 1px solid white; /* This will hide the borders */
            font-size: 12px;  
            font-weight: bold;
        }
        img {
            width: 100%;
            height: auto; /* Maintain aspect ratio */
            display: block; /* Remove any default spacing */
            margin-bottom: 5px;
            margin-top: 20px;
        }

        .f12{
            font-size: 12px;
            font-weight: bold;
        }
    </style>
</head>
<body>
 
    <div class="row">
        <div class="column">
            <p class="center"><b>CIVIL SERVICE FORM 48</b></p>
            <div class="img-logo"></div>
            <p class="center"><b>DAILY TIME RECORD</b></p>
            <br>
            <p style="text-decoration: underline; text-transform: uppercase" class="center" id="TeacherName"><b><?php echo $teacherName ?></b></p>
            <p class="center">NAME</p>
            <p class='f12'>For the month of <span style="text-decoration: underline; text-transform: uppercase"><?php echo $monthName.', '.$Year ?></span></p>
            <table class="tbl-no-border" >
                <tr style="padding: 40px;">
                    <td></td>
                    <td><b>AM</b></td>
                    <td style="width: 10%"></td>
                    <td><b>PM</b></td>
                </tr>
                <tr>
                    <td><b>Office Hrs. -Arrival:</b></td>
                    <td style="text-decoration: underline;"><b><?php echo $TimeInAM ?></b></td>
                    <td></td>
                    <td style="text-decoration: underline;"><b><?php echo $TimeInPM ?></b></td>
                </tr>
                <tr>
                    <td style="text-align: right;"><b>Departure:</b></td>
                    <td style="text-decoration: underline;"><b><?php echo $TimeOutAm ?></b></td>
                    <td></td>
                    <td style="text-decoration: underline;"><b><?php echo $TimeOutPM ?></b></td>
                </tr>
            </table>
            <p class="f12">Regular Days ______ Saturdays ______</p>
            <br>
            <table class="tbl-bordered">
                <tr>
                    <td rowspan="2">Day</td>
                    <th colspan="2" style="text-align: center;">AM</th>
                    <th colspan="2" style="text-align: center;">PM</th>
                    <th colspan="2" style="text-align: center;">UNDERTIME</th>
                </tr>
                <tr style="padding: 5px;">
                    <td>Arrival</th>
                    <td>Departure</td>
                    <td>Arrival</td>
                    <td>Departure</td>
                    <td>hours</td>
                    <td>Minutes</th>
                </tr>
                <tr>
                    <?php 
                        $GetDTR = "WITH RECURSIVE DateRange AS (
                                SELECT 1 AS Day
                                UNION ALL
                                SELECT Day + 1
                                FROM DateRange
                                WHERE Day < 31
                            )
                            SELECT 
                                DR.Day,
                                COALESCE(MIN(CASE WHEN state_id = 1 AND HOUR(T.recordedTime) < 12 THEN DATE_FORMAT(T.recordedTime, '%l:%i') END), ' ') AS Morning_IN,
                                COALESCE(MAX(CASE WHEN state_id = 2 AND HOUR(T.recordedTime) < 14 THEN DATE_FORMAT(T.recordedTime, '%l:%i') END), ' ') AS Morning_OUT,
                                COALESCE(MIN(CASE WHEN state_id = 1 AND HOUR(T.recordedTime) >= 10 THEN DATE_FORMAT(T.recordedTime, '%l:%i') END), ' ') AS Afternoon_IN,
                                COALESCE(MAX(CASE WHEN state_id = 2 AND HOUR(T.recordedTime) >= 12 THEN DATE_FORMAT(T.recordedTime, '%l:%i') END), ' ') AS Afternoon_OUT
                            FROM 
                                DateRange DR
                            LEFT JOIN (
                                SELECT * FROM tbl_dtr
                                WHERE MONTH(recordedTime) = $Month AND YEAR(recordedTime) = $Year AND teacher_id = $teacherID
                            ) T ON DR.Day = DAY(T.recordedTime)
                            GROUP BY 
                                DR.Day
                            ORDER BY 
                                DR.Day;";
                        $resutl = mysqli_query($con, $GetDTR);

                        foreach($resutl as $row){
                    ?>
                    <tr>
                        <td style="text-align: center;"><?php echo $row['Day'] ?></td>
                        <td style="text-align: center;"><?php echo $row['Morning_IN'] ?></td>
                        <td style="text-align: center;"><?php echo $row['Morning_OUT'] ?></td>
                        <td style="text-align: center;"><?php echo $row['Afternoon_IN'] ?></td>
                        <td style="text-align: center;"><?php echo $row['Afternoon_OUT']; ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php } ?>
                </tr>
                <tr>
                   <td></td>
                    <td rowspan="6">Total</td>
                </tr>
            </table>
            
           
            <p style="font-size: 11px">I certify on my honor that the above is true and correct report of the hours of work performed, record or which was made daily at the time of arrival at and departure from office.</p>
            <br>
            <p class='footer'>_______________</p>
            <p class="footer">_______________________</p>
            <p class="footer">Verified as the prescribed office hours</p>
            <br>
            <br>
            <p class="principal">SHIELA G. BALBON, Ed. D</p>
            <p class="footer">Principal II</p>
            <br>
            <br>
        </div>
        <div class="column"></div>
      </div>
      <?php } ?>
      <script src="../plugins/jquery/jquery.min.js"></script>
      <script>
        $(window).on('load', () =>{

            var imgElement = $('<img>', {
            src: '../dist/img/cityhigh/header.png',
            alt: 'Image Alt Text',
            width: '100%',
            height: '30px'
        });
        $('.img-logo').append(imgElement);

        imgElement.on('load', ()=> {
            window.print();
        })
        })
      </script>
</body>
</html>
