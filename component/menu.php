<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>

    <!-- Right navbar links -->
    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="../dist/img/cityhigh/school-logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">GSCNHS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info mx-auto">
        <?php
session_start();
require('../connect.php');

// Redirect if session name is not set
if (!isset($_SESSION['name'])) {
    session_destroy();
    header('Location: ../index.php');
    exit();
}
?>
<a href="#" class="d-block"><?php echo $_SESSION['name'];  ?></a>

        </div>
      </div>

      <!-- SidebarSearch Form -->
     

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item" id="master">
            <a href="#" class="nav-link" >
              <i class="nav-icon fas fa-database"></i>
              <p>Master Data<i class="fas fa-angle-left right"></i></p></a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../pages/teacher.php" class="nav-link" id="teacher">
                  <i class="nav-icon fas fa-chalkboard-teacher"></i>
                    <p>Teacher</p>
                  </a>
                </li>
                                    
                <li class="nav-item">
                  <a href="../pages/OfficeHrs.php" class="nav-link" id="clock">
                  <i class="nav-icon fas fa-clock"></i>
                    <p>Office Hours</p>
                  </a>
                </li>
              </ul>
            </li>
          <li class="nav-item" >
            <a href="../pages/main.php" class="nav-link" id='dtr'>
              <i class="nav-icon fas fa-file-import"></i>
              <p>
                Import
              </p>
            </a>
          </li>
          <li class="nav-item" >
            <a href="../pages/generatedtr.php" class="nav-link" id='generatedtrmenu'>
              <i class="nav-icon fas fa-th"></i>
              <p>
                DTR
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../index.php" class='nav-link'>
            <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Log out
              </p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
