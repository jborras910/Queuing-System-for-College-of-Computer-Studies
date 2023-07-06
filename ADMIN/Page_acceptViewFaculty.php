<?php



$page = 'Accept_Faculty';

include('../dbconfig.php');
include('includes/header.php');

?>

<style>
.faculty_image {
    max-width: 400px !important;
    max-height: 400px !important;
    border-radius: 5% !important;
    border: 2px solid grey !important;
    padding: 10px !important;

}

.card-body {
    padding: 10px 20px !important;
}

table {
    border: 2px solid black !important;
    width: 100% !important;

}

table tbody tr td {
    padding: 20px !important;
    font-weight: 600 !important;

    font-size: 20px !important;
    border-bottom: 2px solid black !important;

}

</style>

<?php 

if (isset($_POST['view_faculty'])) {
    $faculty_id = $_POST['faculty_id'];

    $query = "SELECT * FROM faculty_table WHERE id='$faculty_id'";
    $query_run = mysqli_query($conn, $query);
    if (mysqli_num_rows($query_run) > 0) {
        while ($row=mysqli_fetch_assoc($query_run)) {
            ?>

<?php if($_SESSION['auth_user']['role'] == 'Main Admin'):?>
<div class="container-fluid">

    <div class="card shadow mb-4">

        <?php include('../alert.php');?>
        <div class="card-header">
            <div class="flex-box" style="display:flex; justify-content:space-between">
                <h3 class="mb-0">Pending Faculty To Accept</h3>
                <div>
                    <a type="button" onclick="location.href = document.referrer; return false;"
                        class="btn btn-danger text-white">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="row align-items-center align-content-center text-dark p-5 rounded ">
                <div class="col-md-5  text-center ">
                    <img class="faculty_image mb-4" src="upload_image_faculty/<?php echo $row['faculty_image'] ?>"
                        alt="">


                </div>
                <div class="col-md-7 ">
                    <h1>Information</h1>
                    <hr>
                    <table class="mb-3">
                        <tbody>
                            <tr>
                                <td>Full Name</td>
                                <td><?php echo $row['first_name']." ".$row['middle_name']." ".$row['last_name'] ?></td>
                            </tr>
                            <tr>
                                <td>Invitation Date</td>
                                <td><?php echo $row['date_invitation'] ?></td>
                            </tr>
                            <tr>
                                <td>Submitted Date</td>
                                <td><?php echo $row['date_submitted'] ?></td>
                            </tr>

                            <tr>
                                <td>Department</td>
                                <td><?php echo $row['department'] ?></td>
                            </tr>

                            <tr>
                                <td>Role</td>
                                <td><?php echo $row['role'] ?></td>
                            </tr>

                            <tr>
                                <td>Contact</td>
                                <td><?php echo $row['contact'] ?></td>
                            </tr>

                            <tr>
                                <td>Email</td>
                                <td><?php echo $row['email'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <form action="function.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                        <input type="hidden" name="email" value="<?php echo $row['email'] ?>">
                        <input type="hidden" name="role" value="<?php echo $row['role'] ?>">
                        <input type="hidden" name="department" value="<?php echo $row['department'] ?>">


                        <button type="button" class="btn btn-primary mb-2 btn-block" data-toggle="modal"
                            data-target="#approved">
                            Approved Faculty
                        </button>

                        <!-- Approved Modal -->
                        <div class="modal fade" id="approved" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">ALERT</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        Click the Approved Button Below if you agree to Approved this user
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" name="approved_faculty"
                                            class="btn btn-success">Approved</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                    <form action="function.php" method="POST">
                        <input type="hidden" name="id_disapproved" value="<?php echo $row['id'] ?>">

                        <input type="hidden" name="email_disapproved" value="<?php echo $row['email'] ?>">
                        <input type="hidden" name="role_disapproved" value="<?php echo $row['role'] ?>">
                        <input type="hidden" name="department_disapproved" value="<?php echo $row['department'] ?>">
                        <button type="button" class="btn btn-danger btn-block" data-toggle="modal"
                            data-target="#disapproved">
                            Disapproved Faculty
                        </button>

                        <!--Disapproved Modal -->
                        <div class="modal fade" id="disapproved" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">ALERT</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">

                                        Click the Disapproved Button Below if you agree to Disapproved this user
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" name="disapproved_faculty"
                                            class="btn btn-danger ">Disapproved</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
















                </div>
            </div>



        </div>
    </div>
</div>
<?php endif;?>

<?php
        }
    }
}
?>


<?php


include('includes/script.php');

?>


<!-- Bootstrap core JavaScript-->
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>
