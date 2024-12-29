<?php
include("header.php");

// Database connection (ensure $connect is defined)
$companies = [];
$companyBranchCounts = [];
$userCities = [];
$userCounts = [];
$cities = [];
$branchCounts = [];

// Query to get the number of branches per company
$sql = "SELECT c.company_name, COUNT(b.branch_id) AS branch_count 
        FROM companies c 
        LEFT JOIN branches b ON c.company_id = b.company_id 
        GROUP BY c.company_id";
$result = $connect->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $companies[] = $row['company_name'];
        $companyBranchCounts[] = $row['branch_count'];
    }
}

// Query to get the number of users per city
$sql = "SELECT c.city_name, COUNT(u.user_id) AS user_count 
        FROM users u 
        JOIN cities c ON u.city = c.city_id 
        GROUP BY c.city_name";
$result = $connect->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $userCities[] = $row['city_name'];
        $userCounts[] = $row['user_count'];
    }
}

// Get the count of cities
$cityQuery = "SELECT COUNT(*) as city_count FROM cities";
$cityResult = mysqli_query($connect, $cityQuery);
$cityRow = mysqli_fetch_assoc($cityResult);
$cityCount = $cityRow['city_count'];

// Get the count of companies
$companyQuery = "SELECT COUNT(*) as company_count FROM companies";
$companyResult = mysqli_query($connect, $companyQuery);
$companyRow = mysqli_fetch_assoc($companyResult);
$companyCount = $companyRow['company_count'];

// Get the count of cities
$branchQuery = "SELECT COUNT(*) as branch_count FROM branches";
$branchResult = mysqli_query($connect, $branchQuery);
$branchRow = mysqli_fetch_assoc($branchResult);
$branchCount = $branchRow['branch_count'];

// Get the count of companies
$courierQuery = "SELECT COUNT(*) as courier_count FROM couriers";
$courierResult = mysqli_query($connect, $courierQuery);
$courierRow = mysqli_fetch_assoc($courierResult);
$courierCount = $courierRow['courier_count'];

$connect->close();
?>

<!-- Content wrapper -->
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-xxl-12 mb-6 order-0">
            <div class="card">
                <div class="d-flex align-items-start row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary mb-3">Hi Admin <?php echo $_SESSION['full_name'] ?> 🎉
                            </h5>
                            <p class="mb-6">
                                Welcome back to your admin dashboard! <br />
                                You have full control to manage cities, branches, companies, agents, and more. <br />
                                Stay on top of the courier operations and ensure smooth management.
                            </p>
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



        <!-- Counts Section -->
        <div class="row">

            <div class="col-xxl-3 col-xl-3 col-md-4 col-12 mx-auto my-4 ">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                            <div style="background-color: rgb(232,249,223); color: #71dd37 "
                                class="avatar d-flex justify-content-center align-items-center rounded">
                                <i class="fa fa-city"></i>
                            </div>

                        </div>
                        <p class="mb-1">Cities</p>
                        <h4 class="card-title mb-3"><?= $cityCount ?></h4>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-xl-3 col-md-4 col-12 mx-auto my-4 ">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                            <div style="background-color: #d6f5fc; color: rgb(3,195,236); "
                                class="avatar d-flex justify-content-center align-items-center rounded">
                                <i class="fa fa-industry "></i>
                            </div>
                        </div>
                        <p class="mb-1">Companies</p>
                        <h4 class="card-title mb-3"><?= $companyCount ?></h4>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-xl-3 col-md-4 col-12 mx-auto my-4 ">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                            <div style="background-color: rgb(255,224,219); color: rgb(255,139,119); "
                                class="avatar d-flex justify-content-center align-items-center rounded">
                                <i class="fa fa-building "></i>
                            </div>

                        </div>
                        <p class="mb-1">Branches</p>
                        <h4 class="card-title mb-3"><?= $branchCount ?></h4>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-xl-3 col-md-4 col-12 mx-auto my-4 ">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between mb-4">
                            <div style="background-color: rgb(231,231,255); color: rgb(162,161,255); "
                                class="avatar d-flex justify-content-center align-items-center rounded">
                                <i class="fa fa-truck "></i>
                            </div>
                        </div>
                        <p class="mb-1">Couriers</p>
                        <h4 class="card-title mb-3"><?= $courierCount ?></h4>
                    </div>
                </div>
            </div>

        </div>


        <!-- Charts -->
        <div class=" row mx-auto mt-4">
            <div class="col-xl-6 col-sm-12 bg-white rounded mb-6">
                <div style="width: 90%; margin: auto;">
                    <h4 class="mt-3">Total Branches by Companies</h4>
                    <canvas id="companyBranchChart"></canvas>
                </div>
            </div>
            <div class="col-xl-6 col-sm-12 mb-6 rounded">
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <h4>Total Users </h4>
                            <canvas id="userCityChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include("row.php") ?>


        <?php
        include("footer.php");
        ?>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Debugging Data in Console
            console.log("Companies:", <?php echo json_encode($companies); ?>);
            console.log("Company Branch Counts:", <?php echo json_encode($companyBranchCounts); ?>);
            console.log("Cities:", <?php echo json_encode($cities); ?>);
            console.log("Branch Counts:", <?php echo json_encode($branchCounts); ?>);
            console.log("User Cities:", <?php echo json_encode($userCities); ?>);
            console.log("User Counts:", <?php echo json_encode($userCounts); ?>);

            // Chart: Company-wise Branch Distribution
            new Chart(document.getElementById('companyBranchChart').getContext('2d'), {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($companies); ?>,
                    datasets: [{
                        label: 'Number of Branches',
                        data: <?php echo json_encode($companyBranchCounts); ?>,
                        backgroundColor: '#e7e7ff',
                        borderColor: '#696cff',
                        tension: 0.4,
                        fill: true,
                        borderWidth: 2
                    }]
                },
                options: { responsive: true }
            });

            // Chart: User Distribution by City
            new Chart(document.getElementById('userCityChart').getContext('2d'), {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($userCities); ?>,
                    datasets: [{
                        label: 'Number of Users',
                        data: <?php echo json_encode($userCounts); ?>,
                        backgroundColor: '#fff9ed',
                        borderColor: '#ffb826',
                        tension: 0.4,
                        fill: true,
                        borderWidth: 2
                    }]
                },
                options: { responsive: true }
            });

        </script>