<?php 
session_start();
include('../dbconfig.php');


$faculty_id = $_SESSION['auth_user']['id'];
$offline_faculty_query = "UPDATE faculty_table SET active_status='false' WHERE id='$faculty_id'";

if(mysqli_query($conn,$offline_faculty_query)){

session_unset();
session_destroy();

header("location: ../facultyLogin.php");
 exit();


}else{

  $_SESSION['status'] =  'Errorr';
  header('Location: ADMIN/index.php');
}
?>
