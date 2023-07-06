<?php
include('../dbconfig.php');
session_start();
$token =  $_SESSION['token'];
?>


<?php

$query = "SELECT * FROM queing_table WHERE queue_token='$token'";
$query_run = mysqli_query($conn,$query);
if (mysqli_num_rows($query_run) > 0) {
while ($row=mysqli_fetch_assoc($query_run)) {
    ?>

<h3 class="text-danger">Consultation Timer:
    <?php
            date_default_timezone_set('Asia/Manila');
    $now = time();
    $expiry_date = strtotime($row['expiry_date']);
    if ($now < $expiry_date) {
        $diff =  $expiry_date - $now;
        $minutes = floor(($diff% (60 * 60)) / 60);
        $seconds = $diff % 60;

        $_SESSION['consultation_time'] = $minutes.":".$seconds;

        echo $_SESSION['consultation_time'];
    } else {
        echo "Consultation Time Done!!!";
    }
    ?>
</h3>


<?php }}?>
