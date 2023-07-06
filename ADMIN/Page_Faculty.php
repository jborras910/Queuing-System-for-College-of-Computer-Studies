<?php



include('../dbconfig.php');
$page = 'Faculty';

include('includes/header.php');

?>





















<style>
.faculty_image {
    border: 1px solid grey;
    max-width: 40px;
    max-height: 40px;

}

.flex-box {
    display: flex;
    justify-content: space-between
}


@media screen and (max-width: 1000px) {


    .Department {
        display: none !important;
    }

    .flex-box {
        text-align: center !important;
        flex-direction: column !important;
    }

    .flex-box h3 {
        font-size: 18px !important;
        margin-bottom: 15px !important;
    }

    .flex-box .btn {
        width: 100% !important;
    }




}

</style>
<?php if($_SESSION['auth_user']['role'] == 'Main Admin'):?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <?php include('../alert.php');?>
        <div class="card-header">
            <div class="flex-box">
                <h3 class="mb-0">Official Faculty Member Table</h3>
                <div>
                    <a href="Page_AddFaculty.php" class="btn btn-primary">INVITE FACULTY</a>

                </div>
            </div>
        </div>
        <div class="card-body">



            <?php 
        $query = "SELECT * FROM faculty_table WHERE authenticated='yes' AND isDeactivated='false' AND role !='Main Admin'";
        $query_run = mysqli_query($conn,$query);
?>
            <table class="table bg-light table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th class="email">Email</th>
                        <th class="Department">Department</th>
                        <th class="role">Role</th>
                        <th class=""><span class="action_span">Action</span></th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
if (mysqli_num_rows($query_run) > 0) {
    while ($row=mysqli_fetch_assoc($query_run)) {
        ?>
                    <tr>

                        <th><img class="rounded-circle border mr-2 faculty_image"
                                src="upload_image_faculty/<?php echo $row['faculty_image'] ?>"><?php echo $row['first_name']." ".$row['middle_name']." ".$row['last_name']?>
                            <?php if($row['active_status'] =='true'):?>
                            <small class="ml-1"><i class="fa-solid fa-circle text-success"></i></small>
                            <?php endif;?>
                        </th>
                        <th class="email"><?php echo $row['email'] ?></th>
                        <th class="Department"><?php echo $row['department'] ?></th>
                        <th class="role"><?php echo $row['role'] ?></th>

                        <th class="">
                            <form action="Page_ViewFaculty.php" method="POST">
                                <input type="hidden" name="faculty_id" value="<?php echo $row['id']?>">
                                <Button type="submit" name="view_faculty" class="btn btn-success text-center btn-block">
                                    View Profile
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
include('includes/footer.php');

include('includes/script.php');

?>




<!-- Bootstrap core JavaScript-->
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>
