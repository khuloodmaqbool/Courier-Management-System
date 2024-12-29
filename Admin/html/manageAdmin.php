<?php
include("header.php");

$select = "SELECT 
    u.user_id, 
    u.username, 
    u.email, 
    u.full_name, 
    u.phone_number, 
    u.residential_address, 
    u.profile_picture, 
    r.role_name
FROM 
    users u
INNER JOIN 
    roles r ON u.role_id = r.role_id
WHERE
    r.role_name = 'Admin'"; 

// Search functionality
if (isset($_POST['search'])) {
    $search_admin = $_POST['search_admin'];
    if (!empty($search_admin)) {
        $select .= " AND u.username LIKE '%$search_admin%'";
    }
}

$query = mysqli_query($connect, $select);
?>

<!-- Search and Add Admin -->
<div class="container-fluid pt-4 px-4 my-4">
    <div class=" bg-white  text-center rounded py-4 px-3">
        <div class="d-flex flex-wrap align-items-center justify-content-between">
            <form style="width: 300px" class="input-group my-2 mx-1" method="post" action="">
                <input name="search_admin" placeholder="Enter username" type="text" class="form-control">
                <button name="search" type="submit" class="input-group-text bg-primary text-white">
                    <i class="fa fa-search"></i>
                </button>
            </form>
            <a class="btn btn-primary my-2 mx-1" href="addAdmin.php">Add new Admin +</a>
        </div>
    </div>
</div>

<!-- User Table Start -->
<div class="container-fluid pb-4 pt-2">
    <div class="row justify-content-center">
        <div class="bg-white rounded shadow-sm col-12">
            <div class=" h-100 p-4 ">
                <div class="d-flex justify-content-between">
                    <h4 class='mb-4'>Admin</h4>
                    <a href="manageAdmin.php" class="btn btn-primary my-2 mx-1" p-1">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">S.no</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if (mysqli_num_rows($query) > 0) {
                                $counter = 1;
                                while ($user = mysqli_fetch_assoc($query)) { ?>
                                    <tr>
                                        <th scope="row"><?php echo $counter++; ?></th>
                                        <td class="d-flex">
                                            <img style="border-radius: 50%;" src="../images/<?php echo $user['profile_picture']; ?>" alt="Profile Picture" width="50" height="50">
                                            <div class="ms-1">
                                                <div class="text-black fw-bold"><?php echo $user['username']; ?></div>
                                                <div><?php echo $user['residential_address']; ?></div>
                                            </div>   
                                        </td>
                                        <td style="word-break: break-word; max-width: 200px;"><?php echo $user['email']; ?></td>
                                        <td><?php echo $user['full_name']; ?></td>
                                        <td><?php echo $user['phone_number']; ?></td>
                                        <td>
                                            <a href="updateAdmin.php?u_id=<?php echo $user['user_id']; ?>" class="btn btn-outline-success btn-sm">
                                                <i class="fa fa-edit" style="color: green;"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="?d_id=<?php echo $user['user_id']; ?>" onclick="return confirm('Are you sure?')" class="btn btn-outline-danger btn-sm">
                                                <i class="fa fa-trash" style="color: red;"></i>
                                            </a>
                                        </td>
                                    </tr>
                            <?php }
                            } else {
                                echo "<tr><td colspan='9'>No users found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_GET["d_id"])) {
    $d_id = $_GET["d_id"];

    // Fetch admin email and full name
    $get_admin_query = "SELECT email, full_name FROM users WHERE user_id = '$d_id'";
    $admin_result = mysqli_query($connect, $get_admin_query);

    if ($admin_result && mysqli_num_rows($admin_result) > 0) {
        $admin_data = mysqli_fetch_assoc($admin_result);
        $admin_email = $admin_data['email'];
        $admin_name = $admin_data['full_name'];

        // Delete admin
        $delete = "DELETE FROM `users` WHERE `user_id` = '$d_id'";
        $done = mysqli_query($connect, $delete);

        if ($done) {
            // Send email notification
            $to = $admin_email;
            $subject = "Account Deletion Notification";
            $message = "Dear $admin_name,\n\nYour admin account has been deleted from our system. If you have any concerns, please contact the support team.\n\nRegards,\nAdmin Team";
            $headers = "From: admin@example.com";

            // Send the email
            mail($to, $subject, $message, $headers);

            echo "<script>
                alert('Record Deleted and email sent!');
                window.location.href = 'manageAdmin.php';
            </script>";
        } else {
            echo "<script>alert('Error deleting record.');</script>";
        }
    } else {
        echo "<script>alert('Admin not found.');</script>";
    }
}
?>

<?php include("footer.php"); ?>
