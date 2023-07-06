<?php 

session_start();
if(isset($_SESSION['authenticanted'])){
    header('Location: ADMIN/index.php');
    $_SESSION['status'] =  'Access Denied';
}

include('dbconfig.php');


?>

<html lang="en">

    <head>
        <meta charset="UTF-8">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="https://tip.edu.ph/assets/Uploads/TIP-INFORMAL-LOGO-04-2.png">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reset Password</title>

        <!--font awesome icon-->
        <script src="https://kit.fontawesome.com/6cea1e7bdb.js" crossorigin="anonymous"></script>

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
                url('assets/background_2.jpg');
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .container {
            margin: 5% auto !important;
            padding: 10px 50px !important;
            background: #fff !important;
            box-shadow: 0 15px 15px rgba(0, 0, 0, 0.5);
            max-width: 28% !important;
        }

        .title {
            text-align: center !important;
        }

        .title img {
            width: 100% !important;
            padding-top: 20px !important;

        }

        .form-group {
            text-align: left;
            position: relative;
            font-family: Arial, FontAwesome;
        }

        .form-group input {
            width: 100%;
            padding: 10px 15px;
            outline: none !important;
            color: black;
            box-shadow: 0 2px 0px 0px rgba(0, 0, 0, 0.2) !important;

        }

        .btn {
            width: 100% !important;
            border-radius: 0px !important;
            margin-bottom: 10px !important;
            font-weight: 600 !important;
            padding: 10px !important;
            border: none !important;
            text-transform: uppercase !important;
            border-bottom: 2px solid rgba(22, 22, 26, 0.18);
            box-shadow: 0 4px 2px -2px rgba(0, 0, 0, 0.2) !important;

        }

        .login-btn {
            background: #292929 !important;
        }

        .btn:hover {
            background-color: #fcd007 !important;
            color: #292929 !important;
            transition: 0.5s !important;

            border-bottom: 2px solid rgba(22, 22, 26, 0.18);
            box-shadow: 0 4px 2px -2px rgba(0, 0, 0, 0.2) !important;
        }


        ::placeholder {
            color: grey !important;
            opacity: 1;
        }

        .field-icon {
            float: right;
            margin-right: 20px;
            margin-top: -31px;
            position: relative;
            font-size: 15px;
            color: grey !important;
            font-weight: 900;
            cursor: pointer;
            z-index: 2;
        }

        .fa-circle-user {
            font-size: 100px !important;
            margin-bottom: 5px !important;
        }

        @media screen and (max-width: 1000px) {
            body {
                background: #fff !important;
            }

            .container {
                margin-top: 25% !important;
                max-width: 100% !important;
                max-height: 100% !important;

                box-shadow: none !important;

            }

            .container img {
                width: 100% !important;
                border: 2px solid #292929 !important;
                background: #292929;
                padding: 0px !important;
            }
        }

        </style>
    </head>

    <body>
        <?php include('preloader.php');?>
        <script>
        var loader = document.getElementById('preloader');

        window.addEventListener('load', setTimeout(function() {
            loader.style.display = 'none';


        }, 1500));
        </script>



        <?php 
$get_token = $_GET['token'];
$check_token = "SELECT * FROM faculty_table WHERE verify_token='$get_token' LIMIT 1";
$check_token_run = mysqli_query($conn, $check_token);



if(mysqli_num_rows($check_token_run) > 0):?>




        <div class="container">
            <div class="title text-center">
                <img src="https://tip.edu.ph/assets/headerfooter/tip-logo.png" alt="">
                <hr>

                <h4>PASSWORD CHANGE</h4>
            </div>
            <hr>
            <?php include('alert2.php');?>

            <form action="function.php" method="POST" autocomplete="off">
                <input type="hidden" name="token" value="<?php if(isset($_GET['token'])){echo $_GET['token'];}?>">
                <div class="row p-2">
                    <div class="form-group col-md-12 text-left">
                        <label>Email:</label>
                        <input type="hidden" name="email_update"
                            value="<?php if(isset($_GET['email'])){echo $_GET['email'];}?>"
                            placeholder="&#xf0e0;  Email Address..." required>

                        <input class="email_hidden" class="text-white bg-dark"
                            value="<?php if(isset($_GET['email'])){echo "&#xf0e0  ".$_GET['email'];}?>"
                            placeholder="&#xf0e0;  Email Address..." disabled="disabled">
                    </div>
                    <div class="form-group col-md-12 text-left">
                        <label>New Password:</label>
                        <input type='password' id="password_1" class="input" name="new_password"
                            placeholder="&#xf023;  New Password..." required>
                        <span id="toggle-password1" onclick="showPassword1()"
                            class="fa fa-fw fa-solid fa-eye field-icon"></span>
                    </div>
                    <div class="form-group col-md-12 text-left">
                        <label>Confirm Password:</label>
                        <input type='password' id="password_2" class="input" name="confirm_password"
                            placeholder="&#xf023;   Confirm Password..." required>
                        <span id="toggle-password2" onclick="showPassword2()"
                            class="fa fa-fw fa-solid fa-eye field-icon"></span>
                    </div>
                </div>
                <div class="row buttons ">
                    <div class="form-group col-md-12">
                        <button type="submit" name="Update_password" class="btn btn-primary login-btn">Update
                            Password</button>
                    </div>

                </div>

            </form>




        </div>


        <?php else: ?>
        <script>
        window.location.href = "facultyLogin.php";
        </script>

        <?php endif; ?>





    </body>



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

    function showPassword2(event_2) {
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
    </script>






</html>
