<?php include('header.php');
?>

<div class='container-xxl flex-grow-1 mt-5'>
    <div class='bg-white rounded p-2'>
        <h5 class='py-4 px-2 fw-bold fs-4'>Add New Invoice</h5>
        <nav class='px-2' aria-label='breadcrumb'>
            <ol class='breadcrumb'>
                <li class='breadcrumb-item'><a href='manageCourier.php'>Manage Invoice</a></li>
                <li class='breadcrumb-item active' aria-current='page'>Add new Invoice</li>
            </ol>
        </nav>
    </div>
</div>

<div class='content-wrapper'>
    <div class='container-xxl flex-grow-1 container-p-y'>
        <div class='row'>
            <div class='col-12'>
                <div class='card'>
                    <div class='card-body'>
                        <div class='row'>
                            <div class='col-lg-8 mx-auto'>
                                <h5 class='mb-4'>1. Delivery Address</h5>
                                <form method='POST' action=''>
                                    <div class='row g-6'>

                                        <!-- Sender and Receiver Details -->

                                        <div class='col-md-6'>
                                            <label class='form-label' for='fullname'>Sender Name</label>
                                            <input name='sender_name' type='text' id='fullname' class='form-control'
                                                placeholder='John Doe' />
                                            <span class='error'></span>
                                        </div>
                                        <div class='col-md-6'>
                                            <label class='form-label' for='fullname'>Receiver Name</label>
                                            <input name='receiver_name' type='text' id='fullname' class='form-control'
                                                placeholder='John Doe' />
                                            <span class='error'></span>
                                        </div>
                                        <div class='col-md-6'>
                                            <label class='form-label' for='fullname'>Sender Address</label>
                                            <input name='sender_address' type='text' id='fullname' class='form-control'
                                                placeholder='123 Main Street' />
                                            <span class='error'></span>
                                        </div>
                                        <div class='col-md-6'>
                                            <label class='form-label' for='fullname'>Receiver Address</label>
                                            <input name='receiver_address' type='text' id='fullname'
                                                class='form-control' placeholder='101 ABC Society' />
                                            <span class='error'></span>
                                        </div>
                                        <div class='col-md-6'>
                                            <label class='form-label' for='fullname'>Sender Number</label>
                                            <input name='sender_number' type='text' id='fullname' class='form-control'
                                                placeholder='+1234567890' />
                                            <span class='error'></span>
                                        </div>
                                        <div class='col-md-6'>
                                            <label class='form-label' for='fullname'>Receiver Number</label>
                                            <input name='receiver_number' type='text' id='fullname' class='form-control'
                                                placeholder='+1234567890' />
                                            <span class='error'></span>
                                        </div>

                                        <!-- courier type  -->
                                        <div class=' mb-3 col-12 col-md-6'>
                                            <label for='floatingInput' class='form-label'>Courier Type</label>
                                            <select name='courier_type' id='courier_type'
                                                class='form-select text-secondary' required>
                                                <option selected disabled>Select Courier Type</option>
                                                <option value='Parcel'>Parcel</option>
                                                <option value='Document'>Document</option>
                                                <option value='Heavy'>Heavy</option>
                                            </select>
                                            <span class='error'></span>
                                        </div>

                                        <!-- weight  -->
                                        <div class='col-md-6'>
                                            <label class='form-label' for='weight'>Weight( kg )</label>
                                            <input name='weight' type='number' id='weight' class='form-control'
                                                placeholder='5' />
                                            <span class='error'></span>
                                            <div style='font-size: 12px;' class='mt-1 d-flex justify-content-end'>per kg
                                                Rs 200</div>

                                        </div>

                                        <hr>
                                        <!-- 2. Delivery Type -->
                                        <h5 class='my-6'>2. Delivery Type</h5>

                                        <div class='row gy-3 '>

                                            <div class='col-md '>
                                                <div class='form-check custom-option custom-option-icon text-center'>
                                                    <label class='form-check-label custom-option-content'
                                                        for='customRadioIcon1'>
                                                        <div class='d-flex flex-column align-items-center'>
                                                            <i class='bx bx-briefcase-alt-2'></i>
                                                            <div class='custom-option-title mb-2'>Standard</div>
                                                            <div><small>Delivery in 3-5 days.</small></div>
                                                            <input name='customDeliveryRadioIcon'
                                                                class='form-check-input mt-2' type='radio'
                                                                value='Standard' id='customRadioIcon1' checked />
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class='col-md'>
                                                <div class='form-check custom-option custom-option-icon text-center'>
                                                    <label class='form-check-label custom-option-content'
                                                        for='customRadioIcon2'>
                                                        <div class='d-flex flex-column align-items-center'>
                                                            <i class='bx bx-paper-plane'></i>
                                                            <div class='custom-option-title mb-2'>Express</div>
                                                            <div><small>Delivery within 2 days.</small></div>
                                                            <input name='customDeliveryRadioIcon'
                                                                class='form-check-input mt-2' type='radio'
                                                                value='Express' id='customRadioIcon2' />
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class='col-md'>
                                                <div class='form-check custom-option custom-option-icon text-center'>
                                                    <label class='form-check-label custom-option-content'
                                                        for='customRadioIcon3'>
                                                        <div class='d-flex flex-column align-items-center'>
                                                            <i class='bx bx-crown'></i>
                                                            <div class='custom-option-title mb-2'>Overnight</div>
                                                            <div><small>Delivery within a day.</small></div>
                                                            <input name='customDeliveryRadioIcon'
                                                                class='form-check-input mt-2' type='radio'
                                                                value='Overnight' id='customRadioIcon3' />
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>

                                        </div>
                                        <hr>
                                        <div class='col d-flex justify-content-end'>
                                            <button type='submit' name='add_courier' class='btn btn-primary '>Place
                                                Courier</button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src='https://code.jquery.com/jquery-3.6.0.min.js'></script>
        <style>
            .error {
                color: red;
                font-size: 0.85rem;
                margin-top: 4px;
                display: none;
                /* Hidden by default */
            }
        </style>
        <script>
            $(document).ready(function () {

                // Show error message

                function showError(input, message) {
                    const errorElement = input.nextElementSibling;
                    if (errorElement) {
                        errorElement.textContent = message;
                        errorElement.style.display = 'block';
                    }
                }

                // Hide error message

                function hideError(input) {
                    const errorElement = input.nextElementSibling;
                    if (errorElement) {
                        errorElement.textContent = '';
                        errorElement.style.display = 'none';
                    }
                }

                // Validation function

                function validateForm() {
                    const nameRegex = /^[ A-Za-z\s ] {
                    3, 50
                }
                $ /;
                const addressRegex = /^[ A-Za-z0-9\s, .- ] {
                5, 100
            }
                $ /;
            const phoneRegex = /^\+?[ 0-9 ] {
            10, 15}
            $ /;
            const weightRegex = /^[ 0-9 ]+( \.[ 0-9 ] {
            1, 2}
                    )?$ /;
            // Positive number with up to 2 decimal places
            const dateRegex = /^\d {
            4}
            -\d {
                2
            }
            -\d {
                2
            }
            $ /;
            // YYYY-MM-DD format

            let isValid = true;

            // Validate fields
            $('.form-control').each(function () {
                hideError(this);
                // Reset errors
            }
            );

            // Sender Name
            const senderNameInput = document.getElementById('fullname');
            if (!nameRegex.test(senderNameInput.value.trim())) {
                showError(senderNameInput, 'Enter a valid sender name (3-50 alphabetic characters).');
                isValid = false;
            }

            // Receiver Name
            const receiverNameInput = document.getElementsByName('receiver_name')[0];
            if (!nameRegex.test(receiverNameInput.value.trim())) {
                showError(receiverNameInput, 'Enter a valid receiver name (3-50 alphabetic characters).');
                isValid = false;
            }

            // Sender Address
            const senderAddressInput = document.getElementsByName('sender_address')[0];
            if (!addressRegex.test(senderAddressInput.value.trim())) {
                showError(senderAddressInput, 'Enter a valid sender address (5-100 alphanumeric characters).');
                isValid = false;
            }

            // Receiver Address
            const receiverAddressInput = document.getElementsByName('receiver_address')[0];
            if (!addressRegex.test(receiverAddressInput.value.trim())) {
                showError(receiverAddressInput, 'Enter a valid receiver address (5-100 alphanumeric characters).');
                isValid = false;
            }

            // Sender Phone Number
            const senderPhoneInput = document.getElementsByName('sender_number')[0];
            if (!phoneRegex.test(senderPhoneInput.value.trim())) {
                showError(senderPhoneInput, 'Enter a valid sender phone number (10-15 numeric characters).');
                isValid = false;
            }

            // Receiver Phone Number
            const receiverPhoneInput = document.getElementsByName('receiver_number')[0];
            if (!phoneRegex.test(receiverPhoneInput.value.trim())) {
                showError(receiverPhoneInput, 'Enter a valid receiver phone number (10-15 numeric characters).');
                isValid = false;
            }

            // Weight
            const weightInput = document.getElementsByName('weight')[0];
            if (!weightRegex.test(weightInput.value.trim()) || parseFloat(weightInput.value) <= 0) {
                showError(weightInput, 'Enter a valid weight (positive number, up to 2 decimal places).');
                isValid = false;
            }

            // Courier Type
            const courierTypeInput = document.getElementsByName('courier_type')[0];
            if (courierTypeInput.value === 'Select Courier Type' || courierTypeInput.value === '') {
                showError(courierTypeInput, 'Please select a courier type.');
                isValid = false;
            }

            return isValid;
                        }

                    }
                );
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
            $delivery_type = $_POST['customDeliveryRadioIcon'];
            $status = 'Fulfilled';
            $created_at = date('Y-m-d');
            $delivery_date = date('Y-m-d');
            $branch_id = $_SESSION['branch_id'];
            $company_id = $_SESSION['company_id'];
            $user_id = $_SESSION['user_id'];
            $city = $_SESSION['city'];
            $weight = $_POST['weight'];
            $price = $weight * 200;
            $user_customer_id = $_SESSION['user_id'];

            $tracking_number = strtoupper(uniqid('TRK', true));

            $insertQuery = "INSERT INTO `couriers`(`sender_name`, `receiver_name`, `sender_address`, `receiver_address`,
       `sender_phone_number`, `reciever_phone_number`, `city`,
        `courier_type`, `delivery_type`, `weight_kg`, `price_pkr`, `status`, `created_at`, `delivery_date`, `branch_id`, `user_id`, `tracking_number`, `company_id`,`user_customer_id`)
       VALUES (' $sender_name','$receiver_name','$sender_address','$receiver_address',
       '$sender_number','$receiver_number','$city',
       '$courier_type','$delivery_type','$weight','$price','$status','$created_at','$delivery_date','$branch_id','$user_id','$tracking_number','$company_id', '$user_customer_id')";

            if (mysqli_query($connect, $insertQuery)) {
                echo "<script>alert('Courier Added Successfully!');</script>";
            } else {
                echo "<script>alert('Error: " . mysqli_error($connect) . "');</script>";
            }
        }
        ?>

        <?php include('footer.php');
        ?>