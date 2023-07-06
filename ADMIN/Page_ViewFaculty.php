<?php
include('../dbconfig.php');
$page = 'Faculty';

include('includes/header.php');

?>
<style>
.faculty_image {
    max-width: 400px !important;
    max-height: 400px !important;
    border-radius: 5% !important;

    padding: 10px !important;

}

.card-body {
    padding: 10px 20px !important;
}

.form-group input,
.form-group select {
    width: 100%;

    font-size: 17px !important;
    border: 2px solid grey;
    outline: none !important;
    box-shadow: 0 2px 0px 0px rgba(0, 0, 0, 0.2) !important;
}

.form-group label {
    margin-bottom: 2px !important;
    margin-left: 2px !important;
    font-size: 20px !important;
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


<div class="container-fluid">

    <div class="card shadow mb-4">

        <?php include('../alert.php');?>
        <div class="card-header">
            <div class="flex-box" style="display:flex; justify-content:space-between">
                <h3 class="mb-0">View Faculty Profile</h3>
                <div>
                    <a type="button" onclick="location.href = document.referrer; return false;"
                        class="btn btn-danger text-white">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="function.php" method="POST" enctype="multipart/form-data">
                <div>

                    <img id="blah" class="faculty_image"
                        src="<?php echo "upload_image_faculty/".$row['faculty_image'] ?>">
                    <br><br>
                    <label for="image">Upload User Image</label>
                    <input type="hidden" name="stored_image" value="<?php echo $row['faculty_image']?>">
                    <input type="hidden" name="email" value="<?php echo $row['email']?>">
                    <br>
                    <input type="file" id="imgInp" accept="image/*" onchange="previewImage();" name="new_image" />
                    <input type="hidden" value="<?php echo $row['id']?>" name="faculty_id">
                    <br> <br>

                    <h5>Invitation Date: <span class="text-danger">
                            <?php echo date("F j, Y, g:i a", strtotime($row['date_invitation']));?> </span></h5>
                    <h5>Submitted Date: <span class="text-danger">
                            <?php echo date("F j, Y, g:i a", strtotime($row['date_submitted']));?> </span></h5>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">First Name</label>
                            <input type="text" value="<?php echo $row['first_name']?>" name="first_name"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Last Name</label>
                            <input type="text" value="<?php echo $row['last_name']?>" name="last_name"
                                class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Middle Name</label>
                            <input type="text" value="<?php echo $row['middle_name']?>" name="middle_name"
                                class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Department</label>
                            <select name="department" class="form-control">
                                <option <?php if($row['department']=='Information Technology') echo"Selected"; ?>
                                    value="Information Technology">Information Technology</option>
                                <option <?php if($row['department']=='Computer Science') echo"Selected"; ?>
                                    value="Computer Science">Computer Science</option>
                                <option value="Computer Science">Information System</option>
                                <option value="Data Science">Data Science</option>
                            </select>
                        </div>
                    </div>
















                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Designation</label>
                            <select name="role" class="form-control">
                                <option value="Select Designation">Select Designation</option>
                                <option <?php if ($row['role'] == 'Dean') echo 'selected'; ?> value="Dean">Dean
                                </option>
                                <option <?php if ($row['role'] == 'Faculty') echo 'selected'; ?> value="Faculty">Faculty
                                </option>
                                <option <?php if ($row['role'] == 'OJT In Charge') echo 'selected'; ?>
                                    value="OJT In Charge">OJT In Charge</option>
                                <option <?php if ($row['role'] == 'Research Coordinator') echo 'selected'; ?>
                                    value="Research Coordinator">Research Coordinator</option>
                                <option <?php if ($row['role'] == 'Industry Lecturer') echo 'selected'; ?>
                                    value="Industry Lecturer">Industry Lecturer</option>
                            </select>
                        </div>
                    </div>



























                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Contact</label>
                            <input type="text" disabled value="<?php echo $row['contact']?>" class="form-control">
                            <input type="hidden" name="contact" value="<?php echo $row['contact']?>">
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" value="<?php echo $row['email']?>" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" disabled value="<?php echo $row['password']?>" class="form-control">
                        </div>
                    </div>
                </div>
                <hr>
                <div class="modal fade" id="update" tabindex="-1" role="dialog"
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
                                <input type="text" value="<?php echo $row['email']?>" class="form-control" disabled>
                                <br>
                                Are you entirely certain that you want to update this faculty?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="update_faculty" class="btn btn-primary">Save
                                    changes</button>
                            </div>
                        </div>
                    </div>
                </div>





                <button type="button" class="btn btn-primary mb-5" data-toggle="modal" data-target="#update">UPDATE
                    FACULTY</button>




                <button type="button" data-toggle="modal" data-target="#delete_faculty"
                    class="btn btn-danger mb-5">DELETE
                    FACULTY</button>

                <div class="modal fade" id="delete_faculty" tabindex="-1" role="dialog"
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
                                Are you certain you want to remove this Faculty?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="delete_faculty" class="btn btn-danger">Delete
                                    Faculty</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>







        </div>
    </div>
</div>


<?php
        }
    }
}
?>




<?php


include('includes/script.php');

?>

<script>
imgInp.onchange = evt => {
    const [file] = imgInp.files
    if (file) {
        blah.src = URL.createObjectURL(file)
    }
}
</script>
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
