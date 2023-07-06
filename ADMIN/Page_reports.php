<?php
$page = 'view_consultation_page';
include('../dbconfig.php');
include('includes/header.php');







?>
<?php if($_SESSION['auth_user']['role'] !='Main Admin'): ?>
<script>
window.location.href = "Page_ViewConsultation.php";
</script>

<?php endif; ?>
<style>
.card .btn {
    border: none !important;
    width: 100% !important;

}

.flex-box_2 {
    display: flex;
    justify-content: space-between
}

@media screen and (max-width: 1000px) {
    .card-header {
        text-align: center !important;
    }

    .flex-box_2 {

        flex-direction: column !important;
        align-items: center !important;
    }

    .flex-box h3 {
        font-size: 18px !important;
    }

    .flex-box_2 h2 {
        font-size: 18px !important;
    }
}

</style>

<div class="container-fluid">




    <div class="card shadow mb-4">
        <?php include('../alert.php');?>
        <div class="card-header">
            <div class="flex-box">
                <h3 class="mb-0">Consultation Reports <?php echo date('F Y'); ?></h3>
                <div>


                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4 ">
                        <div class="card-body row">
                            <div class=" col-md-10"><span class="text-uppercase">
                                    Information
                                    Technology
                                </span>
                            </div>
                            <div class="col-md-2">
                                <?php 
                        $query = "SELECT *  FROM queing_table WHERE department = 'Information Technology' AND isServing='done' AND DATE_FORMAT(`date_end`, '%M %Y') = DATE_FORMAT(NOW(), '%M %Y')";
                        $query_run = mysqli_query($conn,$query);
                        $row = mysqli_num_rows($query_run);
                        echo '<h4>'.$row.'</h4>';
                        ?>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <form action="Page_reports_departments.php" method="POST">
                                <input type="hidden" name="department" value="Information Technology">
                                <button type="submit" name="view_report" class="btn btn-light">View
                                    Details</button>
                            </form>
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
                <div class=" col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body row">
                            <div class="col-md-10"><span class="text-uppercase">Computer Science</span></div>
                            <div class="col-md-2">
                                <?php 
               

               $query = "SELECT *  FROM queing_table WHERE department = 'Computer Science' AND isServing='done' AND DATE_FORMAT(`date_end`, '%M %Y') = DATE_FORMAT(NOW(), '%M %Y')";
                    $query_run = mysqli_query($conn,$query);
                    $row = mysqli_num_rows($query_run);
                    echo '<h4>'.$row.'</h4>';
                    ?>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <form action="Page_reports_departments.php" method="POST">
                                <input type="hidden" name="department" value="Computer Science">
                                <button type="submit" name="view_report" class="btn btn-light">View
                                    Details</button>
                            </form>
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-dark  text-white mb-4">
                        <div class="card-body row">
                            <div class="col-md-10"><span class="text-uppercase">Information System</span>
                            </div>
                            <div class="col-md-2">
                                <?php 
                                 

                    
                    $query = "SELECT *  FROM queing_table WHERE department = 'Information System' AND isServing='done' AND DATE_FORMAT(`date_end`, '%M %Y') = DATE_FORMAT(NOW(), '%M %Y')";
                    $query_run = mysqli_query($conn,$query);
                    $row = mysqli_num_rows($query_run);
                    echo '<h4>'.$row.'</h4>';
                    ?>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <form action="Page_reports_departments.php" method="POST">
                                <input type="hidden" name="department" value="Information System">
                                <button type="submit" name="view_report" class="btn btn-light">View
                                    Details</button>
                            </form>
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body row">
                            <div class="col-md-10"><span class="text-uppercase">Data Science and Analytics</span></div>
                            <div class="col-md-2">
                                <?php 
                                
                    $query = "SELECT *  FROM queing_table WHERE department = 'Data Science' AND isServing='done'  AND DATE_FORMAT(`date_end`, '%M %Y') = DATE_FORMAT(NOW(), '%M %Y')";
                    $query_run = mysqli_query($conn,$query);
                    $row = mysqli_num_rows($query_run);
                    echo '<h4>'.$row.'</h4>';
                    ?>


                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <form action="Page_reports_departments.php" method="POST">
                                <input type="hidden" name="department" value="Data Science">
                                <button type="submit" name="view_report" class="btn btn-light">View
                                    Details</button>
                            </form>
                            <i class="fa-solid fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>


            <br>

            <div class="">
                <div class="flex-box_2">
                    <div>
                        <h2>Overall Consultation <?php echo date('F Y'); ?></h2>
                    </div>

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
                                $link = "downloadReports.php?month=$month&year=$year";
                                
                                // Output the link as a dropdown item
                                echo "<a href=\"$link\" class=\"dropdown-item\">$month</a>";
                            }
                            ?>
                        </div>
                    </div>









                </div>
                <hr>
                <table class="table bg-light table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Date </th>
                            <th>Student</th>
                            <th>Assits By</th>
                            <th>Department</th>
                            <th>Topic for consultation</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php 
                            $query = "SELECT * FROM queing_table WHERE isServing='done' AND DATE_FORMAT(`date`, '%M %Y') = DATE_FORMAT(NOW(), '%M %Y') ORDER BY date DESC ";
                            $query_run = mysqli_query($conn,$query);
                            $counter = 1;
                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row=mysqli_fetch_assoc($query_run)) {
                               
                        ?>
                        <tr>
                            <td> <?php echo $counter."." ?></td>
                            <td><?php echo date("F j, Y, g:i a", strtotime($row['date_accepted'])); ?></td>
                            <td><?php echo ucwords($row['first_name']." ".$row['middle_name']." ".$row['last_name']);?>
                            </td>
                            <td><?php echo $row['faculty_full_name'] ?></td>
                            <td><?php echo $row['department'] ?></td>
                            <td><?php echo $row['concern'];?></td>

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
