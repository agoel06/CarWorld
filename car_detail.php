<?php
session_start();
require "includes/database_connect.php";

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
$admin_id = isset($_SESSION['admin_id']) ? $_SESSION['admin_id'] : NULL;
$car_id = $_GET["car_id"];

$sql_1="SELECT * FROM cars car INNER JOIN cities c ON car.city_id = c.id WHERE car.id = $car_id";
$result_1 = mysqli_query($conn, $sql_1);
if (!$result_1) {
    echo "Something went wrong!";
    return;
    
}
$car = mysqli_fetch_assoc($result_1);
if (!$car) {
    echo "Something went wrong!";
    return;
}
$city=$car['name'];

$sql_2 = "SELECT * FROM interested_users_cars WHERE car_id = $car_id";
$result_2 = mysqli_query($conn, $sql_2);
if (!$result_2) {
    echo "Something went wrong!";
    return;
}
$interested_users = mysqli_fetch_all($result_2, MYSQLI_ASSOC);
$interested_users_count = mysqli_num_rows($result_2);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $car['model']; ?> | Car World</title>

    <?php
    include "includes/head_links.php";
    ?>
    <link href="css/car_detail.css" rel="stylesheet" />
</head>

<body>
    <?php
    include "includes/header.php";
    ?>

    <nav aria-label="breadcrumb bg-light">
        <ol class="breadcrumb py-2">
            <li class="breadcrumb-item">
                <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="car_list.php?city=<?= $city; ?>"><?= $city; ?></a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <?= $car['model']; ?>
            </li>
        </ol>
    </nav>
    

    <div id="car-images" class="carousel slide car-img-background mx-4 my-2 carousel_custom" data-ride="carousel">       
        <div class="carousel-inner ">
            <?php
            $car_images = glob("./img/cars/" . $car_id . "/*");
            foreach ($car_images as $index => $car_image) {
            ?>
                <div class="carousel-item <?= $index == 0 ? "active" : ""; ?>">
                    <img class="d-block w-100 mx-auto" src="<?= $car_image ?>" alt="slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Car ID: <?=$car_id ?></h5>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
        <a class="carousel-control-prev" href="#car-images" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#car-images" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

    
        <div >
            <div class="detail-container container pb-4">
                
                <h3 class="car-model">
                    <?= $car['model'] ?>
                    <span class="interested-container mr-4">
                    <?php
                    $is_interested = false;
                    foreach ($interested_users as $interested_user) {
                        if ($interested_user['user_id'] == $user_id) {
                            $is_interested = true;
                        }
                    }
                    if($admin_id==NULL){
                        if ($is_interested) {
                    ?>
                            <i class="is-interested-image fas fa-heart"></i>
                    <?php
                        } else {
                    ?>
                            <i class="is-interested-image far fa-heart"></i>
                    <?php
                        }
                    }
                    ?>
                    <div class="interested-text mt-2 ">
                        <span class="interested-user-count"><?= $interested_users_count ?></span> interested
                    </div>
                    </span>
                </h3>
                <div class="price">₹ <?= number_format($car['price']) ?>/-</div>

                <table cellspacing="30px">
                    <tr>
                        <th>Showroom: </th>
                        <td><?= $city ?></td>
                    </tr>
                    <tr>
                        <th>Brand: </th>
                        <td><?= $car['make'] ?></td>
                    </tr>
                    <tr>
                        <th>Model: </th>
                        <td><?= $car['model'] ?></td>
                    </tr>
                    <tr>
                        <th>Fuel: </th>
                        <td><?= $car['fuel'] ?></td>
                    </tr>
                    <tr>
                        <th>Owner: </th>
                        <td><?= $car['owner'] ?></td>
                    </tr>
                    <tr>
                        <th>Year: </th>
                        <td><?= $car['year'] ?></td>
                    </tr>
                    <tr>
                        <th>Mileage: </th>
                        <td><?= number_format($car['mileage']) ?> km</td>
                    </tr>
                </table>
                
            </div>
        </div>
        
            
       
   
    <?php
        if($car['description']!=NULL){
    ?>
    <div class=" detail-container">
        <h1>Car Details</h1>
        <p><?= $car['description'] ?></p>
    </div>
    <?php
        }

    include "includes/signup_modal.php";
    include "includes/login_modal.php";
    include "includes/admin_login_modal.php";
    include "includes/footer.php";
    ?>

    <script type="text/javascript" src="js/car_detail.js"></script>
</body>

</html>
