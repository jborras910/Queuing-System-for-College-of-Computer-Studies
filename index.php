<?php 


session_start();
if (isset($_SESSION['queue_activate'])) {
    $_SESSION['status'] =  'Access Denied';
    header('Location: queing.php');
}


?>


<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="https://tip.edu.ph/assets/Uploads/TIP-INFORMAL-LOGO-04-2.png">
        <title>Services</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>


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
            background: #fff !important;
            padding: 40px !important;
            margin-top: 8% !important;
            font-weight: 600 !important;
            width: 40% !important;
            border-radius: 10px !important;
            border-bottom: 2px solid rgba(22, 22, 26, 0.18);
            box-shadow: 0 4px 2px -2px rgba(0, 0, 0, 0.2) !important;
        }

        .container img {
            width: 400px !important;
            margin-bottom: 25px !important;
        }

        .container .btn {

            border: none !important;
            padding: 10px !important;
            font-weight: 600 !important;

            width: 40% !important;
            display: block !important;
            margin: 15px auto !important;
            box-shadow: 0 2px 0px 0px rgba(0, 0, 0, 0.2) !important;
        }

        .Student-btn {


            background: #ffc20f !important;
            color: #292929 !important;
        }

        .Faculty-btn {
            background: #EEEEEE !important;
            color: black !important;
        }

        @media screen and (max-width: 1000px) {
            body {
                background: #fff !important;
            }

            .container-fluid {
                width: 100% !important;

            }

            .container {
                margin-top: 10% !important;
                width: auto !important;
                padding: 5% !important;
                border: none !important;
                box-shadow: none !important;

            }

            .container .btn {
                width: 100% !important;
            }

            .container img {
                width: 100% !important;
                border: 2px solid #292929 !important;
                background: #292929;
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

        <div class="container-fluid">
            <div class="container  text-center">

                <img src="https://tip.edu.ph/assets/headerfooter/tip-logo.png" alt="">
                <h2>Hi, TIPian!</h2>

                <p><i class="fa-solid fa-arrow-down mr-2"></i>Please click or tap your destination</p>

                <a type="button" href="student_advising.php" class="btn btn-primary Student-btn">Student Concern</a>
                <a type="button" href="facultyLogin.php" class="btn btn-primary Faculty-btn">Faculty</a>
                <hr>
                <p>By using this service, you understood and agree to the T.I.P Online Services Terms of Use and
                    Privacy Statement</p>
            </div>
        </div>




    </body>


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
