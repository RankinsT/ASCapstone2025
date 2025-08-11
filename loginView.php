<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="./css/loginStyle.css"> <!-- Link to your login CSS file -->
</head>
<body>

    <?php

    session_start(); // Start the session


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
            header('Location: adminView.php'); // Redirect to the home view
            exit();
        } else {
            $error = "Invalid username or password"; // Set an error message for invalid login
        }
    }

    ?>

    <div class="login-grid-container">
        <div class="header"></div>
        <form action="loginView.php" method="post" class="login-form">

            <div>
                <img src="images/LogoTemp.png" alt="logo" class="login-logo">
            </div>

            <div><a href="homeView.php">Go to Homepage</a></div>

            <div><input type="text" name="username" placeholder="Username" required></div>
            <div><input type="password" name="password" placeholder="Password" required></div>
            <div><button type="submit">Login</button></div>
            <div>&nbsp;</div>

            <?php if (!empty($error)): ?>
                        <div class="alert alert-error" style="color: red; margin-bottom: 15px; padding: 10px; border: 1px solid red; background-color: #fff0f0; border-radius: 4px;">
                            <ul style="margin: 0; padding-left: 20px;">
                                <?= $error ?>
                            </ul>
                        </div>
            <?php endif; ?>
            
            
        </form>
    </div>
    <div class="footer"></div>

</body>
</html>