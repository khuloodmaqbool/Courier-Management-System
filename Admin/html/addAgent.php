<?php
include("header.php");

// Check database connection
if (!$connect) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Fetch roles, branches, cities, and companies
$query1 = mysqli_query($connect, "SELECT * FROM `roles`");
$query2 = mysqli_query($connect, "SELECT * FROM `branches`");
$query3 = mysqli_query($connect, "SELECT * FROM `companies`");
$query4 = mysqli_query($connect, "SELECT * FROM `cities`"); // Query for cities
?>

<div class="container-fluid py-4 ">
<div class="bg-white rounded py-3 px-2">
<h5 style="font-weight: semibold" class="py-4 px-2">Add New Agent</h5>
<nav class="px-2" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="viewAgent.php">Manage Agent</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add new Agent</li>
    </ol>
</nav>
</div>
</div>
<!-- Form Start -->
<div class="container-fluid pb-4 pt-2">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="bg-white rounded h-100 p-4 shadow-sm">
                <form method="POST" action="" enctype="multipart/form-data" class="row g-3">

                    <!-- Username -->
                    <div class="col-12 col-md-6">
                      
                        <label for="floatingInput" class="form-label">User Name</label>
                        <input name="username" type="text" class="form-control py-3" id="floatingInput"
                            placeholder="Enter username" required>
                    </div>

                    <!-- Password -->
                    <div class="col-12 col-md-6">
                        <label for="floatingPassword" class="form-label">Password</label>
                        <input name="password" type="text" class="form-control py-3" id="floatingPassword"
                            placeholder="Enter password" required>
                    </div>

                    <!-- Email -->
                    <div class="col-12 col-md-6">
                        <label for="floatingEmail" class="form-label">Email</label>
                        <input name="email" type="email" class="form-control py-3" id="floatingEmail"
                            placeholder="Enter email" required>
                    </div>

                    <!-- Full Name -->
                    <div class="col-12 col-md-6">
                        <label for="floatingFullName" class="form-label">Full Name</label>
                        <input name="full_name" type="text" class="form-control py-3" id="floatingFullName"
                            placeholder="Enter full name" required>
                    </div>

                    <!-- Phone Number -->
                    <div class="col-12 col-md-6">
                        <label for="floatingPhoneNumber" class="form-label">Phone Number</label>
                        <input name="phone_number" type="text" class="form-control py-3" id="floatingPhoneNumber"
                            placeholder="Enter phone number" required>
                    </div>

                    <!-- Address -->
                    <div class="col-12 col-md-6">
                        <label for="floatingAddress" class="form-label">Residential Address</label>
                        <input name="residential_address" type="text" class="form-control py-3" id="floatingAddress"
                            placeholder="Enter address" required>
                    </div>

                    <!-- Profile Picture -->
                    <div class="col-12">
                        <label for="floatingProfilePicture" class="form-label">Profile Picture</label>
                        <input name="profile_picture" type="file" class="form-control py-3" id="floatingProfilePicture"
                            accept="image/*">
                    </div>

                    <!-- City -->
                    <div class="col-12 col-md-6">
                        <label for="citySelect" class="form-label">City</label>
                        <select name="city_id" class="form-select py-3" id="citySelect" required>
                            <option selected disabled>Select City</option>
                            <?php while ($fetchCity = mysqli_fetch_assoc($query4)) { ?>
                                <option value="<?php echo $fetchCity['city_id']; ?>">
                                    <?php echo $fetchCity['city_name']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- Company -->
                    <div class="col-12 col-md-6">
                        <label for="companySelect" class="form-label">Company</label>
                        <select name="company_id" class="form-select py-3" id="companySelect" required>
                            <option selected disabled>Select Company</option>
                            <?php while ($fetchCompany = mysqli_fetch_assoc($query3)) { ?>
                                <option value="<?php echo $fetchCompany['company_id']; ?>"
                                    data-city-id="<?php echo $fetchCompany['city_id']; ?>">
                                    <?php echo $fetchCompany['company_name']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- Branch -->
                    <div class="col-12 col-md-6">
                        <label for="branchSelect" class="form-label">Branch</label>
                        <select name="branch_id" class="form-select py-3" id="branchSelect" required>
                            <option selected disabled>Select Branch</option>
                            <?php while ($fetchBranch = mysqli_fetch_assoc($query2)) { ?>
                                <option value="<?php echo $fetchBranch['branch_id']; ?>"
                                    data-company-id="<?php echo $fetchBranch['company_id']; ?>">
                                    <?php echo $fetchBranch['branch_name']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-12 d-flex justify-content-end text-center">
                        <button name="userSubmit" type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Form End -->

<!-- jQuery for dynamic filtering -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#citySelect').change(function () {
            const selectedCityId = $(this).val();

            $('#companySelect option').each(function () {
                const companyCityId = $(this).data('city-id');
                if (companyCityId == selectedCityId) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            $('#companySelect').val('');
            $('#branchSelect').val('');
        }).trigger('change');


        $('#companySelect').change(function () {
            const selectedCompanyId = $(this).val();

            $('#branchSelect option').each(function () {
                const branchCompanyId = $(this).data('company-id');
                if (branchCompanyId == selectedCompanyId) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            $('#branchSelect').val('');
        }).trigger('change');
    });
</script>

<?php
if (isset($_POST['userSubmit'])) {
    // Collect form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $full_name = $_POST['full_name'];
    $phone_number = $_POST['phone_number'];
    $residential_address = $_POST['residential_address'];
    $role_id = 2;
    $branch_id = $_POST['branch_id'];
    $company_id = $_POST['company_id'];
    $city = $_POST['city_id'];

    // Profile picture upload handling
    $profile_picture = $_FILES['profile_picture']['name'];
    $profile_picture_tmp = $_FILES['profile_picture']['tmp_name'];
    $profile_picture_path = '../images/' . $profile_picture;
    move_uploaded_file($profile_picture_tmp, $profile_picture_path);

    // Insert data into database
    $insert = "INSERT INTO `users` (`username`, `password`, `email`, `full_name`, `phone_number`, `residential_address`, `city`, `profile_picture`, `role_id`, `branch_id`, `company_id`) 
               VALUES ('$username', '$password', '$email', '$full_name', '$phone_number', '$residential_address','$city' ,'$profile_picture', '$role_id', '$branch_id', '$company_id')";

    if (mysqli_query($connect, $insert)) {
        echo "<script>
                alert('User Added Successfully!');
                // window.location.href = 'viewUsers.php';
              </script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($connect) . "');</script>";
    }
}

include("footer.php"); ?>