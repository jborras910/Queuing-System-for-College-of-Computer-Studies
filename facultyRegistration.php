<?php

include('dbconfig.php');

session_start();




if(isset($_GET['token'])){
    $token = $_GET['token'];
    $email = $_GET['email'];
    $check_token_query = "SELECT verify_token FROM faculty_table WHERE verify_token='$token' AND date_submitted='' LIMIT 1";
    $check_token_query_run = mysqli_query($conn, $check_token_query);
    
    if(mysqli_num_rows($check_token_query_run)>0){
     ?>




<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="https://tip.edu.ph/assets/Uploads/TIP-INFORMAL-LOGO-04-2.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registration form</title>



        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />

        <!-- datatable -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"
            rel="stylesheet">

        <!-- datatable -->
        <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


        <!-- Custom fonts for this template -->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet" />


        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>






        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>








        <style>
        body {
            background-image:
                /* top, transparent red */
                linear-gradient(rgba(211, 224, 149, 0.45),
                    rgba(160, 155, 155, 0.45)),
                /* your image */
                url('https://upload.wikimedia.org/wikipedia/commons/e/ec/Technological_Institute_of_the_Philippines_Quezon_City.jpg');
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .container {

            margin: 5% auto !important;
            padding: 10px 50px !important;
            background: #fff !important;
            width: 50%;
            border-radius: 10px !important;
            box-shadow: 0 15px 15px rgba(0, 0, 0, 0.5);



        }

        .title {
            text-align: center !important;
        }

        .title img {
            width: 65% !important;
            margin-top: 8% !important;
            border: 2px solid #292929 !important;
            background: #292929 !important;
            box-shadow: 0 2px 2px rgba(0, 0, 0, 0.5);

        }

        .form-group label {
            margin-bottom: 2px !important;
        }

        .btn {
            width: 100% !important;
            border-radius: 0px !important;
            background-color: #292929 !important;
            color: #fcd007 !important;
            font-weight: 600 !important;
            padding: 10px !important;
            border: none !important;

            text-transform: uppercase !important;
            border-bottom: 2px solid rgba(22, 22, 26, 0.18);
            box-shadow: 0 4px 2px -2px rgba(0, 0, 0, 0.2) !important;
        }

        .btn:hover {
            background-color: #fcd007 !important;
            color: #292929 !important;
            transition: 0.5s !important;

            border-bottom: 2px solid rgba(22, 22, 26, 0.18);
            box-shadow: 0 4px 2px -2px rgba(0, 0, 0, 0.2) !important;
        }

        .iti {
            width: 100%;
            display: block;
        }

        .field-icon {
            float: right;
            margin-right: 20px;
            margin-top: -27px;
            position: relative;
            font-size: 15px;
            color: grey !important;
            font-weight: 900;
            cursor: pointer;
            z-index: 2;
        }

        .form-group {
            text-align: left;
            position: relative;
            font-family: Arial, FontAwesome;
        }


        @media screen and (max-width: 1000px) {
            .container {

                width: 100% !important;
                height: auto !important;
                margin: 0% auto !important;



            }

            .title img {
                width: 100% !important;
            }
        }

        </style>
    </head>

    <body>

        <div class="container">
            <div class="title">
                <img src="https://tip.edu.ph/assets/headerfooter/tip-logo.png" alt="">
                <hr>
            </div>
            <form action="function.php" method="POST" autocomplete="off" enctype="multipart/form-data">
                <?php include('alert.php');?>
                <div>
                    <img class="border" id="blah" src="#" alt="" width="200px">
                    <br><br>
                    <label for="image">Upload 2X2 Picture Here</label>
                    <br>
                    <input type="file" id="imgInp" accept="image/*" onchange="previewImage();" name="faculty_image"
                        required>
                    <hr>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">First Name</label>
                            <input type="text"
                                value="<?php if(isset($_SESSION['user_inputs']['first_name'])){echo $_SESSION['user_inputs']['first_name']; unset($_SESSION['user_inputs']['first_name']);}?>"
                                name="first_name" placeholder="First Name..." class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Last Name</label>
                            <input type="text"
                                value="<?php if(isset($_SESSION['user_inputs']['last_name'])){echo $_SESSION['user_inputs']['last_name']; unset($_SESSION['user_inputs']['last_name']);}?>"
                                name="last_name" placeholder="Last Name..." class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Middle Name</label>
                            <input type="text"
                                value="<?php if(isset($_SESSION['user_inputs']['middle_name'])){echo $_SESSION['user_inputs']['middle_name']; unset($_SESSION['user_inputs']['middle_name']);}?>"
                                name="middle_name" placeholder="Middle Name..." class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" value="<?php echo $email ?>" class="form-control" disabled>
                            <input type="hidden" value="<?php echo $email ?>" name="email">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Contact</label>
                            <input type="tel"
                                value="<?php if(isset($_SESSION['user_inputs']['contact'])){echo $_SESSION['user_inputs']['contact']; unset($_SESSION['user_inputs']['contact']);}?>"
                                id="phone" name="contact" placeholder="Contact..." class="form-control">
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Password</label>

                            <input type="password"
                                value="<?php if(isset($_SESSION['user_inputs']['password'])){echo $_SESSION['user_inputs']['password']; unset($_SESSION['user_inputs']['password']);}?>"
                                name="password" placeholder="Password..." id="password" class="form-control">

                            <span id="toggle-password1" onclick="showPassword1()"
                                class="fa fa-fw fa-solid fa-eye field-icon"></span>
                        </div>
                    </div>




                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Confirm Password</label>
                            <input type="password"
                                value="<?php if(isset($_SESSION['user_inputs']['confirm_password'])){echo $_SESSION['user_inputs']['confirm_password']; unset($_SESSION['user_inputs']['confirm_password']);}?>"
                                name="confirm_password" placeholder="Confirm Password..." class="form-control"
                                id="confirm_password">
                            <span id="toggle-password2" onclick="showPassword2()"
                                class="fa fa-fw fa-solid fa-eye field-icon"></span>

                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12 mb-5">
                        <button class="btn btn-primary" type="button" data-toggle="modal"
                            data-target="#exampleModalCenter">Submit</button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
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
                                        Please validate your application before you submit
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="faculty_register_btn"
                                            class="btn btn-primary">Submit</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </body>

</html>


<script>
function showPassword1(event) {
    var password = document.getElementById("password");
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
    var confirm_password = document.getElementById("confirm_password");
    if (confirm_password.type === "password") {
        confirm_password.type = "text";
        document.getElementById("toggle-password2").classList.add("fa-eye-low-vision");
        document.getElementById("toggle-password2").classList.remove("fa-eye");

    } else {
        confirm_password.type = "password";
        document.getElementById("toggle-password2").classList.remove("fa-eye-low-vision");
        document.getElementById("toggle-password2").classList.add("fa-eye");

    }
}
</script>











<script>
imgInp.onchange = evt => {
    const [file] = imgInp.files
    if (file) {
        blah.src = URL.createObjectURL(file)
    }
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script src="js/scripts.js"></script>

<script src="js/jquery-3.6.2.min.js" crossorigin="anonymous"></script>
<script src="js/jquery.dataTables.min.js" crossorigin="anonymous"></script>






<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>




<script>
const phoneInputField = document.querySelector("#phone");
const phoneInput = window.intlTelInput(phoneInputField, {
    preferredCountries: ["ph"],
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
});
</script>







<?php
    
    
    }else{

      
        header('Location: facultyLogin.php');
    
    }


}else{
    echo 'empty token';
}

?>
