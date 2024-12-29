<?php
include('header.php');

if (!$connect) {
    die('Database connection failed: ' . mysqli_connect_error());
}

if (isset($_GET['uc_id'])) {
    $uc_id = $_GET['uc_id'];
    // Fetch company details
    $select = "SELECT * FROM `companies` WHERE `company_id` = '$uc_id'";
    $u_row = mysqli_query($connect, $select);
    $fetch = mysqli_fetch_assoc($u_row);

    // Fetch all cities for the dropdown
    $cities_query = "SELECT * FROM `cities`";
    $cities_result = mysqli_query($connect, $cities_query);

    ?>

  <div class="bg-white rounded shadow-sm mx-6 my-4 px-3 py-3">
  <h4 style="font-weight: semibold" class=" px-2">Edit Company</h4>
    <nav class="px-2" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="manageCompany.php">Manage Company</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Company</li>
        </ol>
    </nav>
  </div>
    <!-- Form Start -->
    <div class='container-fluid pt-4'>
        <div class='row g-4'>
            <div class='col'>
                <form method='POST' action=''>
                    <div class='bg-white rounded h-100 p-4'>
                        <div class='row'>
                            <div class='col-md-6 my-2'>
                                <div class='form-floating mb-3'>
                                    <input value="<?php echo $fetch['company_name'] ?>" name='company_name' type='text'
                                           class='form-control' id='floatingBranchName' placeholder='Company Name' required>
                                    <label for='floatingBranchName'>Company Name</label>
                                </div>
                            </div>
                            <div class='col-md-6 my-2'>
                                <div class='form-floating mb-3'>
                                    <input value="<?php echo $fetch['address'] ?>" name='location' type='text'
                                           class='form-control' id='floatingLocation' placeholder='Location' required>
                                    <label for='floatingLocation'>Location</label>
                                </div>
                            </div>
                            <div class='col-md-6 my-2'>
                                <div class='form-floating mb-3'>
                                    <input value="<?php echo $fetch['contact_info'] ?>" name='contact_info' type='text'
                                           class='form-control' id='floatingContactInfo' placeholder='Contact Info' required>
                                    <label for='floatingContactInfo'>Contact Info</label>
                                </div>
                            </div>
                            <div class='col-md-6 my-2'>
                                <div class='form-floating mb-3'>
                                    <select name="city_id" class="form-select" id="floatingCity" required>
                                        <option value="" disabled>Select City</option>
                                        <?php
                                        while ($city = mysqli_fetch_assoc($cities_result)) {
                                            $selected = ($city['city_id'] == $fetch['city_id']) ? 'selected' : '';
                                            echo "<option value='{$city['city_id']}' $selected>{$city['city_name']}</option>";
                                        }
                                        ?>
                                    </select>
                                    <label for="floatingCity">City</label>
                                </div>
                            </div>
                            <div class='col-12 text-end'>
                                <button name='update_company' type='submit' class='btn btn-primary'>Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Form End -->

    <?php
    if (isset($_POST['update_company'])) {
        $company_name = $_POST['company_name'];
        $location = $_POST['location'];
        $contact_info = $_POST['contact_info'];
        $city_id = $_POST['city_id'];

        // Update company details
        $updated = "UPDATE `companies` 
                    SET `company_name` = '$company_name', 
                        `address` = '$location', 
                        `contact_info` = '$contact_info',
                        `city_id` = '$city_id'
                    WHERE `company_id` = '$uc_id'";
        $done = mysqli_query($connect, $updated);

        if ($done) {
            echo "<script>
                alert('Record Updated!');
                window.location.href = 'manageCompany.php';
                </script>";
        }
    }
}

include('footer.php');
?>
