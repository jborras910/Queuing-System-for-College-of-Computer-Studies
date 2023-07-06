<?php
include('dbconfig.php');

session_start();


if (!isset($_SESSION['queue_activate'])) {
    $_SESSION['status'] =  'Access Denied';
    header('Location: student_advising.php');
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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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


        .main {
            padding: 50px 30px !important;
            box-shadow: 0 2px 0px 0px rgba(0, 0, 0, 0.2) !important;
            width: 40% !important;
            margin: 5% auto !important;
            background: #fff !important;

        }

        .queue {

            padding: 10px !important;
            background: #ffc20f !important;
            border: 2px solid #292929 !important;
            box-shadow: 0 7px 2px -2px rgba(0, 0, 0, 0.2) !important;
            color: #292929 !important;
            font-weight: bold !important;
            font-size: 200px !important;
            width: 25% !important;
            height: 100% !important;
            margin: 0px auto !important;
            border-radius: 50% !important;



        }

        .queue h3 {
            font-size: 85px !important;
            font-weight: 600 !important;
            color: #292929 !important;

        }


        .hide {
            display: none !important;
        }






        .active {
            background: #ffc20f !important;
            color: #292929 !important;
        }

        .lineup_box {
            border-bottom: none !important;
            background: #292929;
            color: #fff;
            margin-bottom: 5px !important;
            font-weight: 600 !important;
            padding: 20px !important;
            border-bottom: 2px solid rgba(22, 22, 26, 0.18);
            box-shadow: 0 4px 2px -2px rgba(0, 0, 0, 0.2) !important;

            width: 100% !important;

        }


        .timer {
            position: absolute;
            right: 25px;
            top: 29px;
            font-size: 1.5rem;
            color: #fff;
        }

        .rejected_container_body {
            margin-top: 8% !important;
        }

        .main img {

            border-bottom: 2px solid #292929 !important;
            background: #292929 !important;
            box-shadow: 0 2px 0px 0px rgba(0, 0, 0, 0.2) !important;
            width: 100%;
        }

        .fa-circle-check {
            font-weight: 600 !important;
            font-size: 100px !important;
            padding: 20px !important;
        }

        .other-queue {
            padding: 5px !important;
            margin: 10px auto !important;
            text-transform: uppercase !important;
        }

        .faculty_img {
            width: 200px !important;
            margin: 15px auto !important;
        }


        @media screen and (max-width: 1000px) {
            body {
                background: #fff !important;
            }

            .queue {

                width: 40% !important;
                height: auto !important;
                border-radius: 50% !important;
                border: 2px solid #292929 !important;




            }

            .queue h3 {
                font-size: 85px !important;
                font-weight: 600 !important;
                color: #292929 !important;

            }

            .date_accpeted {
                font-size: 15px !important;
            }



            .main {
                padding: 0px !important;
                box-shadow: none;
                width: 100% !important;
                margin: 0px !important;
                box-shadow: none !important;

            }



            .title {
                width: 100% !important;
                border: 2px solid red !important;

            }

            .mobile_img {

                border-bottom: 2px solid #292929 !important;
                background: #292929 !important;
                box-shadow: 0 2px 0px 0px rgba(0, 0, 0, 0.2) !important;
            }

            .lineup_box {
                padding: 20px !important;

            }

            .rejected_container_body {
                margin-top: 20% !important;
            }

            .rejected_container .btn {
                width: 60%;
            }

            .textarea_mobile_view {
                height: 200px !important;
                width: 100% !important;
                padding: 10px !important;
                border: 2px solid #292929 !important;
                box-shadow: 0 2px 0px 0px rgba(0, 0, 0, 0.2) !important;

            }

            .feedback_btn {
                background: #ffc20f !important;
                color: #292929 !important;
                border: 2px solid #292929 !important;
                box-shadow: 0 2px 0px 0px rgba(0, 0, 0, 0.2) !important;
            }


            .accepted_page {
                padding: 10px !important;
                margin-top: 5% !important;


            }

            .fa-circle-check {
                font-size: 200px !important;
                padding: 10% !important;
            }

            .faculty_img {
                width: 60% !important;
                height: 200px !important;
                margin: 15px auto !important;
            }

        }

        </style>

    </head>

    <body>

        <?php 
 
            $varify_queue_token = $_SESSION['student_data']['queue_token'];
        
            $varify_queue_token_run = "SELECT * FROM queing_table WHERE queue_token='$varify_queue_token'";
            $query_run = mysqli_query($conn,$varify_queue_token_run);
                if (mysqli_num_rows($query_run) > 0):
                while ($row=mysqli_fetch_assoc($query_run)) :
        ?>
        <?php if ($row['isServing']=='true') : ?>
        <div class="main text-center">
            <img class="mobile_img mb-4" src="https://tip.edu.ph/assets/headerfooter/tip-logo.png" alt="">

            <div class="accepted_page">
                <div class="p-2">
                    <h5 class="text-success mt-3">Your Queue has been Accepted By:
                    </h5>


                    <?php 
                        $get_faculty_data = $row['faculty'];

                        $get_faculty_data_query = "SELECT * FROM faculty_table WHERE email='$get_faculty_data'";
                        $get_faculty_data_query_run = mysqli_query($conn,$get_faculty_data_query);

                        if (mysqli_num_rows($get_faculty_data_query_run) >0) {
                            $get_faculty_data_row = mysqli_fetch_array($get_faculty_data_query_run);

                                $_SESSION['get_faculty_data_row'] = [
                                    'faculty_image' => $get_faculty_data_row['faculty_image'],
                                    'faculty_role' => $get_faculty_data_row['role']

                                ];
                            
                        }
                        ?>

                    <img class="faculty_img"
                        src="ADMIN/upload_image_faculty/<?php echo $_SESSION['get_faculty_data_row']['faculty_image'] ?>"
                        alt="">
                    <h6 class="text-capitalize">
                        <?php echo $row['faculty_full_name']?><br><br><span>
                            <?php echo $_SESSION['get_faculty_data_row']['faculty_role']?></span>
                    </h6>

                    <hr>




                    <h5>You may now proceed inside the faculty</h5>
                </div>

            </div>

        </div>


        <?php elseif ($row['isServing']=='done') : ?>

        <script>
        window.location.href = "done_consultation.php";
        </script>


        <?php else:?>
        <div class="main text-center">
            <img class="logo mb-4" src="https://tip.edu.ph/assets/headerfooter/tip-logo.png" alt="">

            <div>
                <?php 
                    $queue_token = $_SESSION['student_data']['queue_token'];

                 

                    $check_faculty = "SELECT * FROM queing_table WHERE queue_token='$queue_token'";
                    $check_faculty_run = mysqli_query($conn,$check_faculty);

                    if (mysqli_num_rows($check_faculty_run) >0) {
                        $row = mysqli_fetch_array($check_faculty_run);

                            $_SESSION['faculty_selected'] = [
                                'faculty' => $row['faculty']
                            ];
                        
                    }

                    $faculty_selected = $_SESSION['faculty_selected']['faculty'];


                    $query = "SELECT * FROM queing_table WHERE isServing='false' AND faculty='$faculty_selected' AND reserve='false' ORDER BY date asc";
                    $query_run = mysqli_query($conn,$query);
                    $number =1;
                ?>

                <?php 
                if (mysqli_num_rows($query_run) > 0) :
                    while ($row=mysqli_fetch_assoc($query_run)) :
                ?>
                <div
                    class="container  <?php if($row['queue_token'] == $queue_token){echo 'show';}else{ echo 'hide';} ?> mt-2">
                    <h4>HI <span style="text-transform:uppercase"><?php echo $row['first_name'] ?></span> </h4>
                    <h6 class="text-success">Thank you for waiting.</h6>
                    <hr>
                    <h6 class="mb-3">Your current position in our queue is:</h6>

                    <div class="queue">

                        <h3><?php if($row['queue_token'] == $queue_token){if($number == 0 ){echo $number;}else{ echo $number; }} ?>
                        </h3>

                    </div>
                    <h6 class="mt-4" for=""><?php echo date("F j, Y, g:i a", strtotime($row['date'])); ?></h6>
                    <br>
                    <h6 class="text-success">We'll notify you when we're ready to see you</h6>
                    <hr>


                    <form action="function.php" method="POST">
                        <input type="hidden" name="queue_token" value='<?php echo $row['queue_token']?>'>
                        <button type="button" data-toggle="modal" data-target="#alertwarning"
                            class="btn btn-danger btn-block mt-2">Leave Queue</button>



                </div>
                <!-- Modal -->
                <div class="modal fade" id="alertwarning" tabindex="-1" role="dialog"
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
                                Are you sure you want to cancel your ticket?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button name="cancel_queue" type="submit" class="btn btn-danger">Cancel
                                    now</button>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
                <?php
                 $number ++;
                endwhile;
                    endif;
                ?>

                <div class="container mt-4 text-left">
                    <div class="row">
                        <?php
                            $check_queue = $_SESSION['student_data']['queue_token'];
                            $check_queue_query = "SELECT * FROM queing_table WHERE queue_token='$check_queue' ";
                            $check_queue_query_result = mysqli_query($conn, $check_queue_query);
                            $check_queue_query_row = mysqli_fetch_array($check_queue_query_result);
                            if ($check_queue_query_row === NULL) :
                        ?>
                        <div class="container rejected_container">
                            <div class="text-center">
                                <i class="fa-solid fa-trash"></i>
                                <h4>Your Queue has been Rejected</h4>
                                <hr>
                                <form action="function.php" method="POST">
                                    <button name="get_another_queue_btn" class="btn btn-danger mb-4">Get Another
                                        Queue</button>
                                </form>
                            </div>
                        </div>
                        <?php else: ?>


                        <div class="container" id="demo">

                        </div>

                        <?php  endif; ?>
                    </div>
                </div>
            </div>



            <script>
            function loadXMLDoc() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("demo").innerHTML =
                            this.responseText;
                    }
                };
                xhttp.open("GET", "queue_list.php", true);
                xhttp.send();
            }
            setInterval(function() {
                loadXMLDoc()
            }, 1000)

            window.onload = loadXMLDoc;
            </script>
        </div>
        <?php
        endif;
        endwhile;
        ?>







        <?php else: ?>

        <div class="container main text-center rejected_container">
            <img class="logo mb-4" src="https://tip.edu.ph/assets/headerfooter/tip-logo.png" alt="">

            <div class="rejected_container_body">
                <i style="font-size:140px" class="fa-solid fa-ban text-danger"></i>
                <br> <br>
                <h4>Your Queue has been Reajected</h4>
                <hr>
                <form action="function.php" method="POST">
                    <button name="get_another_queue_btn" class="btn btn-danger mb-4">Get Another
                        Queue</button>
                </form>
            </div>

        </div>

        <?php endif; ?>




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





    <script>
    setInterval(function() {
        location.reload();
    }, 5000);
    </script>

</html>
