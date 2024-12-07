<?php
include("header.php");

// Check database connection
if (!$connect) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>
<h5 style="font-weight: semibold" class="py-4 px-2">Add New User</h5>
<nav class="px-2" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="viewUser.php">Manage User</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add new User</li>
  </ol>
</nav>
<!-- Form Start -->



<div class="container-fluid pb-4 pt-2">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4 shadow-sm">

            <form method="POST" enctype="multipart/form-data" class="row g-3">
            
                    
                    <div class="col-12 col-md-6">
                        <label for="floatingInput" class="form-label">User Name</label>
                        <input name="username" type="text" class="form-control py-3" id="floatingInput" placeholder="Enter username" required>
                    </div>
                    
                    <div class="col-12 col-md-6">
                        <label for="floatingPassword" class="form-label">Password</label>
                        <input name="password" type="text" class="form-control py-3" id="floatingPassword" placeholder="Enter password" required>
                    </div>
                    
                    <div class="col-12 col-md-6">
                        <label for="floatingEmail" class="form-label">Email</label>
                        <input name="email" type="email" class="form-control py-3" id="floatingEmail" placeholder="Enter email" required>
                    </div>
                    
                    <div class="col-12 col-md-6">
                        <label for="floatingFullName" class="form-label">Full Name</label>
                        <input name="full_name" type="text" class="form-control py-3" id="floatingFullName" placeholder="Enter full name" required>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="floatingPhoneNumber" class="form-label">Phone Number</label>
                        <input name="phone_number" type="text" class="form-control py-3" id="floatingPhoneNumber" placeholder="Enter phone number" required>
                    </div>
                    <div class="text-center d-flex justify-content-end">
                        <button name="userSubmit" type="submit" class="btn btn-primary">Add User</button>
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
    $residential_address = NULL;
    $role_id = 3;
    $branch_id = NULL;
    $company_id = NULL;
    $profile_picture = NULL;

    // Insert data into database
    $insert = "INSERT INTO `users` (`username`, `password`, `email`, `full_name`, `phone_number`, `residential_address`, `profile_picture`, `role_id`, `branch_id`, `company_id`) 
               VALUES ('$username', '$password', '$email', '$full_name', '$phone_number', '$residential_address', '$profile_picture', '$role_id', '$branch_id', '$company_id')";

    if (mysqli_query($connect, $insert)) {
        echo "<script>
                alert('User Added Successfully!');
                // window.location.href = 'viewUsers.php';
              </script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($connect) . "');</script>";
    }
}
?>

<?php include("footer.php"); ?>
