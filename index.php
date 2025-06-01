<!-- 
    Succeesfull page without any error with SOP features
 -->

<?php
include 'layouts/session.php';

if (!isset($_SESSION['txtUsername'])) {
    header("location:landing.php");
}

$admin = $_SESSION['level'] == 1;
$teacher = $_SESSION['level'] == 2;
$student = $_SESSION['level'] == 3;

if ($admin) {
    header("Location: admin/index.php");
} elseif ($teacher) {
    header("Location: teacher/index.php");
} elseif ($student) {
    header("Location: student/index.php");
}
