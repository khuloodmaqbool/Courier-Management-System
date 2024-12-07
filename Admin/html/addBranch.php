<?php
include('header.php');

if (!$connect) {
    die('Database connection failed: ' . mysqli_connect_error());
}

$select1 = 'SELECT * FROM `companies`';
$query1 = mysqli_query($connect, $select1);

$select2 = 'SELECT * FROM `cities`';
$query2 = mysqli_query($connect, $select2);

?>

<div class='container-fluid  '>
    <div class="bg-white p-2 rounded my-4">
    <h5 style='font-weight: semibold' class='py-4 px-2 fs-4 fw-bold'>Add New Branch</h5>
<nav class='px-2' aria-label='breadcrumb'>
    <ol class='breadcrumb'>
        <li class='breadcrumb-item'><a href='manageBranch.php'>Manage Branch</a></li>
        <li class='breadcrumb-item active' aria-current='page'>Add new Branch</li>
    </ol>
</nav>
    </div>

</div>

<!-- Form Start -->
<div class='container-fluid pb-4 pt-2'>
    <div class='row justify-content-center'>
        <div class='col-12'>
            <div class='bg-white rounded h-100 p-4 shadow-sm'>

                <form method='POST' class='row g-3'>

                        <div class=' mb-3 col-12 col-md-6'>
                        <label for='floatingBranchName'  class="form-label">Branch Name</label>
                            <input name='branch_name' type='text' class='form-control py-3' id="floatingBranchName"
                                placeholder='Branch Name' required>
                        </div>

                        <div class=' mb-3 col-12 col-md-6'>
                        <label for='floatingLocation'>Location</label>
                            <input name='location' type='text' class='form-control py-3' id='floatingLocation'
                                placeholder='Location' required>
                        </div>
                        <div class=' mb-3 col-12 col-md-6'>
                        <label for='floatingContactInfo'>Contact Info</label>
                            <input name='contact_info' type='text' class='form-control py-3' id='floatingContactInfo'
                                placeholder='Contact Info' required>
                        </div>
                        <div class=' mb-3 col-12 col-md-6'>
                             <label for='floatingSelect'>Company</label>
                            <select name='company_id' id="'floatingSelect'" class='form-select py-3' required>
                                <option selected disabled>Select Company</option>
                                <?php while ($fetch = mysqli_fetch_assoc($query1)) {
                                    ?>
                                    <option value="<?php echo $fetch['company_id']; ?>">
                                        <?php echo $fetch['company_name'];
                                        ?>
                                    </option>
                                <?php }
                                ?>
                            </select>
                           
                        </div>

                        <div class=' mb-3 col-12 col-md-6'>
                             <label for='floatingSelect'>City</label>
                            <select name='city_id' id="'floatingSelect'" class='form-select py-3' required>
                                <option selected disabled>Select City</option>
                                <?php while ($fetch = mysqli_fetch_assoc($query2)) {
                                    ?>
                                    <option value="<?php echo $fetch['city_id']; ?>">
                                        <?php echo $fetch['city_name'];
                                        ?>
                                    </option>
                                <?php }
                                ?>
                            </select>
                           
                        </div>
                        <div class=' mb-3 col-12 d-flex justify-content-end'>
                            <button name='add_branch' type='submit' class='btn btn-primary m-2'>Add</button>
                        </div>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- Form End -->

<?php
if (isset($_POST['add_branch'])) {
    $branch_name = $_POST['branch_name'];
    $location = $_POST['location'];
    $contact_info = $_POST['contact_info'];
    $company_id = $_POST['company_id'];
    $city = $_POST['city_id'];
    

    $insert = "INSERT INTO `branches` (`branch_name`, `location`, `contact_info`, `company_id`,`city`) 
               VALUES ('$branch_name', '$location', '$contact_info', '$company_id','$city')";

    if (mysqli_query($connect, $insert)) {
        echo "<script>
                alert('Branch Added Successfully!');
                window.location.href = window.location.href; // Reload the page
              </script>";
    } else {
        echo "<script>alert('Error: " . mysqli_error($connect) . "');</script>";
    }
}
?>

<?php include('footer.php');
?>