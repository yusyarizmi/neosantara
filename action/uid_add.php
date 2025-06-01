<?php include '../layouts-back/session.php'; ?>
<?php
include '../action/config.php';

if (!isset($_SESSION['txtUsername'])) {
    header("location:../landing.php");
}

if (isset($_POST['pkstudent']) && isset($_POST['uid'])) {
    if ($_POST['pkstudent'] !== '' && $_POST['uid'] !== '') {
        $pkstudent = $_POST['pkstudent'];
        $uid = $_POST['uid'];

        $sql = "UPDATE _student SET _uid = '$uid' WHERE pkstudent = '$pkstudent'";
        query($sql);

        echo 200;
    } else {
        echo 500;
    }
}
?>