<?php
session_start();

require("../includes/database_connect.php");
$user_id=$_SESSION['user_id'];

$old_password = $_POST['old_password'];
$new_password = $_POST['new_password'];
$re_new_password = $_POST['re_new_password'];
$old_password = sha1($old_password);
if ($new_password!=$re_new_password) {
    $response = array("success" => false, "message" => "New passwords entered does not match!");
    echo json_encode($response);
    return;
}
$new_password=sha1($new_password);

$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = mysqli_query($conn, $sql);
if (!$result) {
    $response = array("success" => false, "message" => "Something went wrong!");
    echo json_encode($response);
    return;
}

$user=mysqli_fetch_assoc($result);
if ($user['password']!=$old_password) {
    $response = array("success" => false, "message" => "Old password does not match!");
    echo json_encode($response);
    return;
}


$sql = "UPDATE users SET password='$new_password'";
$result = mysqli_query($conn, $sql);
if (!$result) {
    $response = array("success" => false, "message" => "Something went wrong!");
    echo json_encode($response);
    return;
}

$response = array("success" => true, "message" => "Your password has been changed successfully!");
echo json_encode($response);
mysqli_close($conn);
?>