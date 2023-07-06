<?php
 $page = 'Dashboards';
include('../dbconfig.php');
include('includes/header.php');


?>


<style>
.box {
    padding: 20px 15px !important;
}

.box img {
    height: 600px !important;
    width: 500px !important;
}

table {
    width: 100% !important;
    border: 1px solid black !important;
    font-weight: 600 !important;
    font-size: 20px !important;
}

table tbody tr td {

    border-bottom: 1px solid black !important;
    padding: 5px !important;
    font-size: 17px !important;
}

.flex-box {
    display: flex;
    justify-content: space-between;
}

@media screen and (max-width: 1000px) {
    .box img {
        height: 500px !important;
        width: 100% !important;
    }

    .flex-box {
        flex-direction: column !important;
    }
}

</style>

<?php

if(isset($_POST['accept_btn'])){
    $student_full_name = $_POST['student_full_name'];
    $token =  $_POST['queue_token'];

    $_SESSION['token'] = $token;
    

    $activity = "You Accept the queue of ".$student_full_name;
    $faculty = $_SESSION['auth_user']['email'];
    $activityLog_query = "INSERT INTO activity_log (email,activty) VALUES ('$faculty','$activity')";

    if(mysqli_query($conn,$activityLog_query)){

        $update_query= "UPDATE 
        queing_table 
        SET 
        isServing='true'
        WHERE queue_token='$token'";
        if(mysqli_query($conn,$update_query)){

            date_default_timezone_set('Asia/Manila');
            $date_accepted = date('Y-m-d H:i:s');
            $date_accpeted_queue_query = "UPDATE queing_table SET date_accepted='$date_accepted' WHERE queue_token='$token'";

            if(mysqli_query($conn,$date_accpeted_queue_query)){

                $newtime = strtotime('+15 minutes');
                $expiry_date = date('Y-m-d H:i:s.v',$newtime);

                $newtime_query =  "UPDATE queing_table SET expiry_date='$expiry_date' WHERE queue_token='$token'";

                if(mysqli_query($conn,$newtime_query));
                    
                





            }else{

            }
        }

    }else{
        echo "error 2323";
    }


?>

<?php





?>



<div class="container-fluid">
    <?php

$query = "SELECT * FROM queing_table WHERE queue_token='$token'";
$query_run = mysqli_query($conn,$query);
if (mysqli_num_rows($query_run) > 0) {
    while ($row=mysqli_fetch_assoc($query_run)) {
?>
    <div class="card shadow mb-4">
        <div class="card-header">
            <div class="flex-box">
                <h3 class="mb-0">Student Concern</h3>
                <div>
                    <div id='timer'>

                    </div>
                </div>
            </div>

        </div>
        <div class="card-body">


            <div class="row">
                <div class="col-md-4 border box">
                    <h3 class="text-uppercase">Student ID</h3>
                    <hr>
                    <img class="" src="student_ids/<?php echo $row['school_id'] ?>" alt="">
                </div>
                <div class="col-md-4 border box">
                    <h3 class="text-uppercase">Input Concern</h3>
                    <hr>
                    <?php if($row['endores'] !='no'):?>
                    <div class="form-group border p-3">
                        <h6>
                            <?php echo $row['report']?>
                        </h6>
                    </div>
                    <hr>
                    <?php endif;?>

                    <table>
                        <tbody>
                            <tr>
                                <td>Date Submitted:</td>
                                <td><?php echo date("F j, Y, g:i a", strtotime($row['date']));?></td>
                            </tr>
                            <tr>
                                <td>Full Name:</td>
                                <td><?php echo $row['first_name']." ".$row['middle_name']." ".$row['last_name'] ?></td>
                            </tr>
                            <tr>
                                <td>Program:</td>
                                <td><?php echo $row['program']?></td>
                            </tr>

                            <tr>
                                <td>Year Level:</td>
                                <td><?php echo $row['year_level']?></td>
                            </tr>
                            <tr>
                                <td>Student Number:</td>
                                <td><?php echo $row['student_number']?></td>
                            </tr>

                            <tr>
                                <td>Email:</td>
                                <td><?php echo $row['email']?></td>
                            </tr>

                            <tr class="text-danger">
                                <td>Nature of Advising:</td>
                                <td><?php echo $row['nature_of_advising']?></td>
                            </tr>

                            <tr class="text-danger">
                                <td>Concern:</td>
                                <td><?php echo $row['concern']?></td>
                            </tr>
                            <tr class="text-danger">
                                <td>Endores:</td>
                                <td><?php echo $row['endores']?></td>
                            </tr>


                        </tbody>
                    </table>

                </div>
                <div class="col-md-4 border box">
                    <h3 class="text-uppercase">Faculty Report</h3>
                    <hr>
                    <div class="form-group">


                        <form action="function.php" method="POST">
                            <label>Remark:</label>
                            <textarea name="report" placeholder="Consultation remark..." class="form-control"
                                id="exampleFormControlTextarea1" rows="3" required></textarea>
                            <hr>
                            <input type="hidden" name="student_full_name"
                                value="<?php echo $row['first_name']." ".$row['middle_name']." ".$row['last_name'] ?>">
                            <input type="hidden" name="token_queue" value="<?php echo $row['queue_token']; ?>">
                            <button type="submit" name="done_consultation_btn"
                                class="btn btn-block btn-primary">DONE</button>

                        </form>
                        <hr>
                        <button type="button" class="btn btn-info btn-block text-white" data-toggle="modal"
                            data-target="#exampleModalCenter_ENDORSE">ENDORSE</button>
                        <form action="function.php" method="POST">
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModalCenter_ENDORSE" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">ENDORSE</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <input type="hidden" name="queue_token"
                                                value="<?php echo $row['queue_token']; ?>">




                                            <input type="hidden" name="student_full_name"
                                                value="<?php echo $row['first_name']." ".$row['middle_name']." ".$row['last_name'] ?>">

                                            <input type="hidden" name="sending_faculty"
                                                value="<?php echo $_SESSION['auth_user']['email']; ?>">
                                            <div class="form-group">
                                                <label for="faculty">Will be sent to</label>
                                                <select name="faculty" id="faculty" class="form-control"
                                                    aria-label="Default select example" required>
                                                    <option value="Select Faculty">Select Faculty</option>
                                                    <?php
                                                        $exclude_faculty = $_SESSION['auth_user']['email'];
                                                        $query_check_faculty = "SELECT * FROM faculty_table WHERE authenticated='yes' AND role != 'Main Admin' AND email!='$exclude_faculty'";
                                                        $query_check_faculty_run = mysqli_query($conn, $query_check_faculty);

                                                        if (mysqli_num_rows($query_check_faculty_run) > 0) {
                                                            while ($row_faculty = mysqli_fetch_assoc($query_check_faculty_run)) {
                                                    ?>
                                                    <option value="<?php echo $row_faculty['email'] ?>">
                                                        <?php echo $row_faculty['first_name'] . " " . $row_faculty['middle_name'] . " " . $row_faculty['last_name']." (".$row_faculty['role'].")";  ?>

                                                    </option>

                                                    <?php
                                                    
                                                        }
                                                    }
                                                    ?>

                                                </select>
                                                <hr>
                                                <label>Please Put The Remarks Here:</label>
                                                <textarea required placeholder="Please put some remark on this..."
                                                    name="endorse_remarks" class="form-control" rows="3"></textarea>
                                            </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" name="endore_btn"
                                                class="btn btn-primary text-white">Send
                                                Endorse</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>






































                    </div>












                </div>
            </div>

            <?php   }}}?>


        </div>
    </div>
</div>


<script>
function loadXMLDoc() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("timer").innerHTML =
                this.responseText;
        }
    };
    xhttp.open("GET", "Page_ViewConcernRespone.php", true);
    xhttp.send();
}
setInterval(function() {
    loadXMLDoc()
}, 1000)

window.onload = loadXMLDoc;
</script>











<?php
include('includes/footer.php');

include('includes/script.php');

?>
