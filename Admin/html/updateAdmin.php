<?php
include("header.php");

if (isset($_GET['u_id'])) {
    $userId = $_GET['u_id'];
    $selectUser = "SELECT * FROM users WHERE user_id = $userId";
    $userResult = mysqli_query($connect, $selectUser);
    $userData = mysqli_fetch_assoc($userResult);
}

if (isset($_POST['updateUser'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];
    $phone_number = $_POST['phone_number'];
    $residential_address = $_POST['residential_address'];
    
    // Handle profile picture upload
    $profile_picture = $userData['profile_picture'];
    if ($_FILES['profile_picture']['name']) {
        $profile_picture = $_FILES['profile_picture']['name'];
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], "../images/$profile_picture");
    }

    $update = "UPDATE users SET 
                username = '$username',
                password = '$password',
                email = '$email',
                full_name = '$full_name',
                phone_number = '$phone_number',
                residential_address = '$residential_address',
                profile_picture = '$profile_picture'
              WHERE user_id = $userId";

    if (mysqli_query($connect, $update)) {
        echo "<script>alert('Updated successfully!'); window.location.href='manageAdmin.php';</script>";
    } else {
        echo "<script>alert('Error updating user.');</script>";
    }

    if (mysqli_query($connect, $update)) {
        // Email Notification
        $to = $email;
        $subject = "Account Details Updated";
        $message = "
            <html>
            <head>
                <title>Account Details Updated</title>
            </head>
            <body>
                <p>Dear $full_name,</p>
                <p>Your account details have been successfully updated.</p>
                <p>If you did not request these changes, please contact our support team immediately.</p>
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
            echo "<script>alert('Updated successfully and email sent!'); window.location.href='manageAdmin.php';</script>";
        } else {
            echo "<script>alert('Updated successfully, but email could not be sent.'); window.location.href='manageAdmin.php';</script>";
        }
    } else {
        echo "<script>alert('Error updating user.');</script>";
    }
    
}
?>

 <div class="bg-white rounded shadow-sm mx-6 my-4 px-3 py-3">
  <h4 style="font-weight: semibold" class=" px-2">Edit Admin</h4>
    <nav class="px-2" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="manageAdmin.php">Manage Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Admin</li>
        </ol>
    </nav>
  </div>
<!-- Form Start -->
<div class='container-fluid pb-4 pt-2'>
    <div class='row justify-content-center'>
        <div class='col-12'>
            <div class='bg-white rounded h-100 p-4 shadow-sm'>
                <form method='POST' action='' enctype='multipart/form-data' class='row g-3'>
                    <!-- Username -->
                    <div class='col-12 col-md-6'>
                        <label for='floatingInput' class='form-label'>User Name</label>
                        <input name='username' type='text' class='form-control py-3' id='floatingInput'
                            value='<?php echo $userData['username']; ?>' required>
                    </div>

                    <!-- Password -->
                    <div class='col-12 col-md-6'>
                        <label for='floatingPassword' class='form-label'>Password</label>
                        <input name='password' type='text' class='form-control py-3' id='floatingPassword'
                        value='<?php echo $userData['password']; ?>' placeholder='Enter password' required>
                    </div>

                    <!-- Email -->
                    <div class='col-12 col-md-6'>
                        <label for='floatingEmail' class='form-label'>Email</label>
                        <input name='email' type='email' class='form-control py-3' id='floatingEmail'
                            value='<?php echo $userData['email']; ?>' required>
                    </div>

                    <!-- Full Name -->
                    <div class='col-12 col-md-6'>
                        <label for='floatingFullName' class='form-label'>Full Name</label>
                        <input name='full_name' type='text' class='form-control py-3' id='floatingFullName'
                            value='<?php echo $userData['full_name']; ?>' required>
                    </div>

                    <!-- Phone Number -->
                    <div class='col-12 col-md-6'>
                        <label for='floatingPhoneNumber' class='form-label'>Phone Number</label>
                        <input name='phone_number' type='text' class='form-control py-3' id='floatingPhoneNumber'
                            value='<?php echo $userData['phone_number']; ?>' required>
                    </div>

                    <!-- Address -->
                    <div class='col-12 col-md-6'>
                        <label for='floatingAddress' class='form-label'>Residential Address</label>
                        <input name='residential_address' type='text' class='form-control py-3' id='floatingAddress'
                            value='<?php echo $userData['residential_address']; ?>' required>
                    </div>

                    <!-- Profile Picture -->
                    <div class='col-12'>
                        <label for='floatingProfilePicture' class='form-label'>Profile Picture</label>
                        <input name='profile_picture' type='file' class='form-control py-3' id='floatingProfilePicture'
                            accept='image/*'>
                        <img src="../images/<?php echo $userData['profile_picture']; ?>" alt="Current Profile Picture" width="100" class="mt-2">
                    </div>

                    <!-- Submit Button -->
                    <div class='col-12 d-flex justify-content-end'>
                        <button name='updateUser' type='submit' class='btn btn-primary'>Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Form End -->

<?php include("footer.php"); ?>
