<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdminView</title>

    <link rel="stylesheet" href="./css/adminStyle.css"> <!-- Link to your admin CSS file -->
</head>
<body>

    <?php

    session_start(); // Start the session


    include './models/model_admin.php'; // Include the model for admin functionalities

    ?>

    <div>
        <?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']): ?>

            <!-- Your admin view content goes here -->

            <div class="admin-grid-container">
                <div class="admin-header">
                    header here
                </div>
                <!-- div /header -->

                <div class="admin-customers">
                    customers here
                </div>
                <!-- div /customers -->

                <div class="admin-add-customers">
                    add customer button?
                </div>
                <!-- div /add-customers -->

            </div>
            <!-- div /grid-container -->

        <?php else:
            header('Location: loginView.php'); // Redirect to login view if not logged in
            exit();
        endif; ?>
    </div>
    
</body>
</html>