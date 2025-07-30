<?php

session_start(); // Start the session

include 'includes/header.php'; // Include the header file
include 'includes/footer.php'; // Include the footer file
include __DIR__ . '/models/model_admin.php'; // Include the model for admin login

$_SESSION['isLoggedIn'] = false; // Set the session variable to indicate the user is not logged in
$_SESSION['username'] = ''; // Clear the username session variable
$error = ''; // Initialize an error variable
if (isset($_POST['username'])) {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING); // Sanitize the username input
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING); // Sanitize the password input

    if (login($username, $password)) {
        $_SESSION['isLoggedIn'] = true; // Set the session variable to indicate the user is logged in
        $_SESSION['username'] = $username; // Store the username in the session
        header('Location: homeView.php'); // Redirect to the home view
        exit();
    } else {
        $error = "Invalid username or password"; // Set an error message for invalid login
    }
}

?>

<div>
    <form action="loginView.php" method="post" class="login-form">

        <div><img src="" alt="logo"></div>

        <div><a href="homeView.php">Go to Homepage</a></div>

        <div><input type="text" name="username" placeholder="Username" required></div>
        <div><input type="password" name="password" placeholder="Password" required></div>
        <div><button type="submit">Login</button></div>

        <?php
        if (isset($error) && $error != "") { ?>
            <div class="error-message"><?php echo $error; ?></div>
        <?php
        }
        ?>
        
    </form>
</div>