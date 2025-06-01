<?php include '../layouts-back/session.php'; ?>

<?php
include '../action/config.php';

if (!isset($_SESSION['txtUsername'])) {
    header("location:../landing.php");
}

$tableNumber = $_GET['table'];

$sql_s = "SELECT * FROM student_tokens";
$res_s = query($sql_s);

$sql_t = "SELECT * FROM teacher_tokens";
$res_t = query($sql_t);

if ($tableNumber == 1) {
    while ($row_s = $res_s->fetch_assoc()) {
        $token_s[] = $row_s['token_value'];
    }
    echo json_encode($token_s);
}

if ($tableNumber == 2) {
    while ($row_t = $res_t->fetch_assoc()) {
        $token_t[] = $row_t['token_value'];
    }
    echo json_encode($token_t);
}
?>