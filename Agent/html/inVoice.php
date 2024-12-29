<?php
include('header.php');
$select = "
  SELECT 
    c.courier_id, 
    c.sender_name, 
    c.receiver_name, 
    c.sender_address, 
    c.receiver_address, 
    c.sender_phone_number, 
    c.reciever_phone_number, 
    c.courier_type, 
    c.status, 
    c.weight_kg,
    c.price_pkr,
    c.delivery_type,
    c.created_at, 
    c.delivery_date,
    c.user_customer_id, 
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
    c.status = 'Fulfilled' AND 
    c.user_id = {$_SESSION['user_id']};";


$query = mysqli_query($connect, $select);

// Check if the query was successful
if (!$query) {
    die("Query Error: " . mysqli_error($connect));
}

?>

<!-- Recent Sales Start -->
<div class='container-fluid pt-4 px-4 mx-2'>

    <div class='bg-white rounded py-4 px-3'>
        <h5 class='py-1 px-2 fs-4 fw-bold'>All Invoice</h5>
        <div class='d-flex flex-wrap align-items-center justify-content-between g-'>
            <form style='width: 300px' class='input-group  my-2 mx-1'>
                <input placeholder='Enter tracking number' type='text' class='form-control'>
                <button type='submit' class='input-group-text bg-primary text-white'><i
                        class='fa fa-search'></i></button>
            </form>
            <a class='btn btn-primary my-2 mx-1' href='addInvoice.php'>Add new Invoice +</a>
        </div>

    </div>
</div>

<!-- Recent Sales End -->
<div class='content-wrapper'>
    <!-- Content -->
    <div class='container-fluid'>
        <div class='row mx-auto'>
            <div class='row g-4 mx-auto'>

                <?php
                // Check if there are any courier rows
                if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_assoc($query)) {
                        ?>
                        <div class='col-12 col-md-6 col-lg-6 mx-auto'>

                            <div style='border: 2px solid #696CFF;' class="card p-4 ">


                            <div id="card<?php echo $row['courier_id']; ?>"  >

                                    <div class='d-flex justify-content-between bg-white'>
                                        <img style='width: 150px; height: fit-content;' src='../images/logo.png' alt=''>
                                        <div class="d-flex flex-column">
                                            <h2 class='my-0 fw-bold'>INVOICE</h2>
                                            <p class='my-0 text-wrap' style='max-width: 180px; word-break: break-word;'>
                                                <?php echo $row['tracking_number']; ?>
                                            </p>
                                        </div>


                                    </div>

                                    <hr>

                                    <div class='d-flex flex-row justify-content-between align-items-center'>
                                        <div>
                                            <p class="m-0"><strong>Sender:</strong> <?php echo $row['sender_name']; ?></p>
                                            <p class="m-0"><?php echo $row['sender_phone_number']; ?></p>
                                            <p class="m-0"><?php echo $row['sender_address']; ?></p>
                                        </div>
                                        <div>
                                            <p class="m-0"><strong>Recipient:</strong> <?php echo $row['receiver_name']; ?></p>
                                            <p class="m-0"><?php echo $row['reciever_phone_number']; ?></p>
                                            <p class="m-0"><?php echo $row['receiver_address']; ?></p>
                                        </div>
                                    </div>
                                    <hr>

                                    <table class='text-center my-4 w-100'>
                                        <thead class='bg-black text-white'>
                                            <tr>
                                                <th class='p-2'>Courier Type</th>
                                                <th class='p-2'>Weight</th>
                                                <th class='p-2'>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class='p-2'><?php echo $row['courier_type']; ?></td>
                                                <td class='p-2'><?php echo $row['weight_kg']; ?> kg</td>
                                                <td class='p-2'><?php echo $row['price_pkr']; ?> Rs</td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <hr>

                                    <div class='d-flex justify-content-between align-items-center'>
                                        <div>
                                            <p class="m-0"><strong>Agent:</strong> <?php echo $row['username']; ?></p>
                                            <p class="m-0"><strong>Payment Method:</strong> Cash</p>
                                            <p class="m-0">Thank you for choosing us</p>
                                        </div>
                                        <div>
                                            <p class="m-0"><strong>Date:</strong> <?php echo $row['delivery_date']; ?></p>
                                            <p class="m-0"><strong>Branch:</strong> <?php echo $row['company_name']; ?></p>
                                            <p class="m-0"><strong>Branch:</strong> <?php echo $row['branch_name']; ?></p>
                                        </div>
                                    </div>



                                </div>

                                <div class='d-flex justify-content-end align-items-center mt-8 mb-4'>
                                    <button class='btn btn-primary'
                                        onclick="printCard('card<?php echo $row['courier_id']; ?>')">Print Status</button>
                                </div>
                            </div>


                        </div>
                        <?php
                    }
                } else {
                    echo "<div class='container'><h5>No Invoice Found</h5></div>";
                }
                ?>

            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>

<!-- JavaScript for Print Functionality -->
<script>
    function printCard(cardId) {
        var printContents = document.getElementById(cardId).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;

        // Reload to restore original state
        window.location.reload();
    }
</script>