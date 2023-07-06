<?php

$page = 'Faculty';

include('includes/header.php');



?>
<!-- tel input -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<style>
.faculty_img {
    max-width: 300px !important;
    max-height: 300px !important;
}

.form-group label {

    margin-bottom: 2px !important;
    margin-left: 3px !important;

}

input {

    width: 100% !important;
}


.iti {
    width: 100% !important;
}

.card {
    width: 100% !important;
}

.flex-box {
    display: flex;
    justify-content: space-between
}

@media screen and (max-width: 1000px) {
    .flex-box {
        flex-direction: column !important;
        align-items: center !important;
    }

    .flex-box h3 {
        font-size: 18px !important;
        margin-bottom: 20px !important;
    }


}

</style>

<div class="container-fluid">




    <div class="card shadow mb-4">
        <?php include('../alert.php');?>
        <div class="card-header">
            <div class="flex-box">
                <h3 class="mb-0">Add Faculty Member</h3>
                <div>
                    <a href="Page_pendingFaculty.php" class="btn btn-info">View Pending Invitation</a>
                    <a href="Page_Faculty.php" class="btn btn-danger">Back</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <?php include('../alert.php');?>
            <form action="function.php" class="p-2" method="POST" enctype="multipart/form-data">
                <div>
                    <div class="row">
                        <div class="col-md-4">


                            <div class="form-group">
                                <label for="">Department</label>
                                <select name="department" class="form-control">
                                    <option value="Select Department">Select Department</option>



                                    <option
                                        <?php if (isset($_SESSION['user_inputs_invite']['department']) && $_SESSION['user_inputs_invite']['department'] == 'Information Technology') echo 'selected'; ?>
                                        value="Information Technology">Information Technology</option>
                                    <option
                                        <?php if (isset($_SESSION['user_inputs_invite']['department']) && $_SESSION['user_inputs_invite']['department'] == 'Computer Science') echo 'selected'; ?>
                                        value="Computer Science">Computer Science</option>
                                    <option
                                        <?php if (isset($_SESSION['user_inputs_invite']['department']) && $_SESSION['user_inputs_invite']['department'] == 'Information System') echo 'selected'; ?>
                                        value="Information System">Information System</option>
                                    <option
                                        <?php if (isset($_SESSION['user_inputs_invite']['department']) && $_SESSION['user_inputs_invite']['department'] == 'Data Science and Analytics') echo 'selected'; ?>
                                        value="Data Science and Analytics">Data Science and Analytics</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">





                            <div class="form-group">
                                <label for="">Designation</label>
                                <select name="role" class="form-control">
                                    <option value="Select Designation">Select Designation</option>
                                    <option
                                        <?php if (isset($_SESSION['user_inputs_invite']['role']) && $_SESSION['user_inputs_invite']['role'] == 'Dean') echo 'selected'; ?>
                                        value="Dean">Dean</option>
                                    <option
                                        <?php if (isset($_SESSION['user_inputs_invite']['role']) && $_SESSION['user_inputs_invite']['role'] == 'Faculty') echo 'selected'; ?>
                                        value="Faculty">Faculty</option>
                                    <option
                                        <?php if (isset($_SESSION['user_inputs_invite']['role']) && $_SESSION['user_inputs_invite']['role'] == 'OJT In Charge') echo 'selected'; ?>
                                        value="OJT In Charge">OJT In Charge</option>
                                    <option
                                        <?php if (isset($_SESSION['user_inputs_invite']['role']) && $_SESSION['user_inputs_invite']['role'] == 'Research Coordinator') echo 'selected'; ?>
                                        value="Research Coordinator">Research Coordinator</option>
                                    <option
                                        <?php if (isset($_SESSION['user_inputs_invite']['role']) && $_SESSION['user_inputs_invite']['role'] == 'Industry Lecturer') echo 'selected'; ?>
                                        value="Industry Lecturer">Industry Lecturer</option>
                                </select>
                            </div>
























                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Email Address</label>
                                <input name="email" required
                                    value="<?php if(isset($_SESSION['user_inputs_invite']['email'])){echo $_SESSION['user_inputs_invite']['email']; unset($_SESSION['user_inputs_invite']['email']);}?>"
                                    type="email" class="form-control" placeholder="Email...">
                            </div>
                        </div>
                    </div>
                    <br>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal"
                        data-target="#exampleModalCenter">
                        Send Invitation
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Alert</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <h5>Are you sure you want to invite this person?</h5>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="invite_faculty_btn" class="btn btn-primary">Send
                                        Invitation</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </form>
        </div>
    </div>
</div>

<script>
const phoneInputField = document.querySelector("#phone");
const phoneInput = window.intlTelInput(phoneInputField, {
    preferredCountries: ["ph"],
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
});
</script>

<?php
include('includes/footer.php');

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
