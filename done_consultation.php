<?php

?>

<?php
include('dbconfig.php');

session_start();
if(!isset($_SESSION['student_data']['queue_token'])){
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
            border-bottom: 2px solid rgba(22, 22, 26, 0.18);
            box-shadow: 0 7px 2px -2px rgba(0, 0, 0, 0.2) !important;
            color: #292929 !important;
            font-weight: bold !important;
            width: 30% !important;
            margin: 0px auto !important;
            border-radius: 10px !important;
            transform: skew(-10deg) !important;

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

        textarea {
            width: 100% !important;
            padding: 10px !important;
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


        @media screen and (max-width: 1000px) {
            body {
                background: #fff !important;
            }

            .queue {

                width: 60% !important;
                height: auto !important;


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

            .ended_queue {
                margin-top: 40% !important;
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

        <?php if(empty($row['feedback'])): ?>
        <div class="main text-center">
            <img class="mobile_img mb-4" src="https://tip.edu.ph/assets/headerfooter/tip-logo.png" alt="">

            <h3>Your Consultation is Done</h3>
            <span class="text-uppercase text-success"><?php echo "Good day ".$row['first_name'] ?></span>
            <form action="function.php" method="POST" class="px-3">
                <div class="form-group px-3">
                    <label>Please provide feedback below:</label>
                    <textarea name="feedback" class="textarea_mobile_view" placeholder="feedback..."
                        class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
                </div>

                <input type="hidden" name="queue_token" value="<?php echo $row['queue_token'] ?>">

                <input type="hidden" name="student_fullname"
                    value="<?php echo $row['first_name']." ".$row['middle_name']." ".$row['last_name'] ?>">
                <button type="submit" name="get_feedback" class="feedback_btn btn btn-primary btn-block">SUBMIT</button>
            </form>
        </div>
        <?php else: ?>
        <div class="main text-center">
            <img class="mobile_img mb-4" src="https://tip.edu.ph/assets/headerfooter/tip-logo.png" alt="">
            <div class="ended_queue">
                <i style="font-size: 100px; margin-bottom:40px" class="fa-solid fa-ban"></i>
                <h3>YOUR SESSION HAS ENDED</h3>
            </div>
        </div>


        <?php endif; ?>

        <?php
      
        endwhile;
    endif;
        ?>






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
