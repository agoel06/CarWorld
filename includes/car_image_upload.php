<?php
if (isset($_FILES['car_images']['name']) AND !empty($_FILES['car_images']['name'])) {

$images = $_FILES['car_images'];
$num_of_imgs = count($images['name']);

for ($i=0; $i < $num_of_imgs && $i<8; $i++) { 
	$image_name = $images['name'][$i];

	$img_ex = pathinfo($image_name, PATHINFO_EXTENSION);
	$img_ex_lc = strtolower($img_ex);
	$allowed_exs = array('jpg', 'jpeg', 'png');

	if (!in_array($img_ex_lc, $allowed_exs)) {
		$response = array("success" => false, "message" => "This image extension not allowed!");
			echo json_encode($response);
			return;
	}
}
$sql = "INSERT INTO cars (make,model,year,price,fuel,mileage,reg_number,description,city_ID,owner)  VALUES ('$make','$model','$year','$price','$fuel','$mileage','$reg_number','$description','$city_ID',$owner)";
$result = mysqli_query($conn, $sql);
if (!$result) {
    $response = array("success" => false, "message" => "Something went wrong!");
    echo json_encode($response);
    return;
}

$sql_1="SELECT * FROM cars ORDER BY id DESC LIMIT 1";
$result_1=mysqli_query($conn,$sql_1);
$car=mysqli_fetch_assoc($result_1);
$car_id=$car['id'];



for ($i=0; $i < $num_of_imgs && $i<8; $i++) { 
	
	# get image info 
	$image_name = $images['name'][$i];
	$tmp_name   = $images['tmp_name'][$i];
	$error      = $images['error'][$i];

	
	if ($error === 0) {
		
	
		$img_ex = pathinfo($image_name, PATHINFO_EXTENSION);
		$img_ex_lc = strtolower($img_ex);

	
		$sql_1="SELECT * FROM cars ORDER BY id DESC LIMIT 1";
		$result_1=mysqli_query($conn,$sql_1);
		$car=mysqli_fetch_assoc($result_1);
		$car_id=$car['id'];
		if(!file_exists('../img/cars/'.$car_id)){
			mkdir('../img/cars/'.$car_id,0777);
		}
		$new_img_name = uniqid('CAR-', true).'.'.$img_ex_lc;
		$img_upload_path = '../img/cars/'.$car_id."/".$new_img_name;
		move_uploaded_file($tmp_name, $img_upload_path);
		


	}else {
		$response = array("success" => false, "message" => "Something went wrong!");
		echo json_encode($response);
		return;

	}
}	
}