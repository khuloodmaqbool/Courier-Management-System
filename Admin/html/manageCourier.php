<?php
include('header.php');

// Prepare the base query
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
";

// Check for search input and use prepared statement to prevent SQL injection
if (isset($_POST['search'])) {
    $search_courier = trim($_POST['search_courier']);
    if (!empty($search_courier)) {
        $select .= " WHERE c.tracking_number LIKE ?";
    }
}

// Prepare the query
$stmt = $connect->prepare($select);
if (isset($search_courier) && !empty($search_courier)) {
    $search_term = '%' . $search_courier . '%';
    $stmt->bind_param("s", $search_term);
}
$stmt->execute();
$result = $stmt->get_result();
?>

<!-- Content wrapper -->
<div class="container-fluid pt-4 px-4 mx-2">
    <div class="bg-white rounded py-4 px-3">
        <div class="d-flex flex-wrap align-items-center justify-content-between">
            <form method="POST" style="width: 300px" class="input-group my-2 mx-1">
                <input name="search_courier" placeholder="Enter tracking number" type="text" class="form-control">
                <button name="search" type="submit" class="input-group-text bg-primary text-white">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>
    </div>
</div>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mt-4 bg-white rounded shadow-sm p-4">
            <h4>All Couriers</h4>
            <a href="manageCourier.php" class="btn btn-primary mx-1">View All</a>
        </div>

        <div class="row mx-auto">
            <div class="row g-4 mx-auto">
                <?php while ($fetch = $result->fetch_assoc()) { ?>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card p-4" style="border: 2px solid #696CFF;">
                            <div class="d-flex justify-content-between align-items-center bg-white">
                                <div class="d-flex align-items-center">
                                    <div class="border border-gray-300 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i style="color: #696CFF;" class="fa fa-truck"></i>
                                    </div>
                                    <h5 class="mb-0 ms-2 text-wrap" style="max-width: 180px; word-break: break-word;">
                                        <?php echo htmlspecialchars($fetch['tracking_number']); ?>
                                    </h5>
                                </div>
                                <button class="px-4 py-1 rounded-pill" style="border: none; background-color: <?php 
                                    echo ($fetch['status'] === 'Pending') ? 'yellow' : 
                                         (($fetch['status'] === 'Fulfilled') ? 'lightgreen' : 
                                         (($fetch['status'] === 'Cancelled') ? 'red' : 'white')); ?>; color: black;">
                                    <?php echo htmlspecialchars($fetch['status']); ?>
                                </button>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="fw-bold"><?php echo htmlspecialchars($fetch['city_name']); ?></h3>
                                <div>
                                    <p class="fs-5 m-0 text-black fw-bold"><?php echo htmlspecialchars($fetch['price_pkr']); ?> Rs</p>
                                    <p style="font-size: 12px;" class="m-0"><?php echo htmlspecialchars($fetch['weight_kg']); ?> kg</p>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <p class="m-0 text-black fw-bold"><?php echo htmlspecialchars($fetch['created_at']); ?></p>
                                <p class="m-0 text-black fw-bold"><?php echo htmlspecialchars($fetch['delivery_date']); ?></p>
                            </div>

                            <img class="w-100 my-4" src="../assets/img/elements/track.svg" alt="">

                            <div class="d-flex flex-row justify-content-between align-items-center">
                                <div class="me-1">
                                    <p class="text-black m-0 fw-bold"><?php echo htmlspecialchars($fetch['sender_address']); ?></p>
                                </div>
                                <div class="ms-1">
                                    <p class="text-black m-0 fw-bold"><?php echo htmlspecialchars($fetch['receiver_address']); ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex flex-row justify-content-between align-items-center">
                                <div>
                                    <p class="text-black m-0 fw-bold"><?php echo htmlspecialchars($fetch['sender_name']); ?></p>
                                    <p class="m-0">Sender</p>
                                </div>
                                <div>
                                    <p class="text-black m-0 fw-bold"><?php echo htmlspecialchars($fetch['receiver_name']); ?></p>
                                    <p class="m-0">Recipient</p>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex flex-row justify-content-between align-items-center">
                                <div>
                                    <p class="text-black m-0 fw-bold"><?php echo htmlspecialchars($fetch['username']); ?></p>
                                    <p class="m-0">Agent</p>
                                </div>
                                <div>
                                    <p class="text-black m-0 fw-bold"><?php echo htmlspecialchars($fetch['courier_type']); ?></p>
                                    <p class="m-0"><?php echo htmlspecialchars($fetch['delivery_type']); ?> Delivery</p>
                                </div>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-end align-items-center">
                                <div>
                                    <p class="text-black m-0 fw-bold"><?php echo htmlspecialchars($fetch['company_name']); ?></p>
                                    <p><?php echo htmlspecialchars($fetch['branch_name']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
