<?php
include("header.php");

// Get the user ID from the query parameter
if (isset($_GET['u_id'])) {
    $user_id = $_GET['u_id'];

    // Fetch the user's current details
    $select = "SELECT 
        u.user_id, 
        u.username, 
        u.password, 
        u.email, 
        u.full_name, 
        u.phone_number, 
        u.residential_address, 
        u.profile_picture,
        u.branch_id, 
        u.company_id,
        r.role_name, 
        b.branch_name, 
        c.company_name
    FROM 
        users u
    INNER JOIN 
        roles r ON u.role_id = r.role_id
    INNER JOIN 
        branches b ON u.branch_id = b.branch_id
    INNER JOIN 
        companies c ON u.company_id = c.company_id
    WHERE u.user_id = $user_id";

    $result = mysqli_query($connect, $select);
    $fetch = mysqli_fetch_array($result);

    // Handle form submission
    if (isset($_POST['updateSubmit'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $fullName = $_POST['full_name'];
        $phoneNumber = $_POST['phone_number'];
        $address = $_POST['residential_address'];
        $company_id = $_POST['company_id'];
        $branch_id = $_POST['branch_id'];

        // Profile picture upload
        if (!empty($_FILES['profile_picture']['name'])) {
            $profilePicture = $_FILES['profile_picture']['name'];
            $targetDir = "../../Agent/images/";
            $targetFile = $targetDir . basename($profilePicture);
            move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFile);
        } else {
            $profilePicture = $fetch['profile_picture'];
        }

        // Encrypt the password only if it has changed
        $hashedPassword = ($password !== $fetch['password']) ? password_hash($password, PASSWORD_BCRYPT) : $fetch['password'];

        // Detect changes
        $changes = [];
        if ($username !== $fetch['username'])
            $changes['Username'] = [$fetch['username'], $username];
        if ($email !== $fetch['email'])
            $changes['Email'] = [$fetch['email'], $email];
        if ($password !== $fetch['password'])
            $changes['Password'] = ['******', '******'];
        if ($fullName !== $fetch['full_name'])
            $changes['Full Name'] = [$fetch['full_name'], $fullName];
        if ($phoneNumber !== $fetch['phone_number'])
            $changes['Phone Number'] = [$fetch['phone_number'], $phoneNumber];
        if ($address !== $fetch['residential_address'])
            $changes['Residential Address'] = [$fetch['residential_address'], $address];
        if ($company_id !== $fetch['company_id'])
            $changes['Company'] = [$fetch['company_name'], $company_id];
        if ($branch_id !== $fetch['branch_id'])
            $changes['Branch'] = [$fetch['branch_name'], $branch_id];
        if ($profilePicture !== $fetch['profile_picture'])
            $changes['Profile Picture'] = ['Old Picture', 'New Picture'];

        // Update the database if there are changes
        if (!empty($changes)) {
            $updateAgent = "UPDATE users SET 
                username = '$username',
                email = '$email',
                `password` = '$hashedPassword',
                full_name = '$fullName',
                phone_number = '$phoneNumber',
                residential_address = '$address',
                profile_picture = '$profilePicture',
                company_id = '$company_id',
                branch_id = '$branch_id'
                WHERE user_id = '$user_id'";

            if (mysqli_query($connect, $updateAgent)) {
                // Prepare email content
                $changeDetails = "The following changes were made:\n\n";
                foreach ($changes as $field => $values) {
                    $changeDetails .= "$field: From '{$values[0]}' to '{$values[1]}'\n";
                }

                $to = $email;
                $subject = "Your Agent Account Has Been Updated";
                $message = "Hello $fullName,\n\n" . $changeDetails . "\nThank you!";
                $headers = "From: admin@example.com";

                // Send email
                if (mail($to, $subject, $message, $headers)) {
                    echo "<script>
                        alert('Agent details updated successfully and email sent!');
                        window.location.href = 'manageAgent.php';
                    </script>";
                } else {
                    echo "<script>alert('Update successful, but email sending failed.');</script>";
                }
            } else {
                echo "<script>alert('Error updating agent details.');</script>";
            }
        } else {
            echo "<script>alert('No changes detected. Update not performed.');</script>";
        }
    }
}
?>

<!-- HTML Form for Editing Agent Details -->
<div class="bg-white rounded shadow-sm mx-6 my-4 px-3 py-3">
    <h4 style="font-weight: semibold" class=" px-2">Edit Agent</h4>
    <nav class="px-2" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="manageAgent.php">Manage Agent</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Agent</li>
        </ol>
    </nav>
</div>
<div class="container-fluid pb-4 pt-2">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="bg-white rounded h-100 p-4 shadow-sm">
                <form method="POST" action="" enctype="multipart/form-data" class="row g-3">
                    <!-- Input fields for user details -->
                    <div class="col-12 col-md-6">
                        <label for="username" class="form-label">User Name</label>
                        <input name="username" type="text" class="form-control py-3" id="username" value="<?php echo $fetch['username']; ?>" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input name="password" type="password" class="form-control py-3" id="password" value="<?php echo $fetch['password']; ?>" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input name="email" type="email" class="form-control py-3" id="email" value="<?php echo $fetch['email']; ?>" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="full_name" class="form-label">Full Name</label>
                        <input name="full_name" type="text" class="form-control py-3" id="full_name" value="<?php echo $fetch['full_name']; ?>" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input name="phone_number" type="text" class="form-control py-3" id="phone_number" value="<?php echo $fetch['phone_number']; ?>" required>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="residential_address" class="form-label">Residential Address</label>
                        <input name="residential_address" type="text" class="form-control py-3" id="residential_address" value="<?php echo $fetch['residential_address']; ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="profile_picture" class="form-label">Profile Picture</label>
                        <input name="profile_picture" type="file" class="form-control py-3" id="profile_picture" accept="image/*">
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="companySelect" class="form-label">Company</label>
                        <select name="company_id" class="form-select py-3" id="companySelect" required>
                            <?php
                            $sel_company = "SELECT * FROM `companies`";
                            $query_company = mysqli_query($connect, $sel_company);

                            while ($fetch_company = mysqli_fetch_assoc($query_company)) { ?>
                                <option value="<?php echo $fetch_company['company_id']; ?>" <?php if ($fetch['company_id'] == $fetch_company['company_id']) echo "selected"; ?>>
                                    <?php echo $fetch_company['company_name']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label for="branchSelect" class="form-label">Branch</label>
                        <select name="branch_id" class="form-select py-3" id="branchSelect" required>
                            <?php
                            $sel_branch = "SELECT * FROM `branches`";
                            $query_branch = mysqli_query($connect, $sel_branch);

                            while ($fetch_branch = mysqli_fetch_assoc($query_branch)) { ?>
                                <option value="<?php echo $fetch_branch['branch_id']; ?>" <?php if ($fetch['branch_id'] == $fetch_branch['branch_id']) echo "selected"; ?>>
                                    <?php echo $fetch_branch['branch_name']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-12 d-flex justify-content-end text-center">
                        <button name="updateSubmit" type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    togglePassword.addEventListener('click', function () {
        const type = passwordInput.type === 'password' ? 'text' : 'password';
        passwordInput.type = type;
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
    });
</script>

<?php include("footer.php"); ?>