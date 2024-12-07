<?php
include("header.php");

$query = "SELECT u.*, c.city_name, com.company_name, b.branch_name 
          FROM `users` u
          JOIN `cities` c ON u.city = c.city_id
          JOIN `companies` com ON u.company_id = com.company_id
          JOIN `branches` b ON u.branch_id = b.branch_id";

$result = mysqli_query($connect, $query);
?>

<!-- <div class="container-fluid">
<div class="bg-white p-3 my-3 rounded">
<h5 style="font-weight: semibold" class="py-4 px-2">View Users</h5>
<nav class="px-2" aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="viewAgent.php">Manage Agent</a></li>
        <li class="breadcrumb-item active" aria-current="page">View Users</li>
    </ol>
</nav>
</div>
</div> -->

<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4 mx-2">
    <div class="bg-white rounded py-4 px-3">
        
    <h5 class="py-1 px-2 fs-4 fw-bold">All Agents</h5>
        <div class="d-flex flex-wrap align-items-center justify-content-between g-">
            <form style="width: 300px" class="input-group  my-2 mx-1">
                <input placeholder="Enter Agent name" type="text" class="form-control">
                <button type="submit" class="input-group-text bg-primary text-white"><i
                        class="fa fa-search"></i></button>
            </form>
            <a class="btn btn-primary my-2 mx-1" href="addAgent.php">Add new Agent +</a>
        </div>


    </div>
</div>



<!-- User Table Start -->
<div class="container-fluid pb-4 pt-2">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="bg-white rounded h-100 p-4 shadow-sm">
            <h6 class="mb-4">Agents</h6>
            <div class="table-responsive" >
            <table class="table table-hover">
                
                    <thead>
                        <tr>
                            <th scope="col">S.no</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Full Name</th>
                            <th scope="col">Phone Number</th>

                            <th scope="col">Company</th>
                            <th scope="col">Branch</th>
                            
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if (mysqli_num_rows($result) > 0) {
                            $counter = 1;
                            while ($user = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <th scope="row"><?php echo $counter++; ?></th>

                                    <td class="d-flex" >
                                        
                                    <img style="border-radius: 50%;" src="../images/<?php echo $user['profile_picture']; ?>" alt="Profile Picture" width="50" height="50">
                                    <div class="ms-1" >
                                        <div class="text-black fw-bold" >  <?php echo $user['username']; ?></div>
                                        <div><?php echo $user['city_name']; ?></div>
                                    </div>   
                                  
                                    </td>

                                    <!-- Email with text wrapping -->
                                    <td style="word-break: break-word; max-width: 200px;">
                                        <?php echo $user['email']; ?>
                                    </td>

                                    <td><?php echo $user['full_name']; ?></td>
                                    <td><?php echo $user['phone_number']; ?></td>
                    
                                    <td><?php echo $user['company_name']; ?></td>
                                    <td><?php echo $user['branch_name']; ?></td>

            
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
                        <?php }
                        } else {
                            echo "<tr><td colspan='10'>No users found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
              
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>
<style>

.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

</style>
