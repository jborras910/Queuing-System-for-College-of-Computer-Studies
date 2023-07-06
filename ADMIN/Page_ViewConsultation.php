<?php

$page = 'view_consultation_page';

include('../dbconfig.php');

include('includes/header.php');




?>


<style>
.flex-box {
    display: flex;
    justify-content: space-between;
}

@media screen and (max-width: 1000px) {
    .flex-box {
        align-items: center !important;
        flex-direction: column !important;
    }

    .flex-box h3 {
        margin-bottom: 15px !important;
        font-size: 18px !important;
    }
}

</style>
<div class="container-fluid">




    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <?php include('../alert.php');?>
        <div class="card-header">
            <div class="flex-box">
                <h3 class="mb-0">View Consultation Report</h3>
                <div class="dropdown">
                    <button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenuButton"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa-solid fa-download mr-2"></i>Download in PDF
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <?php
                            // Loop through all the months of the year
                            for ($i = 1; $i <= 12; $i++) {
                                // Get the month name and year
                                $month = date('F', mktime(0, 0, 0, $i, 1));
                                $year = date('Y');

                                // Construct the link for downloading the report for this month
                                $link = "downloadIndividualreports.php?month=$month&year=$year";
                                
                                // Output the link as a dropdown item
                                echo "<a href=\"$link\" class=\"dropdown-item\">$month</a>";
                            }
                            ?>
                    </div>
                </div>

            </div>
        </div>
        <div class="card-body">
            <?php 
            $faculty = $_SESSION['auth_user']['email'];

            ?>
            <?php if($faculty == 'ccs.qc@tip.edu.ph'):?>


            <script>
            window.location.href = "Page_reports.php";
            </script>


            <?php else: ?>
            <table class="table bg-light table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Date</th>
                        <th>Duration</th>
                        <th>Student</th>
                        <th>Remarks</th>
                        <th>Topic for consultation</th>

                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php 
                            $query = "SELECT * FROM queing_table WHERE faculty='$faculty' AND isServing='done' AND DATE_FORMAT(`date`, '%M %Y') = DATE_FORMAT(NOW(), '%M %Y')  ORDER BY date DESC ";
                            $query_run = mysqli_query($conn,$query);
                            $counter = 1;
                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row=mysqli_fetch_assoc($query_run)) {
                               
                        ?>
                    <tr>
                        <td> <?php echo $counter."." ?></td>
                        <td><?php echo date("F j, Y, g:i a", strtotime($row['date_accepted']));?></td>
                        <td><?php 
                        
                        $dateAccepted = new DateTime($row['date_accepted']);
                        $dateEnd = new DateTime($row['date_end']);
                        $duration = $dateAccepted->diff($dateEnd);
            
                        echo $duration->format("%i minutes, %s Seconds");?></td>
                        <td><?php echo ucwords($row["first_name"]." ".$row["middle_name"]." ".$row["last_name"]);?></td>
                        <td><?php echo ucwords($row["report"]);?></td>
                        <td><?php echo $row['concern']." (".$row['nature_of_advising'].")"; ?></td>

                        <td class="text-center">
                            <form action="Page_ViewConsultationResult.php" method="POST">
                                <input type="hidden" name="token" value="<?php echo $row['queue_token']?>">
                                <button type="submit" name="view_btn" class="btn btn-info btn-block">View</button>
                            </form>
                        </td>
                    </tr>

                    <?php
                     $counter++;
                    }
                }

                    ?>
                </tbody>
            </table>


            <?php endif; ?>
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
