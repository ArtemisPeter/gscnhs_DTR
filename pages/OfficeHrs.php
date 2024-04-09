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
      <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  
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
            <h1 class="m-0">Office Hours</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Office Hours</li>
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
                
                <table class="table" id="tableOfficeHrs">
                    <thead>
                        <tr>   
                            <th class='d-none'>ID</th>
                            <th>Morning IN</th>
                            <th>Morning OUT</th>
                            <th>Afternoon IN</th>
                            <th>Afternoon OUT</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $GetData = "SELECT A.timeInOut_id, A.timeIn_Morning, A.timeOut_Morning, A.timeIn_Afternoon, A.timeOut_Afternoon FROM tbl_timeinout AS A";
                            $Result = mysqli_query($con, $GetData);

                            foreach($Result as $row){
                             ?>
                             <tr>
                                <td class='d-none'><?php echo $row['timeInOut_id'] ?></td>
                                <td><?php echo $row['timeIn_Morning'] ?></td>
                                <td><?php echo $row['timeOut_Morning'] ?></td>
                                <td><?php echo $row['timeIn_Afternoon'] ?></td>
                                <td><?php echo $row['timeOut_Afternoon'] ?></td>
                                <td><button class="btn btn-primary editBtn">Edit</button></td>
                             </tr>
                            <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModal" aria-hidden="true" data-backdrop="static">
                <div class="modal-dialog modal-dialog-centered"role="document">
                    <input type = "hidden" name="update_id" id="update_id">
                    <div class="modal-content" >
                        <div class="modal-header d-flex justify-content-center"style="border-bottom: 1px solid green">
                            <h4 id="namez"></h4>
                            <div class="d-none" id="OfficeHrsID"></div>
                        </div>
                        <form id="updateInfo">
                        <div class="modal-body">
                        <div class="alert alert-danger d-none" id='alert' role="alert">
             
            </div>  
                          <div class="row">
                              <div class="col-12">
                                <label for="firstName">Morning IN</label>
                                <input type="text" class="form-control" id="AMIN" name="AMIN">
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-12">
                                <label for="firstName">Morning OUT</label>
                                <input type="text" class="form-control" id="AMOUT" name="AMOUT">
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-12">
                                <label for="firstName">Afternoon IN</label>
                                <input type="text" class="form-control" id="AFIN" name="AFIN">
                              </div>
                          </div>
                          <div class="row">
                              <div class="col-12">
                                <label for="firstName">Afternoon OUT</label>
                                <input type="text" class="form-control" id="AFOUT" name="AFOUT">
                              </div>
                          </div>
                          
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="closeBtn" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save</button>
                            </form>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>


<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>


<script src='../util/OfficeHrs.js'></script>
<script>
    $('#master').addClass('menu-open');
    $('#clock').addClass('active');
</script>
</body>
</html>
