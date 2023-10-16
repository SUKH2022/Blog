<?php
require 'config/database.php';

// get form data if submit button was clicked
if (isset($_POST['submit'])) {
    $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $create_password = filter_var($_POST['create_password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirm_password = filter_var($_POST['confirm_password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $is_admin = filter_var($_POST['user_role'], FILTER_SANITIZE_NUMBER_INT);
    $profile = $_FILES['profile'];

    // validate input values
    if (!$first_name) {
        $_SESSION['add-user'] = "Please enter your First Name";
    } elseif (!$last_name) {
        $_SESSION['add-user'] = "Please enter your Last Name";
    } elseif (!$username) {
        $_SESSION['add-user'] = "Please enter your Username";
    } elseif (!$email) {
        $_SESSION['add-user'] = "Please enter your a valid email";
    } elseif (strlen($create_password) < 8 || strlen($confirm_password) < 8) {
        $_SESSION['add-user'] = "Password should be more than 8 characters";
    } elseif (!$profile['name']) {
        $_SESSION['add-user'] = "Please add profile";
    } else {
        // check if passwords don't match
        if ($create_password !== $confirm_password) {
            $_SESSION['signup'] = "Passwords do not match";
        } else {
            // hash password
            $hashed_password = password_hash($create_password, PASSWORD_DEFAULT);

            // check if username or email already exist in database
            $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
            $user_check_result = mysqli_query($connection, $user_check_query);
            if (mysqli_num_rows($user_check_result) > 0) {
                $_SESSION['add-user'] = "Username or Email already exist";
            } else {
                // profile
                // rename profile
                $time = time(); // make each image name unique using current timestamp
                $profile_name = $time . $profile['name'];
                $profile_tmp_name = $profile['tmp_name'];
                $profile_destination_path = '../images/' . $profile_name;

                // make sure file is an image
                $allowed_files = ['png', 'jpg', 'jpeg'];
                $extension = explode('.', $profile_name);
                $extension = end($extension);
                if (in_array($extension, $allowed_files)) {
                    // make sure image is not too large (1mb+)
                    if ($profile['size'] < 1000000) {
                        // upload profile
                        move_uploaded_file($profile_tmp_name, $profile_destination_path);
                    } else {
                        $_SESSION['add-user'] = "File size too big. Should be less than 1mb";
                    }
                } else {
                    $_SESSION['add-user'] = "File should be png, jpg, or jpeg";
                }
            }
        }
    }

    // redirect back to add-user pag eif there was any problem
    if (isset($_SESSION['add-user'])) {
        // pass form data back to signup page
        $_SESSION['add-user-data'] = $_POST;
        header('location: ' . ROOT_URL . 'admin/add-user.php');
        die();
    } else {
        // insert new user into users table
        $insert_user_query = "INSERT INTO users SET first_name='$first_name', last_name='$last_name', username='$username', email='$email', password='$hashed_password', profile='$profile_name', is_admin=$is_admin";
        $insert_user_result = mysqli_query($connection, $insert_user_query);

        if (!mysqli_errno($connection)) {
            // redirect to login page with success message
            $_SESSION['add-user-success'] = "New user $first_name $last_name added successfully.";
            echo 'Debugging: ' . ROOT_URL . 'admin/manage_user.php';
            header('location: ' . ROOT_URL . 'admin/manage_user.php');
            die();
        }
    }
} else {
    // if button wasn't clicked, bounce back to signup page
    header('location: ' . ROOT_URL . 'admin/add-user.php');
    die();
}
