<?php
include('header.php');

if (!$connect) {
    die('Database connection failed: ' . mysqli_connect_error());
}

$select1 = "SELECT 
    b.branch_id, 
    b.branch_name, 
    b.location, 
    b.contact_info, 
    c.company_name,
    ci.city_name
FROM 
    branches b
INNER JOIN companies c ON b.company_id = c.company_id
INNER JOIN cities ci ON b.city = ci.city_id";

$query1 = mysqli_query($connect, $select1);
?>

<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-white rounded py-4 px-3">
    <h5 class="py-1 px-2 fs-4 fw-bold">All Branches</h5>
        <div class="d-flex flex-wrap align-items-center justify-content-between g-">
            <form method="GET" style="width: 300px" class="input-group my-2 mx-1">
                <input placeholder="Enter Branch name" name="branch_name" type="text" class="form-control">
                <button type="submit" class="input-group-text bg-primary text-white">
                    <i class="fa fa-search"></i>
                </button>
            </form>
            <a class="btn btn-primary my-2 mx-1" href="addBranch.php">Add new Branch +</a>
        </div>
    </div>
</div>


<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col">
            <div class="bg-white rounded h-100 p-4">
                <h6 class="mb-4">Branches</h6>
                <div class="table-responsive" >
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">S.no</th>
                            <th scope="col">Branch Name</th>
                            <th scope="col">Location</th>
                            <th scope="col">Contact Info</th>
                            <th scope="col">City</th>
                            <th scope="col">Company</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        while ($fetch = mysqli_fetch_assoc($query1)) {
                            ?>
                            <tr>
                                <th scope="row"><?php echo $i++; ?></th>
                                <td><?php echo $fetch['branch_name']; ?></td>
                                <td><?php echo $fetch['location']; ?></td>
                                <td><?php echo $fetch['contact_info']; ?></td>
                                <td><?php echo $fetch['city_name']; ?></td>
                                <td><?php echo $fetch['company_name']; ?></td>
                                <td>
                                    <button class="btn btn-outline-success btn-sm">
                                        <i class="fa fa-edit" style="color: green;"></i>
                                    </button>
                                </td>
                                <td>
                                    <button class="btn btn-outline-danger btn-sm">
                                        <i class="fa fa-trash" style="color: red;"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                </div>
              
            </div>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
<style>

.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

</style>