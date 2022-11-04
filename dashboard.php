<?php
session_start();
require "includes/database_connect.php";

if (!isset($_SESSION["user_id"])) {
    header("location: index.php");
    die();
}
$user_id = $_SESSION['user_id'];

$sql_1 = "SELECT * FROM users WHERE id = $user_id";
$result_1 = mysqli_query($conn, $sql_1);
if (!$result_1) {
    echo "Something went wrong!";
    return;
}
$user = mysqli_fetch_assoc($result_1);
if (!$user) {
    echo "Something went wrong!";
    return;
}

$user_name=$user['full_name'];
$user_email=$user['email'];
$user_address=$user['address'];
$user_phone=$user['phone'];
$user_gender=$user['gender'];
$user_img_name=$user['profile_img'];

$sql_2 = "SELECT * 
            FROM interested_users_cars iuc
            INNER JOIN cars c ON iuc.car_id = c.id
            WHERE iuc.user_id = $user_id";
$result_2 = mysqli_query($conn, $sql_2);
if (!$result_2) {
    echo "Something went wrong!";
    return;
}
$interested_cars = mysqli_fetch_all($result_2, MYSQLI_ASSOC);

if($user_img_name== NULL){
    $user_img= "./img/default_profile_img.jpg";
}else{
    $user_img="./img/users/".$user_img_name;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | Car World</title>

    <?php
    include "includes/head_links.php";
    ?>
    <link href="css/dashboard.css" rel="stylesheet" />
</head>

<body>
    <?php
    include "includes/header.php";
    ?>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb py-2">
            <li class="breadcrumb-item">
                <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                Dashboard
            </li>
        </ol>
    </nav>

    <div class="container-flex ">
    <div class="row mx-0 px-0">
    <div class="col-md-3 pr-5 py-5 mr-3">

        <div class="card" >
            <img src="<?= $user_img ?>" class="card-img-top profile_img" alt="profile image">
            <div class="card-body mx-auto ">
                <h4 class="card-title"><?= $user_name ?></h4>
            </div>
            <ul class="list-group list-group-flush ">
                <li class="list-group-item"><?= $user_email ?></li>
                <li class="list-group-item"><?= $user_phone ?></li>
                <li class="list-group-item"><?= $user_address ?></li>
                <?php
                if($user_gender!=NULL){
                    ?>
                <li class="list-group-item"><?= $user_gender ?></li>
                <?php
                }
                ?>
            </ul>
            <div class="card-body ">
                <div class="edit">

                    <a class="btn btn-primary btn-sm btn-block" href="#" data-toggle="modal" data-target="#update-user-profile-modal">
                        Edit Profile
                    </a>
                    <a class="btn btn-danger btn-sm btn-block" href="#" data-toggle="modal" data-target="#update-user-password-modal">
                        Change password
                    </a>
                </div>
            </div>
        </div>
    </div>
        
    <div class="col-md-8 ml-5 my-5 ">

        
        <?php
    if (count($interested_cars) > 0) {
        ?>
            <h1>My Interested cars</h1>
                <div class="row">
                <?php
                foreach ($interested_cars as $car) {
                    $car_images = glob("img/cars/" . $car['id'] . "/*");
                ?>
                        <div class="col-12 col-md-6 col-lg-4 my-3">
                    <div class="card h-100 car-id-<?= $car['id'] ?>" >
                        <img src="<?= $car_images[0] ?>" class="card-img-top" alt="Car image">
                        
                        <div class="card-body d-flex flex-column">

                            <h5 class="card-title">
                                ₹ <?= number_format($car['price']) ?>
                                <span class="dashboard-interested-container">
                                <i class="is-interested-image fas fa-heart" car_id="<?= $car['id'] ?>"></i>
                                </span>
                            </h5>
                            <p class="card-text"><?= $car['year'] ?> - <?= $car['mileage'] ?></p>
                            <h4 class="card-text"><?= $car['make'] ?> - <?= $car['model'] ?></h4>
                            <div class="mt-auto">
                                
                                <a href="car_detail.php?car_id=<?= $car['id'] ?>" class="btn btn-block btn-primary mt-2">View</a>
                            </div>
                        </div>
                    </div>
                    </div>
                    <?php
                }
                ?>
                </div>
    <?php
    }else{
    ?>
        <div class="no-cars-dashboard ">
            <h2>Sorry! You have no cars in your wish list.</h2>
            <a href="./index.php" class="btn btn-info">Search cars</a>
        </div>
        </div>
        <?php
    }
    ?>
    </div>
    </div>
    <?php
    
    include "includes/update_user_profile_modal.php";
    include "includes/update_user_password_modal.php";
    include "includes/footer.php";
    ?> 

    <script type="text/javascript" src="js/dashboard.js"></script>
</body>

</html>
