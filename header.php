<?php
$connect = mysqli_connect("localhost", "root", "", "newcourier2",3307);
$currentPage = basename($_SERVER['PHP_SELF']);

session_start();
?>
<!DOCTYPE html>
<html lang="en-us">

<head>
  <meta charset="utf-8">
  <title>SHIPSMART</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
  <meta name="description" content="This is meta description">
  <meta name="author" content="Themefisher">
  <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
  <link rel="icon" href="images/favicon.png" type="image/x-icon">

  <!-- theme meta -->
  <meta name="theme-name" content="wallet" />


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="./UserPanel/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="./UserPanel/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="./UserPanel/assets/vendor/css/theme-default.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="./UserPanel/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="./UserPanel/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="./UserPanel/assets/vendor/css/pages/page-auth.css" />

    <!-- Helpers -->
    <script src="./UserPanel/assets/vendor/js/helpers.js"></script>
    <script src="./UserPanel/assets/js/config.js"></script>
    <!-- # CSS Plugins -->
    <link rel="stylesheet" href="plugins/slick/slick.css">
    <link rel="stylesheet" href="plugins/font-awesome/fontawesome.min.css">
    <link rel="stylesheet" href="plugins/font-awesome/brands.css">
    <link rel="stylesheet" href="plugins/font-awesome/solid.css">

    <!-- # Main Style Sheet -->
    <link rel="stylesheet" href="css/style.css">

  <style>
    .nav-link:hover {
      color: #6A6CFF !important
    }

    .btn-class {
      background-color: #6A6CFF;
      outline: none;
      padding: 10px 20px 10px 20px;
      border: none;
      color: white;
      border-radius: 10px;

      transition: 0.3s;
    }

    .btn-class:hover {
      background-color: #494BDA !important;
      color: white;
    }

    .circle-btn {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      overflow: hidden;
      /* Ensures image stays within the circle */
      padding: 0;
      border: none;
      cursor: pointer;
    }

    .circle-btn img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      /* Ensures the image fits perfectly within the circle */
    }

    .dropdown-menu2 {
      display: none;
      /* Initially hidden */
      position: absolute;
      left: 0;
      margin-top: 5px;
    }
    
  </style>
</head>

<body>

  <!-- navigation -->
  <header class="navigation fixed-top bg-tertiary">
    <nav class="navbar navbar-expand-xl navbar-light text-center py-1">
      <div class="container">
        <a class="navbar-brand" href="index.php">
          <img loading="prelaod" decoding="async" class="img-fluid" width="160" src="images/logo1.png" alt="Wallet">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span
            class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
            <li class="nav-item"> <a class="nav-link "
                style="color:<?php echo $currentPage == 'index.php' ? '#6A6CFF' : ''; ?> " href="index.php">Home</a>
            </li>
            <li class="nav-item "> <a class="nav-link"
                style="color: <?php echo $currentPage == 'about.php' ? '#6A6CFF' : ''; ?>" href="about.php">About</a>
            </li>
            <li class="nav-item "> <a class="nav-link"
                style="color: <?php echo $currentPage == 'how-it-works.php' ? '#6A6CFF' : ''; ?>"
                href="how-it-works.php">How It Works</a>
            </li>
            <li class="nav-item "> <a class="nav-link"
                style="color: <?php echo $currentPage == 'services.php' ? '#6A6CFF' : ''; ?>"
                href="services.php">Services</a>
            </li>
            <li class="nav-item "> <a class="nav-link"
                style="color: <?php echo $currentPage == 'contact.php' ? '#6A6CFF' : ''; ?>"
                href="contact.php">Contact</a>
            </li>
            <li class="nav-item "> <a class="nav-link"
                style="color: <?php echo $currentPage == 'faq.php' ? '#6A6CFF' : ''; ?>" href="faq.php">FAQ's</a>
            </li>
          </ul>




          <?php if (!isset($_SESSION['user'])) { ?>
            <a href="signAgent.php" class="btn-class ms-2">Sign Up as Agent</a>
            <a href="signUp.php" class="btn-class ms-2">Sign Up as Customer</a>
          <?php } else { ?>
            <!-- User Profile Dropdown -->
            <div class="dropdown">
             <div class="rounded-circle d-flex justify-content-center align-items-center" 

              >
             <button class="circle-btn" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                aria-expanded="false">
                <img src="<?php
                if ($_SESSION['role_id'] == 1) {
                  echo 'Admin/images/' . $_SESSION['profile_picture'];
                } else if ($_SESSION['role_id'] == 2) {
                  echo 'Agent/images/' . $_SESSION['profile_picture'];
                } else if ($_SESSION['role_id'] == 3) {
                  echo 'UserPanel/images/' . $_SESSION['profile_picture'];
                }
                ?>" alt="User Image" >
              </button>
             </div>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                <li>
                  <!-- <a class="dropdown-item" href="#"> -->
                    <div class="d-flex">
                      <div class="flex-shrink-0 me-3">
                        <div class="avatar avatar-online">
                          <img style="width: 40px; height: 40px;" src="<?php
                          if ($_SESSION['role_id'] == 1) {
                            echo 'Admin/images/' . $_SESSION['profile_picture'];
                          } else if ($_SESSION['role_id'] == 2) {
                            echo 'Agent/images/' . $_SESSION['profile_picture'];
                          } else if ($_SESSION['role_id'] == 3) {
                            echo 'UserPanel/images/' . $_SESSION['profile_picture'];
                          }
                          ?>" alt="Profile Picture" class=" rounded-circle bg-secondary" />
                        </div>
                      </div>
                      <div class="flex-grow-1">
                        <h6 class="mb-0"><?php echo $_SESSION['full_name'] ?></h6>
                        <small class="text-muted">Agent</small>
                      </div>
                    </div>
                  <!-- </a> -->
                </li>
                <li>
                  <div class="dropdown-divider my-1"></div>
                </li>
                <li>
                  <a class="dropdown-item"
                    href="<?php
                    if ($_SESSION['role_id'] == 1) { ?>Admin/html/index.php<?php }
                     else if ($_SESSION['role_id'] == 3) { ?>UserPanel/html/index.php<?php } 
                    else if ($_SESSION['role_id'] == 2) { ?>Agent/html/index.php <?php } ?>">
                    <i class="bx bx-user bx-md me-3"></i><span>My Dashboard</span>
                  </a>
                </li>
                <li>
                  <div class="dropdown-divider my-1"></div>
                </li>
                <li>
                  <a class="dropdown-item" href="logout.php">
                    <i class="bx bx-power-off bx-md me-3"></i><span>Log Out</span>
                  </a>
                </li>
                <li class='w-100  <?php echo $currentPage == '../../index.php' ? 'active' : ''; ?>'>
                  <a href='index.php' class='menu-link my-2'>
                    <div class='text-center py-2 btn-class w-100' data-i18n='Documentation'>Back to Home</div>
                  </a>
                </li>
              </ul>
            </div>
          <?php } ?>
        </div>
      </div>
    </nav>
  </header>


  <?php if (isset($_SESSION['user'])) { ?>
    <a href="signAgent.php" class="btn-class ms-2">Sign Up as Agent</a>
    <a href="signUp.php" class="btn-class ms-2">Sign Up as Customer</a>
  <?php } else { ?>
    <h5 class="ms-3">Sign in done</h5>
  <?php } ?>
  </div>
  </div>
  </nav>
  </header>

  <!-- /navigation -->
