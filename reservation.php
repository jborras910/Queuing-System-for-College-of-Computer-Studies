<?php
include('dbconfig.php');

session_start();

if (!isset($_SESSION['queue_activate'])) {
    $_SESSION['status'] =  'Access Denied';
    header('Location: index.php');
}



?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="icon" href="https://tip.edu.ph/assets/Uploads/TIP-INFORMAL-LOGO-04-2.png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Queuing</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


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


        .main {
            width: 40% !important;
        }

        .flex-box {
            padding: 15px !important;
        }



        .form {
            background: #f5f5f5 !important;

            margin: 5% auto !important;
            border-bottom: 2px solid rgba(22, 22, 26, 0.18);
            box-shadow: 0 4px 2px -2px rgba(0, 0, 0, 0.2) !important;
            padding: 20px !important;
            border-radius: 10px !important;


        }



        .form select option {
            height: 400px !important;
        }

        .form input,
        .form textarea,
        select {
            border-radius: 0px !important;

            background: #fff !important;
            border: 1px solid #292929 !important;
            padding: 7px !important;
            width: 100% !important;
            outline: none !important;

            box-shadow: 0 4px 2px -2px rgba(0, 0, 0, 0.2) !important;

        }


        input[type=file] {
            padding: 5px !important;
        }




        .form label {
            margin-bottom: 2px !important;
            margin-left: 2px !important;

        }

        .form-title {

            text-align: center !important;


        }

        .form-title img {
            width: auto !important;


        }

        .show {
            display: block !important;
        }

        .hide {
            display: none !important;
        }

        .btn {

            text-transform: uppercase !important;
            border: none !important;
            font-weight: 600 !important;
            padding: 10px !important;
            box-shadow: 0 2px 0px 0px rgba(0, 0, 0, 0.2) !important;
        }

        .submit {
            background: #292929 !important;
            color: #fff !important;
        }

        .mobile-title {
            display: none;
        }

        .desktop_logo {
            margin-bottom: 4% !important;
        }



        @media screen and (max-width: 1000px) {
            body {
                background: #fff !important;
            }

            .desktop_logo {
                display: none !important;
            }


            .container {
                width: 100% !important;
                padding: 0px !important;

            }

            .form {
                width: 100% !important;
                border: 0px !important;
                background: #fff !important;
                box-shadow: none !important;

            }

            .for_file {

                color: #292929 !important;
                font-weight: 600 !important;
                padding-left: 10px !important;
                display: block !important;
                color: grey !important;
                padding-bottom: 5px !important;

            }

            label {
                display: none;
            }

            .form input,
            .form select {

                outline: none !important;
                border: none !important;
                border-bottom: 1px solid grey !important;
                background-color: transparent !important;
                padding: 6px 10px !important;

                font-weight: 600 !important;
                border-radius: 0px !important;
                margin-bottom: 15px !important;
                width: 100% !important;
                box-shadow: none !important;
                color: grey !important;
                box-shadow: 0 3px 2px -2px rgba(0, 0, 0, 0.2) !important;

            }

            ::placeholder {
                color: grey !important;
                font-weight: 600 !important;
            }

            .form input[type=file] {
                padding-bottom: 10px !important;
                border-bottom: 1px solid grey !important;
                box-shadow: 0 3px 2px -2px rgba(0, 0, 0, 0.2) !important;
            }




            .form-title {

                display: none !important;
            }

            .form {
                padding: 4% !important;
                margin-top: 5px !important;
            }

            .mobile-title {

                display: block !important;
                text-align: center;
                width: 100% !important;

            }

            .mobile-title img {
                width: 100%;
                height: auto !important;
                margin-bottom: 6% !important;
                background: #292929;
                border-bottom: 2px solid #292929;
                box-shadow: 0 2px 0px 0px rgba(0, 0, 0, 0.2);
            }

            .desktop-title {
                display: none !important;
            }

            .ccs_logo {
                background-color: transparent !important;
                border-bottom: none !important;
                box-shadow: none !important;
                width: 200px !important;
                padding-top: 5px !important;
            }

            .header {
                padding-left: 30px !important;
                padding-right: 30px !important;

            }



        }

        </style>

    </head>

    <body>




        <div class="container main">

            <div class="mobile-title mb-1">
                <img src="https://tip.edu.ph/assets/headerfooter/tip-logo.png" alt="">
                <br> <br>
                <div class="header">
                    <h6 class="px-4">COLLEGE OF COMPUTER STUDIES STUDENT ADVISING RESERVATION</h6>
                    <br>
                    <img class="ccs_logo" src="assets/CCS_LOGO_FINAL Finally.png" alt="">

                </div>
                <br>
            </div>



            <form action="function.php" class="form " method="POST" autocomplete="off" enctype="multipart/form-data">
                <div class="form-title">
                    <img src="https://tip.edu.ph/assets/headerfooter/tip-logo.png" alt="">
                </div>
                <div class="desktop-title mb-1 mt-3 text-center p-3">


                    <h4>STUDENT ADVISING RESERVATION</h4>

                    <hr>

                </div>
                <?php include('alert2.php');?>
                <div class="text-center">

                    <br>
                    <div class=" text-center mb-5">

                        <img class="desktop_logo" style="width:300px;" src="assets/CCS_LOGO_FINAL Finally.png" alt="">

                        <h5 class="text-success text-capitalize"><span class="h4">Hi,
                                <?php echo $_SESSION['student_data']['first_name']." ".$_SESSION['student_data']['last_name'] ?>
                                👋 </span>
                            <br><br> Please wait
                            for an email to see if your advising request schedule has been
                            accepted by the faculty.
                        </h5>

                    </div>
                </div>
            </form>


        </div>


    </body>

    <?php unset($_SESSION['queue_activate']); unset($_SESSION['student_data']) ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

</html>
