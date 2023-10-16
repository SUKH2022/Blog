<!-- sukhmani password- 123456789 -->
<?php
require 'config/database.php';

//get signup from data if signup button was clicked
if (isset($_POST['submit'])) {
    $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $create_password = filter_var($_POST['create_password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirm_password = filter_var($_POST['confirm_password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $profile = $_FILES['profile'];
    // echo $first_name, $last_name, $username, $email, $create_password, $confirm_password;
    // var_dump($profile);

    // validate input values
    if (!$first_name) {
        $_SESSION['signup'] = "Please Enter Your First NAME";
    } elseif (!$last_name) {
        $_SESSION['signup'] = "Please Enter Your Last NAME";
    } elseif (!$username) {
        $_SESSION['signup'] = "Please Enter Your Username";
    } elseif (!$email) {
        $_SESSION['signup'] = "Please Enter Your Valid Email";
    } elseif (strlen($create_password) < 8 || strlen($confirm_password) < 8) {
        $_SESSION['signup'] = "Password should be more than 8 characters";
    } elseif (!$profile['name']) {
        $_SESSION['signup'] = "Please add a profile picture";
    } else {
        // check if password don't match
        if ($create_password !== $confirm_password) {
            $_SESSION['signup'] = "Passwords do not match";
        } else {
            // hash password
            $hashed_password = password_hash($create_password, PASSWORD_DEFAULT);
            // echo $create_password . '<br>';
            //  echo $hashed_password;
            //  password123
            // $2y$10$lLbVpuREn2zvG9gbfRwepOo4x2F3Zky6sn4QQMnR0vN31tjhdD/za

            // Check if the username or email already existsin the database
            $user_check_query = "SELECT * FROM user WHERE username = '$username' OR email= '$email'";
            $user_check_result = mysqli_query($connection, $user_check_query);
            // $num_rows = mysqli_num_rows($user_check_result);

            if (mysqli_num_rows($user_check_result) > 0) {
                $_SESSION['signup'] = "Username or email already exists";
            } else {
                // see the profile
                // rename profile
                // $time = Math.random(000, 999);
                // each img will be unique as it is using current timestamp
                $time = time();
                $profile_name = $time . $profile['name'];
                $profile_tmp_name = $profile['tmp_name'];
                $profile_destination_path = 'images/' . $profile_name;

                // file should be an img
                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extension = explode('.', $profile_name);
                $extension = end($extension);

                if (in_array($extension, $allowed_files)) {
                    // make sure the img should not be too large or more than 1mb
                    if ($profile['size'] < 1000000) {
                        // upload the profile
                        move_uploaded_file($profile_tmp_name, $profile_destination_path);
                    } else {
                        $_SESSION['signup'] = "File size is too big, it should be less than 1mb";
                    }
                }else {
                    $_SESSION['signup'] = "File should be jpg, png, or jpeg";
                }
            }
        }
    }

    // redirect back to the signup page if there was any error
    if (isset($_SESSION['signup'])) {
        // pass form data back to signup page
        $_SESSION['signup-data'] = $_POST;
        header('location: ' . ROOT_URL . 'signup.php');
        die();
    } else {
        // insert the new user into sign_user table
        $insert_user_query = "INSERT INTO users SET first_name ='$first_name', last_name= '$last_name', username= '$username', email= '$email', password= '$hashed_password', profile= '$profile_name', is_admin= 0";

        $insert_user_result = mysqli_query($connection, $insert_user_query);

        if (!mysqli_errno($connection)) {
            // redirect to login page with a success msg
            $_SESSION['signup-success'] = "Registration Successful. Kindly Log In";
            header('location: ' . ROOT_URL . 'signin.php');
            die();
        }
    }
    // echo time();
    // seconds are unique
    // 1691153475
    // var_dump($profile);
    // array(5) { ["name"]=> string(12) "avatar12.jpg" ["type"]=> string(10) "image/jpeg" ["tmp_name"]=> string(14) "/tmp/phpDqdsdV" ["error"]=> int(0) ["size"]=> int(26254) }
} else {
    //if button wasn't clicked, bounce back to the signup page
    header('location: ' . ROOT_URL . 'signup.php');
    die();
}
