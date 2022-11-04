<?php
session_start();

require("../includes/database_connect.php");
$user_id = $_SESSION['user_id'];

$full_name = $_POST['full_name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];
$gender = $_POST['gender'];
$password = $_POST['password'];
$password = sha1($password);

$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = mysqli_query($conn, $sql);
if (!$result) {
    $response = array("success" => false, "message" => "Something went wrong!");
    echo json_encode($response);
    return;
}

$user=mysqli_fetch_assoc($result);
if ($user['password']!=$password) {
    $response = array("success" => false, "message" => "Invalid password entered!");
    echo json_encode($response);
    return;
}

$sql_1 = "SELECT * FROM users WHERE email='$email' and id!='$user_id'";
$result_1 = mysqli_query($conn, $sql_1);
if (!$result_1) {
    $response = array("success" => false, "message" => "Something went wrong!");
    echo json_encode($response);
    return;
}

$row_count = mysqli_num_rows($result_1);
if ($row_count != 0) {
    $response = array("success" => false, "message" => "This email id is already registered with us!");
    echo json_encode($response);
    return;
}


$sql = "UPDATE users SET email='$email',  full_name='$full_name', phone='$phone', gender='$gender', address='$address' WHERE id = '$user_id'";
$result = mysqli_query($conn, $sql);
if (!$result) {
    $response = array("success" => false, "message" => "Something went wrong!");
    echo json_encode($response);
    return;
}

$response = array("success" => true, "message" => "Your account has been updated successfully!");
echo json_encode($response);
mysqli_close($conn);
?>