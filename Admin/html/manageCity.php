<?php include("header.php"); 

// Fetch cities for the dropdown
$select1 = "SELECT * FROM `cities`";

if (isset($_POST['search'])) {
    $search_city = $_POST['search_city'];
    if (!empty($search_city)) {
        $select1 .= " WHERE city_name LIKE '%$search_city%'";
    }
}

$query1 = mysqli_query($connect, $select1);

?>            


<!-- Recent Sales Start -->
<div class="container-fluid pt-4 px-4 my-4">
    <div class="bg-white text-center rounded py-4 px-3">
        <div class="bg-white d-flex flex-wrap align-items-center justify-content-between g-">
            <!-- <h6 class="mb-0">Courier Details</h6> -->
            <form method="POST" style="width: 300px" class="input-group  my-2 mx-1">
                <input placeholder="Enter City name" type="text" name="search_city" class="form-control">
                <button name="search" type="submit" class="input-group-text bg-primary text-white"><i
                        class="fa fa-search"></i></button>
            </form>
            <a class="btn btn-primary my-2 mx-1" href="addCity.php">Add new City +</a>
        </div>


    </div>
</div>

<!-- Recent Sales End -->



<!-- Table Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <!-- hover  -->
        <div class="col-12 bg-white rounded shadow-sm mx-2">
        <div class=" d-flex justify-content-between align-items-center mt-2">
                <h4 class='p-4'>City</h4>
                <a href="manageCity.php" class="btn btn-primary mb-2 mx-1 mt-4 ">View All</a>
                </div>
            <div class="bg-white rounded h-100 px-4 pb-4">
           
                <table class="table table-hover bg-white">
                    <thead>
                        <tr>
                            <th scope="col">S.no</th>
                            <th scope="col">City Name</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // Fetch and display cities from the database
                        $i = 1; // Row number
                        while ($fetch = mysqli_fetch_assoc($query1)) { 
                        ?>
                            <tr>
                                <th scope="row"><?php echo $i++; ?></th>
                                <td><?php echo $fetch['city_name']; ?></td>
                                <td><a href="updateCity.php?uc_id=<?php echo $fetch['city_id']; ?>"><button  class="border-0" ><i class="fa fa-edit" style="color: green;"></i></a></i>
                                </button></td>
                                <td><a href="manageCity.php?dc_id=<?php echo $fetch['city_id']; ?>"><button class="border-0" ><i class="fa fa-trash" style="color: red;"></i></button></a></td>
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

    // Delete data 

    if (isset($_GET["dc_id"])) {
        $c_id = $_GET["dc_id"];
        $delete = "DELETE FROM `cities` WHERE `city_id` = '$c_id'";
        $done = mysqli_query($connect, $delete);
    if ($done) {
      echo
        "<script>
      alert('Record Delete!');
      window.location.href = 'manageCity.php';
      </script>";
    }
    }
?>

<?php include("footer.php"); ?>
