<?php
session_start(); // Start the session to store messages
require_once './config.php';

if (isset($_POST['submit'])) {
    // Initialize an array to store errors
    $errors = [];
    $success = "";

    // Sanitize and validate each field
    $userName = isset($_POST['userName']) ? trim(htmlspecialchars($_POST['userName'])) : "";
    $userPass = isset($_POST['password']) ? trim(htmlspecialchars($_POST['password'])) : "";

    // Validate username
    if (empty($userName)) {
        $errors['userName'] = "Username is required.";
    } elseif (strlen($userName) < 3) {
        $errors['userName'] = "Username must be at least 3 characters long.";
    }

    // Validate password
    if (empty($userPass)) {
        $errors['password'] = "Password is required.";
    } elseif (strlen($userPass) < 6) {
        $errors['password'] = "Password must be at least 6 characters long.";
    }

    // If no errors, proceed with database insertion
    if (empty($errors)) {
        $userName = mysqli_real_escape_string($conn, $userName);
        $userPass = mysqli_real_escape_string($conn, $userPass);

        $insert_qry = "INSERT INTO `users` (`user_name`, `password`) VALUES ('$userName', '$userPass')";

        if (mysqli_query($conn, $insert_qry)) {
            $success = "User registered successfully.";
        } else {
            $errors['database'] = "Error inserting user: " . mysqli_error($conn);
        }
    }

    // Store errors and success messages in session
    $_SESSION['errors'] = $errors;
    $_SESSION['success'] = $success;

    // Redirect back to the form page
    header("Location: index.php");
    exit;
}
?>