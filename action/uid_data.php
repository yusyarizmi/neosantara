<?php include '../layouts-back/session.php'; ?>
<?php
include '../action/config.php';

if (!isset($_SESSION['txtUsername'])) {
    header("location:../landing.php");
}

$sql = "SELECT * FROM `_tmpuid` WHERE 1";
$res = query($sql);
$row = mysqli_fetch_array($res);

$uid = $row['_uid'];

if ($uid == "null") {
    echo '';
} else {
    echo json_encode($uid);
}
?>