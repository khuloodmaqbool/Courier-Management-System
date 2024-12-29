<?php
$connect = mysqli_connect('localhost', 'root', '', 'newcourier2',3307);

// Check Database Connection
if (mysqli_connect_errno()) {
    echo "<div class='alert alert-danger'>Failed to connect to Database: " . mysqli_connect_error() . "</div>";
    exit();
}
// Fetch cities
$selectCities = "SELECT * FROM `cities`";
$queryCities = mysqli_query($connect, $selectCities);

// Fetch companies
$selectCompanies = "SELECT * FROM `companies`";
$queryCompanies = mysqli_query($connect, $selectCompanies);

// Fetch branches
$selectBranches = "SELECT * FROM `branches`";
$queryBranches = mysqli_query($connect, $selectBranches);


$branchesData = [];
$companiesData = [];

// Store branches data
while ($branch = mysqli_fetch_assoc($queryBranches)) {
    $branchesData[] = $branch;
}



// Store companies data
while ($company = mysqli_fetch_assoc($queryCompanies)) {
    $companiesData[] = $company;
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
        <div class="container-p-y">
            <div class="authentication-inner row">
                <div class=" col-lg-6">
                    <img style="width:80%;" src="images/sign-up.png" alt="">
                </div>
                <!-- Register Card -->
                <div class="card px-sm-6 px-0 col-lg-6 shadow-none border-0">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center mb-6">
                            <a href="index.html" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">

                                </span>
                                <!-- <span class="app-brand-text demo text-heading fw-bold">sneat</span> -->
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-1">Become an Agent and Empower Your Career</h4>
                        <p class="mb-6">Join our network and start managing courier deliveries today!</p>

                        <form method="POST" enctype="multipart/form-data" class="row g-3">
                            <div class="mb-6 col-md-6">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="user_name"
                                    placeholder="Enter your username" autofocus />
                            </div>

                            <div class="mb-6 col-md-6">
                                <label for="fullname" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="fullname" name="full_name"
                                    placeholder="Enter your full name" autofocus />
                            </div>

                            <div class="mb-6 col-md-6">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number"
                                    placeholder="Enter your phone number" autofocus />
                            </div>

                            <div class="mb-6 col-md-6">
                                <label for="residential_address" class="form-label">Residential Address</label>
                                <input type="text" class="form-control" id="residential_address"
                                    name="residential_address" placeholder="Enter your address" autofocus />
                            </div>

                            <div class="mb-6 col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Enter your email" />
                            </div>

                            <div class="mb-6 col-md-6">
                                <label for="profile" class="form-label">Profile Picture</label>
                                <input type="file" name="profile_picture" id="profilePic" class="form-control">
                            </div>

                            <div class="mb-6 col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="pass" class="form-control" name="pass"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                            </div>

                            <div class="mb-6 col-md-6">
                                <label for="city" class="form-label">City</label>
                                <select name="city_id" id="city" class="form-select text-secondary" required>
                                    <option selected disabled>Select City</option>
                                    <?php while ($city = mysqli_fetch_assoc($queryCities)) { ?>
                                        <option value="<?php echo $city['city_id']; ?>"><?php echo $city['city_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="mb-6 col-md-6">
                                <label for="company_id" class="form-label">Company</label>
                                <select name="company_id" id="company_id" class="form-select text-secondary" required>
                                    <option selected disabled>Select Company</option>
                                </select>
                            </div>

                            <div class="mb-6 col-md-6">
                                <label for="branch_id" class="form-label">Branches</label>
                                <select name="branch_id" id="branch_id" class="form-select text-secondary" required>
                                    <option selected disabled>Select Branch</option>
                                </select>
                            </div>

                            <!-- <div class="my-8">
                                <div class="form-check mb-0 ms-2">
                                    <input class="form-check-input" type="checkbox" id="terms-conditions"
                                        name="terms" />
                                    <label class="form-check-label" for="terms-conditions">
                                        I agree to
                                        <a href="javascript:void(0);">privacy policy & terms</a>
                                    </label>
                                </div>
                            </div> -->

                            <button name="userSubmit" type="submit" class=" d-grid  btn-class">Sign
                                up</button>
                        </form>


                        <p class="text-center mt-4">
                            <span>Already have an account?</span>
                            <a href="signin.php">
                                <span>Sign in instead</span>
                            </a>
                        </p>
                    </div>
                </div>
                <!-- Register Card -->
            </div>
        </div>
    </div>

    <!-- / Content -->
    <?php include("footer.php") ?>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag before closing body tag for github widget button. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- jQuery for dynamic filtering -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            const branches = <?php echo json_encode($branchesData); ?>;
            const companies = <?php echo json_encode($companiesData); ?>;

            // Filter companies based on city
            $('#city').on('change', function () {
                const cityId = $(this).val();
                $('#company_id').html('<option selected disabled>Select Company</option>');
                $('#branch_id').html('<option selected disabled>Select Branch</option>');
                $('#user_id').html('<option selected disabled>Select Agent</option>');

                // Populate companies
                companies.forEach(company => {
                    if (company.city_id == cityId) {
                        $('#company_id').append(`<option value="${company.company_id}">${company.company_name}</option>`);
                    }
                });
            });

            // Filter branches based on company
            $('#company_id').on('change', function () {
                const companyId = $(this).val();
                $('#branch_id').html('<option selected disabled>Select Branch</option>');
                $('#user_id').html('<option selected disabled>Select Agent</option>');
                branches.forEach(branch => {
                    if (branch.company_id == companyId) {
                        $('#branch_id').append(`<option value="${branch.branch_id}">${branch.branch_name}</option>`);
                    }
                });
            });
        });



        document.querySelector('form').addEventListener('submit', function (event) {
            let isValid = true;

            // Clear previous errors
            document.querySelectorAll('.error-msg').forEach(error => error.remove());

            // Validate Username
            const username = document.getElementById('username');
            const usernameRegex = /^[a-zA-Z0-9_]{5,25}$/; // Allow 5-15 alphanumeric or underscore
            if (!usernameRegex.test(username.value)) {
                isValid = false;
                showError(username, 'Username must be 5-15 characters long and contain only letters, numbers, or underscores.');
            }

            // Validate Full Name
            const fullname = document.getElementById('fullname');
            const fullnameRegex = /^[a-zA-Z\s]{2,50}$/; // Allow only letters and spaces, 2-50 characters
            if (!fullnameRegex.test(fullname.value)) {
                isValid = false;
                showError(fullname, 'Full Name must be 2-50 characters long and contain only letters and spaces.');
            }

            // Validate Phone Number
            const phone = document.getElementById('phone_number');
            const phoneRegex = /^[0-9]{10,15}$/; // Allow 10-15 digits
            if (!phoneRegex.test(phone.value)) {
                isValid = false;
                showError(phone, 'Phone Number must be 10-15 digits long.');
            }

            // Validate Email
            const email = document.getElementById('email');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Basic email validation
            if (!emailRegex.test(email.value)) {
                isValid = false;
                showError(email, 'Enter a valid email address.');
            }

            // Validate Password
            const password = document.getElementById('pass');
            const passwordRegex = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/; // Minimum 8 characters, 1 letter, 1 number
            if (!passwordRegex.test(password.value)) {
                isValid = false;
                showError(password, 'Password must be at least 8 characters long, including 1 letter and 1 number.');
            }


            // Resedential Address
            const address = document.getElementById('residential_address');
            const addressRegex = /^[a-zA-Z0-9\s,.'-]{10,}$/; // Minimum 8 characters, 1 letter, 1 number
            if (!addressRegex.test(address.value)) {
                isValid = false;
                showError(address, "Please enter a valid address with at least 10 characters.");
            }


            const city = document.getElementById('city');
    if (city.value === "Select City" || city.value === null) {
        isValid = false;
        showError(city, 'Please select a city.');
    }

    // Validate Company selection
    const company = document.getElementById('company_id');
    if (company.value === "Select Company" || company.value === null) {
        isValid = false;
        showError(company, 'Please select a company.');
    }

    // Validate Branch selection
    const branch = document.getElementById('branch_id');
    if (branch.value === "Select Branch" || branch.value === null) {
        isValid = false;
        showError(branch, 'Please select a branch.');
    }





  // Validate Profile Picture
  const profilePic = document.getElementById('profilePic');
    const file = profilePic.files[0];
    if (file) {
        const fileType = file.type.split('/')[0];
        const fileSize = file.size / 1024 / 1024; // size in MB

        // Check if the file is an image and its size is less than 2MB
        if (fileType !== 'image') {
            isValid = false;
            showError(profilePic, 'Please upload a valid image file.');
        } else if (fileSize > 2) {
            isValid = false;
            showError(profilePic, 'Profile picture must be less than 2MB.');
        }
    } else {
        isValid = false;
        showError(profilePic, 'Please upload a profile picture.');
    }

    if (!isValid) {
        event.preventDefault();
    }
});

        function showError(input, message) {
            const error = document.createElement('div');
            error.className = 'error-msg';
            error.style.color = 'red';
            error.style.fontSize = '12px';
            error.textContent = message;
            input.parentElement.appendChild(error);
        }



    </script>

<?php
if (isset($_POST['userSubmit'])) {
    // Sanitize and fetch input values
    $username = mysqli_real_escape_string($connect, $_POST['user_name']);
    $pass = $_POST['pass'];
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $full_name = mysqli_real_escape_string($connect, $_POST['full_name']);
    $residential_address = mysqli_real_escape_string($connect, $_POST['residential_address']);
    $phone_number = mysqli_real_escape_string($connect, $_POST['phone_number']);
    $branch_id = mysqli_real_escape_string($connect, $_POST['branch_id']);
    $company_id = mysqli_real_escape_string($connect, $_POST['company_id']);
    $city_id = mysqli_real_escape_string($connect, $_POST['city_id']);
    $status = mysqli_real_escape_string($connect, "pending");

    // Password encryption
    $encryptPass = password_hash($pass, PASSWORD_BCRYPT);
    $role_id = 2;

    // Handle profile picture upload,
    $profile_picture = $_FILES['profile_picture']['name'];
    $profile_picture_tmp = $_FILES['profile_picture']['tmp_name'];
    $profile_picture_path = './Agent/images/' . $profile_picture;

    if (!empty($profile_picture)) {
        move_uploaded_file($profile_picture_tmp, $profile_picture_path);
    } else {
        $profile_picture = null; // Handle case where no image is uploaded
    }

    // Check if the username already exists
    $sel = "SELECT * FROM users WHERE username = '$username'";
    $q = mysqli_query($connect, $sel);

    if (mysqli_num_rows($q) > 0) {
        echo "<div class='alert alert-danger'>Username already exists!</div>";
    } else {
        // Insert query
        $insert = "INSERT INTO `users` (`username`, `password`, `email`, `full_name`, `phone_number`, `residential_address`, `city`, `profile_picture`, `role_id`, `branch_id`, `company_id` , `status`) 
                   VALUES ('$username', '$encryptPass', '$email', '$full_name', '$phone_number', '$residential_address', '$city_id', '$profile_picture', '$role_id', '$branch_id', '$company_id' , '$status')";

        // Execute insert query
        if (mysqli_query($connect, $insert)) {
            echo "<script>alert('Your account is currently under review or awaiting approval. An email has been sent to notify you about account approval.'); window.location.href = 'signin.php';</script>";
        } else {
            echo "<div class='alert alert-danger'>Failed to create account: " . mysqli_error($connect) . "</div>";
        }
    }
}
?>