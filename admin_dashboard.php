<?php
session_start();
require "includes/database_connect.php";

if (!isset($_SESSION["admin_id"])) {
    header("location: index.php");
    die();
}
$admin_id = $_SESSION['admin_id'];

$sql_1 = "SELECT * FROM admin WHERE id = $admin_id";
$result_1 = mysqli_query($conn, $sql_1);
if (!$result_1) {
    echo "Something went wrong!";
    return;
}
$admin = mysqli_fetch_assoc($result_1);
if (!$admin) {
    echo "Something went wrong!";
    return;
}
$sql_2="SELECT * FROM cars ORDER BY id DESC";
$result_2=mysqli_query($conn,$sql_2);
if(!$result_2){
    echo "Something went wrong!";
    return;
}

$cars = mysqli_fetch_all($result_2, MYSQLI_ASSOC);

$admin_img_name=$admin['profile_img'];
if($admin_img_name== NULL){
    $admin_img= "./img/default_profile_img";
}else{
    $admin_img="./img/admin/".$admin_img_name;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard | Car World</title>

    <?php
    include "includes/head_links.php";
    ?>
    <link href="css/dashboard.css" rel="stylesheet" />
</head>

<body>
    <?php
    include "includes/header.php";
    ?>
    
    <div class="row m-0">
    <div class="col-md-3 pr-5 py-5 mr-3">


        <div class="card" >
            <img src="<?= $admin_img?>" class="card-img-top profile_img" alt="profile image">
            <div class="card-body mx-auto">
                <h5 class="card-title"><?= $admin['full_name'] ?></h5>
            </div>
            <ul class="list-group list-group-flush mx-auto">
                <li class="list-group-item"><?= $admin['email'] ?></li>
            </ul>
            <div class="card-body mx-auto">
            <div class="new_car">
                <a class="btn btn-danger btn-block btn-sm" href="#" data-toggle="modal" data-target="#add-car-modal">
                    Add Car
                </a>
            </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 ml-5 my-5 ">

    <?php
        if(count($cars)>0){
    ?>
            <h1>Listed Cars</h1>
    <div class="row">
    <?php
    foreach ($cars as $car) {
        $car_images = glob("img/cars/" . $car['id'] . "/*");
    ?>
        
        <div class="col-12 col-md-6 col-lg-4 my-3">

        <div class="card h-100 car-id-<?= $car['id'] ?>" >
            <img src="<?= $car_images[0] ?>" class="card-img-top" alt="...">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">₹ <?= number_format($car['price']) ?> <span class="car_id">Car ID: <?=$car['id'] ?></span> </h5>
                <h4 class="card-text"><?= $car['make'] ?> - <?= $car['model'] ?></h4>
                <p>Owner - <?= $car['owner'] ?> </p>
                <p class="card-text"><?= $car['year'] ?> - <?= number_format($car['mileage']) ?> km</p>
                <div class="mt-auto">
                    <a href="car_detail.php?car_id=<?= $car['id'] ?>" class="btn btn-primary btn-sm btn-block">View</a>

                    <a href="./api/delete_car.php?car_id=<?= $car['id'] ?>" class="btn btn-danger btn-sm btn-block delete-icon">Delete</a>
                </div>
            </div>
        </div>
        </div>
        <?php
    }
    ?>
        </div>
    <?php
    }

    else {
    ?>
        <div class="no-car-container">
            <h2>No Cars listed</h2>
        </div>
    <?php
    }
    ?>
</div>
    </div>
   

    <?php
    include "includes/add_car_modal.php";
    include "includes/footer.php";

    ?>
    <script type="text/javascript" src="js/admin_dashboard.js"></script>
</body>

</html>
