<?php


$page = 'Profile_page';
include('../dbconfig.php');


include('includes/header.php');

?>

<style>
.card-body {
    padding: 70px !important;
}

.jumbotron {
    padding: 15px !important;
}

.user-image {

    max-width: 100% !important;
    max-height: 490px !important;


}


.form-group {
    border-bottom: 2px solid grey !important;
    padding-left: 5px !important;
    margin-bottom: 20px !important;
    box-shadow: 0 4px 2px -2px rgba(0, 0, 0, 0.2) !important;
}

input[type="file"] {
    border: 2px solid grey !important;
    width: 100% !important;
    margin-bottom: 10px !important;
}

input[type="text"],
input[type="email"],
input[type="number"],
input[type="password"] {
    border: 2px solid grey !important;
    width: 100% !important;
    margin-bottom: 10px !important;
    padding: 5px !important;
    background: transparent !important;
    color: white !important;

    box-shadow: 0 4px 2px -2px rgba(0, 0, 0, 0.2) !important;
}

.modal_image {
    max-width: 60% !important;
    max-height: 250px !important;
    border-radius: 50% !important;
    padding: 10px !important;

}

.form-group label {
    margin-bottom: 0px !important;
    font-weight: 600 !important;
    color: #df4759 !important;
}

.form-group {
    position: relative;
    text-align: left;

}



.field-icon {
    float: right;
    margin-right: 30px;
    margin-top: -37px;
    position: relative;
    font-size: 15px !important;
    color: white !important;
    font-weight: 600;
    cursor: pointer !important;



}

.flex-box {
    display: flex;
    justify-content: space-between
}

@media screen and (max-width: 1000px) {
    .modal {
        text-align: left !important;
    }

    .card-body {
        padding: 10px !important;
        background-color: #e9ecef !important;
    }

    .flex-box {
        text-align: center !important;
        flex-direction: column !important;
    }

    .flex-box h3,
    .jumbotron h2 {

        margin-bottom: 15px !important;
        font-size: 20px !important;
    }

    .flex-box .btn {

        margin-bottom: 5px !important;
        width: 100% !important;
    }

    .card-body img {

        height: 350px !important;
        margin-bottom: 10px !important;

    }

    .modal_image {

        max-height: 190px !important;

    }



}

</style>

<div class="container-fluid">
    <?php 
        $user_email =  $_SESSION['auth_user']['email']; 
        $user_data_query = "SELECT * FROM faculty_table WHERE email='$user_email'";
        $query_run = mysqli_query($conn,$user_data_query);
        if (mysqli_num_rows($query_run) > 0) {
while ($row=mysqli_fetch_assoc($query_run)) {

    ?>


    <div class="card shadow mb-4">
        <?php include('../alert.php');?>

        <div class="card-header">



            <div class="flex-box">
                <h3 class="mb-0">My Profile</h3>
                <div>
                    <button type="button" data-toggle="modal" data-target="#edit_profile" class="btn btn-primary"><i
                            class="fa-solid fa-pen-to-square mr-1"></i>Edit Profile</button>
                    <button type="button" data-toggle="modal" data-target="#change_password"
                        class="btn btn-danger">Change Password</button>


                    <form action="function.php" method="POST" autocomplete="off" enctype="multipart/form-data">

                        <!-- Modal -->
                        <div class="modal fade" id="edit_profile" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">EDIT PROFILE</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="image-container">
                                            <div class="text-center mb-4">
                                                <img class="modal_image" id="blah"
                                                    src="<?php echo "upload_image_faculty/".$row['faculty_image'] ?>">
                                            </div>

                                            <label for="image">Upload User Image</label>

                                            <br>
                                            <input type="file" id="imgInp" name="faculty_image_upload" accept="image/*"
                                                onchange="previewImage();" name="user_images" />

                                            <input type="hidden" value="<?php echo $row['faculty_image']?>"
                                                name="faculty_image_current">
                                        </div>
                                        <div class="group-form">
                                            <label class="mb-1" for="image">First Name</label>
                                            <input type="text" value="<?php echo $row['first_name']?>"
                                                name="first_name">
                                        </div>

                                        <div class="group-form">
                                            <label class="mb-1" for="image">Last Name</label>
                                            <input type="text" value="<?php echo $row['last_name']?>" name="last_name">
                                        </div>

                                        <div class="group-form">
                                            <label class="mb-1" for="image">Middle Name</label>
                                            <input type="text" value="<?php echo $row['middle_name']?>"
                                                name="middle_name">
                                        </div>

                                        <div class="group-form">
                                            <label class="mb-1" for="image">Contact</label>
                                            <input type="number" value="<?php echo $row['contact']?>" name="contact">
                                        </div>
                                        <input type="hidden" name="user_id" value="<?php echo $row['id'] ?>">

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" name="update_profile_btn"
                                            class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>




                    <form action="function.php" method="POST" autocomplete="off" enctype="multipart/form-data">


                        <!-- Modal -->
                        <div class="modal fade" id="change_password" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">CHANGE PASSWORD</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="current_password"
                                            value="<?php echo $row['password'] ?>">
                                        <input type="hidden" name="user_id" value="<?php echo $row['id'] ?>">

                                        <div class="group-form">
                                            <label class="mb-1" for="image">Old Password</label>
                                            <input placeholder="Old Password..." type="password" id="password_1"
                                                required name="old_password">

                                            <span id="toggle-password1" onclick="showPassword1()"
                                                class="fa fa-fw fa-solid fa-eye field-icon"></span>



                                        </div>

                                        <div class="group-form">
                                            <label class="mb-1" for="image">New Password</label>
                                            <input placeholder="New Password..." type="password" id="password_2"
                                                name="new_password">

                                            <span id="toggle-password2" onclick="showPassword2()"
                                                class="fa fa-fw fa-solid fa-eye field-icon"></span>
                                        </div>

                                        <div class="group-form">
                                            <label class="mb-1" for="image">Confirm Password</label>
                                            <input placeholder="Confirm Password..." id="password_3" type="password"
                                                name="confirm_password">


                                            <span id="toggle-password3" onclick="showPassword3()"
                                                class="fa fa-fw fa-solid fa-eye field-icon"></span>
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" name="reset_password"
                                            class="btn btn-danger">Confirm</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>







                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row ">
                <div class="col-md-4">
                    <img class=" user-image" src="<?php echo "upload_image_faculty/".$row['faculty_image'] ?>" alt="">
                </div>
                <div class="col-md-8 jumbotron">
                    <h2>Basic Infomation</h2>
                    <br>
                    <div class="form-group">
                        <label class="h6" for="">Name</label>
                        <h5><?php echo $row['first_name']." ".$row['middle_name']." ".$row['last_name'] ?></h5>
                    </div>
                    <div class="form-group">
                        <label class="h6" for="">Department</label>
                        <h5><?php echo $row['department'];?></h5>
                    </div>


                    <div class="form-group">
                        <label class="h6" for="">Designation</label>
                        <h5><?php echo $row['role'];?></h5>
                    </div>



                    <div class="form-group">
                        <label class="h6" for="">Contact</label>
                        <h5><?php echo $row['contact'];?></h5>
                    </div>


                    <div class="form-group">
                        <label class="h6" for="">Email Address</label>
                        <h5><?php echo $row['email'];?></h5>
                    </div>





                </div>
            </div>

        </div>


    </div>







    <?php }}?>
</div>























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

<script>
function showPassword1(event) {
    var password = document.getElementById("password_1");
    if (password.type === "password") {
        password.type = "text";
        document.getElementById("toggle-password1").classList.add("fa-eye-low-vision");
        document.getElementById("toggle-password1").classList.remove("fa-eye");

    } else {
        password.type = "password";
        document.getElementById("toggle-password1").classList.remove("fa-eye-low-vision");
        document.getElementById("toggle-password1").classList.add("fa-eye");

    }
}

function showPassword2(event) {
    var password_2 = document.getElementById("password_2");
    if (password_2.type === "password") {
        password_2.type = "text";
        document.getElementById("toggle-password2").classList.add("fa-eye-low-vision");
        document.getElementById("toggle-password2").classList.remove("fa-eye");

    } else {
        password_2.type = "password";
        document.getElementById("toggle-password2").classList.remove("fa-eye-low-vision");
        document.getElementById("toggle-password2").classList.add("fa-eye");

    }
}





function showPassword3(event) {
    var password_3 = document.getElementById("password_3");
    if (password_3.type === "password") {
        password_3.type = "text";
        document.getElementById("toggle-password3").classList.add("fa-eye-low-vision");
        document.getElementById("toggle-password3").classList.remove("fa-eye");

    } else {
        password_3.type = "password";
        document.getElementById("toggle-password3").classList.remove("fa-eye-low-vision");
        document.getElementById("toggle-password3").classList.add("fa-eye");

    }
}
</script>
