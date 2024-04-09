<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Import</title>
  <?php require('../component/icon.php') ?>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
 


</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../dist/img/cityhigh/school-logo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->

  <?php 
  require('../component/menu.php');
  $userId = $_SESSION['userId'];
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Import</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Import</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        </div>
       
        <div class="card">
          <div class="card-body">
            <button type="button" class='btn btn-primary' data-bs-toggle="modal" data-bs-target="#staticBackdrop">Import CSV</button>
            <table class="table" id='tableDTR'>
              <thead>
                <tr></tr>
                  <th>Name</th>
                  <th>DateTime</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $retrieveData = "SELECT CONCAT(B.fname,' ',B.lname) AS teacher, A.recordedTime, C.state FROM tbl_dtr AS A
                  INNER JOIN tbl_teacher AS B ON B.teacher_id = A.teacher_id
                  INNER JOIN tbl_state AS C ON C.state_id = A.state_id";
                  $result = mysqli_query($con, $retrieveData);

                  foreach($result as $row){
                ?>
                  <tr>
                    <td><?php echo $row['teacher']?></td>
                    <td><?php echo $row['recordedTime']?></td>
                    <td><?php echo $row['state']; ?></td>
                  </tr>
                  <?php 
                  };
                  ?>
              </tbody>
            </table>
          </div>
        </div>
      

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Import CSV</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div id="remind"></div>
      <form id="dtr_import" enctype="multipart/form-data">

                <a href="https://drive.google.com/drive/folders/1OvNGMMpE28ZsAVR5tecX3GRwP-DzDLpe?usp=drive_link" class="d-flex justify-content-center" target="_blank">Click me to download the CSV file</a>
                    <div class="row d-flex justify-content-center mt-4 mb-4">
                        <div class="col-10">
                            <input type="file" class="form-control-file form-control-lg" name ="dtr_" id ="dtr_" required accept=".csv" >
                            
                        </div>
                        
                        <div class="col-2">
                            <button class="btn btn-danger" type="submit" id="import" name="import"><i class="fas fa-file-upload"></i></button>
                        </div>
                        <div class="alert mt-4 d-none" id='alert' role="alert">
                         
                        </div>
                    </div>
                </form>
      </div>
      
    </div>
  </div>
</div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <?php require('../component/footer.php') ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>

<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<script src='../util/import.js'></script>
<script>
  $('#dtr').addClass('active');
</script>
</body>
</html>
