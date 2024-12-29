<?php
include('header.php');

// Get the user details
$select = "SELECT * FROM users WHERE user_id = $_SESSION[user_id]";
$query = mysqli_query($connect, $select);
$fetch = mysqli_fetch_array($query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $fetch['password'];
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];
    $phone_number = $_POST['phone_number'];
    $residential_address = $_POST['residential_address'];

    // Handle profile picture upload
    $profile_picture = $fetch['profile_picture'];
    if ($_FILES['profile_picture']['name']) {
        $profile_picture = basename($_FILES['profile_picture']['name']);
        $profile_picture = preg_replace('/[^a-zA-Z0-9._-]/', '_', $profile_picture);
        $profile_picture = time() . "_" . $profile_picture;

        if (!move_uploaded_file($_FILES['profile_picture']['tmp_name'], "../images/$profile_picture")) {
            echo "<script>alert('Failed to upload the profile picture. Please try again.');</script>";
            exit;
        }
    }

    // Update user details
    $update = "UPDATE users SET 
        username = '$username',
        password = '$password',
        email = '$email',
        full_name = '$full_name',
        phone_number = '$phone_number',
        residential_address = '$residential_address',
        profile_picture = '$profile_picture'
    WHERE user_id = '{$_SESSION['user_id']}'";

    if (mysqli_query($connect, $update)) {
        // sendEmail($email, $username);
        echo "<script>alert('Your changes have been saved successfully!'); window.location.href='accountSetting.php';</script>";
        exit;
    } else {
        echo "<script>alert('An error occurred while saving your changes. Please try again later.');</script>";
    }
}
?>

<!-- Content wrapper -->
<div class='content-wrapper'>
    <!-- Content -->
    <div class='container-xxl flex-grow-1 container-p-y'>
        <div class='row'>
            <div class='col-md-12'>
                <div class='nav-align-top'>
                    <ul class='nav nav-pills flex-column flex-md-row mb-6'>
                        <h4 class='fw-bold'>Account Setting</h4>
                    </ul>
                </div>
                <div class='card mb-6'>
                    <!-- Account -->
                    <form id='formAccountSettings' method='POST' enctype="multipart/form-data" onsubmit='return validateForm()'>
                        <div class='card-body'>
                            <div class='d-flex align-items-start align-items-sm-center gap-6 pb-4 border-bottom'>
                                <img src='../images/<?php echo $fetch['profile_picture'] ?>' alt='user-avatar'
                                    class='d-block w-px-100 h-px-100 rounded' id='uploadedAvatar' />
                                <div class='button-wrapper'>
                                    <label for='upload' class='btn btn-primary me-3 mb-4' tabindex='0'>
                                        <span class='d-none d-sm-block'>Upload new photo</span>
                                        <i class='bx bx-upload d-block d-sm-none'></i>
                                        <input name="profile_picture" type='file' id='upload' class='account-file-input'
                                            hidden accept='image/png, image/jpeg' />
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class='card-body pt-4'>
                            <div class='row g-6'>
                                <div class='col-md-6'>
                                    <label for='firstName' class='form-label'>User Name</label>
                                    <input class='form-control' value="<?php echo $fetch['username'] ?>" type='text'
                                        id='firstName' name='username' />
                                    <small id='firstNameError' style='color: red;'></small>
                                </div>
                                <div class='col-md-6'>
                                    <label for='lastName' class='form-label'>Full Name</label>
                                    <input class='form-control' value="<?php echo $fetch["full_name"] ?>" type='text'
                                        name='full_name' id='lastName' />
                                    <small id='lastNameError' style='color: red;'></small>
                                </div>
                                <div class='col-md-6'>
                                    <label for='email' class='form-label'>E-mail</label>
                                    <input class='form-control' value="<?php echo $fetch["email"] ?>" type='email'
                                        id='email' name='email' />
                                    <small id='emailError' style='color: red;'></small>
                                </div>
                                <div class='col-md-6'>
                                    <label for='phoneNumber' class='form-label'>Phone Number</label>
                                    <input value="<?php echo $fetch['phone_number'] ?>" class='form-control' type='text'
                                        id='phoneNumber' name='phone_number' />
                                    <small id='phoneNumberError' style='color: red;'></small>
                                </div>
                                <div class='col-md-6'>
                                    <label for='address' class='form-label'>Address</label>
                                    <input value="<?php echo $fetch['residential_address'] ?>" class='form-control'
                                        type='text' id='address' name='residential_address' />
                                    <small id='addressError' style='color: red;'></small>
                                </div>
                            </div>
                            <div class='mt-6'>
                                <button name="submitBtn" type='submit' class='btn btn-primary me-3'>Save changes</button>
                            </div>
                    </form>
                </div>
                <!-- /Account -->
            </div>
        </div>
    </div>
</div>

<script>
    function validateForm() {
        let isValid = true;

        // Reset all error messages
        document.getElementById('firstNameError').textContent = '';
        document.getElementById('lastNameError').textContent = '';
        document.getElementById('emailError').textContent = '';
        document.getElementById('passwordError').textContent = '';
        document.getElementById('phoneNumberError').textContent = '';
        document.getElementById('addressError').textContent = '';

        // Validate User Name
        const firstName = document.getElementById('firstName').value;
        if (!firstName || firstName.length < 2 || firstName.length > 30) {
            document.getElementById('firstNameError').textContent = 'User Name must be 2-30 characters long.';
            isValid = false;
        }

        // Validate Full Name
        const lastName = document.getElementById('lastName').value;
        if (!lastName || lastName.length < 2 || lastName.length > 50) {
            document.getElementById('lastNameError').textContent = 'Full Name must be 2-50 characters long.';
            isValid = false;
        }

        // Validate Email
        const email = document.getElementById('email').value;
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!email || !emailPattern.test(email)) {
            document.getElementById('emailError').textContent = 'Enter a valid email.';
            isValid = false;
        }

        // Validate Password
        const password = document.getElementById('password').value;
        if (password == "") {
            document.getElementById('passwordError').textContent = 'Password cannot be empty';
            isValid = false;
        }

        // Validate Phone Number
        const phoneNumber = document.getElementById('phoneNumber').value;
        const phonePattern = /^\d{10,15}$/;
        if (!phoneNumber || !phonePattern.test(phoneNumber)) {
            document.getElementById('phoneNumberError').textContent = 'Phone number must be 10-15 digits.';
            isValid = false;
        }

        // Validate Address
        const address = document.getElementById('address').value;
        if (!address) {
            document.getElementById('addressError').textContent = 'Address cannot be empty.';
            isValid = false;
        }

        return isValid;
    }

    document.getElementById('upload').addEventListener('change', function (event) {
        const file = event.target.files[0];
        if (file) {
            const validTypes = ['image/jpeg', 'image/png'];
            if (!validTypes.includes(file.type)) {
                alert('Invalid file type. Only JPG and PNG are allowed.');
                return false;
            }

            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('uploadedAvatar').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>

<?php include('footer.php'); ?>
