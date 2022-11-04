
<?php
require("../includes/database_connect.php");

$make = $_POST['make'];
$model = $_POST['model'];
$year = $_POST['year'];
$price=$_POST['price'];
$car_city=$_POST['city'];
$fuel=$_POST['fuel_type'];
$mileage = $_POST['mileage'];
$reg_number = $_POST['reg_number'];
$owner = $_POST['owner'];
$description = $_POST['description'];

$sql="SELECT * FROM cities WHERE name = '$car_city'";
$result = mysqli_query($conn, $sql);
if (!$result) {
    $response = array("success" => false, "message" => "Something went wrong!");
    echo json_encode($response);
    return;
}
$city=mysqli_fetch_assoc($result);
$city_ID=$city['id'];




include "../includes/car_image_upload.php";

$response = array("success" => true, "message" => "Car added successfully!");
echo json_encode($response);
mysqli_close($conn);
?>

