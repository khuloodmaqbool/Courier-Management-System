<?php
$connect = mysqli_connect("localhost", "root", "", "newcourier2",3307);

$sql = "SELECT c.city_name, COUNT(b.branch_id) AS branch_count 
        FROM branches b
        JOIN cities c ON b.city = c.city_id 
        GROUP BY c.city_name";
$result = $connect->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cities[] = $row['city_name'];
        $branchCounts[] = $row['branch_count'];
    }
}


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
    cities ci ON ci.city_id = co.city_id LIMIT 2;

";

$query = mysqli_query($connect, $select);
?>






<!-- <div class='row'> -->

    <div class='row g-4'>
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

                        <button style='background-color: #BCBEFF;' class='btn btn-outline-primary px-4 py-1 rounded-pill'>
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
        <div class='col-12 col-md-6 col-lg-4 '>

            <div class="h-100">
                <div class="card">
                    <div class="card-body">
                        <div class="chart-container">
                            <h4>Total Branch by City</h4>
                            <canvas id="branchesChart"></canvas>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="btn btn-primary mt-6" href="manageCourier.php">View All Couriers</a>

<!-- </div> -->


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Chart: Branch Distribution by City (Donut)
    new Chart(document.getElementById('branchesChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: <?php echo json_encode($cities); ?>,
            datasets: [{
                label: 'Number of Branches',
                data: <?php echo json_encode($branchCounts); ?>,
                backgroundColor: ['#ff6384', '#36a2eb', '#cc65fe', '#ffce56', '#4bc0c0'],
                hoverOffset: 4
            }]
        },
        options: { responsive: true }
    });
</script>