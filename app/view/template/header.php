<?php
/**
 * @var $data ['title'] -> Title for the page
 */
?>

<!DOCTYPE html>
<html lang=”en”>
<head>
    <meta charset=”UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/bootstrap.min.css">
    <script async src="<?php echo BASE_URL; ?>/public/js/bootstrap.bundle.min.js"></script>
    <title>Halaman <?php echo $data['title']; ?></title>
</head>
<body>
<nav class="navbar navbar-expand-lg" style="background-color: #77DD77">
    <div class="container-fluid">
        <img src="https://housebuddy.kitzdev.com/public/images/House_Buddy_Main_Icon.png" alt="House Buddy" width="30" height="24">
        <a class="navbar-brand" href="/" style="margin-left: 20px">House Buddy</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?php echo $data['title'] === "Home" ? "active" : ""; ?>" aria-current="page"
                       href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $data['title'] === "House" ? "active" : ""; ?>""
                    href="/house">House</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $data['title'] === "Booking" ? "active" : ""; ?>""
                    href="/booking">Booking</a>
                </li>
            </ul>
        </div>
    </div>
</nav>