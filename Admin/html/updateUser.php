<?php
include('header.php');

if (!$connect) {
  die('Database connection failed: ' . mysqli_connect_error());
}
if (isset($_GET['u_id'])) {
  $u_id = $_GET['u_id'];
  $select = "SELECT * FROM `users` WHERE `user_id` = '$u_id'";
  $u_row = mysqli_query($connect, $select);
  $fetch = mysqli_fetch_assoc($u_row);

  ?>

<div class="bg-white rounded shadow-sm mx-6 my-4 px-3 py-3">
  <h4 style="font-weight: semibold" class=" px-2">Edit User</h4>
    <nav class="px-2" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="manageUser.php">Manage User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit User</li>
        </ol>
    </nav>
  </div>
  
<!-- Form Start -->

<div class="container-fluid pb-4 pt-2">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="bg-white rounded h-100 p-4 shadow-sm">

                <form method="POST" enctype="multipart/form-data" class="row g-3">

                    <div class="col-12 col-md-6">
                        <label for="floatingInput" class="form-label">User Name</label>
                        <input value="<?php echo $fetch['username'] ?>" name="username" type="text" class="form-control py-3" id="floatingInput"
                            placeholder="Enter username" required>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="floatingPassword" class="form-label">Password</label>
                        <input value="<?php echo $fetch['password'] ?>" name="password" type="text" class="form-control py-3" id="floatingPassword"
                            placeholder="Enter password" required>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="floatingEmail" class="form-label">Email</label>
                        <input value="<?php echo $fetch['email'] ?>" name="email" type="email" class="form-control py-3" id="floatingEmail"
                            placeholder="Enter email" required>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="floatingFullName" class="form-label">Full Name</label>
                        <input value="<?php echo $fetch['full_name'] ?>" name="full_name" type="text" class="form-control py-3" id="floatingFullName"
                            placeholder="Enter full name" required>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="floatingPhoneNumber" class="form-label">Phone Number</label>
                        <input value="<?php echo $fetch['phone_number'] ?>" name="phone_number" type="text" class="form-control py-3" id="floatingPhoneNumber"
                            placeholder="Enter phone number" required>
                    </div>

                    <div class="text-center d-flex justify-content-end">
                        <button name="update_user" type="submit" class="btn btn-primary">Update User</button>
                    </div>

                </form>


            </div>
        </div>
    </div>
</div>

<!-- Form End -->



  <?php
  if (isset($_POST['update_user'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];
    $phone_number = $_POST['phone_number'];

    $updated = "UPDATE `users` SET `username`='$username',`password`='$password',`email`='$email',`full_name`='$full_name',`phone_number`='$phone_number'
     WHERE `user_id` = '$u_id'";
    $done = mysqli_query($connect, $updated);
    if ($done) {
      echo
        "<script>
      alert('Record Updated!');
      window.location.href = 'manageUser.php';
      </script>";
    }

  }
}
include('footer.php');
?>