<?php
$page = 'view_consultation_page';

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

    font-weight: 600 !important;
    font-size: 20px !important;
}

table tbody tr td {


    padding: 9px !important;
    font-size: 17px !important;
}

table thead tr {

    background: red !important;

    border: 1px solid black !important;
}

@media screen and (max-width: 1000px) {
    .card {
        width: 100% !important;
    }

    .box img {
        height: 100% !important;
        width: 100% !important;
    }
}

</style>

<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-header">
            <div class="flex-box" style="display:flex; justify-content:space-between">
                <h3 class="mb-0">View Consultation Report</h3>
                <div>
                    <form action="Page_reports_departments.php" method="POST">
                        <input type="hidden" name="department"
                            value="<?php if(isset($_SESSION['department'])){echo $_SESSION['department'];}else{ echo '';}  ?>">
                        <button type="submit" name="view_report" class="btn btn-danger text-white">BACK</a>
                    </form>

                </div>
            </div>
        </div>
        <div class="card-body">

            <?php 
    
        if(isset($_POST['view_btn'])){
            $token = $_POST['token'];

            $query = "SELECT * FROM queing_table WHERE queue_token='$token'";
            $query_run = mysqli_query($conn,$query);

            if (mysqli_num_rows($query_run) > 0) {
                while ($row=mysqli_fetch_assoc($query_run)) {
                    
?>

            <div class="row">
                <div class="col-md-4 box border">
                    <h3 class="text-uppercase">Student ID</h3>
                    <hr>
                    <img src="student_ids/<?php echo $row['school_id'] ?>" alt="">
                </div>
                <div class="col-md-4 box border">

                    <h3 class="text-uppercase">Input Concern</h3>
                    <hr>

                    <table class="border">
                        <thead>
                            <label for="">
                                Student Data
                            </label>
                        </thead>
                        <tbody>
                            <tr class="border-bottom">
                                <td>Full Name:</td>
                                <td><?php echo $row['first_name']." ".$row['middle_name']." ".$row['last_name'] ?></td>
                            </tr>
                            <tr class="border-bottom">
                                <td>Program:</td>
                                <td><?php echo $row['program']?></td>
                            </tr>

                            <tr class="border-bottom">
                                <td>Year Level:</td>
                                <td><?php echo $row['year_level']?></td>
                            </tr>
                            <tr class="border-bottom">
                                <td>Student Number:</td>
                                <td><?php echo $row['student_number']?></td>
                            </tr>

                            <tr class="border-bottom">
                                <td>Email:</td>
                                <td><?php echo $row['email']?></td>
                            </tr>

                            <tr class="border-bottom text-danger">
                                <td>Nature of Advising:</td>
                                <td><?php echo $row['nature_of_advising']?></td>
                            </tr>

                            <tr class=" border-bottom text-danger">
                                <td>Concern:</td>
                                <td><?php echo $row['concern']?></td>
                            </tr>
                            <tr class="border-bottom text-danger">
                                <td>Endores:</td>
                                <td><?php echo $row['endores']?></td>
                            </tr>
                        </tbody>
                    </table>


                </div>
                <div class="col-md-4 box border">
                    <h3 class="text-uppercase">Feed Back</h3>
                    <hr>
                    <label for="">Faculty Report</label>
                    <div class="form-group border p-3">

                        <h6>Assist by: <?php 
                    
                    if($_SESSION['auth_user']['email'] == $row['faculty']){

                        echo "You";

                    }else{
                        echo $row['faculty'];
                    }
                    
                    
                    
                    
                    ?></h6>
                        <h6>Report:
                            <?php echo $row['report']?>
                        </h6>
                        <hr>
                        <h6>Date Submitted: <?php echo date("F j, Y, g:i a", strtotime($row['date_accepted']));?></h6>
                        <h6>Date End <?php echo date("F j, Y, g:i a", strtotime($row['date_end']));?></h6>
                    </div>
                    <label for="">Student Feedback</label>
                    <div class="border p-3">
                        <?php echo $row['feedback']?>
                    </div>
                </div>
            </div>


            <?php
            
                }

            }

            
        }
    
    ?>


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
