<?php
session_start();


$from_time1 = date('Y-m-d H:i:s');
$to_time1 = date('Y-m-d H:i:s', $_COOKIE['endTime'] / 1000); // Convert milliseconds to seconds
$timefirst = strtotime($from_time1);
$timesecond = strtotime($to_time1);
$differenceinseconds = $timesecond - $timefirst;
echo gmdate("i:s", $differenceinseconds);




?>
