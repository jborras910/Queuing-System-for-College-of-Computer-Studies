<?php
include('dbconfig.php');

session_start();


?>


<h5 class="text-center other-queue text-success"><span>Serving</span></h5>
<?php 
                            
                            
                            $student_queue = $_SESSION['student_data']['queue_token'];

                            $check_faculty = "SELECT * FROM queing_table WHERE queue_token='$student_queue'";
                            $check_faculty_run = mysqli_query($conn,$check_faculty);

                            if (mysqli_num_rows($check_faculty_run) >0) {
                                $row = mysqli_fetch_array($check_faculty_run);

                                    $_SESSION['faculty_selected'] = [
                                        'faculty' => $row['faculty']
                                    ];
                                
                            }


                            $faculty_selected = $_SESSION['faculty_selected']['faculty'];
                            $query = "SELECT * FROM queing_table WHERE faculty='$faculty_selected' AND isServing ='true'";
                            $query_run = mysqli_query($conn,$query);
                            // initialize the counter
                            $counter = 1;
                            if (mysqli_num_rows($query_run) > 0):
                                while ($row = mysqli_fetch_assoc($query_run)):
                        ?>

<div
    class="col-md-12 lineup_box <?php echo $row['queue_token'] == $_SESSION['student_data']['queue_token'] ? 'active ' : '' ?>">
    <label for="">
        <?php if ($row['isServing'] == 'true'): ?>
        <div id="response" class="timer"></div>
        <h6 class="text-info date_accpeted"> Now Serving
            <br>
            <span>Consultation Timer:
                <?php 
                                    date_default_timezone_set('Asia/Manila');
                                    $now = time();
                                    $expiry_date = strtotime($row['expiry_date']);
                                    if($now < $expiry_date){
                                        $diff =  $expiry_date - $now;
                                        $minutes = floor(($diff% (60 * 60)) / 60);
                                        $seconds = $diff % 60;

                                        echo $minutes.":".$seconds;
                                        
                                    }else{
                                        echo "Consultation Time Done";
                                    }
                                    ?>
            </span>
        </h6>
        <?php endif; ?>

        <?php echo "Ticket: ".$row['queue_token']?>
        <?php echo $row['queue_token'] == $_SESSION['student_data']['queue_token'] ? '(You)' : '' ?>
        <br>
        <?php echo "Date Submitted: ".date("F j, Y, g:i a", strtotime($row['date'])); ?>



    </label>
</div>
<?php
                            // increment the counter
                            $counter++;
                            endwhile;
                        else:
                        ?>

<div class="col-md-12 lineup_box text-center">
    No Serving right now
</div>

<?php endif; ?>
