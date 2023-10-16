<?php
include 'inc/header.php';

// get back form data if there was a registration error
$first_name= $_SESSION['signup-data']['first_name'];
$last_name= $_SESSION['signup-data']['last_name'] ?? NULL;
$username= $_SESSION['signup-data']['username'] ?? NULL;
$email= $_SESSION['signup-data']['email'] ?? NULL;
$create_password= $_SESSION['signup-data']['create_password'] ?? NULL;
$confirm_password= $_SESSION['signup-data']['confirm_password'] ?? NULL;

//DELETE SIGNUP DATA SESSION
UNSET($_SESSION['signup-data']);

?>
<!-- Signup page -->
<section class="form_section">
    <div class="container form_section_container">
        <h2>Sign Up</h2>
        <?php if (isset($_SESSION['signup'])) : ?>
            <div class="alert_message error">
                <p><?php echo $_SESSION['signup'];
                    unset($_SESSION['signup']);
                    ?>
                </p>
            </div>
        <?php endif ?>
        <!-- <div class="alert_message error">
            <p>This is an error alert_message</p>
        </div> -->
        <form action="<?php echo ROOT_URL ?>signup_logic.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="first_name" 
            value="<?php echo $first_name ?>" placeholder="First Name">
            <input type="text" name="last_name" value="<?php echo $last_name ?>" placeholder="Last Name">
            <input type="text" name="username" 
            value="<?php echo $username ?>" placeholder="Username">
            <input type="email" name="email" value="<?php echo $email ?>" placeholder="E-mail">
            <input type="password" name="create_password" value="<?php echo $create_password ?>" placeholder="Create password">
            <input type="password" name="confirm_password" value="<?php echo 
            $confirm_password ?>" placeholder="Confirm password">
            <div class="form_control">
                <label for="profile">User Profile</label>
                <input type="file" name="profile" id="profile">
            </div>
            <button type="submit" name="submit" class="btn">Sign Up</button>
            <small>Already have an account? <a href="signin.php">Sign in</a></small>
        </form>
    </div>
</section>