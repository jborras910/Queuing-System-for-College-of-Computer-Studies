<?php
 $page = 'Dashboards';

 include('../dbconfig.php');
include('includes/header.php');

date_default_timezone_set('Asia/Manila');

?>


<style>
.title {
    padding-top: 30px !important;
    display: flex !important;
    justify-content: space-between !important;
}

.flex-box {
    display: flex !important;
    justify-content: space-between !important;
}

@media screen and (max-width: 1000px) {



    .title h4 {
        display: none !important;
    }

    .charts {
        width: 100% !important;

        margin: 0% !important;


    }

    .flex-box {
        align-items: center !important;
        flex-direction: column !important;
    }

    .flex-box h3 {
        font-size: 18px !important;
        margin-bottom: 20px !important;
    }

    .charts .card {

        width: 100% !important;
    }

    .display-1 {
        font-size: 60px !important;
    }


}

</style>

<!-- js chart api -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



<div class="container-fluid">
    <div class=" title">
        <h3>Faculty Dashboard</h3>
        <h4><span id='ct7'></span></h4>

    </div>
    <hr>
    <?php if($_SESSION['auth_user']['role'] == 'Main Admin'):?>

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4 ">
                <div class="card-body row">
                    <div class=" col-md-10"><i class="fa-solid fa-screwdriver-wrench mr-2"></i>Total Faculty
                    </div>
                    <div class="col-md-2">
                        <?php 
             
                        $query = "SELECT * FROM faculty_table WHERE authenticated = 'yes' AND role !='Main Admin'";
                        $query_run = mysqli_query($conn,$query);
                        $row = mysqli_num_rows($query_run);
                        echo '<h4>'.$row.'</h4>';
                        ?>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="Page_Faculty.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class=" col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body row">
                    <div class="col-md-10"><i class="fa-solid fa-pen-to-square mr-2"></i>Total Peding
                        Faculty to be Accepted</div>
                    <div class="col-md-2">
                        <?php 
               

                    $query = "SELECT * FROM faculty_table WHERE authenticated ='no' AND date_submitted!=''";
                    $query_run = mysqli_query($conn,$query);
                    $row = mysqli_num_rows($query_run);
                    echo '<h4>'.$row.'</h4>';
                    ?>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="Page_acceptFaculty.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary  text-white mb-4">
                <div class="card-body row">
                    <div class="col-md-10"><i class="fa-solid fa-circle-check mr-2"></i>Total Done Consultation This
                        Month
                    </div>
                    <div class="col-md-2">
                        <?php 
                                 

                    $query = "SELECT * FROM queing_table WHERE isServing ='done' AND DATE_FORMAT(`date`, '%M %Y') = DATE_FORMAT(NOW(), '%M %Y')";
                    $query_run = mysqli_query($conn,$query);
                    $row = mysqli_num_rows($query_run);
                    echo '<h4>'.$row.'</h4>';
                    ?>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="Page_ViewConsultation.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body row">
                    <div class="col-md-10"><i class="fa-solid fa-comment mr-2"></i>Total Pending Faculty Invitation
                    </div>
                    <div class="col-md-2">
                        <?php 
                    $query = "SELECT * FROM faculty_table WHERE authenticated ='no'";
                    $query_run = mysqli_query($conn,$query);
                    $row = mysqli_num_rows($query_run);
                    echo '<h4>'.$row.'</h4>';
                    ?>


                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="Page_pendingFaculty.php">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="card text-dark mb-4 bg-light">
                <div class="card-body row">
                    <div class="col-md-10">
                        <h6 class="text-capitalize"><i class="fa-sharp fa-solid fa-calendar-day mr-2"></i>Faculty With
                            the highest Queue This day
                        </h6>
                        <hr>
                        <?php 
                        $query = "SELECT faculty_full_name, COUNT(faculty_full_name) AS faculty_full_name_count 
                                FROM `queing_table` 
                                WHERE DATE_FORMAT(`date`, '%d %Y') = DATE_FORMAT(NOW(), '%d %Y')
                                GROUP BY faculty_full_name
                                ORDER BY faculty_full_name_count DESC
                                LIMIT 1;";
                        $query_run = mysqli_query($conn,$query);

                        // Check if any rows were returned
                        $has_results = (mysqli_num_rows($query_run) > 0);
                                            
                        // Fetch the result set
                        $row = mysqli_fetch_assoc($query_run);
                        ?>

                        <?php if ($has_results): ?>
                        <h4><?php echo ucwords($row['faculty_full_name']); ?></h4>
                        <h6 class="">Total Consultation: <?php echo $row['faculty_full_name_count']; ?> </h6>
                        <?php else: ?>
                        <h4>No results found.</h4><br>
                        <?php endif; ?>
                    </div>

                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <button type="button" data-toggle="modal" data-target="#faculty_highest_queue"
                        class="btn-dark  text-white btn-block p-2">View
                        Details</button>




                    <!-- Modal -->
                    <div class="modal fade" id="faculty_highest_queue" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Faculty With the highest Queue
                                        This day</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table text-white text-center">
                                        <thead class="border">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Queue</th>
                                            </tr>
                                        </thead>
                                        <tbody class="border">
                                            <?php 
                                    $query = "SELECT SUBSTRING_INDEX(faculty_full_name, ' ', -1) AS Last_name, COUNT(faculty_full_name) AS faculty_full_name_count 
                                    FROM `queing_table` 
                                    WHERE DATE_FORMAT(`date`, '%D %Y') = DATE_FORMAT(NOW(), '%D %Y')
                                    GROUP BY faculty_full_name DESC;";
                                    $query_run = mysqli_query($conn,$query);

                                    $counter = 1;
                                    if (mysqli_num_rows($query_run) > 0) {
                                    while ($row=mysqli_fetch_assoc($query_run)) {

                                        ?>
                                            <tr class="">
                                                <th scope="row"><?php echo $counter; ?></th>
                                                <td class="text-white text-capitalize"><?php echo $row['Last_name'] ?>
                                                </td>

                                                <td><?php echo $row['faculty_full_name_count'] ?></td>
                                            </tr>


                                            <?php
                                          $counter++; }}else{
                                            ?>
                                            <p>NO RECORD FOUND</p>

                                            <?php
                                          }
                                        ?>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" data-dismiss="modal"
                                        class="btn btn-primary btn-block">DONE</button>
                                </div>
                            </div>
                        </div>
                    </div>







                </div>
            </div>
        </div>




        <div class="col-xl-4 col-md-6">
            <div class="card text-dark mb-4 bg-light">
                <div class="card-body row">
                    <div class="col-md-10">
                        <h6 class="text-capitalize"><i class="fa-solid fa-calendar-days mr-2"></i>Faculty With the
                            highest Queue This Month
                        </h6>
                        <hr>
                        <?php 
                        $query = "SELECT faculty_full_name, COUNT(faculty_full_name) AS faculty_full_name_count 
                        FROM `queing_table` 
                        WHERE DATE_FORMAT(`date`, '%M %Y') = DATE_FORMAT(NOW(), '%M %Y')
                        GROUP BY faculty_full_name
                        ORDER BY faculty_full_name_count DESC
                        LIMIT 1;";
                        $query_run = mysqli_query($conn,$query);

                        // Check if any rows were returned
                        $has_results = (mysqli_num_rows($query_run) > 0);
                                            
                        // Fetch the result set
                        $row = mysqli_fetch_assoc($query_run);
                        ?>

                        <?php if ($has_results): ?>
                        <h4><?php echo ucwords($row['faculty_full_name']); ?></h4>
                        <h6 class="">Total Consultation: <?php echo $row['faculty_full_name_count']; ?> </h6>
                        <?php else: ?>
                        <h4>No results found.</h4><br>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <button type="button" data-toggle="modal" data-target="#faculty_highest_queue_month"
                        class="btn-dark  text-white btn-block p-2">View
                        Details</button>


                    <!-- Modal -->
                    <div class="modal fade" id="faculty_highest_queue_month" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Faculty With the highest Queue
                                        This Month</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table text-white text-left">
                                        <thead class="border">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th class="border" scope="col">Name</th>
                                                <th scope="col">Queue</th>
                                            </tr>
                                        </thead>
                                        <tbody class="border">
                                            <?php 
                                    $query = "SELECT faculty_full_name AS Last_name, COUNT(faculty_full_name) AS faculty_full_name_count 
                                    FROM `queing_table` 
                                    WHERE DATE_FORMAT(`date`, '%M %Y') = DATE_FORMAT(NOW(), '%M %Y')
                                    GROUP BY faculty_full_name DESC;";
                                    $query_run = mysqli_query($conn,$query);

                                    $counter = 1;
                                    if (mysqli_num_rows($query_run) > 0) {
                                    while ($row=mysqli_fetch_assoc($query_run)) {

                                        ?>
                                            <tr class="">
                                                <th scope="row"><?php echo $counter; ?></th>
                                                <td class="text-white text-capitalize border">
                                                    <?php echo $row['Last_name'] ?>
                                                </td>

                                                <td><?php echo $row['faculty_full_name_count'] ?></td>
                                            </tr>


                                            <?php
                                          $counter++; }}else{
                                            ?>
                                            <p>NO RECORD FOUND</p>

                                            <?php
                                          }
                                        ?>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" data-dismiss="modal"
                                        class="btn btn-primary btn-block">DONE</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="col-xl-4 col-md-6">
            <div class="card text-dark mb-4 bg-light">
                <div class="card-body row">
                    <div class="col-md-10">
                        <h6 class="text-capitalize"><i class="fa-solid fa-calendar-days mr-2"></i>Faculty With the
                            highest Queue This Year
                        </h6>
                        <hr>
                        <?php 
                        $query = "SELECT faculty_full_name, COUNT(faculty_full_name) AS faculty_full_name_count 
                        FROM `queing_table` 
                        WHERE DATE_FORMAT(`date`, '%Y') = DATE_FORMAT(NOW(), '%Y')
                        GROUP BY faculty_full_name
                        ORDER BY faculty_full_name_count DESC
                        LIMIT 1;";
                        $query_run = mysqli_query($conn,$query);

                        // Check if any rows were returned
                        $has_results = (mysqli_num_rows($query_run) > 0);
                                            
                        // Fetch the result set
                        $row = mysqli_fetch_assoc($query_run);
                        ?>

                        <?php if ($has_results): ?>
                        <h4><?php echo ucwords($row['faculty_full_name']); ?></h4>
                        <h6 class="">Total Consultation: <?php echo $row['faculty_full_name_count']; ?> </h6>
                        <?php else: ?>
                        <h4>No results found.</h4><br>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <button type="button" data-toggle="modal" data-target="#faculty_highest_queue_year"
                        class="btn-dark  text-white btn-block p-2">View
                        Details</button>


                    <!-- Modal -->
                    <div class="modal fade" id="faculty_highest_queue_year" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Faculty With the highest Queue
                                        This Year</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table text-white text-left">
                                        <thead class="border">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th class="border" scope="col">Name</th>
                                                <th scope="col">Queue</th>
                                            </tr>
                                        </thead>
                                        <tbody class="border">
                                            <?php 
                                    $query = "SELECT faculty_full_name AS Last_name, COUNT(faculty_full_name) AS faculty_full_name_count 
                                    FROM `queing_table` 
                                    WHERE DATE_FORMAT(`date`, '%Y') = DATE_FORMAT(NOW(), '%Y')
                                    GROUP BY faculty_full_name DESC;";
                                    $query_run = mysqli_query($conn,$query);

                                    $counter = 1;
                                    if (mysqli_num_rows($query_run) > 0) {
                                    while ($row=mysqli_fetch_assoc($query_run)) {

                                        ?>
                                            <tr class="">
                                                <th scope="row"><?php echo $counter; ?></th>
                                                <td class="text-white text-capitalize border">
                                                    <?php echo $row['Last_name'] ?>
                                                </td>

                                                <td><?php echo $row['faculty_full_name_count'] ?></td>
                                            </tr>


                                            <?php
                                          $counter++; }}else{
                                            ?>
                                            <p>NO RECORD FOUND</p>

                                            <?php
                                          }
                                        ?>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" data-dismiss="modal"
                                        class="btn btn-primary btn-block">DONE</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


































        <div class="row charts">

            <div class="col-md-8">
                <!-- Bar Chart -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Programs with Most Consultations</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-bar">
                            <canvas style="width:100%; height: 400px" id="Program_bar_chart"></canvas>
                        </div>
                        <hr>
                        Programs with Most Consultations. The bar chart below displays the number of consultations
                        received from different academic
                        programs: BSIT, BSCS, BSIS, and BSDS.
                    </div>
                </div>


                <!-- Area Chart -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Faculty with Most Consultations</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-bar">
                            <canvas style="width:100%; height: 400px" id="programs_data_faculty_barchart"></canvas>
                        </div>
                        <hr>
                        A bar chart is a useful way to visually represent data, and in this case, we are using it to
                        display the number of consultations received by different faculty members.
                    </div>
                </div>



            </div>

            <!-- Donut Chart -->
            <div class="col-md-4 ">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Faculty Registered by Department</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4">
                            <canvas id="doughnut_chart"></canvas>

                        </div>
                        <hr>
                        Each department is represented by the chart
                        section, the size of which represents the number of faculty members registered in that
                        department.
                    </div>
                </div>

                <!-- Donut Chart -->
                <div class="">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Average Time Transaction</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body text-center">
                            <div class="chart-pie pt-4">

                                <hr>
                                <?php

                        $query = "SELECT FROM_UNIXTIME(AVG(UNIX_TIMESTAMP(`date`))) AS avg_datetime
                        FROM queing_table;";
                        $query_run = mysqli_query($conn,$query);
                        $row = mysqli_fetch_assoc($query_run);

                        ?>
                                <h1 class="display-1 bg-primary p-5 text-white">
                                    <?php echo date("g:i a", strtotime($row['avg_datetime'])); ?></h1>
                            </div>
                            <hr>
                            Average Transaction
                        </div>
                    </div>
                </div>

            </div>
        </div>






        <?php else:?>
        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="card bg-primary text-white mb-4 ">
                    <div class="card-body row">
                        <div class=" col-md-10 text-uppercase"><i class="fa-solid fa-screwdriver-wrench mr-2"></i>Total
                            Done
                            Consultation this Month
                        </div>
                        <div class="col-md-2">
                            <?php 
                        $faculty = $_SESSION['auth_user']['email'];
                        $query = "SELECT *  FROM queing_table WHERE isServing = 'done' AND faculty='$faculty' AND DATE_FORMAT(`date`, '%M %Y') = DATE_FORMAT(NOW(), '%M %Y')";
                        $query_run = mysqli_query($conn,$query);
                        $row = mysqli_num_rows($query_run);
                        echo '<h4>'.$row.'</h4>';
                        ?>
                        </div>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link" href="Page_ViewConsultation.php">View Details</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>





        </div>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <?php include('../alert.php');?>
            <div class="card-header">
                <div class="flex-box">
                    <h3 class="mb-0">Students Concern Table </h3>
                    <div>
                        <a href="Page_reservation.php" class="btn btn-info"><i
                                class="fa-solid fa-address-book mr-2"></i>View Reservation Here</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table">
                    <table class="table bg-light table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <?php 
                $faculty = $_SESSION['auth_user']['email'];
                $query = "SELECT * FROM queing_table WHERE faculty='$faculty' AND isServing='false' AND reserve='false' ORDER BY date ASC";
                $query_run = mysqli_query($conn,$query);
                $counter = 1;
                ?>
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Date</th>

                                <th>Name</th>
                                <th>Concern</th>
                                <th>Endorse</th>
                                <th class="text-center">Accept</th>
                                <th class="text-center">Reject</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                if (mysqli_num_rows($query_run) > 0) {
                    while ($row=mysqli_fetch_assoc($query_run)) {


                        
                        $class = strtotime($row['date']) > time() ? 'bg-secondary text-white' : 'bg-white text-dark';
                        ?>

                            <div class="modal fade hide" id="exampleModalCenter_<?php echo $row['queue_token']?>"
                                tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">ALERT</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <label>Are you sure you want to accept
                                                <span
                                                    class="text-success text-uppercase"><?php echo $row['first_name']." ".$row['last_name']?></span>
                                                queue?
                                            </label>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>


                                            <form action="Page_ViewConcern.php" method="POST">
                                                <input type="hidden" name="queue_token"
                                                    value="<?php echo $row['queue_token']?>">


                                                <input type="hidden" name="student_full_name"
                                                    value="<?php echo $row['first_name']." ".$row['middle_name']." ".$row['last_name']?>">
                                                <button type="submit" name="accept_btn"
                                                    class="btn btn-primary">Accept</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>









                            <div class="modal fade hide" id="exampleModalCenter2_<?php echo $row['queue_token']?>"
                                tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">ALERT</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <label>Are you sure you want to reject
                                                <span
                                                    class="text-success text-uppercase"><?php echo $row['first_name']." ".$row['last_name']?></span>
                                                queue?
                                            </label>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>

                                            <form action="function.php" method="POST">
                                                <input type="hidden" name="queue_token"
                                                    value="<?php echo $row['queue_token']?>">
                                                <button type="submit" name="reject_btn"
                                                    class="btn btn-danger">Reject</button>
                                            </form>


                                            <form action="Page_ViewConcern.php" method="POST">
                                                <input type="hidden" name="queue_token"
                                                    value="<?php echo $row['queue_token']?>">


                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>



























                            <tr class="<?php echo $class; ?>">
                                <th class="number"> <?php echo $counter ?></th>
                                <th><?php echo date("F j, Y, g:i a", strtotime($row['date']));?></th>

                                <th><?php echo $row['first_name']." ".$row['middle_name']." ".$row['last_name'] ?></th>

                                <th><?php echo $row['concern'] ?> (<?php echo $row['nature_of_advising'] ?>)</th>
                                <th><?php echo $row['endores'];?> </th>

                                <th class="text-center">
                                    <?php if(strtotime($row['date']) < time()):?>
                                    <input type="hidden" name="token" value="<?php echo $row['queue_token']?>">
                                    <!-- Include jQuery library -->


                                    <!-- Modal button and content -->
                                    <button type="button" class="btn btn-primary d-inline" data-toggle="modal"
                                        data-target="#exampleModalCenter_<?php echo $row['queue_token']?>">
                                        Accept
                                    </button>

                                    <?php endif; ?>


                                </th>
                                <th class="text-center">
                                    <button type="button" class="btn btn-danger d-inline" data-toggle="modal"
                                        data-target="#exampleModalCenter2_<?php echo $row['queue_token']?>">
                                        Reject
                                    </button>
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

        <?php endif;?>
    </div>




    <script>
    function display_ct7() {
        var x = new Date()
        var ampm = x.getHours() >= 12 ? ' PM' : ' AM';
        hours = x.getHours() % 12;
        hours = hours ? hours : 12;
        hours = hours.toString().length == 1 ? 0 + hours.toString() : hours;

        var minutes = x.getMinutes().toString()
        minutes = minutes.length == 1 ? 0 + minutes : minutes;

        var seconds = x.getSeconds().toString()
        seconds = seconds.length == 1 ? 0 + seconds : seconds;

        var month = (x.getMonth() + 1).toString();
        month = month.length == 1 ? 0 + month : month;

        var dt = x.getDate().toString();
        dt = dt.length == 1 ? 0 + dt : dt;

        var x1 = month + "/" + dt + "/" + x.getFullYear();
        x1 = x1 + " - " + hours + ":" + minutes + ":" + seconds + " " + ampm;
        document.getElementById('ct7').innerHTML = x1;
        display_c7();
    }

    function display_c7() {
        var refresh = 1000; // Refresh rate in milli seconds
        mytime = setTimeout('display_ct7()', refresh)
    }
    display_c7()
    </script>

    <?php include('includes/script.php'); ?>




    <script>
    setInterval(function() {
        location.reload();
    }, 30000);
    </script>





    <script>
    <?php 
$sql = "SELECT department, COUNT(department) AS faculty FROM `faculty_table` WHERE authenticated='yes' GROUP BY department;";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($result)){


$department[] = $row['department'];
$faculty[] = $row['faculty'];


}
?>




    const data = {
        labels: <?php echo json_encode($department); ?>,
        datasets: [{
            label: 'Faculty in different department',
            data: <?php echo json_encode($faculty); ?>,
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    };




    const config_2 = {
        type: 'pie',
        data: data
    };




    const doughnut_chart = new Chart(
        document.getElementById('doughnut_chart'),
        config_2
    );
    </script>






    <script>
    <?php 
$sql = "SELECT program, COUNT(program) AS Program 
FROM `queing_table` 
WHERE DATE_FORMAT(`date`, '%Y') = DATE_FORMAT(NOW(), '%Y')
GROUP BY program;";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_array($result)){


$program[] = $row['program'];
$Program[] = $row['Program'];


}
?>


    const programs_data = {
        labels: <?php echo json_encode($program); ?>,
        datasets: [{
            label: 'Program',
            backgroundColor: ['#fae80e', '#16a085', '#c0392b', '#3498db'],
            borderColor: ['rgb(227, 220, 16)', 'rgb(22, 160, 133)', 'rgb(192, 57, 43)',
                'rgb(52, 152, 219)'
            ],
            data: <?php echo json_encode($Program); ?>,
        }]
    };

    const config_1 = {
        type: 'bar',
        data: programs_data,
        options: {
            plugins: {
                legend: {
                    display: false // Set display property to false to hide the label
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            if (Number.isInteger(value)) {
                                return value;
                            }
                            return '';
                        }
                    }
                }
            }
        }

    };
    const Program_bar_chart = new Chart(
        document.getElementById('Program_bar_chart'),
        config_1
    );
    </script>












    <script>
    <?php 
$sql_faculty_barchart = "SELECT LOWER(SUBSTRING_INDEX(faculty_full_name, ' ', -1)) AS Last_name, COUNT(faculty_full_name) AS faculty_full_name_count 
FROM `queing_table` 
WHERE DATE_FORMAT(`date`, '%Y') = DATE_FORMAT(NOW(), '%Y')
GROUP BY faculty_full_name;";
$result_bar_chart = mysqli_query($conn, $sql_faculty_barchart);

while($row_faculty_bar = mysqli_fetch_array($result_bar_chart)){
  $faculty_full_name[] = $row_faculty_bar['Last_name'];
  $faculty_full_name_count[] = $row_faculty_bar['faculty_full_name_count'];
}
?>

    const backgroundColors = Array.from({
        length: 30
    }, () => `#${Math.floor(Math.random()*16777215).toString(16)}`);



    const programs_data_faculty_barchart_config = {
        labels: <?php echo json_encode($faculty_full_name); ?>,
        datasets: [{
            label: 'Faculty Consultation',
            backgroundColor: backgroundColors,
            borderColor: backgroundColors,
            data: <?php echo json_encode($faculty_full_name_count); ?>,
        }]
    };

    const config_4 = {
        type: 'bar',
        data: programs_data_faculty_barchart_config,
        options: {
            plugins: {
                legend: {
                    display: false // Set display property to false to hide the label
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            if (Number.isInteger(value)) {
                                return value;
                            }
                            return '';
                        }
                    }
                }
            }
        }
    };

    const programs_data_faculty_barchart = new Chart(
        document.getElementById('programs_data_faculty_barchart'),
        config_4
    );
    </script>








    <script>
    <?php 
$sql_3 = "SELECT year_level AS Student_year, COUNT(year_level) AS Year_lvl_counter 
FROM `queing_table` 
WHERE DATE_FORMAT(`date`, '%M %Y') = DATE_FORMAT(NOW(), '%M %Y')
GROUP BY year_level";

$result_3 = mysqli_query($conn, $sql_3);

while($row_3 = mysqli_fetch_array($result_3)){

    $Student_year[] = $row_3['Student_year'];
    $Year_lvl_counter[] = $row_3['Year_lvl_counter'];
    
    
    }
?>


    const data_3 = {
        labels: <?php echo json_encode($Student_year); ?>,
        datasets: [{
            label: 'Student By Year',
            data: <?php echo json_encode($Year_lvl_counter); ?>,
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }]
    };

    const config_3 = {
        type: 'line',
        data: data_3,
        options: {
            animations: {
                tension: {
                    duration: 1000,
                    easing: 'linear',
                    from: 1,
                    to: 0,
                    loop: true
                }
            }

        }
















    };




    const bar_chart_year_lvl = new Chart(
        document.getElementById('bar_chart_year_lvl'),
        config_3
    );
    </script>








    <?php

include('includes/footer.php');



?>
