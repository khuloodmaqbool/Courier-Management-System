<?php
include('header.php');

// Check database connection
if (!$connect) {
    die('Database connection failed: ' . mysqli_connect_error());
}

// Fetch roles, branches, and companies
$query1 = mysqli_query($connect, 'SELECT * FROM `roles`');
?>

<div class='container-fluid'>
    <div class="bg-white p-2 rounded my-4">
        <h5 style="font-weight: semibold" class="py-4 px-2 fs-4 fw-bold">Add New Admin</h5>
        <nav class="px-2" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="manageAdmin.php">Manage Admin</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add new Admin</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Form Start -->
<div class=' container-fluid pb-4 pt-2'>
    <div class='row justify-content-center'>
        <div class='col-12'>
            <div class='bg-white rounded h-100 p-4 shadow-sm'>
                <form method='POST' enctype='multipart/form-data' class='row g-3' onsubmit="return validateForm()">

                    <!-- Username -->
                    <div class='col-12 col-md-6'>
                        <label for='floatingInput' class='form-label'>User Name</label>
                        <input name='username' type='text' class='form-control py-3' id='floatingInput'
                            placeholder='Enter username' required>
                        <span id="usernameError" class="text-danger"></span>
                    </div>

                    <!-- Password -->
                    <div class='col-12 col-md-6'>
                        <label for='floatingPassword' class='form-label'>Password</label>
                        <input name='password' type='password' class='form-control py-3' id='floatingPassword'
                            placeholder='Enter password' required>
                        <span id="passwordError" class="text-danger"></span>
                    </div>

                    <!-- Email -->
                    <div class='col-12 col-md-6'>
                        <label for='floatingEmail' class='form-label'>Email</label>
                        <input name='email' type='email' class='form-control py-3' id='floatingEmail'
                            placeholder='Enter email' required>
                        <span id="emailError" class="text-danger"></span>
                    </div>

                    <!-- Full Name -->
                    <div class='col-12 col-md-6'>
                        <label for='floatingFullName' class='form-label'>Full Name</label>
                        <input name='full_name' type='text' class='form-control py-3' id='floatingFullName'
                            placeholder='Enter full name' required>
                        <span id="fullNameError" class="text-danger"></span>
                    </div>

                    <!-- Phone Number -->
                    <div class='col-12 col-md-6'>
                        <label for='floatingPhoneNumber' class='form-label'>Phone Number</label>
                        <input name='phone_number' type='text' class='form-control py-3' id='floatingPhoneNumber'
                            placeholder='Enter phone number' required>
                        <span id="phoneNumberError" class="text-danger"></span>
                    </div>

                    <!-- Address -->
                    <div class='col-12 col-md-6'>
                        <label for='floatingAddress' class='form-label'>Residential Address</label>
                        <input name='residential_address' type='text' class='form-control py-3' id='floatingAddress'
                            placeholder='Enter address' required>
                        <span id="addressError" class="text-danger"></span>
                    </div>

                    <!-- Profile Picture -->
                    <div class='col-12'>
                        <label for='floatingProfilePicture' class='form-label'>Profile Picture</label>
                        <input name='profile_picture' type='file' class='form-control py-3' id='floatingProfilePicture'
                            accept='image/*'>
                        <span id="profilePictureError" class="text-danger"></span>
                    </div>

                    <!-- Submit Button -->
                    <div class='col-12 d-flex justify-content-end text-center'>
                        <button name='userSubmit' type='submit' class='btn btn-primary'>Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Form End -->

<?php
if (isset($_POST['userSubmit'])) {
    // Collect form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];
    $phone_number = $_POST['phone_number'];
    $residential_address = $_POST['residential_address'];
    $role_id = 1;
    $encryptPass = password_hash($password, PASSWORD_BCRYPT);

    // Profile picture upload handling
    $profile_picture = $_FILES['profile_picture']['name'];
    $profile_picture_tmp = $_FILES['profile_picture']['tmp_name'];
    $profile_picture_path = '../images/' . $profile_picture;
    move_uploaded_file($profile_picture_tmp, $profile_picture_path);

    // Insert data into database
    $insert = "INSERT INTO `users` (`username`, `password`, `email`, `full_name`, `phone_number`, `residential_address`, `profile_picture`, `role_id`) 
               VALUES ('$username', '$encryptPass', '$email', '$full_name', '$phone_number', '$residential_address', '$profile_picture', '$role_id')";

    if (mysqli_query($connect, $insert)) {
        echo "<script>
                alert('Admin Added Successfully!');
                window.location.href = 'manageAdmin.php';
              </script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($connect) . "');</script>";
    }


    // Mail
    if (mysqli_query($connect, $insert)) {
        // Send email notification
        $to = $email;
        $subject = "Admin Account Created";
        $message = "
        <html>
        <head>
            <title>Admin Account Created</title>
        </head>
        <body>
            <p>Dear $full_name,</p>
            <p>Your admin account has been successfully created.</p>
            <p>Username: <b>$username</b></p>
            <p>Please log in to your account to manage the system.</p>
            <br>
            <p>Best regards,</p>
            <p>Courier Management System</p>
        </body>
        </html>
    ";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: no-reply@yourdomain.com" . "\r\n";

        if (mail($to, $subject, $message, $headers)) {
            echo "<script>
                alert('Admin Added Successfully and Email Sent!');
                window.location.href = 'manageAdmin.php';
              </script>";
        } else {
            echo "<script>
                alert('Admin Added Successfully, but Email Could Not Be Sent.');
                window.location.href = 'manageAdmin.php';
              </script>";
        }
    } else {
        echo "<script>alert('Error: " . mysqli_error($connect) . "');</script>";
    }

}
?>

<script>
    function validateForm() {
        let valid = true;

        // Clear previous errors
        document.getElementById('usernameError').innerText = '';
        document.getElementById('passwordError').innerText = '';
        document.getElementById('emailError').innerText = '';
        document.getElementById('fullNameError').innerText = '';
        document.getElementById('phoneNumberError').innerText = '';
        document.getElementById('addressError').innerText = '';
        document.getElementById('profilePictureError').innerText = '';

        // Username validation (at least 4 characters, only letters, no spaces or numbers)
        const username = document.getElementById('floatingInput').value;
        const usernameRegex = /^[a-zA-Z]{4,}$/; // Only letters and at least 4 characters
        if (!usernameRegex.test(username)) {
            document.getElementById('usernameError').innerText = 'Username should be at least 4 letters long and contain only letters.';
            valid = false;
        }

        // Password validation (at least 6 characters)
        const password = document.getElementById('floatingPassword').value;
        if (password.length < 6) {
            document.getElementById('passwordError').innerText = 'Password should be at least 6 characters long.';
            valid = false;
        }

        // Email validation (basic email format)
        const email = document.getElementById('floatingEmail').value;
        const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailRegex.test(email)) {
            document.getElementById('emailError').innerText = 'Please enter a valid email address.';
            valid = false;
        }

        // Full Name validation (should contain only letters and spaces, and at least two words)
        const fullName = document.getElementById('floatingFullName').value;
        const fullNameRegex = /^[A-Za-z\s]+$/; // Allows spaces for first and last name
        const fullNameWords = fullName.trim().split(/\s+/).length;
        if (!fullNameRegex.test(fullName) || fullNameWords < 2) {
            document.getElementById('fullNameError').innerText = 'Full Name should contain only letters and spaces, and must include at least two words.';
            valid = false;
        }

        // Phone Number validation (numbers only, 11 digits)
        const phoneNumber = document.getElementById('floatingPhoneNumber').value;
        const phoneNumberRegex = /^[0-9]{11}$/;
        if (!phoneNumberRegex.test(phoneNumber)) {
            document.getElementById('phoneNumberError').innerText = 'Phone Number should be 11 digits.';
            valid = false;
        }

        // Residential Address validation (at least 12 characters)
        const address = document.getElementById('floatingAddress').value;
        if (address.length < 12) {
            document.getElementById('addressError').innerText = 'Residential Address should be at least 12 characters long.';
            valid = false;
        }

        // Profile Picture validation (file selected)
        const profilePicture = document.getElementById('floatingProfilePicture').files.length;
        if (profilePicture === 0) {
            document.getElementById('profilePictureError').innerText = 'Please select a profile picture.';
            valid = false;
        }

        return valid;
    }
</script>

<?php include('footer.php'); ?>