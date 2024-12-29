<?php
include('header.php');

if (!$connect) {
  die('Database connection failed: ' . mysqli_connect_error());
}

if (isset($_GET["ub_id"])) {
  $ub_id = $_GET['ub_id'];
  $select = "SELECT b.*, c.company_name
  FROM branches b
  INNER JOIN companies c
  ON b.company_id = c.company_id 
  WHERE b.branch_id = '$ub_id'";
  $result = mysqli_query($connect, $select);
  $fetch = mysqli_fetch_array($result);


  ?>

  <!-- Form Start -->
  <div class="bg-white rounded shadow-sm mx-6 px-3 my-6">
  <h4 style="font-weight: semibold" class="p-2">Edit Branch</h4>
  <nav class="px-2" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="manageBranch.php">Manage Branch</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit Branch</li>
    </ol>
  </nav>
</div>
<!-- Form Start -->
<div class="container-fluid pt-4">
  <div class="row">
    <div class="col">
      <form method="POST" action="">
        <div class="bg-white rounded h-100 p-4">
          <div class="row">
            <!-- Branch Name -->
            <div class="form-floating col-md-6 my-4">
              <input name="branch_name" type="text" class="form-control " id="floatingBranchName" placeholder="Branch Name" required value="<?php echo $fetch['branch_name']; ?>">
              <label class="ms-3" for="floatingBranchName">Branch Name</label>
            </div>
            <!-- Location -->
            <div class="form-floating col-md-6 my-4">
              <input name="location" type="text" class="form-control " id="floatingLocation" placeholder="Location" required value="<?php echo $fetch['location']; ?>">
              <label class="ms-3" for="floatingLocation">Location</label>
            </div>
          </div>
          <div class="row">
            <!-- Contact Info -->
            <div class="form-floating col-md-6 my-4">
              <input name="contact_info" type="text" class="form-control " id="floatingContactInfo" placeholder="Contact Info" required value="<?php echo $fetch['contact_info']; ?>">
              <label class="ms-3" for="floatingContactInfo">Contact Info</label>
            </div>
            <!-- Company Select -->
            <div class="form-floating col-md-6 my-4">
              <select name="company_id" class="form-select " required>
                <?php
                $sel_company = "SELECT * FROM `companies`";
                $query_company = mysqli_query($connect, $sel_company);

                while ($fetch_company = mysqli_fetch_assoc($query_company)) { ?>
                  <option value="<?php echo $fetch_company['company_id']; ?>" <?php if (isset($fetch['company_id']) && $fetch['company_id'] == $fetch_company['company_id']) {
                    echo "selected='selected'";
                  } ?>>
                    <?php echo $fetch_company['company_name']; ?>
                  </option>
                <?php } ?>
              </select>
              <label class="ms-4" for="floatingSelect">Company</label>
            </div>
          </div>
          <!-- Submit Button -->
          <div class="d-flex justify-content-end">
            <button name="update_branch" type="submit" class="btn btn-primary">Update Branch</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Form End -->

  <!-- Form End -->


  <?php
  if (isset($_POST['update_branch'])) {
    $branch_name = $_POST['branch_name'];
    $location = $_POST['location'];
    $contact_info = $_POST['contact_info'];
    $company_id = $_POST['company_id'];

    $update = "UPDATE `branches` SET `branch_name`='$branch_name',`location`='$location',`contact_info`='$contact_info',`company_id`='$company_id' WHERE `branch_id` = $ub_id ";

    if (mysqli_query($connect, $update)) {
      echo "<script>
                alert('Branch Edit Successfully!');
                window.location.href = 'manageBranch.php';
              </script>";
    } else {
      echo "<script>alert('Error: " . mysqli_error($connect) . "');</script>";
    }
  }
}



?>

<?php include('footer.php');
?>