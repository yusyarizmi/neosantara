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

            $sql_2 = "SELECT _imgIn,_imgOut FROM _absent WHERE pkabsent=$pk";
            $res = query($sql_2);
            $row = mysqli_fetch_assoc($res);

            $imgIn = $imgOut = "";

            $imgIn = $row['_imgIn'];
            $imgOut = $row['_imgOut'];

            if ($imgIn != "") {
                unlink($imgIn);
            }

            if ($imgOut != "") {
                unlink($imgOut);
            }

            $sql = "DELETE FROM _absent WHERE pkabsent = $pk";
            $result = query($sql);

            if ($result) {
                echo "Your absent has been deleted.";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "pk ancur anjayy";
        }
    }

    exit;
}
