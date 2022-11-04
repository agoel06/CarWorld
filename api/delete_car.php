
<?php
session_start();

require "../includes/database_connect.php";

if (!isset($_SESSION['admin_id'])) {
    $response=array("success" => false, "is_logged_in" => false);
    echo json_encode($response);
    return;
}

$car_id = $_GET["car_id"];
$sql_1 = "SELECT * FROM interested_users_cars WHERE car_id=$car_id";
$result_1 = mysqli_query($conn, $sql_1);
if (!$result_1) {
    $response=array("success" => false, "message" => "Something went wrong!!!");
    echo json_encode($response);
    return;
}
if (mysqli_num_rows($result_1) != 0) {
        
        $sql_2="DELETE FROM interested_users_cars WHERE car_id=$car_id ";
        $result_2=mysqli_query($conn,$sql_2);
        if (!$result_2) {
            $response = array("success" => false, "message" => "Something went wrong!");
            echo json_encode($response);
            return;
        }
    }
$sql_3 = "DELETE FROM cars WHERE id = $car_id";
$result_3=mysqli_query($conn,$sql_3);

if (!$result_3) {
    $response=array("success" => false, "message" => "Something went wrong!");
    echo json_encode($response);
    return;
}
if(file_exists("../img/cars/" . $car_id)){
$car_images = glob("../img/cars/" . $car_id . "/*");
foreach ($car_images as $car_image){
    unlink($car_image);
}
rmdir("../img/cars/".$car_id);
}

$response=array("success" => true, "message"=>"Deleted successfully","car_id"=>$car_id);
echo json_encode($response);
return;

mysqli_close($conn);
?>