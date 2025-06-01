<?php include '../layouts-back/session.php'; ?>

<?php
include '../action/config.php';

if (!isset($_SESSION['txtUsername'])) {
    header("location:../landing.php");
}

$random_number = random_int(1000, 9999);
$new_token_t = $_POST['token_t'] ?? null;
$new_token_s = $_POST['token_s'] ?? null;

if (isset($_POST['token_t']) && isset($_POST['token_s'])) {
    $new_token_t = $_POST['token_t'];
    $new_token_s = $_POST['token_s'];
} elseif (isset($_POST['token_t'])) {
    $new_token_t = $_POST['token_t'];
} elseif (isset($_POST['token_s'])) {
    $new_token_s = $_POST['token_s'];
}

if (!empty($new_token_t) && empty($new_token_s)) {
    $sql = "UPDATE teacher_tokens SET token_value = '$random_number'";
    $res = query($sql);
    if ($res) {
        $response = array("status" => "Success", "message" => "Token updated successfully");
    } else {
        $response = array("status" => "Error", "message" => "Failed to update token");
    }
    echo json_encode($response);
} elseif (!empty($new_token_s) && empty($new_token_t)) {
    $sql = "UPDATE student_tokens SET token_value = '$random_number'";
    $res = query($sql);
    if ($res) {
        $response = array("status" => "Success", "message" => "Token updated successfully");
    } else {
        $response = array("status" => "Error", "message" => "Failed to update token");
    }
    echo json_encode($response);
}
?>