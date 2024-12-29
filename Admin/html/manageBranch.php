<?php
include('header.php');

if (!$connect) {
    die('Database connection failed: ' . mysqli_connect_error());
}

// Fetch companies for the dropdown
$select1 = 'SELECT * FROM `companies`';
$query1 = mysqli_query($connect, $select1);

// Fetch branches joined with company names
$select = "SELECT 
    b.branch_id, 
    b.branch_name, 
    b.location, 
    b.contact_info, 
    c.company_name
FROM 
    branches b
INNER JOIN 
    companies c 
ON 
    b.company_id = c.company_id";

// search 
if (isset($_POST['search'])) {
    $search_branch = $_POST['search_branch'];
    if (!empty($search_branch)) {
        $select .= " WHERE b.branch_name LIKE '%$search_branch%'";
    }
}

$query = mysqli_query($connect, $select);
?>

<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4 my-4">
    <div class="bg-white text-center rounded py-4 px-3">
        <div class="d-flex flex-wrap align-items-center justify-content-between g-">
            <form style="width: 300px" method="POST" class="input-group  my-2 mx-1">
                <input placeholder="Enter Branch name" type="text" name="search_branch" class="form-control">
                <button name="search" type="submit" class="input-group-text bg-primary text-white"><i
                        class="fa fa-search"></i></button>
            </form>
            <a class="btn btn-primary my-2 mx-1" href="addBranch.php">Add new Branch +</a>
        </div>
    </div>
</div>

<!-- Recent Sales End -->


<!-- Table Start -->
<div class='container-fluid pt-4 px-4'>
    <div class='row g-4'>
        <div class='col-12 rounded  bg-white shadow-sm mx-2'>
            <div class='h-100 p-4'>
                <div class="d-flex justify-content-between">
                    <h4 class=''>Branches</h4>
                    <a href="manageBranch.php" class="btn btn-primary my-2 mx-1">View All</a>
                </div>
                <table class='table table-hover'>
                    <thead>
                        <tr>
                            <th scope='col'>S.no</th>
                            <th scope='col'>Branch Name</th>
                            <th scope='col'>Location</th>
                            <th scope='col'>Contact Info</th>
                            <th scope='col'>Company</th>
                            <th scope='col'>Edit</th>
                            <th scope='col'>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $i = 1;
                        while ($fetch = mysqli_fetch_assoc($query)) {

                            ?>
                            <tr>
                                <th scope='row'><?php echo $i++;
                                ?></th>
                                <td><?php echo $fetch['branch_name'];
                                ?></td>
                                <td><?php echo $fetch['location'];
                                ?></td>
                                <td><?php echo $fetch['contact_info'];
                                ?></td>
                                <td><?php echo $fetch['company_name'];
                                ?></td>
                                <td class='px-auto'><a
                                        href="updateBranch.php?ub_id=<?php echo $fetch['branch_id']; ?>"><button
                                            class='border-0 mx-auto'><i class='fa fa-edit'
                                                style='color: green;'></i></button></a></td> </button></td>
                                <td class='px-auto'><a
                                        href="manageBranch.php?db_id=<?php echo $fetch['branch_id']; ?>"><button
                                            class='border-0 mx-auto'><i class='fa fa-trash'
                                                style='color: red;'></i></button></a></td>
                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Table End -->

<?php

// Delete data 

if (isset($_GET["db_id"])) {
    $branch_id = $_GET["db_id"];
    $delete = "DELETE FROM `branches` WHERE `branch_id` = '$branch_id'";
    $done = mysqli_query($connect, $delete);
    if ($done) {
        echo
            "<script>
  alert('Record Delete!');
  window.location.href = 'manageBranch.php';
  </script>";
    }
}

?>


<?php include('footer.php');
?>