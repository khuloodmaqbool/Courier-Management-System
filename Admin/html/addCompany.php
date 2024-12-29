<?php include("header.php");

// Fetch cities for the dropdown
$select1 = "SELECT * FROM `cities`";
$query1 = mysqli_query($connect, $select1);

?>

<div class='container-fluid'>
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
                <form method="POST" class="row g-3" onsubmit="return validateForm()">
                    <div class="col-12 col-md-6 mb-3">
                        <label for="floatingInput">Company Name</label>
                        <input type="text" class="form-control py-3" id="companyName" name="company_name" placeholder="Company Name" >
                        <small id="companyNameError" class="text-danger d-none"></small>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="floatingAddress">Company Address</label>
                        <input type="text" class="form-control py-3" id="floatingAddress" name="address" placeholder="Company Address" >
                        <small id="addressError" class="text-danger d-none"></small>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="floatingContact">Contact Info (Email)</label>
                        <input type="email" class="form-control py-3" id="contactInfo" name="contact_info" placeholder="Contact Info (Email)" >
                        <small id="contactInfoError" class="text-danger d-none"></small>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <label for="floatingContact">Contact City</label>
                        <select name="city_id" id="citySelect" class="form-control" >
                            <option selected disabled>Choose City</option>
                            <?php
                            while ($fetch = mysqli_fetch_assoc($query1)) {
                                echo "<option value='" . $fetch["city_id"] . "'>" . $fetch["city_name"] . "</option>";
                            }
                            ?>
                        </select>
                        <small id="cityError" class="text-danger d-none"></small>
                    </div>

                    <div class="col-12 d-flex align-items-center justify-content-end">
                        <button type="submit" name="add_branch" class="btn btn-primary m-2">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Form End -->

<script>
// Form validation function
function validateForm() {
    let isValid = true;

    // Get form elements
    const companyName = document.getElementById('companyName');
    const companyNameError = document.getElementById('companyNameError');
    const address = document.getElementById('floatingAddress');
    const addressError = document.getElementById('addressError');
    const contactInfo = document.getElementById('contactInfo');
    const contactInfoError = document.getElementById('contactInfoError');
    const citySelect = document.getElementById('citySelect');
    const cityError = document.getElementById('cityError');

    // Validate Company Name (at least 5 characters long, must contain letters)
    const companyNameRegex = /[a-zA-Z]/;
    if (companyName.value.trim().length < 5 || !companyNameRegex.test(companyName.value)) {
        companyNameError.textContent = 'Company Name must be at least 5 characters long and contain letters.';
        companyNameError.classList.remove('d-none');
        companyName.classList.add('is-invalid');
        isValid = false;
    } else {
        companyNameError.textContent = '';
        companyNameError.classList.add('d-none');
        companyName.classList.remove('is-invalid');
    }

    // Validate Company Address (at least 12 characters long)
    if (address.value.trim().length < 12) {
        addressError.textContent = 'Company Address must be at least 12 characters long.';
        addressError.classList.remove('d-none');
        address.classList.add('is-invalid');
        isValid = false;
    } else {
        addressError.textContent = '';
        addressError.classList.add('d-none');
        address.classList.remove('is-invalid');
    }

    // Validate Contact Info (check if it is a valid email address)
    const contactInfoRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!contactInfoRegex.test(contactInfo.value)) {
        contactInfoError.textContent = 'Contact Info must be a valid email address.';
        contactInfoError.classList.remove('d-none');
        contactInfo.classList.add('is-invalid');
        isValid = false;
    } else {
        contactInfoError.textContent = '';
        contactInfoError.classList.add('d-none');
        contactInfo.classList.remove('is-invalid');
    }

    // Validate City Selection (Choose City should not be selected)
    if (citySelect.value === "Choose City") {
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
                window.location.href = 'manageCompany.php';
               </script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($connect) . "');</script>";
    }
}
?>

<?php include("footer.php"); ?>
