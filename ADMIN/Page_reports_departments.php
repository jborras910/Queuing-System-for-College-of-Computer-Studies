<?php
$page = 'view_consultation_page';
include('../dbconfig.php');
include('includes/header.php');


?>



<?php

if($_SESSION['auth_user']['role'] !='Main Admin'):
  
?>
<script>
window.location.href = "Page_ViewConsultation.php";
</script>

<?php
            endif;
            ?>



<div class="container-fluid">




    <div class="card shadow mb-4">
        <?php include('../alert.php');?>
        <div class="card-header">
            <div class="flex-box" style="display:flex; justify-content:space-between">
                <h3 class="mb-0">Department Reports</h3>
                <?php 

if(isset($_POST['view_report'])){
    $_SESSION['department'] = $_POST['department'];
    $department = $_SESSION['department'];
    ?>
                <div>
                    <a href="Page_reports_departments_pdfdownload.php" class="btn btn-danger text-bold text-white"><i
                            class="fa-solid fa-download mr-2"></i>Download in
                        PDF</a>
                    <a href="Page_ViewConsultation.php" class="btn btn-danger">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table bg-light table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Date </th>

                        <th>Student</th>
                        <th>Faculty</th>

                        <th>Topics for consultation</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                       
                            $query = "SELECT * FROM queing_table WHERE department='$department' AND isServing ='done' AND DATE_FORMAT(`date`, '%M %Y') = DATE_FORMAT(NOW(), '%M %Y') ORDER BY date DESC ";
                            $query_run = mysqli_query($conn,$query);
                            $counter = 1;
                        if (mysqli_num_rows($query_run) > 0) {
                            while ($row=mysqli_fetch_assoc($query_run)) {
                        ?>
                    <tr>
                        <td><?php echo $counter."." ?></td>
                        <td><?php echo date("F j, Y, g:i a", strtotime($row['date_accepted'])); ?></td>

                        <td><?php echo ucwords($row["first_name"]." ".$row["middle_name"]." ".$row["last_name"]) ?></td>
                        <td><?php echo $row['faculty_full_name'] ?></td>

                        <td><?php echo $row['concern']." (".$row['nature_of_advising'].")"; ?></td>
                        <td>
                            <form action="Page_ViewConsultationResult.php" method="POST">
                                <input type="hidden" name="token" value="<?php echo $row['queue_token']?>">
                                <button type="submit" name="view_btn" class="btn btn-info btn-block">View</button>
                            </form>
                        </td>
                    </tr>

                    <?php
                         $counter++;
                    }
                } }

                    ?>
                </tbody>
            </table>



        </div>
    </div>
</div>







<?php
include('includes/footer.php');

include('includes/script.php');

?>
<!-- datatable -->


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>




<!-- Bootstrap core JavaScript-->
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>
