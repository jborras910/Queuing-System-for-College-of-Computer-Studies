<?php






$page = 'Accept_Faculty';

include('../dbconfig.php');
include('includes/header.php');












?>

<style>
.faculty_image {
    border: 1px solid grey;
    max-width: 40px;
    max-height: 40px;

}

</style>
<?php if($_SESSION['auth_user']['role'] == 'Main Admin'):?>
<div class="container-fluid">

    <div class="card shadow mb-4">

        <?php include('../alert.php');?>
        <div class="card-header">
            <div class="flex-box" style="display:flex; justify-content:space-between">
                <h3 class="mb-0">Pending Faculty Member</h3>
                <div>


                </div>
            </div>
        </div>
        <div class="card-body">
            <?php         
            
            $query = "SELECT * FROM faculty_table WHERE authenticated ='no' AND date_submitted!=''";
            $query_run = mysqli_query($conn,$query);
            ?>

            <table class="table bg-light table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>

                        <th>Invitation Date</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Role</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>


                <tbody>
                    <?php 
if (mysqli_num_rows($query_run) > 0) {
    while ($row=mysqli_fetch_assoc($query_run)) {
        ?>
                    <tr>
                        <th class="text-danger"><?php echo $row['date_invitation']?></th>
                        <th><img class="rounded-circle border mr-2 faculty_image"
                                src="upload_image_faculty/<?php echo $row['faculty_image'] ?>"><?php echo $row['email']?>
                        </th>
                        <th><?php echo $row['department']?></th>
                        <th><?php echo $row['role']?></th>
                        <th class="text-center">
                            <form action="Page_acceptViewFaculty.php" method="POST">
                                <input type="hidden" name="faculty_id" value="<?php echo $row['id']?>">
                                <button type="submit" name="view_faculty" class="btn btn-success">
                                    View Faculty
                                </Button>
                            </form>
                        </th>
                    </tr>

                    <?php
    }
}


?>
                </tbody>
            </table>







        </div>
    </div>
</div>

<?php endif;?>




<?php


include('includes/script.php');

?>
<!-- datatable -->




<!-- Bootstrap core JavaScript-->
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>
