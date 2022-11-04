<?php
session_start();
require "includes/database_connect.php";

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
$city_name = $_GET["city"];

$sql_1 = "SELECT * FROM cities WHERE name = '$city_name'";
$result_1 = mysqli_query($conn, $sql_1);
if (!$result_1) {
    echo "Something went wrong!";
    return;
}
$city = mysqli_fetch_assoc($result_1);
if (!$city) {
    echo "Sorry! We do not have any Cars listed in this city.";
    return;
}
$city_id = $city['id'];


$sql_2 = "SELECT * FROM cars WHERE city_id = $city_id";
$result_2 = mysqli_query($conn, $sql_2);
if (!$result_2) {
    echo "Something went wrong!";
    return;
}
$cars = mysqli_fetch_all($result_2, MYSQLI_ASSOC);


$sql_3 = "SELECT * 
            FROM interested_users_cars iuc
            INNER JOIN cars c ON iuc.car_id = c.id
            WHERE c.city_id = $city_id";
$result_3 = mysqli_query($conn, $sql_3);
if (!$result_3) {
    echo "Something went wrong!";
    return;
}
$interested_users_cars = mysqli_fetch_all($result_3, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $city_name ?> | Car World</title>

    <?php
    include "includes/head_links.php";
    ?>
    <link href="css/car_list.css" rel="stylesheet" />
</head>

<body >
    <?php
    include "includes/header.php";
    ?>

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb py-2">
            <li class="breadcrumb-item">
                <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                <?php echo $city_name; ?>
            </li>
        </ol>
    </nav>
<div class="container my-4 px-0">
    <div class="row">

        <?php
        foreach ($cars as $car) {
            $car_images = glob("img/cars/" . $car['id'] . "/*");
        ?>
        <div class="col-12 col-md-5 col-lg-4 ">
            <div class="card car-id-<?= $car['id'] ?> car_card">
                <img src="<?= $car_images[0] ?>" />
                
                <div class="card-body">
                        <h5 class="card-title">
                            ₹ <?= number_format($car['price']) ?>
                            <span class="car-list-interested-container">
                        <?php
                        
                        $is_interested = false;
                        foreach ($interested_users_cars as $interested_user_car) {
                            if ($interested_user_car['car_id'] == $car['id'] && $interested_user_car['user_id'] == $user_id ) {
                                    $is_interested = true;
                                    break;
                                }
                            }

                        if ($is_interested) {
                        ?>
                            <i class="is-interested-image fas fa-heart" car_id="<?= $car['id'] ?>"></i>
                        <?php
                        } else {
                        ?>
                            <i class="is-interested-image far fa-heart" car_id="<?= $car['id'] ?>"></i>
                        <?php
                        }
                        ?>
                    </span>
                </h5>
                <h4 class="card-text"><?= $car['make'] ?> - <?= $car['model'] ?></h4>
                <p>Owner - <?= $car['owner'] ?> </p>
                <p class="card-text"><?= $car['year'] ?> - <?= number_format($car['mileage']) ?> km</p>
                    <a href="car_detail.php?car_id=<?= $car['id'] ?>" class="btn btn-block btn-primary mt-2">View</a>
                </div>
                </div>
            </div>
            <?php
        }
        ?>
        </div>
        </div>
        <?php
        if (count($cars) == 0) {
        ?>
            <div class="no-car-container">
                <p>No Cars listed.</p>
            </div>
        <?php
        }
        ?>
    </div>

    <?php
    include "includes/signup_modal.php";
    include "includes/login_modal.php";
    include "includes/admin_login_modal.php";
    include "includes/footer.php";
    ?>

    <script type="text/javascript" src="js/car_list.js"></script>
</body>

</html>
