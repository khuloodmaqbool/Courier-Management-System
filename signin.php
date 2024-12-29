<?php
// Database Connection
$connect = mysqli_connect('localhost', 'root', '', 'newcourier2',3307);

session_start();

if (isset($_SESSION['user'])) {
    header("location: ./UserPanel/html/index.php");
    exit();
}

if (isset($_POST['signinBtn'])) {
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];

    $stmt = $connect->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $uname);
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        if ($row['status'] === 'pending') {
            echo "<script>alert('Your account is currently pending approval. Please wait for confirmation or contact support for assistance.');</script>";
        } elseif (password_verify($pass, $row['password'])) {
            // Existing logic for approved users
            $_SESSION['user'] = $row['username'];
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['city'] = $row['city'];
            $_SESSION['branch_id'] = $row['branch_id'];
            $_SESSION['company_id'] = $row['company_id'];
            $_SESSION['full_name'] = $row['full_name'];
            $_SESSION['role_id'] = $row['role_id'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['profile_picture'] = $row['profile_picture'];
    
            // Redirect to User Panel
            header("location: ./UserPanel/html/index.php");
            exit();
        } else {
            echo "<script>alert('Invalid Password');</script>";
        }
    } else {
        echo "<script>alert('Username not found');</script>";
    }
    $stmt->close();
    
    
}
?>




<!doctype html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free" data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>SHIPSMART</title>

    <meta name="description" content="" />

    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
  <link rel="icon" href="images/favicon.png" type="image/x-icon">

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
        .btn-class{
          background-color: #6A6CFF;
          outline: none;
          padding: 10px 20px 10px 20px;
          border: none;
          color: white;
          border-radius: 10px;
          transition: 0.3s;
        }
        .btn-class:hover{
          background-color: #494BDA !important;
          color: white;
        }

    </style>
</head>

<body>


    <!-- navigation -->
    <header class="navigation sticky-top bg-tertiary">
        <nav class="navbar navbar-expand-xl navbar-light text-center py-1">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img loading="prelaod" decoding="async" class="img-fluid" width="160" src="images/logo1.png"
                        alt="Wallet">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item"> <a class="nav-link "
                                style="color:<?php echo $currentPage == 'index.php' ? '#6A6CFF' : ''; ?> "
                                href="index.php">Home</a>
                        </li>
                        <li class="nav-item "> <a class="nav-link"
                                style="color: <?php echo $currentPage == 'about.php' ? '#6A6CFF' : ''; ?>"
                                href="about.php">About</a>
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
                                style="color: <?php echo $currentPage == 'faq.php' ? '#6A6CFF' : ''; ?>"
                                href="faq.php">FAQ's</a>
                        </li>
                    </ul>
                    <a href="signAgent.php" class="btn-class ms-2">Sign Up as Agent</a>
                    <a href="signUp.php" class="btn-class ms-2">Sign Up as Customer</a>

                </div>
            </div>
        </nav>
    </header>
    <!-- /navigation -->



    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Login Card -->
                <div class="card px-sm-6 px-0">
                    <div class="card-body">
                        <h4 class="mb-1">Welcome to Courier Management! 👋</h4>
                        <p class="mb-6">Please sign-in to your account</p>

                        <form id="formAuthentication" method="POST" action="" onsubmit="return validateForm()">
                            <div class="mb-6">
                                <label for="uname" class="form-label">Username</label>
                                <input type="text" id="uname" name="uname" class="form-control"
                                    placeholder="Enter your email or username" autofocus />
                                <span id="unameError" class="text-danger"></span>
                            </div>

                            <div class="mb-6 form-password-toggle">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" name="pass" class="form-control"
                                        placeholder="Enter Password" />
                                    <span class="input-group-text cursor-pointer" onclick="showPass()">
                                        <i class="bx bx-hide" id="toggleIcon"></i>
                                    </span>

                                </div>
                                <span id="passwordError" class="text-danger"></span>
                            </div>

                            <button name="signinBtn" class="btn-class d-grid w-100" type="submit">Login</button>
                        </form>

                        <p class="text-center mt-4">
                            <span>New to our platform?</span>
                            <a href="signUp.php">Create an account</a>
                        </p>
                    </div>
                </div>
                <!-- End Card -->
            </div>
        </div>
    </div>
    <?php include("footer.php") ?>
    <script>
        // Client-side form validation
        // Client-side form validation
        function validateForm() {
            // Clear previous error messages
            document.getElementById('unameError').innerText = '';
            document.getElementById('passwordError').innerText = '';

            const uname = document.getElementById('uname').value;
            const password = document.getElementById('password').value;


            let isValid = true;

            // Check if the username is empty
            if (uname == "") {
                document.getElementById('unameError').innerText = "Username cannot be empty";
                isValid = false;
            }

            // Check if the password is empty
            if (password == "") {
                document.getElementById('passwordError').innerText = "Password cannot be empty";
                isValid = false;
            }

            return isValid;
        }

        // Password Show/Hide functionality
        function showPass() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.replace('bx-hide', 'bx-show');
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.replace('bx-show', 'bx-hide');
            }
        }
    </script>
