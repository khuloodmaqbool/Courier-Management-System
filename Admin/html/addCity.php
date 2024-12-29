<?php include("header.php"); ?>

<div class='container-fluid'>
    <div class="bg-white p-2 rounded my-4">
        <h5 style="font-weight: semibold" class="py-4 px-2 fs-4 fw-bold">Add New City</h5>
        <nav class="px-2" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="manageCity.php">Manage City</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add new City</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Form Start -->             
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col">
            <div class="bg-white  rounded h-100 px-4 py-6">
                <form class="  d-flex flex-column" method="POST" action="" onsubmit="return validateForm()">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="cityNameInput" name="city_name" placeholder="City Name" >
                        <label for="cityNameInput">City Name</label>
                        <small id="cityNameError" class="text-danger d-none"></small>
                    </div>
                    <button style="width: fit-content;" type="submit" name="add_city" class="btn btn-primary">Add New City</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Form End -->

<script>
function validateForm() {
    const cityNameInput = document.getElementById('cityNameInput');
    const cityNameError = document.getElementById('cityNameError');
    const cityName = cityNameInput.value.trim();
    
    // Regular expression for validating city name (letters and spaces only)
    const cityNameRegex = /^[a-zA-Z\s]{2,50}$/;

    if (!cityNameRegex.test(cityName)) {
        cityNameError.textContent = 'Please enter a valid city name (letters and spaces only, 2-50 characters).';
        cityNameError.classList.remove('d-none'); // Show the error message
        cityNameInput.classList.add('is-invalid'); // Add red border to the input
        return false; // Prevent form submission
    }

    // If valid, clear the error message and styling
    cityNameError.textContent = '';
    cityNameError.classList.add('d-none'); // Hide the error message
    cityNameInput.classList.remove('is-invalid'); // Remove red border
    return true; // Allow form submission
}
</script>

<!-- Add Bootstrap styling for the red border -->
<style>
.is-invalid {
    border: 1px solid red !important;
}
</style>

<?php
if (isset($_POST['add_city'])) {
    // Collect form data
    $city_name = $_POST['city_name'];

    // Insert query
    $insert = "INSERT INTO `cities` (`city_name`) 
                VALUES ('$city_name')";
    
    // Execute insert query and check for errors
    if (mysqli_query($connect, $insert)) {
        echo "<script>
                alert('City Added Successfully!');
                window.location.href = 'manageCity.php';
               </script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($connect) . "');</script>";
    }
}
?>

<?php include("footer.php"); ?>
