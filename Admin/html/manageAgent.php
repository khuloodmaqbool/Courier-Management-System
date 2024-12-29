<?php
include("header.php");

// Fetch agent data from the database, filtering by role (Agent)
$select = "SELECT 
    u.user_id, 
    u.username, 
    u.email, 
    u.full_name, 
    u.phone_number, 
    u.residential_address, 
    u.profile_picture, 
    r.role_name, 
    b.branch_name, 
    c.company_name
FROM 
    users u
INNER JOIN 
    roles r ON u.role_id = r.role_id
INNER JOIN 
    branches b ON u.branch_id = b.branch_id
INNER JOIN 
    companies c ON u.company_id = c.company_id
WHERE
    r.role_name = 'Agent'";

// Search functionality
if (isset($_POST['search'])) {
    $search_agent = $_POST['search_agent'];
    if (!empty($search_agent)) {
        $select .= " AND u.username LIKE '%$search_agent%'";
    }
}

$query = mysqli_query($connect, $select);
?>

<!-- Search and Add Agent -->
<div class="container-fluid pt-4 px-4 my-4">
    <div class="bg-white text-center rounded py-4 px-3">
        <div class="d-flex flex-wrap align-items-center justify-content-between">
            <form style="width: 300px" class="input-group my-2 mx-1" method="POST" action="">
                <input name="search_agent" placeholder="Enter username" type="text" class="form-control">
                <button name="search" type="submit" class="input-group-text bg-primary text-white">
                    <i class="fa fa-search"></i>
                </button>
            </form>
            <!-- <a class="btn btn-primary my-2 mx-1" href="addAgent.php">Add new Agent +</a> -->
        </div>
    </div>
</div>

<!-- User Table Start -->
<div class="container-fluid pb-4 pt-2">
    <div class="row justify-content-center">
        <div class="bg-white shadow-sm rounded col-12">
            <div class=" d-flex justify-content-between">
                <h4 class='p-4'>Agents</h4>
                <a style="height: fit-content;" href="manageAgent.php" class="btn btn-primary mb-2 mx-1 mt-4">View
                    All</a>
            </div>
            <div class=" h-100 px-4 pb-4 ">

                <div class="table-responsive">
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
                            if (mysqli_num_rows($query) > 0) {
                                $counter = 1;
                                while ($user = mysqli_fetch_assoc($query)) { ?>
                                    <tr>
                                        <th scope="row"><?php echo $counter++; ?></th>
                                        <td class="d-block">
                                            <img style="border-radius: 50%; display: block; margin: auto;"
                                                src="../../Agent/images/<?php echo $user['profile_picture']; ?>"
                                                alt="Profile Picture" width="50" height="50">

                                            <div class="ms-1 text-center">
                                                <div class="text-black fw-bold"><?php echo $user['username']; ?></div>
                                                <div><?php echo $user['residential_address']; ?></div>
                                            </div>
                                        </td>
                                        <td style="word-break: break-word; max-width: 200px;"><?php echo $user['email']; ?></td>
                                        <td><?php echo $user['full_name']; ?></td>
                                        <td><?php echo $user['phone_number']; ?></td>
                                        <td><?php echo $user['company_name']; ?></td>
                                        <td><?php echo $user['branch_name']; ?></td>
                                        <td>
                                            <a href="updateAgent.php?u_id=<?php echo $user['user_id']; ?>"
                                                class="btn btn-outline-success btn-sm">
                                                <i class="fa fa-edit" style="color: green;"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="?d_id=<?php echo $user['user_id']; ?>"
                                                onclick="return confirm('Are you sure?')" class="btn btn-outline-danger btn-sm">
                                                <i class="fa fa-trash" style="color: red;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php }
                            } else {
                                echo "<tr><td colspan='9'>Not found</td></tr>";
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
// Delete agent and send email
if (isset($_GET["d_id"])) {
    $d_id = mysqli_real_escape_string($connect, $_GET["d_id"]);

    // Fetch agent email and full name
    $get_agent_query = "SELECT email, full_name FROM users WHERE user_id = '$d_id'";
    $agent_result = mysqli_query($connect, $get_agent_query);

    if ($agent_result && mysqli_num_rows($agent_result) > 0) {
        $agent_data = mysqli_fetch_assoc($agent_result);
        $agent_email = $agent_data['email'];
        $agent_name = $agent_data['full_name'];

        // Delete the agent
        $delete = "DELETE FROM `users` WHERE `user_id` = '$d_id'";
        $done = mysqli_query($connect, $delete);

        if ($done) {
            // Send email notification
            $to = $agent_email;
            $subject = "Account Deletion Notification";
            $message = "Dear $agent_name,\n\nYour agent account has been deleted from our system. If you have any concerns, please contact our support team.\n\nRegards,\nAdmin Team";
            $headers = "From: admin@example.com";

            // Send the email
            mail($to, $subject, $message, $headers);

            // Notify the user
            echo "<script>
                alert('Record Deleted and email sent!');
                window.location.href = 'manageAgent.php';
            </script>";
        } else {
            echo "<script>alert('Error deleting record.');</script>";
        }
    } else {
        echo "<script>alert('Agent not found.');</script>";
    }
}

include("footer.php");

?>