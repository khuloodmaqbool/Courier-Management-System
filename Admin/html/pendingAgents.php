<?php include('header.php');



// Fetch pending agents from the database
$query = "SELECT 
            u.user_id, 
            u.username, 
            u.email, 
            u.full_name, 
            u.phone_number, 
            u.residential_address, 
            u.profile_picture, 
            u.status,
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
          WHERE status = 'pending'";
$result = mysqli_query($connect, $query);

// Approve or Reject actions
if (isset($_GET['action']) && isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    if ($_GET['action'] == 'approve') {
        // Approve the account
        $update_query = "UPDATE users SET status = 'approved' WHERE user_id = $user_id";
        if (mysqli_query($connect, $update_query)) {
            echo "<script>alert('Account approved successfully!'); window.location.href='pendingAgents.php';</script>";
        } else {
            echo "<script>alert('Error approving account.');</script>";
        }
    } elseif ($_GET['action'] == 'reject') {
        // Reject the account
        $update_query = "UPDATE users SET status = 'rejected' WHERE user_id = $user_id";
        if (mysqli_query($connect, $update_query)) {
            echo "<script>alert('Account rejected successfully!'); window.location.href='pendingAgents.php';</script>";
        } else {
            echo "<script>alert('Error rejecting account.');</script>";
        }
    }
}
?>

<!-- User Table Start -->
<div class="container-fluid pb-4 pt-2 mt-6 mx-2">
    <div class="row justify-content-center">
        <div class="bg-white shadow-sm rounded col-12">
            <div class=" d-flex justify-content-between">
                <h4 class='p-4'>Pending Accounts</h4>
                
            </div>
            <div class=" h-100 px-4 pb-4 ">

                <div class="table-responsive"></div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Username</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Company</th>
                                <th>Branch</th>
                            <th>Status</th>
                            <th>Approve</th>
                            <th>Reject</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                           $counter = 1;
                         while ($row = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                            <th scope="row"><?php echo $counter++; ?></th>
                                <td class="d-block">
                                    <img style="border-radius: 50%; display: block; margin: auto;"
                                        src="../../Agent/images/<?php echo $row['profile_picture']; ?>"
                                        alt="Profile Picture" width="50" height="50">

                                    <div class="ms-1 text-center">
                                        <div class="text-black fw-bold"><?php echo $row['username']; ?></div>
                                        <div><?php echo $row['residential_address']; ?></div>
                                    
                                    </div>
                                </td>
                                <td><?php echo $row['full_name']; ?></td>
                                <td style="word-break: break-word; max-width: 160px;"><?php echo $row['email']; ?></td>
                                <td><?php echo $row['company_name']; ?></td>
                                <td><?php echo $row['branch_name']; ?></td>
                                <td>
                                    <?php if ($row['status'] == 'pending') { ?>
                                        <span class="badge bg-warning">Pending</span>
                                    <?php } elseif ($row['status'] == 'approved') { ?>
                                        <span class="badge bg-success">Approved</span>
                                    <?php } else { ?>
                                        <span class="badge bg-danger">Rejected</span>
                                    <?php } ?>
                                </td>
                                <td >
                                    <a href="?action=approve&user_id=<?php echo $row['user_id']; ?>"
                                        class="btn btn-success btn-sm my-1 py-2 px-4">Approve</a>
                                </td>
                                <td> <a href="?action=reject&user_id=<?php echo $row['user_id']; ?>"
                                class="btn btn-danger btn-sm my-1 py-2 px-4">Reject</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                </table>

            </div>
        </div>
    </div>
</div>
</div>


<?php include("footer.php") ?>