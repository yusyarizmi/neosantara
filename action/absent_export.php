<?php
include '../layouts-back/session.php';
require '../vendor/autoload.php';

include '../action/config.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

date_default_timezone_set('Asia/Jakarta');

if (!isset($_SESSION['txtUsername'])) {
    header("location:landing.php");
}

$date = date('Y-m-d');
$username = $_SESSION['txtUsername'];

if (isset($_SESSION['noClass']) && isset($_SESSION['noStudent'])) {
    $pkcls = $_SESSION['noClass'];
    $pkstu = $_SESSION['noStudent'];
    $structure_stu = $_SESSION['txtStructure'];
} else {
    $sql_stu = "SELECT * FROM _student WHERE _user='$username'";
    $res_stu = query($sql_stu);
    $row_stu = mysqli_fetch_array($res_stu);
    $pkstu = $row_stu['pkstudent'];
    $pkcls = $row_stu['_pkcls'];
    $structure_stu = $row_stu['_structure'];
}

$sql_absents = "SELECT * FROM _absent WHERE _pkcls = $pkcls AND _date = '$date'";
$res_absents = query($sql_absents);

$spreadsheet = new Spreadsheet();

$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', 'Student Name');
$sheet->setCellValue('B1', 'Due Date');
$sheet->setCellValue('C1', 'Status In');
$sheet->setCellValue('D1', 'Status Out');

$row = 2;
while ($row_absents = mysqli_fetch_assoc($res_absents)) {
    $pkabsent = $row_absents['pkabsent'];
    $sql_stu_loop = "SELECT * FROM _absent WHERE pkabsent = '$pkabsent' AND _date = '$date'";
    $res_stu_loop = query($sql_stu_loop);
    $row_stu_loop = mysqli_fetch_assoc($res_stu_loop);
    $stu_loop = $row_stu_loop['_pkstu'];

    $sql_user = "SELECT * FROM _student WHERE pkstudent = $stu_loop";
    $res_user = query($sql_user);
    $row_user = mysqli_fetch_assoc($res_user);

    $sheet->setCellValue('A' . $row, $row_user['_fullname']);
    $sheet->setCellValue('B' . $row, $row_absents['_date']);
    $sheet->setCellValue('C' . $row, $row_absents['_infoIn']);
    $sheet->setCellValue('D' . $row, $row_absents['_infoOut']);
    $row++;
}

$writer = new Xlsx($spreadsheet);
$filename = 'example.xlsx';
$writer->save($filename);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="example.xlsx"');
header('Cache-Control: max-age=0');

$writer->save('php://output');
