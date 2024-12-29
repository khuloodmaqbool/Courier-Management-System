<?php
include("header.php");

// Fetch user data from the database, filtering by role (User)
$select = "SELECT 
    u.user_id, 
    u.username, 
    u.email, 
     u.password, 
     u.profile_picture,
    u.full_name, 
    u.phone_number, 
    r.role_name
FROM 
    users u
INNER JOIN 
    roles r ON u.role_id = r.role_id
WHERE
    r.role_name = 'User'";

if (isset($_POST['search'])) {
    $search_user = $_POST['search_user'];
    if (!empty($search_user)) {
        $select .= "AND u.username LIKE '%$search_user%'";
    }
}

$query = mysqli_query($connect, $select);
?>


<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4 my-4">
    <div class="bg-white text-center rounded py-4 px-3">
        <div class=" d-flex flex-wrap align-items-center justify-content-between g-">
            <!-- <h6 class="mb-0">Courier Details</h6> -->
            <form method="POST" style="width: 300px" class="input-group  my-2 mx-1">
                <input name="search_user" placeholder="Enter username" type="text" class="form-control">
                <button name="search" type="submit" class="input-group-text bg-primary text-white"><i
                        class="fa fa-search"></i></button>
            </form>
            <!-- <a class="btn btn-primary my-2 mx-1" href="addUser.php">Add new User +</a> -->
        </div>


    </div>
</div>

<!-- Recent Sales End -->

<div class="container-fluid pb-4 pt-2">
    <div class="row justify-content-center">
        <div class="bg-white rounded shadow-sm col-12">
            <div class="d-flex justify-content-between ">
                <h4 class='p-4'>Users</h4>
                <a style="height: fit-content;" href="manageUser.php" class="btn btn-primary mb-2 mt-4 mx-1">View
                    All</a>
            </div>
            <div class=" h-100 px-4 pb-4 ">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">S.No</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                <th scope="col">Password</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Role</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($query) > 0) {
                                $counter = 1;
                                while ($fetch = mysqli_fetch_assoc($query)) { ?>
                                    <tr>
                                        <th scope="row"><?php echo $counter++; ?></th>

                                        <td class="d-block">
                                            <img class="p-1"
                                                style="border-radius: 50%; display: block; margin: auto; background-color:  lightgray;"
                                                src="../../UserPanel/images/<?php echo $fetch['profile_picture']; ?>"
                                                alt="Profile Picture" width="50" height="50">

                                            <div class="ms-1 text-center">
                                                <div class="text-black fw-bold"><?php echo $fetch['username']; ?></div>
                                            </div>
                                        </td>


                                        <td><?php echo $fetch['full_name']; ?></td>
                                        <td><?php echo $fetch['username']; ?></td>
                                        <td style="word-break: break-word; max-width: 200px;"><?php echo $fetch['email']; ?>
                                        </td>
                                        <td
                                            style="word-break: break-word; max-width: 100px; overflow: hidden; text-overflow: ellipsis;">
                                            <?php echo substr($fetch['password'], 0, 10) . '...'; ?>
                                        </td>

                                        <td><?php echo $fetch['phone_number']; ?></td>
                                        <td><?php echo $fetch['role_name']; ?></td>
                                        <td>
                                            <a href="updateUser.php?u_id=<?php echo $fetch['user_id']; ?>"
                                                class="btn btn-outline-success btn-sm">
                                                <i class="fa fa-edit" style="color: green;"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="manageUser.php?d_id=<?php echo $fetch['user_id']; ?>"
                                                onclick="return confirm('Are you sure you want to delete this user?')"
                                                class="btn btn-outline-danger btn-sm">
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
if (isset($_GET['d_id'])) {
    $d_id = $_GET['d_id'];

    // Fetch user details before deleting
    $userQuery = "SELECT email, full_name FROM `users` WHERE `user_id` = $d_id";
    $userResult = mysqli_query($connect, $userQuery);
    $userData = mysqli_fetch_assoc($userResult);

    // Delete the user
    $delete = "DELETE FROM `users` WHERE `user_id` = $d_id";
    $done = mysqli_query($connect, $delete);

    if ($done) {
        // Send email notification
        $to = $userData['email'];
        $subject = "Account Deleted";
        $message = "
            Dear {$userData['full_name']},

            Your account has been deleted from our system. If you believe this was a mistake, please contact support.

            Thank you.
        ";
        $headers = "From: admin@example.com";

        if (mail($to, $subject, $message, $headers)) {
            echo "<script>
                alert('Record deleted and email sent to the user!');
                window.location.href = 'manageUser.php';
            </script>";
        } else {
            echo "<script>
                alert('Record deleted, but email sending failed.');
                window.location.href = 'manageUser.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('Error deleting record.');
            window.location.href = 'manageUser.php';
        </script>";
    }
}
?>


<?php
include("footer.php");
?>