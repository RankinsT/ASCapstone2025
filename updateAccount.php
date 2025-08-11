<?php
session_start();
include './models/model_admin.php';

// Only allow if logged in
if (!isset($_SESSION['isLoggedIn']) || !$_SESSION['isLoggedIn']) {
    header('Location: loginView.php');
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $email = $_POST['adminEmail'] ?? '';
    $currentPassword = $_POST['currentPassword'] ?? '';
    $newPassword = $_POST['newPassword'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';

    // Basic validation
    if (empty($username) || empty($email) || empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
        $error = 'All fields are required.';
    } elseif ($newPassword !== $confirmPassword) {
        $error = 'New password and confirmation do not match.';
    } else {
        // Call model function to update account
        $result = updateAccount($username, $email, $currentPassword, $newPassword);
        if (strpos($result, 'successfully') !== false) {
            $success = $result;
            $_SESSION['username'] = $username;
        } else {
            $error = $result;
        }
    }
}

// Redirect back to the view with a message
if (!empty($success)) {
    $_SESSION['update_success'] = $success;
    header('Location: updateAccountView.php');
    exit();
} else if (!empty($error)) {
    $_SESSION['update_error'] = $error;
    header('Location: updateAccountView.php');
    exit();
}
