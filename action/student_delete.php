<?php include '../layouts-back/session.php'; ?>

<?php
include '../action/config.php';

if (!isset($_SESSION['txtUsername'])) {
    header("location:../landing.php");
}

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'delete') {
        if (isset($_POST['pk']) && is_numeric($_POST['pk'])) {
            $pk = $_POST['pk'];

            $sql = "DELETE FROM _student WHERE pkstudent = $pk";
            $result = query($sql);

            if ($result) {
                echo "Data berhasil dihapus";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "pk tpkak valpk";
        }
    }

    exit;
}
