<?php
$connect = mysqli_connect("localhost", "root", "", "newcourier2",3307);
session_start();

if(!isset($_SESSION['user'])){
    header("location: ../../signin.php");
}
if($_SESSION['role_id'] == 2){
    header("location: ../../Agent/html/index.php");
}else if($_SESSION['role_id'] == 3){
  header("location:  ../../UserPanel/html/index.php ");
}

$currentPage = basename($_SERVER['PHP_SELF']);  // to get current page 

?>

<!doctype html>

<html
  lang="en"
  class="light-style layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
  data-style="light">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

      <title>SHIPSMART</title>

<meta name='description' content='' />

<!-- Favicon -->
<!-- <link rel='icon' type='image/x-icon' href='../assets/img/favicon/favicon.ico' /> -->
<link rel="icon" href="../../images/favicon.png" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class='app-brand demo'>
          <a href='index.php' class='app-brand-link'>
            <img style="width: 100%; height: 70px;" src="../images/logo.png" alt="Logo">
          </a>

          <a href='javascript:void(0);' class='layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none'>
            <i class='bx bx-chevron-left bx-sm d-flex align-items-center justify-content-center'></i>
          </a>
        </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">

            <li class="menu-item <?php echo $currentPage == 'index.php' ? 'active' : ''; ?> ">
              <a href="index.php" class="menu-link">
                <i class="fa fa-home me-2"></i>
                <div class="text-truncate" data-i18n="Tables">Dashboard</div>
              </a>
            </li>

            <li class="menu-item <?php echo $currentPage == 'pendingAgents.php' ? 'active' : ''; ?> ">
              <a href="pendingAgents.php" class="menu-link">
                <i class="fa fa-users me-2"></i>
                <div class="text-truncate" data-i18n="Tables">Pending Agents</div>
              </a>
            </li>

            <li class="menu-item <?php echo $currentPage == 'manageCity.php' ? 'active' : ''; ?> ">
              <a href="manageCity.php" class="menu-link">
                <i class="fa fa-city me-2"></i>
                <div class="text-truncate" data-i18n="Tables">Manage Cities</div>
              </a>
            </li>

            <li class="menu-item <?php echo $currentPage == 'manageBranch.php' ? 'active' : ''; ?> ">
              <a href="manageBranch.php" class="menu-link">
                <i class="fa fa-building me-2"></i>
                <div class="text-truncate" data-i18n="Tables">Manage Branches</div>
              </a>
            </li>

            <li class="menu-item <?php echo $currentPage == 'manageCompany.php' ? 'active' : ''; ?> ">
              <a href="manageCompany.php" class="menu-link">
                <i class="fa fa-industry me-2"></i>
                <div class="text-truncate" data-i18n="Tables">Manage Companies</div>
              </a>
            </li>

            <li class="menu-item <?php echo $currentPage == 'manageAdmin.php' ? 'active' : ''; ?> ">
              <a href="manageAdmin.php" class="menu-link">
                <i class="fa fa-user-shield me-2"></i>
                <div class="text-truncate" data-i18n="Tables">Manage Admin</div>
              </a>
            </li>

            <li class="menu-item <?php echo $currentPage == 'manageAgent.php' ? 'active' : ''; ?> ">
              <a href="manageAgent.php" class="menu-link">
                <i class="fa fa-users me-2"></i>
                <div class="text-truncate" data-i18n="Tables">Manage Agent</div>
              </a>
            </li>

            <li class="menu-item <?php echo $currentPage == 'manageUser.php' ? 'active' : ''; ?> ">
              <a href="manageUser.php" class="menu-link">
                <i class="fa fa-user me-2"></i>
                <div class="text-truncate" data-i18n="Tables">Manage User</div>
              </a>
            </li>


            <li class="menu-item <?php echo $currentPage == 'manageCourier.php' ? 'active' : ''; ?> ">
              <a href="manageCourier.php" class="menu-link">
                <i class="fa fa-truck me-2"></i>
                <div class="text-truncate" data-i18n="Tables">Manage Courier</div>
              </a>
            </li>
            
            <li class="menu-item <?php echo $currentPage == 'messages.php' ? 'active' : ''; ?> ">
              <a href="messages.php" class="menu-link">
                <i class="fa fa-comment me-2"></i>
                <div class="text-truncate" data-i18n="Tables">Messages</div>
              </a>
            </li>



          
            <!-- Misc -->
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Setting</span></li>
           
           
            <li class="menu-item <?php echo $currentPage == 'accountSetting.php' ? 'active' : ''; ?> ">
              <a
                href="accountSetting.php"
                class="menu-link">
                <i class="menu-icon tf-icons fa fa-cog"></i>
                <div class="text-truncate" data-i18n="Documentation">Account Setting</div>
              </a>
            </li>
            <li class='menu-item <?php echo $currentPage == '../../logout.php' ? 'active' : ''; ?> '>
            <a href='../../logout.php' class='menu-link'>
              <i class='menu-icon tf-icons fa fa-sign-out'></i>
              <div class='text-truncate' data-i18n='Documentation'>Log Out</div>
            </a>
          </li>
          <li class='w-100  <?php echo $currentPage == '../../index.php' ? 'active' : ''; ?>'>
            <a href='../../index.php' class='menu-link mx-3 mt-2'>
              <div class='text-truncate btn btn-primary w-100' data-i18n='Documentation'>Back to Home</div>
              </a>
          </li>

          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar">
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                <i class="bx bx-menu bx-md"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

              <ul class="navbar-nav flex-row align-items-center ms-auto">
    

              

            <!-- User -->
            <li class='nav-item navbar-dropdown dropdown-user dropdown'>
                <a class='nav-link dropdown-toggle hide-arrow p-0' href='javascript:void(0);' data-bs-toggle='dropdown'>
                  <div class='avatar avatar-online'>
                    <img src="../images/<?php echo $_SESSION['profile_picture']; ?>" alt class='w-px-40 h-100 rounded-circle' />
                  </div>
                </a>
                <ul class='dropdown-menu dropdown-menu-end'>
                  <li>
                    <!-- <a class='dropdown-item' href='#'> -->
                      <div class='d-flex ms-2'>
                        <div class='flex-shrink-0 me-3'>
                          <div class='avatar avatar-online'>
                          <img src="../images/<?php echo $_SESSION['profile_picture']; ?>" alt="Profile Picture" class="w-px-40 h-100 rounded-circle" />
                          </div>
                        </div>
                        <div class='flex-grow-1'>
                          <h6 class='mb-0'><?php echo  $_SESSION['full_name'] ?></h6>
                          <small class='text-muted'>Admin</small>
                        </div>
                      </div>
                    <!-- </a> -->
                  </li>
                  <li>
                    <div class='dropdown-divider my-1'></div>
                  </li>
                  <li>
                    <a class='dropdown-item' href='index.php'>
                      <i class='bx bx-user bx-md me-3'></i><span>My Dashboard</span>
                    </a>
                  </li>
              
                 
                  <li>
                    <div class='dropdown-divider my-1'></div>
                  </li>
                  <li>
                    <a class='dropdown-item' href='../../logout.php'>
                      <i class='bx bx-power-off bx-md me-3'></i><span>Log Out</span>
                    </a>
                  </li>
                  <li class='w-100  <?php echo $currentPage == '../../index.php' ? 'active' : ''; ?>'>
                    <a href='../../index.php' class='menu-link mx-3 my-2'>
                      <div class='text-truncate btn btn-primary w-100' data-i18n='Documentation'>Back to Home</div>
                    </a>
                  </li>
                </ul>
              </li>
              <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->
