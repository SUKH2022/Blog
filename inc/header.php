<?php
require 'config/database.php';

// fetch current user from database
if (isset($_SESSION['user-id'])) {
    $id = filter_var($_SESSION['user-id'], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT profile FROM users WHERE id=$id";
    $result = mysqli_query($connection, $query);
    $profile = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">

<head id="head">
    <!-- Global meta tags  -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Project</title>
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="Final project of PHP, MySql, HTML, CSS, and JS">

    <!-- the custom google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <!-- iconscout cdn     -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    <!-- css link -->
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/style.css">

    <!-- jQuery then JS at the last  -->
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
</head>

<body>
    <header id="header">

        <!-- Global header -->
        <!-- navigation bar -->
        <header id="header">
            <!-- ... Your previous header content ... -->
            <div class="container header_container">
                <a href="<?php echo ROOT_URL ?>"><img src="<?php echo ROOT_URL ?>images/logo.jpg" class="header_logo" alt="world logo"></a>
                <ul class="header_items">
                    <li class="mt-down"><a href="<?php echo ROOT_URL ?>blog.php">Blog</a></li>

                    <!-- Conditionally display navigation based on user authentication -->
                    <?php if (isset($_SESSION['user-id'])) : ?>
                        <li class="header_profile">
                            <div class="profile">
                                <img src="<?php echo ROOT_URL . 'images/' . $profile['profile'] ?>" alt="profile img">
                            </div>
                            <ul>
                                <li><a href="<?php echo ROOT_URL ?>admin/dashboard.php">Dashboard</a></li>
                                <li><a href="<?php echo ROOT_URL ?>logout.php">Logout</a></li>
                            </ul>
                        </li>
                    <?php else : ?>
                        <li class="mt-down"><a href="<?php echo ROOT_URL ?>signin.php">Sign in</a></li>
                    <?php endif ?>
                </ul>
                <button id="open_header_btn"><i class="uil uil-bars"></i></button>
                <button id="close_header_btn"><i class="uil uil-multiply"></i></button>
            </div>
        </header>