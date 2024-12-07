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
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="fullname">Receiver Name</label>
                    <input name="receiver_name" type="text" id="fullname" class="form-control" placeholder="John Doe" />
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="fullname">Sender Address</label>
                    <input name="sender_address" type="text" id="fullname" class="form-control" placeholder="123 Main Street" />
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="fullname">Receiver Address</label>
                    <input name="receiver_address" type="text" id="fullname" class="form-control" placeholder="101 ABC Society" />
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="fullname">Sender Number</label>
                    <input name="sender_number" type="text" id="fullname" class="form-control" placeholder="+1234567890" />
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="fullname">Receiver Number</label>
                    <input name="receiver_number" type="text" id="fullname" class="form-control" placeholder="+1234567890" />
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
                  </div>

                  <!-- Company Dropdown -->
                  <div class="mb-3 col-12 col-md-6">
                    <label for="company_id" class="form-label">Company</label>
                    <select name="company_id" id="company_id" class="form-select text-secondary" required>
                      <option selected disabled>Select Company</option>
                    </select>
                  </div>

                  <!-- Branch Dropdown -->
                  <div class="mb-3 col-12 col-md-6">
                    <label for="branch_id" class="form-label">Branches</label>
                    <select name="branch_id" id="branch_id" class="form-select text-secondary" required>
                      <option selected disabled>Select Branch</option>
                    </select>
                  </div>

                  <!-- Agent Dropdown -->
                  <div class="mb-3 col-12 col-md-6">
                    <label for="user_id" class="form-label">Agent</label>
                    <select name="user_id" id="user_id" class="form-select text-secondary" required>
                      <option selected disabled>Select Agent</option>
                    </select>
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
                  </div>

                  <!-- weight  -->
                  <div class="col-md-6">
                    <label class="form-label" for="weight">Weight(kg)</label>
                    <input name="weight" type="number" id="weight" class="form-control" placeholder="5" />
                    <div style="font-size: 12px;" class="mt-1 d-flex justify-content-end">per kg Rs 200</div>
                  </div>

<!-- delievery date  -->
<div class="col-md-6">
                    <label class="form-label" for="delivery_date">Delivery Date</label>
                    <input name="delivery_date" type="date" id="delivery_date" class="form-control" />
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
                            <input name="customDeliveryRadioIcon" class="form-check-input mt-2" type="radio" value="Standard"
                              id="customRadioIcon1" checked />
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
                            <input name="customDeliveryRadioIcon" class="form-check-input mt-2" type="radio" value="Express"
                              id="customRadioIcon2" />
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
                            <input name="customDeliveryRadioIcon" class="form-check-input mt-2" type="radio" value="Overnight"
                              id="customRadioIcon3" />
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
    <script>
      $(document).ready(function () {
        const branches = <?php echo json_encode($branchesData); ?>;
        const users = <?php echo json_encode($usersData); ?>;
        const companies = <?php echo json_encode($companiesData); ?>;

        // Filter companies based on city
        $('#city').on('change', function () {
          const cityId = $(this).val();
          $('#company_id').html('<option selected disabled>Select Company</option>');
          $('#branch_id').html('<option selected disabled>Select Branch</option>');
          $('#user_id').html('<option selected disabled>Select Agent</option>');
          
          // Populate companies
          companies.forEach(company => {
            if (company.city_id == cityId) {
              $('#company_id').append(`<option value="${company.company_id}">${company.company_name}</option>`);
            }
          });
        });

        // Filter branches based on company
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

        // Filter agents based on branch
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

<?php
    if (isset($_POST['add_courier'])) {
      $sender_name = $_POST['sender_name'];
      $receiver_name = $_POST['receiver_name'];
      $sender_address = $_POST['sender_address'];
      $receiver_address = $_POST['receiver_address'];
      $sender_number = $_POST['sender_number'];
      $receiver_number = $_POST['receiver_number'];
      $courier_type = $_POST['courier_type'];
      $delivery_type= $_POST['customDeliveryRadioIcon'];
      $status = "Pending";
      $created_at = date('Y-m-d');
      $delivery_date = $_POST['delivery_date'];
      $branch_id = $_POST['branch_id'];
      $company_id = $_POST['company_id'];
      $user_id = $_POST['user_id'];
      $city = $_POST['user_id'];
      $weight = $_POST['weight'];
      $price = $weight*200;

      $tracking_number = strtoupper(uniqid('TRK', true));

      $insertQuery = "INSERT INTO `couriers`(`sender_name`, `receiver_name`, `sender_address`, `receiver_address`,
       `sender_phone_number`, `reciever_phone_number`, `city`,
        `courier_type`, `delivery_type`, `weight_kg`, `price_pkr`, `status`, `created_at`, `delivery_date`, `branch_id`, `user_id`, `tracking_number`, `company_id`)
       VALUES (' $sender_name','$receiver_name','$sender_address','$receiver_address',
       '$sender_number','$receiver_number','$city',
       '$courier_type','$delivery_type','$weight','$price','$status','$created_at','$delivery_date','$branch_id','$user_id','$tracking_number','$company_id')";

      if (mysqli_query($connect, $insertQuery)) {
        echo "<script>alert('Courier Added Successfully!');</script>";
      } else {
        echo "<script>alert('Error: " . mysqli_error($connect) . "');</script>";
      }
    }
    ?>


    <?php include("footer.php"); ?>