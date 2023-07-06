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

</style>

<?php if($_SESSION['auth_user']['role'] == 'Main Admin'):?>
<div class="container-fluid">

    <div class="card shadow mb-4">

        <?php include('../alert.php');?>
        <div class="card-header">
            <div class="flex-box" style="display:flex; justify-content:space-between">
                <h3 class="mb-0">Pending Faculty Invitation</h3>
                <div>

                    <a type="button" href="Page_AddFaculty.php" class="btn btn-danger text-white">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <?php         
            
            $query = "SELECT * FROM faculty_table WHERE authenticated ='no' AND date_submitted=''";
            $query_run = mysqli_query($conn,$query);
            
            
            ?>

            <table class="table bg-light table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>

                        <th>Invitation Date</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Role</th>

                        <th class="text-center">Delete Invitation</th>
                    </tr>
                </thead>




                <tbody>
                    <?php 
if (mysqli_num_rows($query_run) > 0) {
    while ($row=mysqli_fetch_assoc($query_run)) {
        ?>
                    <tr>

                        <th class="text-danger"><?php  echo date("F j, Y, g:i a", strtotime($row['date_invitation']));?>
                        </th>
                        <th><?php echo $row['email']?></th>
                        <th><?php echo $row['department']?></th>
                        <th><?php echo $row['role']?></th>
                        <th class="text-center">


                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#cancelInvitation">
                                Cancel Invitation
                            </Button>


                            <!-- Modal -->
                            <form action="function.php" method="POST">
                                <div class="modal fade" id="cancelInvitation" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                Are you sure you want to cancel the invitaion?
                                                <input type="hidden" name="invitation_id"
                                                    value="<?php echo $row['id']?>">

                                                <input type="hidden" name="email" value="<?php echo $row['email']?>">

                                                <input type="hidden" name="role" value="<?php echo $row['role']?>">

                                                <input type="hidden" name="department"
                                                    value="<?php echo $row['department']?>">

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" name="cancel_invitation_btn"
                                                    class="btn btn-danger">YES I WANT TO CANCEL
                                                    IT</button>
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


include('includes/script.php');

?>
<!-- datatable -->


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    $('#dataTable').DataTable();
});
</script>


<!-- Bootstrap core JavaScript-->
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>
