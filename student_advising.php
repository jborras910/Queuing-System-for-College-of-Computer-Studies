<?php
include('dbconfig.php');

session_start();

date_default_timezone_set('Asia/Manila');

?>


<?php

if (isset($_SESSION['queue_activate'])) {
    $_SESSION['status'] =  'Access Denied';
    header('Location: queing.php');
}elseif(isset($_SESSION['authenticanted'])){
    $_SESSION['status'] =  'Access Denied';
    header('Location: ADMIN/index.php');
}












?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!--font awesome icon-->
        <script src="https://kit.fontawesome.com/6cea1e7bdb.js" crossorigin="anonymous"></script>
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

        .form input[type='text'],
        .form input[type='email'],
        .form input[type='datetime-local'],
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

        .custom-file-upload {
            background: #fff !important;
            border: 1px solid #292929 !important;
            width: 100% !important;
            display: inline-block;
            padding: 10px !important;
            cursor: pointer;
            color: #292929 !important;


            transition: all 0.3s ease;
        }

        .custom-file-upload:hover {
            background-color: #292929 !important;
            color: white !important;
        }

        input[type="file"] {
            display: none;
        }

        #Curricular,
        #career {
            display: none;
            padding: 10px !important;
            margin: 2px auto !important;
            border: 2px solid grey !important;
            background: #fff !important;
        }

        .hide {
            display: none !important;
        }

        .show {
            display: block !important;
        }

        #Curricular label,
        #career label {
            font-size: 17px !important;
        }

        .header-title {
            background: #fae80e !important;
            text-transform: uppercase !important;
            padding-top: 6px !important;
            border: 2px solid #292929 !important;
            margin-bottom: 20px !important;
            box-shadow: 0 3px 2px -2px rgba(0, 0, 0, 0.2) !important;
        }

        label {

            font-weight: 600 !important;
        }



        @media screen and (max-width: 1000px) {
            body {
                background: #F5F5F5 !important;
            }

            .container {

                width: 100% !important;
                padding: 0px !important;

            }

            label {

                font-weight: 600 !important;
            }



            .form-group {
                background: #F5F5F5 !important;
                margin-bottom: 10px !important;
            }

            .header-title {
                display: none !important;
            }

            .form {

                width: 100% !important;
                border: 0px !important;
                background: #F5F5F5 !important;
                box-shadow: none !important;

            }




            #Curricular label,
            #career label {
                display: inline !important;
                font-size: 16px !important;
            }



            #Curricular input[type='text'],
            #career input[type='text'] {
                border: 2px solid grey !important;

                box-shadow: 0 3px 2px -2px rgba(0, 0, 0, 0.2) !important;
            }


            .form input[type='text'],
            .form input[type='email'],
            .form input[type='datetime-local'],
            .form select,
            .custom-file-upload,

            #Curricular,
            #career {


                outline: none !important;
                border: none !important;
                border: 1px solid grey !important;
                background-color: white !important;
                padding: 8px !important;

                font-weight: 600 !important;
                border-radius: 0px !important;

                width: 100% !important;
                box-shadow: none !important;
                color: grey !important;
                box-shadow: 0 3px 2px -2px rgba(0, 0, 0, 0.2) !important;

            }

            label {
                display: none;
            }


            ::placeholder {
                color: grey;
                font-weight: 600 !important;
                font-size: 16px !important;
            }





            .form-title {

                display: none !important;
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

            <div class="mobile-title ">
                <img src="https://tip.edu.ph/assets/headerfooter/tip-logo.png" alt="">

                <div class="header mt-1">
                    <img class="ccs_logo" src="assets/CCS_LOGO_FINAL Finally.png" alt="">
                    <br>
                    <h6 class="px-4">COLLEGE OF COMPUTER STUDIES ADVISING FORM</h6>
                </div>
                <br>
            </div>



            <form action="function.php" class="form" method="POST" autocomplete="off" enctype="multipart/form-data">
                <div class="form-title">
                    <img src="https://tip.edu.ph/assets/headerfooter/tip-logo.png" alt="">
                </div>
                <div class="desktop-title mb-1 mt-3 text-center p-3">
                    <h4>STUDENT ADVISING FORM</h4>
                    <hr>
                </div>
                <?php include('alert2.php');?>

                <div class="row flex-box">

                    <div class="form-group col-md-12">
                        <label for="">Schedule<span class="text-danger">*</span></label>
                        <select name="Schedule" id="Schedule" class="form-select" onchange="showDateInput()">
                            <option value="0">*Select Schedule</option>
                            <option
                                <?php if (isset($_SESSION['student_input']['Schedule']) && $_SESSION['student_input']['Schedule'] == 'Today') echo 'selected'; ?>
                                value="Today">Walk In</option>
                            <option
                                <?php if (isset($_SESSION['student_input']['Schedule']) && $_SESSION['student_input']['Schedule'] == 'Reserve') echo 'selected'; ?>
                                value="Reserve">Reservation</option>
                        </select>

                        <div class="text-left" id="date-input-div"
                            style="display:<?php if(isset($_SESSION['student_input']['Schedule']) && $_SESSION['student_input']['Schedule']=='Reserve'){echo 'block;'; }else{echo 'none;'; }?> margin-top:10px;">
                            <label style="display:block;font-weight: 600 !important; color:grey;" for="date-input">Your
                                Request Schedule</label>
                            <input id="date-input"
                                value="<?php if(isset($_SESSION['student_input']['schedule_reserve'])){echo $_SESSION['student_input']['schedule_reserve']; unset($_SESSION['student_input']['schedule_reserve']);}?>"
                                type="datetime-local" min="<?php echo date('Y-m-d\T07:30'); ?>" name="schedule_reserve">
                        </div>
                    </div>


                    <div class="form-group col-md-6">
                        <label for="department">Department<span class="text-danger">*</span></label>
                        <select name="department" id="department" aria-label="Default select example">
                            <option value="Select Department">*Select Department</option>
                            <?php
                            $query = "SELECT DISTINCT department FROM faculty_table WHERE authenticated='yes' AND role !='Main Admin'";
                            $query_run = mysqli_query($conn, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                while ($row = mysqli_fetch_assoc($query_run)) {
                                    ?>
                            <option
                                <?php if (isset($_SESSION['student_input']['department']) && $_SESSION['student_input']['department'] == $row['department']) echo 'selected'; ?>
                                value="<?php echo $row['department'] ?>"><?php echo $row['department'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="faculty">Faculty<span class="text-danger">*</span></label>
                        <select name="faculty" id="faculty" aria-label="Default select example">
                            <option value="Select Faculty">*Select Faculty</option>
                            <?php
                            $query = "SELECT * FROM faculty_table WHERE authenticated='yes' AND role !='Main Admin'";
                            $query_run = mysqli_query($conn, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                while ($row = mysqli_fetch_assoc($query_run)) {
                            ?>
                            <option
                                <?php if (isset($_SESSION['student_input']['faculty']) && $_SESSION['student_input']['faculty'] == $row['email']) echo 'selected'; ?>
                                value="<?php echo $row['email'] ?>" data-department="<?php echo $row['department'] ?>">
                                <?php echo $row['first_name'] . " " . $row['middle_name'] . " " . $row['last_name']; ?>
                            </option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>


                    <div class="form-group col-md-12">



                        <label for="">T.I.P ID<span class="text-danger">*</span></label>

                        <label for="file-input" class="custom-file-upload">
                            *Upload Student ID Here
                        </label>
                        <input id="file-input" name="school_id" type="file" accept="image/*" />



                    </div>


                    <div class="form-group col-md-12">
                        <label for="">Nature of Advising<span class="text-danger">*</span></label>
                        <select name="nature_of_advising" id="mySelect">
                            <option value="Select Advising">*Select Advising</option>
                            <option
                                <?php if(isset($_SESSION['student_input']['nature_of_advising']) && $_SESSION['student_input']['nature_of_advising'] == 'Curricular') { echo 'selected'; } ?>
                                value="Curricular">Curricular</option>
                            <option
                                <?php if(isset($_SESSION['student_input']['nature_of_advising']) && $_SESSION['student_input']['nature_of_advising'] == 'Career') { echo 'selected'; } ?>
                                value="Career">Career</option>

                        </select>
                    </div>




                    <style>
                    .hide {
                        display: none !important;
                    }

                    .show {
                        display: block !important;
                    }

                    </style>
                    <div class="form-group col-md-12">
                        <div class="<?php if(isset($_SESSION['student_input']['nature_of_advising'])&& $_SESSION['student_input']['nature_of_advising'] =='Curricular'){echo 'show';}else{echo 'hide';} ?>"
                            id="Curricular">
                            <h6 class="mb-4">Select Curricular Concerns<span class="text-danger">*</span></h6>
                            <br>
                            <div>
                                <input type="checkbox" name="concern[]" value="Enrollment-related concern"
                                    <?php if(isset($_SESSION['student_input']['selectedCheckboxes']) && in_array('Enrollment-related concern', $_SESSION['student_input']['selectedCheckboxes'])) { echo 'checked'; } ?>>
                                <label for="enrollment">Enrollment-related concern</label>
                            </div>
                            <div>
                                <input type="checkbox" name="concern[]" value="Reprogramming of study plan"
                                    <?php if(isset($_SESSION['student_input']['selectedCheckboxes']) && in_array('Reprogramming of study plan', $_SESSION['student_input']['selectedCheckboxes'])) { echo 'checked'; } ?>>
                                <label for="reprogramming">Reprogramming of study plan</label>
                            </div>
                            <div>
                                <input type="checkbox" name="concern[]"
                                    <?php if(isset($_SESSION['student_input']['selectedCheckboxes']) && in_array('Course credit/Transfer credit/Study overload', $_SESSION['student_input']['selectedCheckboxes'])) { echo 'checked'; } ?>
                                    value="Course credit/Transfer credit/Study overload">
                                <label for="course-credit">Course credit/Transfer credit/Study overload</label>
                            </div>
                            <div>
                                <input type="checkbox" name="concern[]"
                                    <?php if(isset($_SESSION['student_input']['selectedCheckboxes']) && in_array('Simultaneous taking of Courses', $_SESSION['student_input']['selectedCheckboxes'])) { echo 'checked'; } ?>
                                    value="Simultaneous taking of Courses">
                                <label for="simultaneous-courses">Simultaneous taking of Courses</label>
                            </div>
                            <div>
                                <input type="checkbox" name="concern[]"
                                    <?php if(isset($_SESSION['student_input']['selectedCheckboxes']) && in_array('Shifting of program', $_SESSION['student_input']['selectedCheckboxes'])) { echo 'checked'; } ?>
                                    value="Shifting of program">
                                <label for="shifting-program">Shifting of program</label>
                            </div>
                            <div>
                                <input type="checkbox"
                                    <?php if(isset($_SESSION['student_input']['selectedCheckboxes']) && in_array('Choice of course elective', $_SESSION['student_input']['selectedCheckboxes'])) { echo 'checked'; } ?>
                                    name="concern[]" value="Choice of course elective">
                                <label for="course-elective">Choice of course elective</label>
                            </div>
                            <hr>

                            <input type="text" placeholder="Type Your Other Concern Here..." name="concern[]">
                            <br><br>
                        </div>

                        <div class="<?php if(isset($_SESSION['student_input']['nature_of_advising'])&& $_SESSION['student_input']['nature_of_advising'] =='Career'){echo 'show';}else{echo 'hide';} ?>"
                            id="career">
                            <h6 class="mb-4" for="">Select Career Concerns<span class="text-danger">*</span></h6>

                            <div>
                                <input type="checkbox"
                                    <?php if(isset($_SESSION['student_input']['selectedCheckboxes']) && in_array('On-the-job training', $_SESSION['student_input']['selectedCheckboxes'])) { echo 'checked'; } ?>
                                    name="concern[]" value="On-the-job training">
                                <label for="job-training">On-the-job training</label>
                            </div>
                            <div>
                                <input type="checkbox" name="concern[]"
                                    <?php if(isset($_SESSION['student_input']['selectedCheckboxes']) && in_array('job shadowing', $_SESSION['student_input']['selectedCheckboxes'])) { echo 'checked'; } ?>
                                    value="job shadowing">
                                <label for="job-shadowing">Job shadowing</label>
                            </div>
                            <div>
                                <input type="checkbox" name="concern[]"
                                    <?php if(isset($_SESSION['student_input']['selectedCheckboxes']) && in_array('pre-employment activities', $_SESSION['student_input']['selectedCheckboxes'])) { echo 'checked'; } ?>
                                    value="pre-employment activities">
                                <label for="pre-employment">Pre-employment activities</label>
                            </div>
                            <div>
                                <input type="checkbox" name="concern[]"
                                    <?php if(isset($_SESSION['student_input']['selectedCheckboxes']) && in_array('student development program', $_SESSION['student_input']['selectedCheckboxes'])) { echo 'checked'; } ?>
                                    value="student development program">
                                <label for="development-program">Student development program</label>
                            </div>
                            <hr>
                            <div>

                                <input type="text" placeholder="Type Your Other Concern Here..." name="concern[]">
                                <br><br>
                            </div>









                        </div>

                    </div>


                    <script>
                    const select = document.getElementById("mySelect");
                    const curriculars = document.querySelector('#Curricular');
                    const career = document.querySelector('#career');
                    const curricularCheckboxes = curriculars.querySelectorAll('input[type="checkbox"]');
                    const careerCheckboxes = career.querySelectorAll('input[type="checkbox"]');

                    select.addEventListener("change", function() {
                        curriculars.classList.toggle("show", select.value === 'Curricular');
                        curriculars.classList.toggle("hide", select.value !== 'Curricular');

                        career.classList.toggle("show", select.value === 'Career');
                        career.classList.toggle("hide", select.value !== 'Career');

                        if (select.value !== 'Curricular') {
                            curricularCheckboxes.forEach(function(checkbox) {
                                checkbox.checked = false;
                            });
                        }

                        if (select.value !== 'Career') {
                            careerCheckboxes.forEach(function(checkbox) {
                                checkbox.checked = false;
                            });
                        }
                    });
                    </script>












                    <div class="form-group col-md-4">
                        <label for="">First Name<span class="text-danger">*</span></label>
                        <input
                            value="<?php if(isset( $_SESSION['student_input']['first_name'])){echo $_SESSION['student_input']['first_name']; unset($_SESSION['student_input']['first_name']);}?>"
                            type="text" name="first_name" placeholder="*First Name...">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Last Name<span class="text-danger">*</span></label>
                        <input
                            value="<?php if(isset( $_SESSION['student_input']['last_name'])){echo $_SESSION['student_input']['last_name']; unset($_SESSION['student_input']['last_name']);}?>"
                            type="text" name="last_name" placeholder="*Last Name...">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">Middle Name</label>
                        <input
                            value="<?php if(isset( $_SESSION['student_input']['middle_name'])){echo $_SESSION['student_input']['middle_name']; unset($_SESSION['student_input']['middle_name']);}?>"
                            type="text" name="middle_name" placeholder=" Middle Name...">
                    </div>


                    <div class="form-group  col-md-6">
                        <label for="">Program<span class="text-danger">*</span></label>
                        <select class="" name="program" aria-label="Default select example">

                            <option value="Select Program" selected>*Your Program</option>
                            <option
                                <?php if (isset($_SESSION['student_input']['program']) && $_SESSION['student_input']['program'] == 'BSIT') echo 'selected'; ?>
                                value="BSIT">
                                BSIT</option>
                            <option
                                <?php if (isset($_SESSION['student_input']['program']) && $_SESSION['student_input']['program'] == 'BSCS') echo 'selected'; ?>
                                value="BSCS">BSCS</option>
                            <option
                                <?php if (isset($_SESSION['student_input']['program']) && $_SESSION['student_input']['program'] == 'BSIS') echo 'selected'; ?>
                                value="BSIS">BSIS</option>
                            <option
                                <?php if (isset($_SESSION['student_input']['program']) && $_SESSION['student_input']['program'] == 'BSDS') echo 'selected'; ?>
                                value="BSDS">BSDS</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="">Year Level<span class="text-danger">*</span></label>
                        <select class="" name="year_level" aria-label="Default select example">
                            <option value="Select Year" selected>*Select Year</option>
                            <option
                                <?php if (isset($_SESSION['student_input']['year_level']) && $_SESSION['student_input']['year_level'] == '1st Year') echo 'selected'; ?>
                                value="1st Year">1st Year</option>
                            <option
                                <?php if (isset($_SESSION['student_input']['year_level']) && $_SESSION['student_input']['year_level'] == '2nd Year') echo 'selected'; ?>
                                value="2nd Year">2nd Year</option>
                            <option
                                <?php if (isset($_SESSION['student_input']['year_level']) && $_SESSION['student_input']['year_level'] == '3rd Year') echo 'selected'; ?>
                                value="3rd Year">3rd Year</option>
                            <option
                                <?php if (isset($_SESSION['student_input']['year_level']) && $_SESSION['student_input']['year_level'] == '4th Year') echo 'selected'; ?>
                                value="4th Year">4th Year</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="">Student Number<span class="text-danger">*</span></label>
                        <input
                            value="<?php if(isset( $_SESSION['student_input']['student_number'])){echo $_SESSION['student_input']['student_number']; unset($_SESSION['student_input']['student_number']);}?>"
                            type="text" name="student_number" placeholder="*Student Number...">
                    </div>


                    <div class="form-group col-md-6">
                        <label for="">T.I.P Email<span class="text-danger">*</span></label>
                        <input
                            value="<?php if(isset( $_SESSION['student_input']['email'])){echo $_SESSION['student_input']['email']; unset($_SESSION['student_input']['email']);}?>"
                            type="email" name="email" placeholder="*Email...">
                    </div>



                    <div class="col-md-12 mt-3">
                        <button type="submit" name="submit_queue_btn" class="btn btn-primary btn-block submit">GET
                            QUEUE</button>

                    </div>
                </div>
            </form>
            <?php unset( $_SESSION['student_input']); ?>

        </div>



    </body>

    <script>
    const fileInput = document.getElementById('file-input');
    const customFileUpload = document.querySelector('.custom-file-upload');

    fileInput.addEventListener('change', (event) => {
        const fileName = event.target.files[0].name;
        customFileUpload.innerHTML = `<i class="fas fa-cloud-upload-alt"></i> ${fileName}`;
    });
    </script>






    <script>
    function showDateInput() {
        var scheduleSelect = document.getElementById("Schedule");
        var dateInputDiv = document.getElementById("date-input-div");
        var dateInput = document.getElementById("date-input");
        if (scheduleSelect.value == "Reserve") {
            dateInputDiv.style.display = "block";

        } else {
            dateInput.value = "";
            dateInputDiv.style.display = "none";

        }
    }
    </script>




    <script>
    function showDateInput() {
        var scheduleSelect = document.getElementById("Schedule");
        var dateInputDiv = document.getElementById("date-input-div");

        if (scheduleSelect.value == "Reserve") {
            dateInputDiv.style.display = "block";
        } else {
            dateInputDiv.style.display = "none";
        }
    }
    </script>






    <script>
    const select = document.getElementById("mySelect");
    const curriculars = document.querySelectorAll('#Curricular');
    const career = document.querySelectorAll('#career');
    const nature = document.getElementById('nature');

    select.addEventListener("change", function() {
        if (select.value == 'Curricular') {
            career.forEach(item => {

                item.classList.add('hide');

            });

            curriculars.forEach(item => item.classList.remove('hide'));
            document.getElementById('other_career').classList.add('hide');
            document.getElementById('other_career_input').value = '';
            nature.value = 'Select Concern';

        } else if (select.value == 'Career') {

            curriculars.forEach(item => {

                item.classList.add('hide');

            });

            career.forEach(item => item.classList.remove('hide'));

            document.getElementById('other_curricular').classList.add('hide');
            document.getElementById('other_curricular_input').value = '';
            nature.value = 'Select Concern';



        } else {
            curriculars.forEach(item => item.classList.add('hide'));
            career.forEach(item => item.classList.add('hide'));
            document.getElementById('other_career').classList.add('hide');
            document.getElementById('other_curricular').classList.add('hide');
            document.getElementById('other_curricular_input').value = '';
            document.getElementById('other_career_input').value = '';
            nature.value = 'Select Concern';
        }
    });

    nature.addEventListener("change", function() {
        if (nature.value === 'Other Curricular Concern') {
            let other_curricular = document.getElementById('other_curricular')
            let other_career = document.getElementById('other_career')

            other_career.classList.add('hide');
            other_curricular.classList.remove('hide');


        } else if (nature.value === 'Other Career Concern') {

            let other_curricular = document.getElementById('other_curricular')
            let other_career = document.getElementById('other_career')


            other_curricular.classList.add('hide');
            other_career.classList.remove('hide');




        } else {
            let other_curricular = document.getElementById('other_curricular')
            let other_career = document.getElementById('other_career')
            let others = [other_curricular, other_career];

            others.forEach(item => item.classList.add('hide'));
            document.getElementById('other_curricular_input').value = '';
            document.getElementById('other_career_input').value = '';


        }
    })
    </script>
    <script>
    $(document).ready(function() {
        // Hide all faculty options by default
        $('#faculty option').hide();

        $('#department').on('change', function() {
            // Get the selected department
            var selectedDepartment = $(this).val();

            // Show only faculty options that belong to the selected department
            $('#faculty option').each(function() {
                var facultyDepartment = $(this).data('department');

                if (selectedDepartment === facultyDepartment) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            // Set the default value of faculty to Select Faculty
            $('#faculty').val('Select Faculty');
        });
    });
    </script>







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
