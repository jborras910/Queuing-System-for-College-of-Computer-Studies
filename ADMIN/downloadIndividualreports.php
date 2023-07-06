<?php
session_start();
require_once('TCPDF-main/tcpdf.php');
include('../dbconfig.php');


// Retrieve the selected month from the query string
$month = $_GET['month'];
$year = $_GET['year'];

$get_faculty = $_SESSION['auth_user']['email'];

$get_name = $_SESSION['auth_user']['first_name']." ".$_SESSION['auth_user']['middle_name']." ".$_SESSION['auth_user']['last_name'];

$get_department = $_SESSION['auth_user']['department'];
// Retrieve data from the database
$sql = "SELECT * FROM queing_table WHERE isServing='done' AND DATE_FORMAT(`date`, '%M %Y') = '$month $year' AND faculty='$get_faculty'";
$result = $conn->query($sql);
$data = array();
if ($result->num_rows > 0) {
    $counter = 1;
    while($row = $result->fetch_assoc()) {

        $dateAccepted = new DateTime($row['date_accepted']);
        $dateEnd = new DateTime($row['date_end']);
        $duration = $dateAccepted->diff($dateEnd);
     
        $data[] = array(
            $counter, 
            date("F j, Y, g:i a", strtotime($row['date_accepted'])),
            $duration->format("%i minutes, %s Seconds"),
            ucwords($row["first_name"]." ".$row["middle_name"]." ".$row["last_name"]), 
            $row["report"],
            strtoupper($row["concern"])
        );
        $counter++;
    }
}






$conn->close();

if(empty($data)){
    $_SESSION['status'] =  'No Consultation Found';
    $_SESSION['status_code'] = 'error';
    header('location: Page_ViewConsultation.php');
}





$pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
$monthYear = date('F Y');
$faculty_name = $_SESSION['auth_user']['first_name']." ".$_SESSION['auth_user']['middle_name']." ".$_SESSION['auth_user']['last_name']." (".$_SESSION['auth_user']['role'].")";
$file_name = $faculty_name." ".$monthYear." .pdf";
$pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle($file_name);
$pdf->SetSubject('Table Data to PDF using TCPDF');
$pdf->SetKeywords('TCPDF, PDF, table, data');
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(10, 10, 10);
$pdf->SetFont('helvetica', '', 8);
$pdf->AddPage('L');
// Add header title

// Set image file path
$image_file = '../assets/LOGO.jpg';

// Add image to PDF document and center it
$pdf->Image($image_file, $x = '138', $y = '5', $w = 20, $h = 20, $type = '', $link = '', $align = 'C', $resize = false, $dpi = 300);
$pdf->Cell(0, 20, ' ', 0, 1, 'C');


// Add header title
$month_date = date('F Y');

$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(0, 0, strtoupper('Technological institute of the philippines'), 0, 1, 'C');
$pdf->SetFont('helvetica', 'B', 15);
$pdf->Cell(0, 19, 'FACULTY CONSULTATION REPORT', 0, 1, 'C');

$pdf->SetFont('helvetica', '', 11);
$monthYear = date('F Y');
$year = date('Y', strtotime($monthYear));
$year_2 = date('Y', strtotime($monthYear . ' -1 year'));
$pdf->Cell(0, 0, "School Year ".$year_2."-".$year, 0, 1, 'C');
$pdf->Cell(0, 0, '', 0, 10, 'C');

$pdf->Cell(0, 8, "Name of Faculty Member: ".ucwords($get_name), 0, 1, 'L');

$pdf->Cell(0, 8, "Date: ".date("F j, Y"), 0, 1, 'L');

$pdf->Cell(0, 8, "Department: ".ucwords($get_department) , 0, 1, 'L');
$pdf->Cell(0, 4, "", 0, 1, 'L');



// Set table header
$pdf->SetFont('helvetica', 'B', 8);
$pdf->Cell(10, 10, 'No', 1, 0, 'C');
$pdf->Cell(32, 10, 'Date of Consultation', 1, 0, 'C');
$pdf->Cell(32, 10, 'Duration', 1, 0, 'C');
$pdf->Cell(40, 10, 'Name of Students', 1, 0, 'C');
$pdf->Cell(45, 10, 'Remark', 1, 0, 'L');
$pdf->Cell(115, 10, 'Topic for Consultation', 1, 1, 'C');

// Set row height
$rowHeight = max($pdf->getCellHeight(10), $pdf->getCellHeight(10));

// Set table data
$pdf->SetFont('helvetica', '', 8);
foreach ($data as $row) {
    $pdf->Cell(10, $rowHeight, $row[0], 1, 0, 'C');
    $pdf->Cell(32, $rowHeight, $row[1], 1, 0, 'C');
    $pdf->Cell(32, $rowHeight, $row[2], 1, 0, 'C');
    $pdf->Cell(40, $rowHeight, $row[3], 1, 0, 'C');
    $pdf->Cell(45, $rowHeight, $row[4], 1, 0, 'L');
    $pdf->MultiCell(115, $rowHeight, $row[5], 1, 'L');
}



// Output the PDF file for download
//FOOTER
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(0, 10, 'This form must be submitted to the Department Chair not later than the fifth day of the month.', 0, 1, 'L');

$pdf->SetFont('helvetica', '', 9);
$pdf->Cell(0, 10, 'Noted By:', 0, 1, 'L');
$pdf->Cell(0, 7, '________________________________                                                                                                                    ________________________________', 0, 1, 'L');
$pdf->Cell(0, 0, '                  Department Chair                                                                                                                                                          Dean / VPAA' , 0, 1, 'L');
$pdf->Output(strtoupper($file_name), 'D');
