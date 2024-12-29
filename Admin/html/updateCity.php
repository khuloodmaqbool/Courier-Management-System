<?php
include('header.php');

if (!$connect) {
  die('Database connection failed: ' . mysqli_connect_error());
}
if (isset($_GET['uc_id'])) {
  $uc_id = $_GET['uc_id'];
  $select = "SELECT * FROM `cities` WHERE `city_id` = '$uc_id'";
  $u_row = mysqli_query($connect, $select);
  $fetch = mysqli_fetch_assoc($u_row);

  ?>

  <h5 style="font-weight: semibold" class="py-4 px-2">Edit City Info</h5>
  <nav class="px-2" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="manageCompany.php">Manage City</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit Info</li>
    </ol>
  </nav>
  <!-- Form Start -->
  <div class='container-fluid pt-4 '>
    <div class='row g-4'>
      <div class='col'>
        <form method='POST' action=''> <!-- Form added -->
          <div class='bg-light rounded h-100 p-4 d-flex justify-content-between'>
            <div class='form-floating mb-3 mx-3'>
              <input value="<?php echo $fetch['city_name'] ?>" name='city_name' type='text'
                class='form-control w-100' id='floatingBranchName' placeholder='Branch Name' required>
              <label for='floatingBranchName'>City Name</label>
            </div>
            <div class='form-floating mb-3 mx-3'>
              <button name='update_city' type='submit' class='btn btn-primary m-2'>Add</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Form End -->


  <?php
  if (isset($_POST['update_city'])) {
    $city_name = $_POST['city_name'];
    $updated = "UPDATE `cities` SET `city_name` = '$city_name'
    WHERE `city_id` = '$uc_id'";
    $done = mysqli_query($connect, $updated);
    if ($done) {
      echo
        "<script>
      alert('Record Updated!');
      window.location.href = 'manageCity.php';
      </script>";
    }

  }
}
include('footer.php');
?>