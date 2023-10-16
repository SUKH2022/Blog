<?php
require 'config/constants.php';

$username_email = $_SESSION['signin-data']['username_email'] ?? NULL;
$password = $_SESSION['signin-data']['password'] ?? NULL;

unset($_SESSION['signin-data']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Project</title>
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="Final project of PHP, MySql, HTML, CSS, and JS">

    <!-- CSS link -->
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/style.css">

    <!-- iconscout cdn     -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    <!-- the custom google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Sign_in page -->
    <section class="form_section">
        <div class="container form_section_container">
            <h2>Sign In</h2>
            <?php if (isset($_SESSION['signup-success'])) : ?>
                <div class="alert_message success">
                    <p><?php echo $_SESSION['signup-success'];
                        unset($_SESSION['signup-success']);
                        ?>
                    </p>
                </div>
            <?php elseif (isset($_SESSION['signin'])) : ?>
                <div class="alert_message error">
                    <p>
                        <?php echo $_SESSION['signin'];
                        unset($_SESSION['signin']);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="<?php echo ROOT_URL ?>signin_logic.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="username_email" value="<?php echo $username_email ?>" placeholder="Username or Email">
                <input type="password" value="<?php echo $password ?>" name="password" placeholder="Password">
                <button type="submit" name="submit" class="btn">Sign In</button>
                <small>Don't have an account? <a href="signup.php">Sign Up</a></small>
            </form>
        </div>
    </section>
</body>

</html>