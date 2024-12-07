<?php include("header.php"); 

// Fetch cities for the dropdown
$select1 = "SELECT * FROM `cities`";
$query1 = mysqli_query($connect, $select1);

?>   

<div class='container-fluid  '>
    <div class="bg-white p-2 rounded my-4">
<h5 style="font-weight: semibold" class="py-4 px-2 fs-4 fw-bold">Add New Company</h5>
<nav class="px-2" aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="manageCompany.php">Manage Company</a></li>
    <li class="breadcrumb-item active" aria-current="page">Add new Company</li>
  </ol>
</nav>
</div>
</div>
<!-- Form Start -->             
<div class="container-fluid pb-4 pt-2">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="bg-white rounded h-100 p-4 shadow-sm">
                <form method="POST" class="row g-3">
                    <div class="col-12 col-md-6 mb-3 ">
                        <label for="floatingInput">Company Name</label>
                        <input type="text" class="form-control py-3" id="floatingInput" name="company_name" placeholder="Company Name" required>
                    </div>
                    <div class="col-12 col-md-6 mb-3 ">
                        <label for="floatingAddress">Company Address</label>
                        <input type="text" class="form-control py-3" id="floatingAddress" name="address" placeholder="Company Address" required>
                    </div>
                    <div class="col-12 col-md-6 mb-3 ">
                        <label for="floatingContact">Contact Info</label>
                        <input type="text" class="form-control py-3" id="floatingContact" name="contact_info" placeholder="Contact Info" required>
                    </div>

                    <div class="col-12 col-md-6 mb-3 ">
                        <label for="floatingContact">Contact City</label>
                        <select name="city_id" class="form-control" required>
                            <option selected disabled>Choose City</option>
                            <?php 
                            while ($fetch = mysqli_fetch_assoc($query1)) {
                                echo "<option value='" . $fetch["city_id"] . "'>" . $fetch["city_name"] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-12 d-flex align-items-center justify-content-end ">
                        <button type="submit" name="add_branch" class="btn btn-primary m-2">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Form End -->

<?php
if (isset($_POST['add_branch'])) {
    // Collect form data
    $company_name = $_POST['company_name'];
    $address = $_POST['address'];
    $contact_info = $_POST['contact_info'];
    $city_id = $_POST['city_id'];

    // Insert query
    $insert = "INSERT INTO `companies` (`company_name`, `address`, `contact_info`, `city_id`) 
               VALUES ('$company_name', '$address', '$contact_info', '$city_id')";
    
    // Execute insert query and check for errors
    if (mysqli_query($connect, $insert)) {
        echo "<script>
                alert('Company Added Successfully!');
                // window.location.reload(); // Optional: Reload to reflect changes
               </script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($connect) . "');</script>";
    }
}
?>

<?php include("footer.php"); ?>
