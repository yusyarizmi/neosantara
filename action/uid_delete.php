<?php include '../layouts-back/session.php'; ?>

<?php
include '../action/config.php';

if (!isset($_SESSION['txtUsername'])) {
    header("location:../landing.php");
}

if (isset($_POST['uid'])) {
    $uid = $_POST['uid'];
    $sql = "UPDATE _tmpuid SET _uid = NULL";
    query($sql);
}
