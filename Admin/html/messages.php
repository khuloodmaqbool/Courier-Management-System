<?php include('header.php');

// Delete functionality
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    // Delete message from database
    $delete_query = "DELETE FROM contact WHERE id = $delete_id";
    if (mysqli_query($connect, $delete_query)) {
        echo "<script>alert('Message deleted successfully!'); window.location.href='messages.php';</script>";
    } else {
        echo "<script>alert('Error deleting message.');</script>";
    }
}

// Fetch contact messages from the database
$query = "SELECT id, full_name, email, message, created_at FROM contact ORDER BY created_at DESC";
$result = mysqli_query($connect, $query);
?>

<!-- Admin Panel to Delete Messages -->
<div class="container-fluid pb-4 pt-2 mt-6">
    <div class="row justify-content-center">
        <div class="bg-white shadow-sm rounded col-12">
            <h4 class="p-4">Contact Messages</h4>
            <div class="table-responsive px-4 pb-4">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($msg = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?php echo $msg['id']; ?></td>
                                <td><?php echo $msg['full_name']; ?></td>
                                <td><?php echo $msg['email']; ?></td>
                                <td><?php echo $msg['message']; ?></td>
                                <td><?php echo $msg['created_at']; ?></td>
                                <td>
                                    <a href="messages.php?delete_id=<?php echo $msg['id']; ?>" class="btn btn-danger btn-sm" title="Delete Message" onclick="return confirm('Are you sure you want to delete this message?');">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Add Bootstrap and FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<?php include('footer.php'); ?>
