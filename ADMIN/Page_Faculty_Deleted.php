<?php



include('../dbconfig.php');
$page = 'Faculty deleted';

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

.modal-body {
    text-align: center !important;
}

.modal-body img {
    border: 1px solid grey;
    max-width: 240px;
    max-height: 240px;
    border-radius: 50px !important;
    margin-bottom: 30px !important;
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
                <h3 class="mb-0">Deleted Faculty Member Table</h3>
                <div>


                </div>
            </div>
        </div>
        <div class="card-body">



            <?php 
        $query = "SELECT * FROM faculty_table WHERE isDeactivated='true' AND role !='Main Admin'";
        $query_run = mysqli_query($conn,$query);
?>
            <table class="table bg-light table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th class="email">Email</th>
                        <th class="Department">Department</th>
                        <th class="role">Role</th>
                        <th class="text-center"><span class="action_span">Action</span></th>
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
                            <form action="function.php" method="POST">
                                <input type="hidden" name="faculty_id" value="<?php echo $row['id']?>">
                                <Button type="button" data-toggle="modal"
                                    data-target="#exampleModalCenter_<?php echo $row['id']?>"
                                    class="btn btn-primary text-center btn-block">
                                    Restore
                                </Button>



                                <div class="modal fade" id="exampleModalCenter_<?php echo $row['id']?>" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Alert</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="upload_image_faculty/<?php echo $row['faculty_image'] ?>"
                                                    alt="">
                                                <h5>Name:
                                                    <?php echo $row['first_name']." ".$row['middle_name']." ".$row['last_name']?>
                                                </h5>


                                                <h5>Role:
                                                    <?php echo $row['role']; ?>
                                                </h5>


                                                <h5>Department:
                                                    <?php echo $row['department']; ?>
                                                </h5>


                                                <hr>

                                                <h5>Are you certain you want to restore this user?</h5>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" name="restore_faculty"
                                                    class="btn btn-primary">Confirm</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>




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
