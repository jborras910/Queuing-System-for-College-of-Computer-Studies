<?php
include('../dbconfig.php');
$page = 'ActivityLog';

include('includes/header.php');

?>



<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header">
            <div class="flex-box" style="display:flex; justify-content:space-between">
                <h3 class="mb-0">Activity logs</h3>
                <div>

                </div>
            </div>
        </div>
        <div class="card-body">

            <table class="table bg-light table-bordered" id="dataTable" width="100%" cellspacing="0">
                <?php 
                $faculty = $_SESSION['auth_user']['email'];
        $query = "SELECT * FROM activity_log WHERE email='$faculty' ORDER BY date DESC ";
        $query_run = mysqli_query($conn,$query);
            ?>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Activty</th>

                    </tr>
                </thead>

                <tbody>
                    <?php 
                if (mysqli_num_rows($query_run) > 0) {
                    while ($row=mysqli_fetch_assoc($query_run)) {
                        ?>
                    <tr>
                        <th class="text-danger"><?php 
                        
                        echo date("F j, Y, g:i a", strtotime($row['date']));
                        
                        ?> </th>
                        <th class="text-success"> <?php echo $row['activty'] ?></th>

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

<?php
include('includes/script.php');
?>



<!-- Bootstrap core JavaScript-->
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>
