<?php
session_start();

include('../dbconfig.php');


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PhpMailer/src/Exception.php';
require '../PhpMailer/src/PHPMailer.php';
require '../PhpMailer/src/SMTP.php';

function send_invitation($get_email,$get_dept, $get_role, $token){
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
    $mail->Subject = 'Invitation for CCS Faculty';
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
    <h2 style='color:grey'>Hello</h2>
    <p 
    style='text-transform:capitalize; color:grey; font-weight:600'>You Have Been Invited To <span style='font-weight:bold;'>$get_dept</span> As The <span style='font-weight:bold;'>$get_role</span> To Accept The Invitation, Click The Accept Invitation Button Below.</p>
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
    
    href='http://localhost/ccs_queuing_system/facultyRegistration.php?token=$token&email=$get_email'>Accept Invitation</a>
    <br/><br/> <br/><br/>
    </div>
    
    ";
    $mail->Body = $_email_template;
    $mail->send();
    
}







function send_request_link($email,$student_full_name,$request_date,$verify_token,$queue_token){
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth= true;
    $mail->Username = 'jborras910@gmail.com';
    $mail->Password = 'gathrquaabwitxdb';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('qjaborras01@tip.edu.ph', $email);
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'Request Schedule';
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
    <h2 style='color:grey'>HI, $student_full_name</h2>
    <p 
    style='text-transform:capitalize; color:grey; font-weight:600'>This message informs you that your request for a counselling schedule ($request_date) has been accepted; you may view your ticket by clicking the button below.</p>
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
    
    href='http://localhost/ccs_queuing_system/queing_reservation.php?token=$verify_token&email=$email&queue=$queue_token'>Accept Invitation</a>
    <br/><br/> <br/><br/>
    </div>
    
    ";
    $mail->Body = $_email_template;
    $mail->send();
    
}

function send_reject_request($faculty_message,$queue_token,$faculty,$email,$student_full_name){


    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth= true;
    $mail->Username = 'jborras910@gmail.com';
    $mail->Password = 'gathrquaabwitxdb';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('qjaborras01@tip.edu.ph', $email);
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'Request Schedule';
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
    <h2 style='color:grey'>HI, $student_full_name</h2>
    <p 
    style='text-transform:capitalize; color:grey; font-weight:600'>We regret to inform you that your reservation has been rejected by the faculty</p>
    <br/><br/>
    <p 
    style='text-transform:capitalize; color:grey; font-weight:600'>$faculty_message</p>
    <br/><br/>
    <p style='text-transform:capitalize; color:grey; font-weight:600'>-$faculty</p>

    <br/><br/> <br/><br/>
    </div>
    
    ";
    $mail->Body = $_email_template;
    $mail->send();




}















if(isset($_POST['invite_faculty_btn'])){

$department = $_POST['department'];
$role = $_POST['role'];
$email = $_POST['email'];
$token = md5(rand());

$_SESSION['user_inputs_invite'] = [
    'department' =>  $department,
    'role' =>  $role,
    'email' => $email,
];

if($department == 'Select Department'){
    $_SESSION["status"] = "Please Select Department"; 
    $_SESSION['status_code'] = 'error';    
    header('Location: Page_AddFaculty.php?errorDepartment');
}else if ($role == 'Select Designation'){
    $_SESSION["status"] = "Please Select The Designation";    
    $_SESSION['status_code'] = 'error'; 
    header('Location: Page_AddFaculty.php?errorRole');
}else if (!filter_var($email, FILTER_VALIDATE_EMAIL)  || strlen($email) <strlen('@gmail.com')){
    $_SESSION["status"] = "Invalid Email";    
    $_SESSION['status_code'] = 'error'; 
    header('Location: Page_AddFaculty.php?errorEmail');
}else{
    
    $check_email_query = "SELECT email FROM faculty_table WHERE email='$email'";
    $check_email_query_run = mysqli_query($conn, $check_email_query);
    if(mysqli_num_rows($check_email_query_run)>0){
    
        $_SESSION['status'] = "The Email Is Already Send an invitation";   
        $_SESSION['status_code'] = 'error'; 
        header('Location: Page_AddFaculty.php?errorEmail');


    }else{

        $query = "INSERT INTO faculty_table (department, role, email,verify_token) VALUES ('$department', '$role', '$email','$token')";
        $query_run = mysqli_query($conn,$query);
    
        if($query_run){


       
        $activity = "You send an invitation to ".$email."  in the department of ".$department.". ".$role." is the role of invitation.";
        $faculty = $_SESSION['auth_user']['email'];
        $activityLog_query = "INSERT INTO activity_log (email,activty) VALUES ('$faculty','$activity')";

        $activityLog_query_run = mysqli_query($conn,$activityLog_query);

            if($activityLog_query_run){
                $get_email = $email;
                $get_dept = $department;
                $get_role = $role;
                send_invitation($get_email,  $get_dept, $get_role, $token);
                $_SESSION['status'] =  'The Invitation Has Been Sent';
                $_SESSION['status_code'] = 'success';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }else{
                $_SESSION['status'] =  'Activity log error';
                $_SESSION['status_code'] = 'error';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }

   



        }else{
            $_SESSION['status'] =  'FAILED';
            $_SESSION['status_code'] = 'error';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }

    }
}
}


if(isset($_POST['cancel_invitation_btn'])){
    
    $invitation_id = $_POST['invitation_id'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $department = $_POST['department'];
    $delete_invitation_query = "DELETE FROM faculty_table WHERE id='$invitation_id'";
    $delete_invitation_query_run = mysqli_query($conn, $delete_invitation_query);


    if($delete_invitation_query_run){

        $activity = "You cancelled an invitation from ".$email." In the ".$department.". Department. The role of invitation is ".$role;
        $faculty = $_SESSION['auth_user']['email'];
        $activityLog_query = "INSERT INTO activity_log (email,activty) VALUES ('$faculty','$activity')";
        $activityLog_query_run = mysqli_query($conn,$activityLog_query);

        if($activityLog_query_run){
            $_SESSION['status'] =  'Invitation Cancelled';
            $_SESSION['status_code'] = 'success';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }else{
            $_SESSION['status'] =  'Activity Log Error';
            $_SESSION['status_code'] = 'error';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }


    }else{
        
        $_SESSION['status'] =  'FAILED TO DELETE';
        $_SESSION['status_code'] = 'error';
         header('Location: ' . $_SERVER['HTTP_REFERER']); 
    }

}


if(isset($_POST['approved_faculty'])){
    $id = $_POST['id'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $department = $_POST['department'];



    $update_query= "UPDATE 
    faculty_table 
    SET 
    authenticated='yes',
    verify_token='done'
    WHERE id='$id'";


$query_run = mysqli_query($conn,$update_query);

if($query_run){

    


    $activity = "You Approved ".$email." in the ".$department.". Department. ".$role." is the invitation role.";
    $faculty = $_SESSION['auth_user']['email'];
    $activityLog_query = "INSERT INTO activity_log (email,activty) VALUES ('$faculty','$activity')";
    $activityLog_query_run = mysqli_query($conn,$activityLog_query);

    if($activityLog_query_run){
        $_SESSION['status'] =  'Faculty Accepted';
        $_SESSION['status_code'] = 'success';
        header('Location: Page_Faculty.php');
    }else{
        $_SESSION['status'] =  'Approved activity log error';
        $_SESSION['status_code'] = 'error';
        header('Location: Page_Faculty.php');
    }
    


}else{
    $_SESSION['status'] =  'Faculty Not Accepted';
    $_SESSION['status_code'] = 'error';
    header('Location: ' . $_SERVER['HTTP_REFERER']); 
}

}

if(isset($_POST['disapproved_faculty'])){
    $id = $_POST['id_disapproved'];
    $email = $_POST['email_disapproved'];
    $role = $_POST['role_disapproved'];
    $department = $_POST['department_disapproved'];

    $delete_query = "DELETE FROM faculty_table WHERE id='$id'";

    $query_run = mysqli_query($conn,$delete_query);

    if($query_run){




        $activity = "You Diapproved ".$email." in the department of ".$department.". ".$role." is the role of invitation.";
        $faculty = $_SESSION['auth_user']['email'];
        $activityLog_query = "INSERT INTO activity_log (email,activty) VALUES ('$faculty','$activity')";
        $activityLog_query_run = mysqli_query($conn,$activityLog_query);

            if($activityLog_query_run){
                $_SESSION['status'] =  'Faculty Rejected';
                $_SESSION['status_code'] = 'success';
                header('Location: Page_acceptFaculty.php');
            }else{
                $_SESSION['status'] =  'Faculty Rejected Activity log Error';
                $_SESSION['status_code'] = 'error';
                header('Location: Page_acceptFaculty.php');
            }




    }else{
        $_SESSION['status'] =  'Faculty Not Rejected';
        $_SESSION['status_code'] = 'error';
        header('Location: Page_acceptFaculty.php');
    }
  
}


if(isset($_POST['update_faculty'])){

    $faculty_id = $_POST['faculty_id'];

    $stored_image = $_POST['stored_image'];
    $new_image = $_FILES['new_image']['name'];




    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $middle_name = $_POST['middle_name'];
    $department = $_POST['department'];
    $role = $_POST['role'];
    $contact = $_POST['contact'];


    
    
    if(strlen($first_name)<3 || strlen($first_name) > 18 || preg_match('~[0-9]+~', $first_name) || preg_match($pattern, $first_name)){
        $_SESSION['status'] =  'Invalid First Name';
        $_SESSION['status_code'] = 'error';
        header('Location: Page_Faculty.php');
    }else if(strlen($last_name)<1 || strlen($last_name) > 18 || preg_match('~[0-9]+~', $last_name) || preg_match($pattern, $last_name)){
        $_SESSION['status'] =  'Invalid Last Name';
        $_SESSION['status_code'] = 'error';
        header('Location: Page_Faculty.php');
    }else if(strlen($middle_name)==1 || strlen($middle_name) > 18 || preg_match('~[0-9]+~', $middle_name) || preg_match($pattern, $middle_name)){
        $_SESSION['status'] =  'Invalid Middle Name';
        $_SESSION['status_code'] = 'error';
        header('Location: Page_Faculty.php');
    }else if(strlen($contact) !=11){
        $_SESSION['status'] =  'Invalid Contact';
        $_SESSION['status_code'] = 'error';
        header('Location: Page_Faculty.php');
    }else if(preg_match('~[0-9]+~', $department)){
        $_SESSION['status'] =  'Invalid Department';
        $_SESSION['status_code'] = 'error';
        header('Location: Page_Faculty.php');
    }else if (preg_match('~[0-9]+~', $role)){
        $_SESSION['status'] =  'Invalid Role';
        $_SESSION['status_code'] = 'error';
        header('Location: Page_Faculty.php');
    }else{



        if(empty($new_image)){
            $update_query= "UPDATE 
            faculty_table 
            SET 
            first_name='$first_name',
            last_name='$last_name',
            middle_name='$middle_name',
            department='$department',
            role='$role'
            WHERE id='$faculty_id'";

            $query_run = mysqli_query($conn,$update_query);

            if($query_run){


                $activity = "You Update the profile of ".$first_name." ".$middle_name." ".$last_name;
                $faculty = $_SESSION['auth_user']['email'];
                $activityLog_query = "INSERT INTO activity_log (email,activty) VALUES ('$faculty','$activity')";
                $activityLog_query_run = mysqli_query($conn,$activityLog_query);

                if($activityLog_query_run){
                    $_SESSION['status'] =  'Faculty Updated';
                    $_SESSION['status_code'] = 'success';
                    header('Location: Page_Faculty.php');
                }else{
                    $_SESSION['status'] =  'Activity logs error';
                    $_SESSION['status_code'] = 'error';
                    header('Location: Page_Faculty.php');
                }


        



            }else{
                $_SESSION['status'] =  'Faculty Not Updated';
                $_SESSION['status_code'] = 'error';
                header('Location: Page_Faculty.php');
            }

        


        }else{


            $update_query= "UPDATE 
            faculty_table 
            SET 
            faculty_image='$new_image',
            first_name='$first_name',
            last_name='$last_name',
            middle_name='$middle_name',
            department='$department',
            role='$role'
            WHERE id='$faculty_id'";

            $query_run = mysqli_query($conn,$update_query);

            if($query_run){

                $activity = "You Update the profile of ".$first_name." ".$middle_name." ".$last_name;
                $faculty = $_SESSION['auth_user']['email'];
                $activityLog_query = "INSERT INTO activity_log (email,activty) VALUES ('$faculty','$activity')";
                $activityLog_query_run = mysqli_query($conn,$activityLog_query);


                if($activityLog_query_run){
                    $faculty_image_tmp_name = $_FILES['new_image']['tmp_name'];
                    move_uploaded_file($faculty_image_tmp_name, 'upload_image_faculty/'.$new_image);
                    
                    $_SESSION['status'] =  'Faculty Updated';
                    $_SESSION['status_code'] = 'success';
                    header('Location: Page_Faculty.php');
                }else{
                    $_SESSION['status'] =  'Activity log error';
                    $_SESSION['status_code'] = 'error';
                    header('Location: Page_Faculty.php');
                }
           
            }else{
                $_SESSION['status'] =  'Faculty Not Updated';
                $_SESSION['status_code'] = 'error';
                header('Location: Page_Faculty.php');
            }
        }
    }
}







if(isset($_POST['delete_faculty'])){
    $faculty_id = $_POST['faculty_id'];
    $email = $_POST['email'];

    $delete_query = "UPDATE faculty_table SET isDeactivated='true' WHERE id='$faculty_id'";
    $query_run = mysqli_query($conn,$delete_query);






    if($query_run){
       
      
        $activity = "You removed ".$email." from the list";
        $faculty = $_SESSION['auth_user']['email'];
        $activityLog_query = "INSERT INTO activity_log (email,activty) VALUES ('$faculty','$activity')";
        $activityLog_query_run = mysqli_query($conn,$activityLog_query);

        if($activityLog_query_run){
            $_SESSION['status'] =  'Faculty Deleted';
            $_SESSION['status_code'] = 'success';
            header('Location: Page_Faculty.php');
        }else{
            $_SESSION['status'] =  'Delete Faculty Activity log error';
            $_SESSION['status_code'] = 'error';
            header('Location: Page_Faculty.php');
        }
  
    }else{
        
        $_SESSION['status'] =  'Faculty Not Deleted';
        $_SESSION['status_code'] = 'error';
        header('Location: Page_Faculty.php');
    }
}


if(isset($_POST['reject_btn'])){
    $queue_token = $_POST['queue_token'];

    $reject_query = "DELETE FROM queing_table WHERE queue_token='$queue_token'";
    $query_run = mysqli_query($conn, $reject_query);

    if($query_run){
        $_SESSION['status_code'] = 'success';
        $_SESSION['status'] =  'The Queue Rejected';
        header('Location: index.php');
    }else{
        $_SESSION['status_code'] = 'error';
        $_SESSION['status'] =  'The function is not working';
        header('Location: index.php');
    }
}




if(isset($_POST['endore_btn'])){


    date_default_timezone_set('Asia/Manila');
    $date_endorse = date('Y-m-d H:i:s');

    $queue_token = $_POST['queue_token'];
    $faculty = $_POST['faculty'];
    $student_full_name = $_POST['student_full_name'];

    $sending_faculty = $_POST['sending_faculty'];
    $endorse_remarks = $_POST['endorse_remarks'];
 
    $sending_remarks = "Endores by: ".$sending_faculty."<br><br> Note: ".$endorse_remarks."<br><br> Date: ".date("F j, Y, g:i a", strtotime($date_endorse));

    $get_faculty_name = "SELECT * FROM faculty_table WHERE email='$faculty'";
    $get_faculty_name_run = mysqli_query($conn, $get_faculty_name);
    $faculty_name_row = mysqli_fetch_array($get_faculty_name_run);

    $faculty_full_name = $faculty_name_row['first_name']." ".$faculty_name_row['middle_name']." ".$faculty_name_row['last_name'];

    $new_department = $faculty_name_row['department'];


    $endorse_query = "UPDATE 
    queing_table SET
    date='$date_endorse',
    department='$new_department',
    faculty='$faculty',
    faculty_full_name='$faculty_full_name',
    endores='yes',
    report='$sending_remarks',
    isServing='false'
    WHERE queue_token='$queue_token'";

    $endorse_query_run = mysqli_query($conn, $endorse_query);

    if($endorse_query_run){

        $activity = "You endorse ".$student_full_name." to ".$faculty;
     
        $activityLog_query = "INSERT INTO activity_log (email,activty) VALUES ('$sending_faculty','$activity')";

        if(mysqli_query($conn,$activityLog_query)){
      
            $_SESSION['status'] =  'Student Endorse Successfully';
            $_SESSION['status_code'] = 'success';
            header('Location: index.php');
        }else{
       
            $_SESSION['status'] =  'Student Endorse Error';
            $_SESSION['status_code'] = 'error';
            header('Location: index.php');
        }
     


    }else{
        $_SESSION['status'] =  'Student Endorse Error';
        $_SESSION['status_code'] = 'error';
        header('Location: index.php');
    }

}


if(isset($_POST['done_consultation_btn'])){
    date_default_timezone_set('Asia/Manila');
    $token_queue = $_POST['token_queue'];
    $report = $_POST['report'];
    $end_datetime = date('Y-m-d H:i:s');
    $student_full_name = $_POST['student_full_name'];

    $end_consultation_query = "UPDATE 
    queing_table SET
    date_end='$end_datetime',
    isServing='done',
    report='$report'
    WHERE queue_token='$token_queue'";

    $end_consultation_query_run = mysqli_query($conn, $end_consultation_query);

    if($end_consultation_query_run){


        $activity = "You Done Consultation with ".$student_full_name;
        $faculty = $_SESSION['auth_user']['email'];
        $activityLog_query = "INSERT INTO activity_log (email,activty) VALUES ('$faculty','$activity')";
        $activityLog_query_run = mysqli_query($conn,$activityLog_query);

        if($activityLog_query_run){
            $_SESSION['status_code'] = 'success';
            $_SESSION['status'] =  'Consultation Done Succefully';
            header('Location: index.php');
        }else{
            $_SESSION['status'] =  'Consultation Done Succefully erorrereasd';
            $_SESSION['status_code'] = 'error';
            header('Location: index.php');
        }

    }else{
        $_SESSION['status_code'] = 'error';
        $_SESSION['status'] =  'Consultation Error';
        header('Location: index.php');
    }
}








if(isset($_POST['update_profile_btn'])){
    $user_id = $_POST['user_id'];
    $faculty_image_upload = $_FILES['faculty_image_upload']['name'];
    $faculty_image_current = $_POST['faculty_image_current'];



    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $middle_name = $_POST['middle_name'];
    $contact = $_POST['contact'];


    $pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);



    if(strlen($first_name)<3 || strlen($first_name) > 18 || preg_match('~[0-9]+~', $first_name) || preg_match($pattern, $first_name)){
        $_SESSION['status_code'] = 'error';
        $_SESSION['status'] =  'Invalid First Name';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else if(strlen($last_name)<1 || strlen($last_name) > 18 || preg_match('~[0-9]+~', $last_name) || preg_match($pattern, $last_name)){
        $_SESSION['status_code'] = 'error';
        $_SESSION['status'] =  'Invalid Last Name';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else if(strlen($middle_name)==1 || strlen($middle_name) > 18 || preg_match('~[0-9]+~', $middle_name) || preg_match($pattern, $middle_name)){
        $_SESSION['status_code'] = 'error';
        $_SESSION['status'] =  'Invalid Middle Name';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else if(strlen($contact) !=11){
        $_SESSION['status_code'] = 'error';
        $_SESSION['status'] =  'Invalid Contact';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else{





        if(empty($faculty_image_upload)){


            $update_query_1 = "UPDATE 
            faculty_table 
            SET 
            faculty_image='$faculty_image_current',
            first_name='$first_name',
            last_name='$last_name',
            middle_name='$middle_name',
            contact='$contact' WHERE id='$user_id'";

            if(mysqli_query($conn, $update_query_1)){
                $_SESSION['status_code'] = 'success';
                $_SESSION['status'] =  'Profile Update Successfully';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }else{
                $_SESSION['status_code'] = 'error';
                $_SESSION['status'] =  'Profile Update Error';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }






        
        }else{
            $faculty_image_upload_tmp_name = $_FILES['faculty_image_upload']['tmp_name'];
            move_uploaded_file($faculty_image_upload_tmp_name, 'upload_image_faculty/'.$faculty_image_upload);


            $update_query_2 = "UPDATE 
            faculty_table 
            SET 
            faculty_image='$faculty_image_upload',
            first_name='$first_name',
            last_name='$last_name',
            middle_name='$middle_name',
            contact='$contact' WHERE id='$user_id'";

            if(mysqli_query($conn, $update_query_2)){
                $_SESSION['status_code'] = 'success';
                $_SESSION['status'] =  'Profile Update Successfully';
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            }else{
                $_SESSION['status_code'] = 'error';
                $_SESSION['status'] =  'Profile Update Error';
                header('Location: ' . $_SERVER['HTTP_REFERER']);  
            }







        }







    }




}


if(isset($_POST['reset_password'])){
    $current_password = $_POST['current_password'];
    $user_id = $_POST['user_id'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];


    $pattern = '/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/';
    $uppercase = preg_match('@[A-Z]@', $new_password);
    $lowercase = preg_match('@[a-z]@', $new_password);
    $number    = preg_match('@[0-9]@', $new_password);
    $specialChars = preg_match('@[^\w]@', $new_password);



    if($current_password !=$old_password){
        $_SESSION['status_code'] = 'error';
        $_SESSION['status'] =  'Invalid Old Password';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($new_password) < 8){
        $_SESSION['status_code'] = 'error';
        $_SESSION['status'] =  'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else if($confirm_password !=$new_password){
        $_SESSION['status_code'] = 'error';
        $_SESSION['status'] =  'Password And Confirm Password does not match .';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else{

        $reset_password_query = "UPDATE faculty_table SET password='$new_password' WHERE id='$user_id'";

        $reset_password_query = mysqli_query($conn, $reset_password_query);

        if($reset_password_query){
            $_SESSION['status_code'] = 'success';
            $_SESSION['status'] =  'Reset Password Successfully';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }else{
            $_SESSION['status_code'] = 'error';
            $_SESSION['status'] =  'Reset Password error';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }






    }
}






























if(isset($_POST['accept_request_btn'])){
    $queue_token = $_POST['queue_token'];
    $email= $_POST['email'];
    $student_full_name = $_POST['student_full_name'];
    $request_date = $_POST['request_date'];
    $verify_token = md5(rand());

    $accept_request_query = "UPDATE 
    queing_table SET 
    reserve='false',
    token='$verify_token' 
    WHERE queue_token='$queue_token'";

    $accept_request_query_run = mysqli_query($conn, $accept_request_query);

    if($accept_request_query_run){
        send_request_link($email,$student_full_name,$request_date,$verify_token,$queue_token);
        $_SESSION['status_code'] = 'success';
        $_SESSION['status'] =  'Accept request successfully';
        header('Location: ' . $_SERVER['HTTP_REFERER']);

    }else{
        $_SESSION['status_code'] = 'error';
        $_SESSION['status'] =  'Accept request error';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }


}



if(isset($_POST['Reject_request_btn'])){
    $faculty_message = $_POST['faculty_message'];
    $queue_token = $_POST['queue_token'];
    $faculty = $_POST['faculty'];
    $email = $_POST['email'];
    $student_full_name = $_POST['student_full_name'];



    $reject_query = "DELETE FROM queing_table WHERE queue_token='$queue_token'";
    $reject_query_run = mysqli_query($conn, $reject_query);

    if($reject_query_run){
        send_reject_request($faculty_message,$queue_token,$faculty,$email,$student_full_name);
        $_SESSION['status_code'] = 'success';
        $_SESSION['status'] =  'Reject Reservation Successfully';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }else{
        $_SESSION['status_code'] = 'error';
        $_SESSION['status'] =  'Reject Reservation Error';
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }




}


if(isset($_POST['restore_faculty'])){
    $faculty_id = $_POST['faculty_id'];


    $restore_query = "UPDATE faculty_table SET isDeactivated='false' WHERE id='$faculty_id'";
    $restore_query_run = mysqli_query($conn, $restore_query);

    if($restore_query_run){
        $_SESSION['status_code'] = 'success';
        $_SESSION['status'] =  'Faculty Restored Successfully';
        header('Location: Page_Faculty_Deleted.php');
    }else{
        $_SESSION['status_code'] = 'error';
        $_SESSION['status'] =  'Faculty Restored error';
        header('Location: Page_Faculty_Deleted.php');
    }


}
