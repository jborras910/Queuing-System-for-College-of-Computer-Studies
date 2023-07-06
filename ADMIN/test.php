<?php
date_default_timezone_set('Asia/Manila');

$currentMonthYear = date('F Y');

echo 'Current month and year in the Philippines: ' . $currentMonthYear;





$date = new DateTime($row['date_accepted'], new DateTimeZone('UTC'));
$date->setTimezone(new DateTimeZone('Asia/Manila'));

$monthYear = $date->format('F Y');

echo $monthYear;


"SELECT program, COUNT(program) AS Program FROM `queing_table` DATE_FORMAT(`date`, '%M %Y') == date('F Y') GROUP BY program;"














?>
