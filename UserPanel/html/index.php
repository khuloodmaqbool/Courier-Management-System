<?php
include('header.php');

$user_id = $_SESSION['user_id']; 

// Total Couriers
$totalCouriersQuery = "SELECT COUNT(*) AS total_couriers FROM couriers WHERE user_customer_id = '$user_id'";
$totalCouriersResult = mysqli_query($connect, $totalCouriersQuery);
$totalCouriers = mysqli_fetch_assoc($totalCouriersResult)['total_couriers'];

// Pending Deliveries
$pendingDeliveriesQuery = "SELECT COUNT(*) AS pending_deliveries FROM couriers WHERE status = 'Pending' AND user_customer_id = '$user_id'";
$pendingDeliveriesResult = mysqli_query($connect, $pendingDeliveriesQuery);
$pendingDeliveries = mysqli_fetch_assoc($pendingDeliveriesResult)['pending_deliveries'];

// Fulfilled Deliveries
$fulfilledDeliveriesQuery = "SELECT COUNT(*) AS fulfilled_deliveries FROM couriers WHERE status = 'Fulfilled' AND user_customer_id = '$user_id'";
$fulfilledDeliveriesResult = mysqli_query($connect, $fulfilledDeliveriesQuery);
$fulfilledDeliveries = mysqli_fetch_assoc($fulfilledDeliveriesResult)['fulfilled_deliveries'];

// Cancelled Deliveries
$cancelledDeliveriesQuery = "SELECT COUNT(*) AS cancelled_deliveries FROM couriers WHERE status = 'Cancelled' AND user_customer_id = '$user_id'";
$cancelledDeliveriesResult = mysqli_query($connect, $cancelledDeliveriesQuery);
$cancelledDeliveries = mysqli_fetch_assoc($cancelledDeliveriesResult)['cancelled_deliveries'];

// Total Revenue
$totalRevenueQuery = "SELECT SUM(price_pkr) AS total_revenue FROM couriers WHERE status = 'Fulfilled' AND user_customer_id = '$user_id'";
$totalRevenueResult = mysqli_query($connect, $totalRevenueQuery);
$totalRevenue = mysqli_fetch_assoc($totalRevenueResult)['total_revenue'];

// Fetch courier details with JOINs
$select = "
  SELECT 
    c.courier_id, 
    c.sender_name, 
    c.receiver_name, 
    c.sender_address, 
    c.receiver_address, 
    c.courier_type, 
    c.status, 
    c.weight_kg,
    c.price_pkr,
    c.delivery_type,
    c.created_at, 
    c.delivery_date, 
    b.branch_name, 
    u.username,
    c.tracking_number,  
    co.company_name,
    ci.city_name        
FROM 
    couriers c
INNER JOIN 
    branches b ON c.branch_id = b.branch_id
INNER JOIN 
    users u ON c.user_id = u.user_id
INNER JOIN 
    companies co ON c.company_id = co.company_id
INNER JOIN 
    cities ci ON ci.city_id = co.city_id 
        WHERE 
    c.user_customer_id = '$user_id'
LIMIT 3;
";

$monthQuery = "SELECT MONTH(created_at) AS month, COUNT(courier_id) AS total_couriers FROM couriers WHERE user_customer_id = '$user_id' GROUP BY MONTH(created_at)";
$monthResult = mysqli_query($connect, $monthQuery);


$months = [];
$totalCouriersPerMonth = [];
while ($row = mysqli_fetch_assoc($monthResult)) {
    $months[] = $row['month'];
    $totalCouriersPerMonth[] = $row['total_couriers'];
}


$select = "
  SELECT 
    c.courier_id, 
    c.sender_name, 
    c.receiver_name, 
    c.sender_address, 
    c.receiver_address, 
    c.courier_type, 
    c.status, 
    c.weight_kg,
    c.price_pkr,
    c.delivery_type,
    c.created_at, 
    c.delivery_date, 
    b.branch_name, 
    u.username,
    c.tracking_number,  
    co.company_name,
    ci.city_name        
FROM 
    couriers c
INNER JOIN 
    branches b ON c.branch_id = b.branch_id
INNER JOIN 
    users u ON c.user_id = u.user_id
INNER JOIN 
    companies co ON c.company_id = co.company_id
INNER JOIN 
    cities ci ON ci.city_id = co.city_id 
        WHERE 
    c.user_customer_id = {$_SESSION['user_id']}
LIMIT 3;
";

$query = mysqli_query($connect, $select);
?>


<!-- HTML Structure for the Dashboard -->
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        
        <div class="col-xxl-12 mb-6 order-0">
            <div class="card">
                <div class="d-flex align-items-start row">
                    <div class="col-sm-7">
                    <div class="card-body">
                            <h5 class="card-title text-primary mb-3">Hi Customer <?php echo  $_SESSION['full_name']?> 🎉</h5>
                            <p class="mb-6">
                            We're glad to see you. Explore your dashboard <br /> to manage your couriers effectively.
                                <!-- You have done 72% more sales today.<br />Check your new badge in your profile. -->
                            </p>
                            <a href="manageCourier.php" class="btn btn-sm btn-outline-primary">View Couriers</a>
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-6">
                            <img src="../assets/img/illustrations/man-with-laptop.png" height="175"
                                class="scaleX-n1-rtl" alt="View Badge User" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class='row text-center mx-auto'>
            <!-- Total Couriers -->
            <div class='col-md-4 mb-3'>
                <div class='card p-4 h-100 shadow rounded'>
                    <div class='card-body'>
                        <div class='card-title d-flex align-items-start justify-content-between mb-4'>
                            <div style='background-color: rgb(231,231,255); color: rgb(162,161,255); '
                                class='avatar d-flex justify-content-center align-items-center rounded mx-auto'>
                                <i class='fa fa-truck mx-auto'></i>
                            </div>
                        </div>
                        <p class='mb-1'>Total Couriers</p>
                        <h4 class='card-title mb-3'><?php echo $totalCouriers; ?></h4>
                    </div>
                </div>
            </div>
            <!-- Pending Deliveries -->
            <div class='col-md-4 mb-3'>
                <div class='card p-4 h-100 shadow rounded'>
                    <div class='card-body'>
                        <div class='card-title d-flex align-items-start justify-content-between mb-4'>
                            <div style='background-color: rgb(232,249,223); color: #71dd37 '
                                class='avatar d-flex justify-content-center align-items-center rounded mx-auto'>
                                <i class='fa fa-cube mx-auto'></i>
                            </div>
                        </div>
                        <p class='mb-1'>Pending Deliveries</p>
                        <h4 class='card-title mb-3'><?php echo $pendingDeliveries; ?></h4>
                    </div>
                </div>
            </div>
            <!-- Fulfilled Deliveries -->
            <div class='col-md-4 mb-3'>
                <div class='card p-4 h-100 shadow rounded'>
                    <div class='card-body'>
                        <div class='card-title d-flex align-items-start justify-content-between mb-4'>
                            <div style='background-color: #d6f5fc; color: rgb(3,195,236); '
                                class='avatar d-flex justify-content-center align-items-center rounded mx-auto'>
                                <i class='fa fa-box mx-auto'></i>
                            </div>
                        </div>
                        <p class='mb-1'>Fulfilled Deliveries</p>
                        <h4 class='card-title mb-3'><?php echo number_format($fulfilledDeliveries); ?></h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Updated HTML structure for responsive charts -->
        <div class="row mb-6 mx-auto mt-6">
            <div class="col-xl-6  col-md-6">
                <div class="bg-white p-6 rounded">
                <h4>Delivery Status</h4>
                <div class="chart-container">
                    <canvas id="courierStatusGraph"></canvas>
                </div>
                </div>
            </div>
            <div class="col-xl-6  col-md-6">
               <div class="bg-white p-6 rounded">
               <h4>Total Couriers</h4>
                <div class="chart-container">
                    <canvas id="totalCouriersGraph"></canvas>
                </div>
               </div>
            </div>
        </div>

        <!-- <div class='row'> -->

<div class='row g-4 mx-auto'>
        <?php while ($fetch = mysqli_fetch_assoc($query)) {
            ?>
            <div class='col-12 col-md-6 col-lg-4 '>
                <div style='border: 2px solid #696CFF;' class='card p-4'>

                    <div class='d-flex justify-content-between align-items-center bg-white'>
                        <div class='d-flex align-items-center'>
                            <div class='border border-gray-300 rounded-circle d-flex align-items-center justify-content-center'
                                style='width: 50px; height: 50px;'>
                                <i style='color: #696CFF;' class='fa fa-truck'></i>
                            </div>
                            <h5 class='mb-0 ms-2 text-wrap' style='max-width: 180px; word-break: break-word;'>
                                <?php echo $fetch['tracking_number'];
                                ?>
                            </h5>

                        </div>

                        <button style="border: none;
            background-color: <?php
            echo ($fetch['status'] === 'Pending') ? 'yellow' :
                ($fetch['status'] === 'Fulfilled' ? 'lightgreen' :
                    ($fetch['status'] === 'Cancelled' ? 'red' : 'white'));
            ?>;
            color: black;
        " class='btn btn-outline-primary px-4 py-1 rounded-pill'>
                                    <?php echo $fetch['status'];
                                    ?></button>
                    </div>
                    <hr>
                    <div class='d-flex justify-content-between align-items-center'>
                        <h3 class='fw-bold'>
                            <!-- 03:50 PM -->
                            <?php echo $fetch['city_name']; ?>
                        </h3>
                        <div>
                            <p class='fs-5 m-0 text-black fw-bold'><?php echo $fetch['price_pkr']; ?>Rs</p>
                            <p style='font-size: 12px;' class='m-0'><?php echo $fetch['weight_kg']; ?>kg</p>
                        </div>
                    </div>

                    <div class='d-flex justify-content-between align-items-center'>
                        <p class='m-0 text-black fw-bold'><?php echo $fetch['created_at'];
                        ?></p>
                        <p class='m-0 text-black fw-bold'><?php echo $fetch['delivery_date'];
                        ?></p>
                    </div>

                    <img class='w-100 my-4' src='../assets/img/elements/track.svg' alt=''>

                    <div class='d-flex  flex-row justify-content-between align-items-center'>
                        <div class='me-1'>
                            <p class='text-black m-0 fw-bold'><?php echo $fetch['sender_address'];
                            ?></p>
                            <!-- <p>Karachi, Pakistan</p> -->
                        </div>
                        <div class='ms-1'>
                            <p class='text-black m-0 fw-bold'><?php echo $fetch['receiver_address'];
                            ?></p>
                            <!-- <p>Lahore, Pakistan</p> -->
                        </div>
                    </div>

                    <hr>

                    <div class='d-flex  flex-row justify-content-between align-items-center'>
                        <div>
                            <p class='text-black m-0 fw-bold'><?php echo $fetch['sender_name'];
                            ?></p>
                            <p class='m-0'>Sender</p>
                            <p class='m-1'>037888978998</p>
                        </div>
                        <div>
                            <p class='text-black m-0 fw-bold'><?php echo $fetch['receiver_name'];
                            ?></p>
                            <p class='m-0'>Recepient</p>
                            <p class='m-1'>037888978998</p>
                        </div>
                    </div>
                    <hr>


                    <div class='d-flex  flex-row justify-content-between align-items-center'>
                        <div>
                            <p class='text-black m-0 fw-bold'><?php echo $fetch['username'];
                            ?></p>
                            <p class='m-0'>Agent</p>
                            <!-- <p class='m-1'>037888978998</p> -->
                        </div>
                        <div>
                            <p class='text-black m-0 fw-bold'><?php echo $fetch['courier_type']; ?></p>
                            <p class='m-0'><?php echo $fetch['delivery_type']; ?> Delivery</p>
                            <!-- <p class='m-1'>037888978998</p> -->
                        </div>
                    </div>

                    <hr>


                    <div class='d-flex justify-content-end align-items-center'>
                        <div>
                            <p class='text-black m-0 fw-bold'><?php echo $fetch['company_name'];
                            ?></p>
                            <p><?php echo $fetch['branch_name'];
                            ?></p>
                        </div>
                    </div>

                </div>
            </div>
        <?php }
        ?>
       
    </div>
    <a style="width:fit-content;" class="btn btn-primary mt-6 ms-3" href="manageCourier.php">View All Couriers</a>

<!-- </div> -->


    </div>
</div>

<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
<script>
    const courierStatusCtx = document.getElementById('courierStatusGraph').getContext('2d');
    const totalCouriersCtx = document.getElementById('totalCouriersGraph').getContext('2d');

    // Courier Status Graph (Pie Chart)
    const courierStatusGraph = new Chart(courierStatusCtx, {
        type: 'pie',
        data: {
            labels: ['Pending', 'Fulfilled', 'Cancelled'],
            datasets: [{
                label: 'Courier Status',
                data: [
                    <?php echo $pendingDeliveries; ?>,
                    <?php echo $fulfilledDeliveries; ?>,
                    <?php echo $cancelledDeliveries; ?>
                ],
                backgroundColor: ['#fff9ed', '#e8f9df', '#ffe0db'],
                borderColor: ['#ffbc31', '#76de3e', '#ff9d8d'],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,  // Ensure aspect ratio is flexible
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function (tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw;
                        }
                    }
                }
            }
        }
    });

    // Total Couriers Graph (Doughnut Chart)
    const totalCouriersGraph = new Chart(totalCouriersCtx, {
        type: 'doughnut',
        data: {
            labels: <?php echo json_encode(array_reverse($months)); ?>,
            datasets: [{
                label: 'Total Couriers',
                data: <?php echo json_encode(array_reverse($totalCouriersPerMonth)); ?>,
                backgroundColor: [
                    '#e7e7ff',
                    '#e7e7ff',
                    '#e7e7ff',
                    '#e7e7ff',
                    '#e7e7ff',
                    '#e7e7ff',
                    '#e7e7ff'
                ],
                borderColor: '#696cff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            cutout: '70%', // Makes the center hole bigger for the doughnut look
            maintainAspectRatio: false,  // Ensure aspect ratio is flexible
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function (tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw;
                        }
                    }
                }
            }
        }
    });

</script>
<?php include("footer.php") ?>