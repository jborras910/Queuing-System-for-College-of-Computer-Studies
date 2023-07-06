<?php
include('../dbconfig.php');
$page = 'reservation';

include('includes/header.php');

?>



<div class="container-fluid">
    <div class="card shadow mb-4">
        <?php include('../alert.php');?>
        <div class="card-header">
            <div class="flex-box" style="display:flex; justify-content:space-between">
                <h3 class="mb-0">Student Reservation Request</h3>
                <div>

                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table">
                <table class="table bg-light table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <?php 
                $faculty = $_SESSION['auth_user']['email'];
                $query = "SELECT * FROM queing_table WHERE faculty='$faculty' AND isServing='false' AND reserve='true' ORDER BY date ASC";
                $query_run = mysqli_query($conn,$query);
                $counter = 1;
                ?>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Schedule</th>
                            <th>Name</th>

                            <th>Concern</th>
                            <th>Email</th>
                            <th class="text-center">Accept</th>
                            <th class="text-center">Reject</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                if (mysqli_num_rows($query_run) > 0) {
                    while ($row=mysqli_fetch_assoc($query_run)) {
                        ?>
                        <tr class="bg-white text-danger">
                            <th> <?php echo $counter."." ?></th>
                            <th><?php echo date("F j, Y, g:i a", strtotime($row['date']));?></th>
                            <th><?php echo $row['first_name']." ".$row['middle_name']." ".$row['last_name'] ?></th>

                            <th><?php echo $row['concern'] ?> (<?php echo $row['nature_of_advising'] ?>)</th>
                            <th><?php echo $row['email'] ?></th>
                            <th class="text-center">

                                <input type="hidden" name="token" value="<?php echo $row['queue_token']?>">
                                <!-- Include jQuery library -->

                                <!-- Modal button and content -->
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#exampleModalCenter_<?php echo $row['queue_token']?>">
                                    Accept
                                </button>


                                <div class="modal fade hide" id="exampleModalCenter_<?php echo $row['queue_token']?>"
                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">ALERT</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <h5><?php echo date("F j, Y, g:i a", strtotime($row['date']));?></h5>
                                                <label>Are you sure you want to accept
                                                    <span
                                                        class="text-success text-uppercase"><?php echo $row['first_name']." ".$row['last_name']?></span>
                                                    Reservation Request
                                                </label>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>


                                                <form action="function.php" method="POST">
                                                    <input type="hidden" name="queue_token"
                                                        value="<?php echo $row['queue_token']?>">

                                                    <input type="hidden" name="faculty"
                                                        value="<?php echo $row['faculty']?>">

                                                    <input type="hidden" name="email"
                                                        value="<?php echo $row['email']?>">
                                                    <input type="hidden" name="request_date"
                                                        value="<?php echo date("F j, Y, g:i a", strtotime($row['date']));?>">

                                                    <input type="hidden" name="student_full_name"
                                                        value="<?php echo $row['first_name']." ".$row['middle_name']." ".$row['last_name']?>">
                                                    <button type="submit" name="accept_request_btn"
                                                        class="btn btn-primary">Accept Request</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </th>
                            <th class="text-center">


                                <!-- Modal button and content -->
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#reject_<?php echo $row['queue_token']?>">
                                    Reject
                                </button>





                                <div class="modal fade hide" id="reject_<?php echo $row['queue_token']?>" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">ALERT</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="function.php" method="POST">
                                                <div class="modal-body text-left">
                                                    <h5><?php echo date("F j, Y, g:i a", strtotime($row['date']));?>
                                                    </h5>
                                                    <div class="form-grouo">
                                                        <label for="">Please explain why you declined the
                                                            reservation.</label>
                                                        <textarea placeholder="Enter the note here..."
                                                            class="form-control" name="faculty_message" id="" cols="10"
                                                            rows="10"></textarea>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>



                                                    <input type="hidden" name="queue_token"
                                                        value="<?php echo $row['queue_token']?>">

                                                    <input type="hidden" name="faculty"
                                                        value="<?php echo $row['faculty_full_name']?>">

                                                    <input type="hidden" name="email"
                                                        value="<?php echo $row['email']?>">
                                                    <input type="hidden" name="request_date"
                                                        value="<?php echo date("F j, Y, g:i a", strtotime($row['date']));?>">

                                                    <input type="hidden" name="student_full_name"
                                                        value="<?php echo $row['first_name']." ".$row['middle_name']." ".$row['last_name']?>">
                                                    <button type="submit" name="Reject_request_btn"
                                                        class="btn btn-danger">Reject Request</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
            </div>

            </th>
            </tr>
            <?php
                 $counter++;
                    }
                }

                    ?>
            </tbody>
            </table>
        </div>
    </div>
</div>

</div>









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
