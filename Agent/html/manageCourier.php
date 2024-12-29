<?php
include('header.php');

// Handle POST request to update the status
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $courier_id = intval($_POST['courier_id']);
    $status = mysqli_real_escape_string($connect, $_POST['status']);

    // Update query
    $update = "UPDATE couriers SET status = '$status' WHERE courier_id = $courier_id";
    if (mysqli_query($connect, $update)) {
        echo "<script>alert('Status updated successfully!');</script>";
    } else {
        echo "<script>alert('Error updating status: " . mysqli_error($connect) . "');</script>";
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
    c.user_customer_id,
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
    c.user_id = {$_SESSION['user_id']};
";


$query = mysqli_query($connect, $select);
?>

<div class = 'container-fluid pt-4 px-4 mx-2'>
<div class = 'bg-white rounded py-4 px-3'>
<h5 class = 'py-1 px-2 fs-4 fw-bold'>All Couriers</h5>
</div>
</div>

<div class = 'content-wrapper'>
<div class = 'container-fluid'>
<div class = 'row'>
<div class = 'row g-4'>
<?php while ( $fetch = mysqli_fetch_assoc( $query ) ) {
    ?>
    <div class = 'col-12 col-md-6 col-lg-4'>
    <div style = 'border: 2px solid #696CFF;' class = 'card p-4'>
    <div class = 'd-flex justify-content-between align-items-center bg-white'>
    <div class = 'd-flex align-items-center'>
    <div class = 'border border-gray-300 rounded-circle d-flex align-items-center justify-content-center'
    style = 'width: 50px; height: 50px;'>
    <i style = 'color: #696CFF;' class = 'fa fa-truck'></i>
    </div>
    <h5 class = 'mb-0 ms-2 text-wrap' style = 'max-width: 180px; word-break: break-word;'>
    <?php echo $fetch[ 'tracking_number' ];
    ?>
    </h5>
    </div>
    <form method = 'POST' action = '' style = 'display: inline;'
    onsubmit = 'return confirmStatusUpdate();'>
    <input type = 'hidden' name = 'courier_id' value = '<?php echo $fetch['courier_id']; ?>'>
    <select name = 'status' class = 'form-select' onchange = 'this.form.submit();' style = "border: none;
            background-color: <?php
            echo ($fetch['status'] === 'Pending') ? 'yellow' :
                ($fetch['status'] === 'Fulfilled' ? 'lightgreen' :
                    ($fetch['status'] === 'Cancelled' ? 'red' : 'white'));
            ?>;
            color: black;
        ">
    <option value = 'Pending' <?php echo ( $fetch[ 'status' ] === 'Pending' ) ? 'selected' : '';
    ?>>Pending</option>
    <option value = 'Fulfilled' <?php echo ( $fetch[ 'status' ] === 'Fulfilled' ) ? 'selected' : '';
    ?>>Fulfilled</option>
    <option value = 'Cancelled' <?php echo ( $fetch[ 'status' ] === 'Cancelled' ) ? 'selected' : '';
    ?>>Cancelled</option>
    </select>
    </form>

    </div>
    <hr>
    <div class = 'd-flex justify-content-between align-items-center'>
    <h3 class = 'fw-bold'><?php echo $fetch[ 'city_name' ];
    ?></h3>
    <div>
    <p class = 'fs-5 m-0 text-black fw-bold'><?php echo $fetch[ 'price_pkr' ];
    ?> Rs</p>
    <p style = 'font-size: 12px;' class = 'm-0'><?php echo $fetch[ 'weight_kg' ];
    ?> kg</p>
    </div>
    </div>
    <div class = 'd-flex justify-content-between align-items-center'>
    <p class = 'm-0 text-black fw-bold'><?php echo $fetch[ 'created_at' ];
    ?></p>
    <p class = 'm-0 text-black fw-bold'><?php echo $fetch[ 'delivery_date' ];
    ?></p>
    </div>
    <img class = 'w-100 my-4' src = '../assets/img/elements/track.svg' alt = ''>
    <div class = 'd-flex  flex-row justify-content-between align-items-center'>
    <div class = 'me-1'>
    <p class = 'text-black m-0 fw-bold'><?php echo $fetch[ 'sender_address' ];
    ?></p>
    </div>
    <div class = 'ms-1'>
    <p class = 'text-black m-0 fw-bold'><?php echo $fetch[ 'receiver_address' ];
    ?></p>
    </div>
    </div>
    <hr>
    <div class = 'd-flex  flex-row justify-content-between align-items-center'>
    <div>
    <p class = 'text-black m-0 fw-bold'><?php echo $fetch[ 'sender_name' ];
    ?></p>
    <p class = 'm-0'>Sender</p>
    </div>
    <div>
    <p class = 'text-black m-0 fw-bold'><?php echo $fetch[ 'receiver_name' ];
    ?></p>
    <p class = 'm-0'>Recipient</p>
    </div>
    </div>
    <hr>
    <div class = 'd-flex justify-content-end align-items-center'>
    <div>
    <p class = 'text-black m-0 fw-bold'><?php echo $fetch[ 'company_name' ];
    ?></p>
    <p><?php echo $fetch[ 'branch_name' ];
    ?></p>
    </div>
    </div>
    </div>
    </div>
    <?php }
    ?>
    </div>
    </div>
    </div>
    </div>

    <script>

    function confirmStatusUpdate() {
        return confirm( 'Are you sure you want to change the status?' );
    }
    </script>

    <?php include( 'footer.php' );
    ?>
