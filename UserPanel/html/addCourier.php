<?php
include("header.php");

// Fetch cities
$selectCities = "SELECT * FROM `cities`";
$queryCities = mysqli_query($connect, $selectCities);

// Fetch companies
$selectCompanies = "SELECT * FROM `companies`";
$queryCompanies = mysqli_query($connect, $selectCompanies);

// Fetch branches
$selectBranches = "SELECT * FROM `branches`";
$queryBranches = mysqli_query($connect, $selectBranches);

// Fetch users
$selectUsers = "SELECT * FROM `users`";
$queryUsers = mysqli_query($connect, $selectUsers);

$branchesData = [];
$usersData = [];
$companiesData = [];

// Store branches data
while ($branch = mysqli_fetch_assoc($queryBranches)) {
  $branchesData[] = $branch;
}

// Store users data
while ($user = mysqli_fetch_assoc($queryUsers)) {
  $usersData[] = $user;
}

// Store companies data
while ($company = mysqli_fetch_assoc($queryCompanies)) {
  $companiesData[] = $company;
}

// mail
if (isset($_POST['add_courier'])) {
    $sender_name = $_POST['sender_name'];
    $receiver_name = $_POST['receiver_name'];
    $sender_address = $_POST['sender_address'];
    $receiver_address = $_POST['receiver_address'];
    $sender_number = $_POST['sender_number'];
    $receiver_number = $_POST['receiver_number'];
    $courier_type = $_POST['courier_type'];
    $delivery_type = $_POST['customDeliveryRadioIcon'];
    $status = "Pending";
    $created_at = date('Y-m-d');
    $delivery_date = $_POST['delivery_date'];
    $branch_id = $_POST['branch_id'];
    $company_id = $_POST['company_id'];
    $user_id = $_POST['user_id'];
    $city = $_POST['user_id'];
    $weight = $_POST['weight'];
    $price = $weight * 200;
    $user_customer_id = $_SESSION['user_id'];

    $tracking_number = strtoupper(uniqid('TRK', true));

    $insertQuery = "INSERT INTO `couriers`(`sender_name`, `receiver_name`, `sender_address`, `receiver_address`,
       `sender_phone_number`, `reciever_phone_number`, `city`,
        `courier_type`, `delivery_type`, `weight_kg`, `price_pkr`, `status`, `created_at`, `delivery_date`, `branch_id`, `user_id`, `tracking_number`, `company_id`,`user_customer_id`)
       VALUES ('$sender_name','$receiver_name','$sender_address','$receiver_address',
       '$sender_number','$receiver_number','$city',
       '$courier_type','$delivery_type','$weight','$price','$status','$created_at','$delivery_date','$branch_id','$user_id','$tracking_number','$company_id', '$user_customer_id')";

    if (mysqli_query($connect, $insertQuery)) {
      $email = $_SESSION['email'];
        // Prepare email content
        $subject = "Courier Booked Successfully - Tracking Number: $tracking_number";
        $to = "$email"; // Replace with the recipient's email
        $from = "no-reply@yourdomain.com"; // Sender email address
        $headers = "From: $from" . "\r\n" .
                   "Reply-To: $from" . "\r\n" .
                   "Content-Type: text/html; charset=UTF-8";

        // Create the HTML email body
        $body = "
        <html>
        <head>
            <title>Courier Booking Confirmation</title>
        </head>
        <body>
            <h2>Courier Booking Confirmation</h2>
            <p><strong>Sender Name:</strong> $sender_name</p>
            <p><strong>Receiver Name:</strong> $receiver_name</p>
            <p><strong>Sender Address:</strong> $sender_address</p>
            <p><strong>Receiver Address:</strong> $receiver_address</p>
            <p><strong>Sender Phone Number:</strong> $sender_number</p>
            <p><strong>Receiver Phone Number:</strong> $receiver_number</p>
            <p><strong>Courier Type:</strong> $courier_type</p>
            <p><strong>Delivery Type:</strong> $delivery_type</p>
            <p><strong>Weight:</strong> $weight kg</p>
            <p><strong>Price:</strong> Rs. $price</p>
            <p><strong>Tracking Number:</strong> $tracking_number</p>
            <p><strong>Delivery Date:</strong> $delivery_date</p>
            <p><strong>Status:</strong> Pending</p>
        </body>
        </html>
        ";

        // Send email
        if (mail($to, $subject, $body, $headers)) {
            echo "<script>alert('Courier Added Successfully! An email confirmation has been sent.');</script>";
        } else {
            echo "<script>alert('Courier Added Successfully! However, email sending failed.');</script>";
        }
    } else {
        echo "<script>alert('Error: " . mysqli_error($connect) . "');</script>";
    }
}
?>


<div class="container-xxl flex-grow-1 mt-5">
  <div class="bg-white rounded p-2">
    <h5 class="py-4 px-2 fw-bold fs-4">Add New Courier</h5>
    <nav class="px-2" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="manageCourier.php">Manage Courier</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add new Courier</li>
      </ol>
    </nav>
  </div>
</div>

<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-lg-8 mx-auto">
                <h5 class="mb-4">1. Delivery Address</h5>
                <form method="POST" action="">
                  <div class="row g-6">

                    <!-- Sender and Receiver Details -->



                    <div class="col-md-6">
                      <label class="form-label" for="fullname">Sender Name</label>
                      <input name="sender_name" type="text" id="fullname" class="form-control" placeholder="John Doe" />
                      <span class="error"></span>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="fullname">Receiver Name</label>
                      <input name="receiver_name" type="text" id="fullname" class="form-control"
                        placeholder="John Doe" />
                        <span class="error"></span>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="fullname">Sender Address</label>
                      <input name="sender_address" type="text" id="fullname" class="form-control"
                        placeholder="123 Main Street" />
                        <span class="error"></span>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="fullname">Receiver Address</label>
                      <input name="receiver_address" type="text" id="fullname" class="form-control"
                        placeholder="101 ABC Society" />
                        <span class="error"></span>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="fullname">Sender Number</label>
                      <input name="sender_number" type="text" id="fullname" class="form-control"
                        placeholder="+1234567890" />
                        <span class="error"></span>
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="fullname">Receiver Number</label>
                      <input name="receiver_number" type="text" id="fullname" class="form-control"
                        placeholder="+1234567890" />
                        <span class="error"></span>
                    </div>

                    <!-- City Dropdown -->
                    <div class="mb-3 col-12 col-md-6">
                      <label for="city" class="form-label">City</label>
                      <select name="city" id="city" class="form-select text-secondary" required>
                        <option selected disabled>Select City</option>
                        <?php while ($city = mysqli_fetch_assoc($queryCities)) { ?>
                          <option value="<?php echo $city['city_id']; ?>"><?php echo $city['city_name']; ?></option>
                        <?php } ?>
                      </select>
                      <span class="error"></span>
                    </div>

                    <!-- Company Dropdown -->
                    <div class="mb-3 col-12 col-md-6">
                      <label for="company_id" class="form-label">Company</label>
                      <select name="company_id" id="company_id" class="form-select text-secondary" required>
                        <option selected disabled>Select Company</option>
                      </select>
                      <span class="error"></span>
                    </div>

                    <!-- Branch Dropdown -->
                    <div class="mb-3 col-12 col-md-6">
                      <label for="branch_id" class="form-label">Branches</label>
                      <select name="branch_id" id="branch_id" class="form-select text-secondary" required>
                        <option selected disabled>Select Branch</option>
                      </select>
                      <span class="error"></span>
                    </div>

                    <!-- Agent Dropdown -->
                    <div class="mb-3 col-12 col-md-6">
                      <label for="user_id" class="form-label">Agent</label>
                      <select name="user_id" id="user_id" class="form-select text-secondary" required>
                        <option selected disabled>Select Agent</option>
                      </select>
                      <span class="error"></span>
                    </div>

                    <!-- courier type  -->
                    <div class=" mb-3 col-12 col-md-6">
                      <label for="floatingInput" class="form-label">Courier Type</label>
                      <select name="courier_type" id="courier_type" class="form-select text-secondary" required>
                        <option selected disabled>Select Courier Type</option>
                        <option value="Parcel">Parcel</option>
                        <option value="Document">Document</option>
                        <option value="Heavy">Heavy</option>
                      </select>
                      <span class="error"></span>
                    </div>

                    <!-- weight  -->
                    <div class="col-md-6">
                      <label class="form-label" for="weight">Weight(kg)</label>
                      <input name="weight" type="number" id="weight" class="form-control" placeholder="5" />
                      <span class="error"></span>
                      <div style="font-size: 12px;" class="mt-1 d-flex justify-content-end">per kg Rs 200</div>
                   
                    </div>
                  
                    <!-- delievery date  -->
                    <div class="col-md-6">
                      <label class="form-label" for="delivery_date">Delivery Date</label>
                      <input name="delivery_date" type="date" id="delivery_date" class="form-control" />
                      <span class="error"></span>
                    </div>

                    <hr>
                    <!-- 2. Delivery Type -->
                    <h5 class="my-6">2. Delivery Type</h5>

                    <div class="row gy-3 ">


                      <div class="col-md ">
                        <div class="form-check custom-option custom-option-icon text-center">
                          <label class="form-check-label custom-option-content" for="customRadioIcon1">
                            <div class="d-flex flex-column align-items-center">
                              <i class='bx bx-briefcase-alt-2'></i>
                              <div class="custom-option-title mb-2">Standard</div>
                              <div><small>Delivery in 3-5 days.</small></div>
                              <input name="customDeliveryRadioIcon" class="form-check-input mt-2" type="radio"
                                value="Standard" id="customRadioIcon1" checked />
                            </div>
                          </label>
                        </div>
                      </div>



                      <div class="col-md">
                        <div class="form-check custom-option custom-option-icon text-center">
                          <label class="form-check-label custom-option-content" for="customRadioIcon2">
                            <div class="d-flex flex-column align-items-center">
                              <i class='bx bx-paper-plane'></i>
                              <div class="custom-option-title mb-2">Express</div>
                              <div><small>Delivery within 2 days.</small></div>
                              <input name="customDeliveryRadioIcon" class="form-check-input mt-2" type="radio"
                                value="Express" id="customRadioIcon2" />
                            </div>
                          </label>
                        </div>
                      </div>



                      <div class="col-md">
                        <div class="form-check custom-option custom-option-icon text-center">
                          <label class="form-check-label custom-option-content" for="customRadioIcon3">
                            <div class="d-flex flex-column align-items-center">
                              <i class='bx bx-crown'></i>
                              <div class="custom-option-title mb-2">Overnight</div>
                              <div><small>Delivery within a day.</small></div>
                              <input name="customDeliveryRadioIcon" class="form-check-input mt-2" type="radio"
                                value="Overnight" id="customRadioIcon3" />
                            </div>
                          </label>
                        </div>
                      </div>


                    </div>
                    <hr>
                    <div class="col d-flex justify-content-end">
                      <button type="submit" name="add_courier" class="btn btn-primary ">Place Courier</button>
                    </div>

                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
  .error {
    color: red;
    font-size: 0.85rem;
    margin-top: 4px;
    display: none; /* Hidden by default */
  }
</style>
<script>
  $(document).ready(function () {
    const branches = <?php echo json_encode($branchesData); ?>;
    const users = <?php echo json_encode($usersData); ?>;
    const companies = <?php echo json_encode($companiesData); ?>;

    // Show error message
    function showError(input, message) {
      const errorElement = input.nextElementSibling;
      if (errorElement) {
        errorElement.textContent = message;
        errorElement.style.display = "block";
      }
    }

    // Hide error message
    function hideError(input) {
      const errorElement = input.nextElementSibling;
      if (errorElement) {
        errorElement.textContent = "";
        errorElement.style.display = "none";
      }
    }

    // Validation function
    function validateForm() {
      const nameRegex = /^[A-Za-z\s]{3,50}$/;
      const addressRegex = /^[A-Za-z0-9\s,.-]{5,100}$/;
      const phoneRegex = /^\+?[0-9]{10,15}$/;
      const weightRegex = /^[0-9]+(\.[0-9]{1,2})?$/; // Positive number with up to 2 decimal places
      const dateRegex = /^\d{4}-\d{2}-\d{2}$/; // YYYY-MM-DD format

      let isValid = true;

      // Validate fields
      $(".form-control").each(function () {
        hideError(this); // Reset errors
      });

      // Sender Name
      const senderNameInput = document.getElementById("fullname");
      if (!nameRegex.test(senderNameInput.value.trim())) {
        showError(senderNameInput, "Enter a valid sender name (3-50 alphabetic characters).");
        isValid = false;
      }

      // Receiver Name
      const receiverNameInput = document.getElementsByName("receiver_name")[0];
      if (!nameRegex.test(receiverNameInput.value.trim())) {
        showError(receiverNameInput, "Enter a valid receiver name (3-50 alphabetic characters).");
        isValid = false;
      }

      // Sender Address
      const senderAddressInput = document.getElementsByName("sender_address")[0];
      if (!addressRegex.test(senderAddressInput.value.trim())) {
        showError(senderAddressInput, "Enter a valid sender address (5-100 alphanumeric characters).");
        isValid = false;
      }

      // Receiver Address
      const receiverAddressInput = document.getElementsByName("receiver_address")[0];
      if (!addressRegex.test(receiverAddressInput.value.trim())) {
        showError(receiverAddressInput, "Enter a valid receiver address (5-100 alphanumeric characters).");
        isValid = false;
      }

      // Sender Phone Number
      const senderPhoneInput = document.getElementsByName("sender_number")[0];
      if (!phoneRegex.test(senderPhoneInput.value.trim())) {
        showError(senderPhoneInput, "Enter a valid sender phone number (10-15 numeric characters).");
        isValid = false;
      }

      // Receiver Phone Number
      const receiverPhoneInput = document.getElementsByName("receiver_number")[0];
      if (!phoneRegex.test(receiverPhoneInput.value.trim())) {
        showError(receiverPhoneInput, "Enter a valid receiver phone number (10-15 numeric characters).");
        isValid = false;
      }

      // Weight
      const weightInput = document.getElementsByName("weight")[0];
      if (!weightRegex.test(weightInput.value.trim()) || parseFloat(weightInput.value) <= 0) {
        showError(weightInput, "Enter a valid weight (positive number, up to 2 decimal places).");
        isValid = false;
      }

      // Courier Type
      const courierTypeInput = document.getElementsByName("courier_type")[0];
      if (courierTypeInput.value === "Select Courier Type" || courierTypeInput.value === "") {
        showError(courierTypeInput, "Please select a courier type.");
        isValid = false;
      }

      // Delivery Date
      const deliveryDateInput = document.getElementsByName("delivery_date")[0];
      if (!dateRegex.test(deliveryDateInput.value.trim())) {
        showError(deliveryDateInput, "Enter a valid delivery date in YYYY-MM-DD format.");
        isValid = false;
      } else {
        const selectedDate = new Date(deliveryDateInput.value);
        const currentDate = new Date();
        if (selectedDate < currentDate) {
          showError(deliveryDateInput, "Delivery date cannot be in the past.");
          isValid = false;
        }
      }

      // City Dropdown
      const cityInput = document.getElementsByName("city")[0];
      if (cityInput.value === "Select City" || cityInput.value === "") {
        showError(cityInput, "Please select a city.");
        isValid = false;
      }

      // Company Dropdown
      const companyInput = document.getElementsByName("company_id")[0];
      if (companyInput.value === "Select Company" || companyInput.value === "") {
        showError(companyInput, "Please select a company.");
        isValid = false;
      }

      // Branch Dropdown
      const branchInput = document.getElementsByName("branch_id")[0];
      if (branchInput.value === "Select Branch" || branchInput.value === "") {
        showError(branchInput, "Please select a branch.");
        isValid = false;
      }

      // Agent Dropdown
      const agentInput = document.getElementsByName("user_id")[0];
      if (agentInput.value === "Select Agent" || agentInput.value === "") {
        showError(agentInput, "Please select an agent.");
        isValid = false;
      }

      return isValid;
    }

    // Form submission event
    $("form").on("submit", function (e) {
      if (!validateForm()) {
        e.preventDefault(); // Prevent form submission if validation fails
      }
    });

    // Dynamic dropdown filters (same as before)
    $('#city').on('change', function () {
      const cityId = $(this).val();
      $('#company_id').html('<option selected disabled>Select Company</option>');
      $('#branch_id').html('<option selected disabled>Select Branch</option>');
      $('#user_id').html('<option selected disabled>Select Agent</option>');
      companies.forEach(company => {
        if (company.city_id == cityId) {
          $('#company_id').append(`<option value="${company.company_id}">${company.company_name}</option>`);
        }
      });
    });

    $('#company_id').on('change', function () {
      const companyId = $(this).val();
      $('#branch_id').html('<option selected disabled>Select Branch</option>');
      $('#user_id').html('<option selected disabled>Select Agent</option>');
      branches.forEach(branch => {
        if (branch.company_id == companyId) {
          $('#branch_id').append(`<option value="${branch.branch_id}">${branch.branch_name}</option>`);
        }
      });
    });

    $('#branch_id').on('change', function () {
      const branchId = $(this).val();
      $('#user_id').html('<option selected disabled>Select Agent</option>');
      users.forEach(user => {
        if (user.branch_id == branchId) {
          $('#user_id').append(`<option value="${user.user_id}">${user.username}</option>`);
        }
      });
    });
  });
</script>
    <?php include("footer.php"); ?>