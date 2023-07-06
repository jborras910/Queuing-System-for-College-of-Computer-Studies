<?php

session_start();

include('dbconfig.php');


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PhpMailer/src/Exception.php';
require 'PhpMailer/src/PHPMailer.php';
require 'PhpMailer/src/SMTP.php';

function send_notification($get_faculty_email,$get_faculty_name, $get_student_concern, $get_student_email){
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth= true;
    $mail->Username = 'jborras910@gmail.com';
    $mail->Password = 'gathrquaabwitxdb';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom($get_student_email, $get_faculty_email);
    $mail->addAddress($get_faculty_email);
    $mail->isHTML(true);
    $mail->Subject = 'Consultation Alert';
    $_email_template = "
    <div
        style='
        border: 3px solid #ffc20f;
        border-radius: 10px;
        width: 600px;
        margin: auto;
        padding: 20px;
        text-align: center;
        background-color: #fff;
        box-shadow: 0 9px 9px rgba(0, 0, 0, 0.5);
        '
    >

    <img style='margin-top: 40px; width: 250px' src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRIkay4Q6Jlj4SuESPXMQOkkc8hpUcGPH4EPBBz3PRmGV8ODFs11ryb_zlBMnIBzrPlbnI&usqp=CAU' />
    <h2 style='color:grey'>Hello $get_faculty_name</h2>
    <p 
    style='text-transform:capitalize; color:grey; font-weight:600'>Someone Sends You A Consultation About <span style='font-weight:bold;'>$get_student_concern</span></p>
    <br/><br/>
    <a
    style='
      background-color: #292929 !important;
      padding: 10px 20px;
      margin-bottom: 30px;
      font-weight: bold;
      font-family: Arial, Helvetica, sans-serif;
      box-shadow: 0 8px 8px rgba(0, 0, 0, 0.5);
      color: #ffc20f;
      text-decoration: none;
    '
    
    href='http://localhost/CCS_PROJECT/facultyLogin.php'>Login Now</a>
    <br/><br/> <br/><br/>
    </div>
    
    ";
    $mail->Body = $_email_template;
    $mail->send();
    
}


function send_password_reset($get_name,$get_email,$token){
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth= true;
    $mail->Username = 'jborras910@gmail.com';
    $mail->Password = 'gathrquaabwitxdb';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('qjaborras01@tip.edu.ph', $get_email);
    $mail->addAddress($get_email);
    $mail->isHTML(true);
    $mail->Subject = 'RESET PASSWORD';
    $_email_template = "
    <div
        style='
        border: 3px solid #ffc20f;
        border-radius: 10px;
        width: 600px;
        margin: auto;
        padding: 20px;
        text-align: center;
        background-color: #fff;
        box-shadow: 0 9px 9px rgba(0, 0, 0, 0.5);
        '
    >

    <img style='margin-top: 40px; width: 250px' src='https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRIkay4Q6Jlj4SuESPXMQOkkc8hpUcGPH4EPBBz3PRmGV8ODFs11ryb_zlBMnIBzrPlbnI&usqp=CAU' />
    <h2 style='color:grey'>Hello $get_name</h2>
    <p 
    style='text-transform:capitalize; color:grey; font-weight:600'>You are receiving this email because we received a password reset request for your account. Please verify your email address by clicking the link below</p>
    <br/><br/>
    <a
    style='
      background-color: #292929 !important;
      padding: 10px 20px;
      margin-bottom: 30px;
      font-weight: bold;
      font-family: Arial, Helvetica, sans-serif;
      box-shadow: 0 8px 8px rgba(0, 0, 0, 0.5);
      color: #ffc20f;
      text-decoration: none;
    '
    
    href='http://localhost/password-change.php?token=$token&email=$get_email'>RESET PASSWORD HERE</a>
    <br/><br/> <br/><br/>
    </div>
    
    ";
    $mail->Body = $_email_template;
    $mail->send();
}





if(isset($_POST['faculty_register_btn'])){

$faculty_image = $_FILES['faculty_image']['name'];

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$middle_name = $_POST['middle_name'];
$email = $_POST['email'];
$contact = $_POST['contact'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];


date_default_timezone_set('Asia/Manila'); 
$current_time = date('Y-m-d H:i:s');

$_SESSION['user_inputs'] = [
    'first_name' =>  $first_name,
    'last_name' =>  $last_name,
    'middle_name' => $middle_name,
    'email' => $email,
    'contact' => $contact,
    'password' => $password,
    'confirm_password' => $confirm_password
];


$pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
$uppercase = preg_match('@[A-Z]@', $password);
$lowercase = preg_match('@[a-z]@', $password);
$number    = preg_match('@[0-9]@', $password);
$specialChars = preg_match('@[^\w]@', $password);


if(strlen($first_name)<3 || strlen($first_name) > 18 || preg_match('~[0-9]+~', $first_name) || preg_match($pattern, $first_name)){
    $_SESSION['status'] =  'Invalid First Name';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}else if(strlen($last_name)<1 || strlen($last_name) > 18 || preg_match('~[0-9]+~', $last_name) || preg_match($pattern, $last_name)){
    $_SESSION['status'] =  'Invalid Last Name';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}else if(strlen($middle_name)==1 || strlen($middle_name) > 18 || preg_match('~[0-9]+~', $middle_name) || preg_match($pattern, $middle_name)){
    $_SESSION['status'] =  'Invalid Middle Name';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}else if(strlen($contact) !=11){
    $_SESSION['status'] =  'Invalid Contact';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}else if($password != $confirm_password){
    $_SESSION['status'] =  'Password and Confirm Password doesnt match';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}else if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8){
    $_SESSION['status'] =  'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}else{

    $check_email_query = "SELECT email FROM faculty_table WHERE email='$email' AND date_submitted=''";
    $check_email_query_run = mysqli_query($conn, $check_email_query);
    if(mysqli_num_rows($check_email_query_run) >0){


        $update_query= "UPDATE 
        faculty_table 
        SET 
        date_submitted='$current_time',
        faculty_image='$faculty_image',
        first_name='$first_name',
        last_name='$last_name',
        middle_name='$middle_name',
        contact='$contact',
        password='$password'
        WHERE email='$email'";


        $query_run = mysqli_query($conn,$update_query);

        
        if($query_run){

           $faculty_image_tmp_name = $_FILES['faculty_image']['tmp_name'];
           move_uploaded_file($faculty_image_tmp_name, 'ADMIN/upload_image_faculty/'.$faculty_image);

           $_SESSION['status'] =  'Succefull Registration';
           header('Location: ' . $_SERVER['HTTP_REFERER']);


        }else{
            $_SESSION['status'] =  'Something went wrong';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }

    }else{
        $_SESSION['status'] =  'Something went wrong';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }



}

}


if(isset($_POST['login_btn'])){
    
    $email = $_POST['email'];
    $password = $_POST['password'];

    $_SESSION['user_inputs'] = [
        'email' =>  $email,
        'password' =>  $password
    ];


    if(empty($email) || empty($password)){
        $_SESSION['status'] =  'Empty inputs';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else{

        $login_query = "SELECT * FROM faculty_table WHERE email='$email' AND BINARY password='$password'";
        $login_query_run = mysqli_query($conn,$login_query);

        if(mysqli_num_rows($login_query_run) >0){

            $row = mysqli_fetch_array($login_query_run);




            if($row['authenticated'] == 'yes' && $row['isDeactivated'] == 'false'){

                $_SESSION['authenticanted'] = true;

                $_SESSION['auth_user'] = [
                    'id' => $row['id'],
                    'faculty_image' => $row['faculty_image'],
                    'first_name' => $row['first_name'],
                    'last_name' => $row['last_name'],
                    'middle_name' => $row['middle_name'],
                    'department' => $row['department'],
                    'role' => $row['role'],
                    'contact' => $row['contact'],
                    'email' => $row['email']
              ];
              $faculty_id = $_SESSION['auth_user']['id'];
              $active_faculty_query = "UPDATE faculty_table SET active_status='true' WHERE id='$faculty_id'";

              if(mysqli_query($conn,$active_faculty_query)){

                $_SESSION['status'] =  'Login Successfully';
                header('Location: ADMIN/index.php');
              }else{

                $_SESSION['status'] =  'Active function error';
                header('Location: ADMIN/index.php');
              }




            }else{
                $_SESSION['status'] =  'You are not authenticated.';
                header('Location: facultyLogin.php?ErrorLogin');
            }



        }else{
            $_SESSION['status'] =  'Invalid Account';
            header('Location: facultyLogin.php?ErrorLogin');
        }

    }
}


if(isset($_POST['submit_queue_btn'])){

    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $middle_name = $_POST['middle_name'];
    $program = $_POST['program'];
    $year_level = $_POST['year_level'];
    $student_number = $_POST['student_number'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $faculty = $_POST['faculty'];
    $Schedule = $_POST['Schedule'];
    $schedule_reserve = $_POST['schedule_reserve'];


    //file
    $school_id = $_FILES['school_id']['name'];
    $nature_of_advising = $_POST['nature_of_advising'];
    $concern = $_POST['concern'];
    $other_curricular = $_POST['other_curricular'];
    $other_career = $_POST['other_career'];


    $selectedCheckboxes = $_POST['concern'];


    $_SESSION['student_input'] = [
        'first_name' => $first_name,
        'last_name' =>  $last_name,
        'middle_name' => $middle_name,
        'program' => $program,
        'year_level' => $year_level,
        'student_number' => $student_number,
        'email' => $email,
        'department' => $department,
        'faculty' => $faculty,
        'school_id' => $school_id,
        'nature_of_advising' => $nature_of_advising,
        'selectedCheckboxes' => $selectedCheckboxes,
        'other_curricular' => $other_curricular,
        'other_career' => $other_career,
        'Schedule' => $Schedule,
        'schedule_reserve' => $schedule_reserve
  ];


  if (empty($selectedCheckboxes)){
    $_SESSION['status'] =  'Please select concern';
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else if(strlen($first_name)<3 || strlen($first_name) > 18 || preg_match('~[0-9]+~', $first_name) || preg_match($pattern, $first_name)){
        $_SESSION['status'] =  'Invalid First Name';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    else if(strlen($last_name)<1 || strlen($last_name) > 18 || preg_match('~[0-9]+~', $last_name) || preg_match($pattern, $last_name)){
        $_SESSION['status'] =  'Invalid Last Name';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else if(strlen($middle_name)==1 || strlen($middle_name) > 18 || preg_match('~[0-9]+~', $middle_name) || preg_match($pattern, $middle_name)){
        $_SESSION['status'] =  'Invalid Middle Name';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else if ($program == 'Select Program'){
        $_SESSION['status'] =  'Please select program';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else if($year_level == 'Select Year'){
        $_SESSION['status'] =  'Please select year';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    } else if(empty($student_number)){
        $_SESSION['status'] =  'Invalid Student Number';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)  || strlen($email) <strlen('@gmail.com')){
        $_SESSION['status'] =  'Invalid Email';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else if($department == 'Select Department'){
        $_SESSION['status'] =  'Please select department';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else if ($faculty == 'Select Faculty'){
        $_SESSION['status'] =  'Please select faculty';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else if (empty($school_id)){
        $_SESSION['status'] =  'Please upload your ID';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else if ($nature_of_advising == 'Select Advising'){
        $_SESSION['status'] =  'Please select advising';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else if ($concern =='Select Concern'){
        $_SESSION['status'] =  'Please select concern';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else{
        
        $selectedValues = implode(". ",$selectedCheckboxes);
        $queue_token = substr(bin2hex(random_bytes(3)), 0, 6);
        move_uploaded_file($_FILES['school_id']['tmp_name'], 'ADMIN/student_ids/'.$school_id);
        $get_faculty_name = "SELECT * FROM faculty_table WHERE email='$faculty'";
        $get_faculty_name_run = mysqli_query($conn, $get_faculty_name);
        $faculty_name_row = mysqli_fetch_array($get_faculty_name_run);

        $faculty_full_name = $faculty_name_row['first_name']." ".$faculty_name_row['middle_name']." ".$faculty_name_row['last_name'];


        if($faculty_name_row['active_status'] == 'false'){
            send_notification($faculty,$faculty_full_name,$nature_of_advising,$email);
        }





        if($Schedule == 'Reserve') {


            $current_time = time();
            date_default_timezone_set('Asia/Manila');
            $current_datetime = date('Y-m-d H:i:s');
            $current_time = date('H:i', strtotime($current_datetime));

            // Set the time boundaries
            $min_time = '07:30';
            $max_time = '17:00';

            if (strtotime($schedule_reserve) < strtotime($current_datetime)) {
                $_SESSION['status'] = 'The selected datetime is in the past';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            } elseif (date('H:i', strtotime($schedule_reserve)) < $min_time || date('H:i', strtotime($schedule_reserve)) >= $max_time) {
                $_SESSION['status'] = 'Please select a valid datetime between 7:30 a.m. and 5 p.m.';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }

















        $verify_sched_query = "SELECT * FROM queing_table WHERE date='$schedule_reserve'";
        $verify_sched_query_run = mysqli_query($conn, $verify_sched_query);
        if(mysqli_num_rows($verify_sched_query_run) > 0) {
            $_SESSION['status'] =  'Please Select another time of schedule';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {


        $query = "INSERT 
                INTO queing_table
                (
                date,
                queue_token,
                first_name, 
                last_name, 
                middle_name, 
                program,
                year_level,
                student_number,
                email,
                department,
                faculty,
                faculty_full_name,
                school_id,
                nature_of_advising,
                concern,
                reserve,
                schedule) 
                VALUES 
                (
                '$schedule_reserve',
                '$queue_token',
                '$first_name',
                '$last_name', 
                '$middle_name',
                '$program',
                '$year_level',
                '$student_number',
                '$email',
                '$department',
                '$faculty',
                '$faculty_full_name',
                '$school_id',
                '$nature_of_advising',
                '$selectedValues',
                'true',
                'Reservation')";


        if(mysqli_query($conn, $query)) {

            $_SESSION['queue_activate'] =  true;
            $queue_query = "SELECT * FROM queing_table  WHERE queue_token='$queue_token'";
            $queue_query_run = mysqli_query($conn, $queue_query);

            if (mysqli_num_rows($queue_query_run) >0) {
                $row = mysqli_fetch_array($queue_query_run);


                $_SESSION['student_data'] = [
                    'queue_token' => $row['queue_token'],
                    'first_name' => $row['first_name'],
                    'last_name' => $row['last_name'],
                    'middle_name' => $row['middle_name'],
                    'faculty' => $row['faculty']
                          ];

                unset($_SESSION['student_input']);
                header('Location: reservation.php');
            }



        } else {
            $_SESSION['status'] =  'error reservation';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }



        }

            }else{

    
                $query = "INSERT 
                INTO queing_table
                (
                queue_token,
                first_name, 
                last_name, 
                middle_name, 
                program,
                year_level,
                student_number,
                email,
                department,
                faculty,
                faculty_full_name,
                school_id,
                nature_of_advising,
                concern) 
                VALUES 
                (
                '$queue_token',
                '$first_name',
                '$last_name', 
                '$middle_name',
                '$program',
                '$year_level',
                '$student_number',
                '$email',
                '$department',
                '$faculty',
                '$faculty_full_name',
                '$school_id',
                '$nature_of_advising',
                '$selectedValues')";
    
               
                if(mysqli_query($conn,$query)){
    
                    $_SESSION['queue_activate'] =  true;
                    $queue_query = "SELECT * FROM queing_table  WHERE queue_token='$queue_token'";
                    $queue_query_run = mysqli_query($conn,$queue_query);
            
                    if (mysqli_num_rows($queue_query_run) >0) {
                        $row = mysqli_fetch_array($queue_query_run);
    
    
                        $_SESSION['student_data'] = [
                            'queue_token' => $row['queue_token'],
                            'first_name' => $row['first_name'],
                            'last_name' => $row['last_name'],
                            'middle_name' => $row['middle_name'],
                            'faculty' => $row['faculty']
                      ];
        
        
                        header('Location: queing.php');
                    }
    
    
               
                }else{
                    $_SESSION['status'] =  'error queing';
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                }
    
    
    
      
    
        }


        

    }


}



if(isset($_POST['cancel_queue'])){
    $queue_token = $_POST['queue_token'];


    $cencel_query = "DELETE FROM queing_table WHERE queue_token='$queue_token'";

    if(mysqli_query($conn,$cencel_query)){
        $_SESSION['status'] =  'Cancel Queue';

        session_unset();
        session_destroy();
        header('Location: student_advising.php');
        exit();
    }else{
        $_SESSION['status'] =  'Not Cancel Queue';
   header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}




if(isset($_POST['get_another_queue_btn'])){
    session_unset();
    session_destroy();

    header("location: student_advising.php");
}



if(isset($_POST['get_feedback'])){


    date_default_timezone_set('Asia/Manila');
    $queue_token = $_POST['queue_token'];
    $feedback = $_POST['feedback'];
    $student_fullname = $_POST['student_fullname'];
    $end_datetime = date('Y-m-d H:i:s');
    $studentfeedback = "Student FullName: ".$student_fullname."<br><br> FeedBack: ".$feedback."<br><br> Date: ".$end_datetime;


    $get_feedback = "UPDATE 
    queing_table SET
    feedback='$studentfeedback'
    WHERE queue_token='$queue_token'";

    $get_feedback_run = mysqli_query($conn,$get_feedback);


    if($get_feedback_run){
        $_SESSION['status'] =  'Consultation Done Succefully';
        session_unset();
        session_destroy();
        header('Location: student_advising.php');
    }else{
        $_SESSION['status'] =  'Consultation Done Succefully erorrereasd';
        header('Location: student_advising.php');
    }

}







if(isset($_POST['password_reset_link'])){
    $email = $_POST['email'];
    $token = md5(rand());

    $check_email = "SELECT * FROM faculty_table WHERE email='$email'";
    $check_email_run = mysqli_query($conn, $check_email);

    if(mysqli_num_rows($check_email_run) > 0){
        $row = mysqli_fetch_array($check_email_run);

        $get_name = $row['first_name']." ".$row['last_name'];
        $get_email = $row['email'];

        $update_token = "UPDATE faculty_table SET verify_token='$token' WHERE email='$get_email' LIMIT 1";
        $update_token_run = mysqli_query($conn, $update_token);

        if($update_token_run)
        {
            unset($_SESSION['email_address']);
            send_password_reset($get_name,$get_email,$token);
            $_SESSION['status'] =  'We will send you an email with a password reset link. Please allow 4-5 minutes for email verification.';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit(0);
        }else
        {
            $_SESSION['status'] =  'Something went wrong.';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit(0);
        }



    }else{
        $_SESSION['email_address'] = $email;
        $_SESSION['status'] =  'No '.$email." email found";
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit(0);
    }


    

}


if(isset($_POST['Update_password'])){



    $email_update = $_POST['email_update'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $token = $_POST['token'];


    $pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
    $uppercase = preg_match('@[A-Z]@', $new_password);
    $lowercase = preg_match('@[a-z]@', $new_password);
    $number    = preg_match('@[0-9]@', $new_password);
    $specialChars = preg_match('@[^\w]@', $new_password);


    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($new_password) < 8){

        $_SESSION['status'] =  'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else if ($new_password != $confirm_password){
        $_SESSION['status'] = 'New Password And Confirm Password Does not match';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else{

        
        $check_token = "SELECT * FROM faculty_table WHERE verify_token='$token' LIMIT 1";
        $check_token_run = mysqli_query($conn, $check_token);

        if(mysqli_num_rows($check_token_run) > 0){

            $change_password_query = "UPDATE faculty_table SET password='$new_password', verify_token='done' WHERE email='$email_update' LIMIT 1";
            $change_password_query_run = mysqli_query($conn, $change_password_query);

            if($change_password_query_run){
                $_SESSION['status'] = 'Password Change Successfully';
                header('Location: facultyLogin.php');
            }else{
                $_SESSION['status'] = 'Password Change error';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }






        }else{
            $_SESSION['status'] = 'Token Does not exist';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }






    }





   
 
}
















?>
