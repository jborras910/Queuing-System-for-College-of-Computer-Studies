<?php 

session_start();
if(isset($_SESSION['authenticanted'])){
    header('Location: ADMIN/index.php');
    $_SESSION['status'] =  'Access Denied';
}




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
            margin-top: -27px;
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
        <div class="container">
            <div class="title text-center">
                <img src="https://tip.edu.ph/assets/headerfooter/tip-logo.png" alt="">
                <hr>

                <h4>RESET PASSWORD</h4>
            </div>
            <hr>
            <?php include('alert2.php');?>
            <form class="mt-2" action="function.php" method="POST" autocomplete="off">
                <div class="form-group">
                    <input type="email" name="email"
                        value="<?php if(isset($_SESSION['email_address'])){echo $_SESSION['email_address']; unset($_SESSION['email_address']); } ?>"
                        class="form-control" placeholder="&#xf0e0;  Enter Email Address..." required>
                </div>


                <button type="submit" name="password_reset_link" class="btn btn-primary login-btn">SEND</button>
                <a type="button" href="facultyLogin.php" class="btn btn-danger text-white">BACK</a>
            </form>
        </div>







    </body>







</html>
