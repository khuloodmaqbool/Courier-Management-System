<?php include("header.php");

// Fetch companies for the dropdown
$select = "SELECT 
    co.company_id,
    co.company_name,
    co.address,
    co.contact_info,
    c.city_name
FROM companies co
INNER JOIN cities c ON co.city_id = c.city_id";

// search 
if (isset($_POST['search'])) {
    $search_company = $_POST['search_company'];
    if (!empty($search_company)) {
        $select .= " WHERE co.company_name LIKE '%$search_company%'";
    }
}
$query = mysqli_query($connect, $select);
?>

<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4 my-4">
    <div class="bg-white text-center rounded py-4 px-3">
        <div class="d-flex flex-wrap align-items-center justify-content-between g-">
            <!-- <h6 class="mb-0">Courier Details</h6> -->
            <form method="POST" style="width: 300px" class="input-group  my-2 mx-1">
                <input placeholder="Enter Company name" name="search_company" type="text" class="form-control">
                <button name="search" type="submit" class="input-group-text bg-primary text-white"><i
                        class="fa fa-search"></i></button>
            </form>
            <a class="btn btn-primary my-2 mx-1" href="addCompany.php">Add new Company +</a>
        </div>


    </div>
</div>

<!-- Recent Sales End -->



<!-- Table Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <!-- hover  -->
        <div class="rounded shadow-sm bg-white col-12 mx-2">
            <div class=" h-100 p-4">
            <div class="d-flex justify-content-between">
                <h4 class='mb-4'>Companies</h4>
                <a href="manageCompany.php" class="btn btn-primary my-2 mx-1">View All</a>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">S.no</th>
                            <th scope="col">Company Name</th>
                            <th scope="col">Company Address</th>
                            <th scope="col">Contact Info</th>
                            <th scope="col">Cities</th>

                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Fetch and display companies from the database
                        $i = 1; // Row number
                        while ($fetch = mysqli_fetch_assoc($query)) {
                            ?>
                            <tr>
                                <th scope="row"><?php echo $i++; ?></th>
                                <td><?php echo $fetch['company_name']; ?></td>
                                <td><?php echo $fetch['address']; ?></td>
                                <td><?php echo $fetch['contact_info']; ?></td>
                                <td><?php echo $fetch['city_name']; ?></td>
                                <td><a href="updateCompany.php?uc_id=<?php echo $fetch['company_id']; ?>"><button
                                            class="border-0"><i class="fa fa-edit" style="color: green;"></i></a></i>
                                    </button></td>
                                <td><a href="manageCompany.php?dc_id=<?php echo $fetch['company_id']; ?>"><button
                                            class="border-0"><i class="fa fa-trash" style="color: red;"></i></button></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Table End -->

<?php



if (isset($_POST['add_company'])) {
    // Collect form data
    $company_name = $_POST['company_name'];
    $address = $_POST['address'];
    $contact_info = $_POST['contact_info'];

    // Insert query
    $insert = "INSERT INTO `companies` (`company_name`, `address`, `contact_info`) 
                VALUES ('$company_name', '$address', '$contact_info')";

    // Execute insert query and check for errors
    if (mysqli_query($connect, $insert)) {
        echo "<script>
                alert('Company Added Successfully!');
                window.location.href = 'manageCompany.php';
               </script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($connect) . "');</script>";
    }
}



// Delete data 

if (isset($_GET["dc_id"])) {
    $company_id = $_GET["dc_id"];
    $delete = "DELETE FROM `companies` WHERE `company_id` = '$company_id'";
    $done = mysqli_query($connect, $delete);
    if ($done) {
        echo
            "<script>
      alert('Record Delete!');
      window.location.href = 'manageCompany.php';
      </script>";
    }
}
?>

<?php include("footer.php"); ?>