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
    $phoneNumber = $_POST['phoneNumber'] ?? '';
    $currentPassword = $_POST['currentPassword'] ?? '';
    $newPassword = $_POST['newPassword'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';

        // Basic validation
        if (empty($username) || empty($email) || empty($phoneNumber)) {
            $error = 'Username, email, and phone number are required.';
        } elseif (!empty($newPassword) || !empty($confirmPassword)) {
            // If password fields are filled, validate and update all
            if (empty($currentPassword)) {
                $error = 'Current password is required to change password.';
            } elseif ($newPassword !== $confirmPassword) {
                $error = 'New password and confirmation do not match.';
            } else {
                $result = updateAccount($username, $email, $currentPassword, $newPassword, $phoneNumber);
                if (strpos($result, 'successfully') !== false) {
                    $success = $result;
                    $_SESSION['username'] = $username;
                } else {
                    $error = $result;
                }
            }
        } else {
            // Only update email and phone number
            $result = updateContactInfo($username, $email, $phoneNumber);
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
