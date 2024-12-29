<?php
include('header.php');

if (!$connect) {
    die('Database connection failed: ' . mysqli_connect_error());
}

$select1 = 'SELECT * FROM `companies`';
$query1 = mysqli_query($connect, $select1);

$select2 = 'SELECT * FROM `cities`';
$query2 = mysqli_query($connect, $select2);
?>

<div class='container-fluid'>
    <div class="bg-white p-2 rounded my-4">
        <h5 style='font-weight: semibold' class='py-4 px-2 fs-4 fw-bold'>Add New Branch</h5>
        <nav class='px-2' aria-label='breadcrumb'>
            <ol class='breadcrumb'>
                <li class='breadcrumb-item'><a href='manageBranch.php'>Manage Branch</a></li>
                <li class='breadcrumb-item active' aria-current='page'>Add new Branch</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Form Start -->
<div class='container-fluid pb-4 pt-2'>
    <div class='row justify-content-center'>
        <div class='col-12'>
            <div class='bg-white rounded h-100 p-4 shadow-sm'>

                <form method='POST' class='row g-3' onsubmit="return validateForm()">

                    <div class='mb-3 col-12 col-md-6'>
                        <label for='branchName' class="form-label">Branch Name</label>
                        <input name='branch_name' type='text' class='form-control py-3' id="branchName_id"
                               placeholder='Branch Name' >
                        <small id="branchNameError" class="text-danger d-none"></small>
                    </div>

                    <div class='mb-3 col-12 col-md-6'>
                        <label for='location'>Location</label>
                        <input name='location' type='text' class='form-control py-3' id='location_id'
                               placeholder='Location' >
                        <small id="locationError" class="text-danger d-none"></small>
                    </div>

                    <div class='mb-3 col-12 col-md-6'>
                        <label for='contactInfo'>Contact Info</label>
                        <input name='contact_info' type='text' class='form-control py-3' id='contactInfo'
                               placeholder='Contact Info' >
                        <small id="contactInfoError" class="text-danger d-none"></small>
                    </div>

                    <div class='mb-3 col-12 col-md-6'>
                        <label for='companySelect'>Company</label>
                        <select name='company_id' id='companySelect' class='form-select py-3' >
                            <option selected disabled>Select Company</option>
                            <?php while ($fetch = mysqli_fetch_assoc($query1)) { ?>
                                <option value="<?php echo $fetch['company_id']; ?>">
                                    <?php echo $fetch['company_name']; ?>
                                </option>
                            <?php } ?>
                        </select>
                        <small id="companyError" class="text-danger d-none"></small>
                    </div>

                    <div class='mb-3 col-12 col-md-6'>
                        <label for='citySelect'>City</label>
                        <select name='city_id' id='citySelect' class='form-select py-3' >
                            <option selected disabled>Select City</option>
                            <?php while ($fetch = mysqli_fetch_assoc($query2)) { ?>
                                <option value="<?php echo $fetch['city_id']; ?>">
                                    <?php echo $fetch['city_name']; ?>
                                </option>
                            <?php } ?>
                        </select>
                        <small id="cityError" class="text-danger d-none"></small>
                    </div>

                    <div class='mb-3 col-12 d-flex justify-content-end'>
                        <button name='add_branch' type='submit' class='btn btn-primary m-2'>Add</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- Form End -->

<script>
function validateForm() {
    let isValid = true;

    // Get input elements
    const branchName = document.getElementById('branchName_id');
    const branchNameError = document.getElementById('branchNameError');
    const location = document.getElementById('location_id');
    const locationError = document.getElementById('locationError');
    const contactInfo = document.getElementById('contactInfo');
    const contactInfoError = document.getElementById('contactInfoError');
    const companySelect = document.getElementById('companySelect');
    const companyError = document.getElementById('companyError');
    const citySelect = document.getElementById('citySelect');
    const cityError = document.getElementById('cityError');

    // Validate Branch Name (Only letters and spaces allowed, at least 5 characters)
    const branchNameRegex = /^[A-Za-z\s]+$/;
    if (!branchNameRegex.test(branchName.value.trim()) || branchName.value.trim().length < 5) {
        branchNameError.textContent = 'Branch Name must only contain letters and spaces, and be at least 5 characters long.';
        branchNameError.classList.remove('d-none');
        branchName.classList.add('is-invalid');
        isValid = false;
    } else {
        branchNameError.textContent = '';
        branchNameError.classList.add('d-none');
        branchName.classList.remove('is-invalid');
    }

    // Validate Location (At least 12 characters long)
    if (location.value.trim().length < 12) {
        locationError.textContent = 'Location must be at least 12 characters long.';
        locationError.classList.remove('d-none');
        location.classList.add('is-invalid');
        isValid = false;
    } else {
        locationError.textContent = '';
        locationError.classList.add('d-none');
        location.classList.remove('is-invalid');
    }

    // Validate Contact Info (Only email address allowed)
    const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!emailRegex.test(contactInfo.value.trim())) {
        contactInfoError.textContent = 'Contact Info must be a valid email address.';
        contactInfoError.classList.remove('d-none');
        contactInfo.classList.add('is-invalid');
        isValid = false;
    } else {
        contactInfoError.textContent = '';
        contactInfoError.classList.add('d-none');
        contactInfo.classList.remove('is-invalid');
    }

    // Validate Company Selection
    if (companySelect.value === 'Select Company') {
        companyError.textContent = 'Please select a company.';
        companyError.classList.remove('d-none');
        companySelect.classList.add('is-invalid');
        isValid = false;
    } else {
        companyError.textContent = '';
        companyError.classList.add('d-none');
        companySelect.classList.remove('is-invalid');
    }

    // Validate City Selection
    if (citySelect.value === 'Select City') {
        cityError.textContent = 'Please select a city.';
        cityError.classList.remove('d-none');
        citySelect.classList.add('is-invalid');
        isValid = false;
    } else {
        cityError.textContent = '';
        cityError.classList.add('d-none');
        citySelect.classList.remove('is-invalid');
    }

    return isValid; // Only submit if validation passes
}
</script>



<style>
.is-invalid {
    border: 1px solid red !important;
}
</style>

<?php
if (isset($_POST['add_branch'])) {
    $branch_name = $_POST['branch_name'];
    $location = $_POST['location'];
    $contact_info = $_POST['contact_info'];
    $company_id = $_POST['company_id'];
    $city = $_POST['city_id'];

    $insert = "INSERT INTO `branches` (`branch_name`, `location`, `contact_info`, `company_id`, `city`) 
               VALUES ('$branch_name', '$location', '$contact_info', '$company_id', '$city')";

    if (mysqli_query($connect, $insert)) {
        echo "<script>
                alert('Branch Added Successfully!');
                window.location.href = 'manageBranch.php';
              </script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($connect) . "');</script>";
    }
}
?>

<?php include('footer.php'); ?>
