<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>

    <link rel="stylesheet" href="./css/homeStyle.css"> <!-- Link to your home CSS file -->
    <link rel="stylesheet" href="./css/adminStyle.css"> <!-- Link to your admin CSS file -->
</head>
<body>
    <?php
    session_start(); // Start the session
    if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) {
        // User is logged in, you can access admin features
        ?>
        <div class="admin-header">
            <div class="homepageButton-customerSearch">
                <div class="homepageButton">
                    <a href="homeView.php">Homepage</a>
                </div>
                <div class="homepageButton">
                    <a href="">Edit</a>
                </div>
            </div>

            <div class="logoutButton-updateAccountButton">
                <div class="logoutButton">
                    <a href="loginView.php">Logout</a>
                </div>
            </div>
        </div>
    <?php }
    
    include './models/model_admin.php'; // Include the model file

    ?>
    <!-- Your home view content goes here -->

    <div class="grid-container">

        

        <div class="header">
            <?php include 'homeViewSections/header.php'; ?> <!-- Include the header section -->
        </div>
        <!-- div /header -->

        <div class="reviews">
            <?php include 'homeViewSections/reviews.php'; ?> <!-- Include the reviews section -->
        </div>
        <!-- div /reviews -->

        <div class="form">
            <?php include 'homeViewSections/form.php'; ?> <!-- Include the form section -->
        </div>
        <!-- div /form -->

        <div class="companyDescription">
            <?php include 'homeViewSections/companyDescription.php'; ?> <!-- Include the company description section -->
        </div>
        <!-- div /companyDescription -->

        <div class="carousel">
            <?php include 'homeViewSections/carousel.php'; ?> <!-- Include the carousel section -->
        </div>
        <!-- div /carousel -->

        <div class="services">
            <?php include 'homeViewSections/services.php'; ?> <!-- Include the services section -->
        </div>
        <!-- div /services -->

        <div class="locations">
            <?php include 'homeViewSections/locations.php'; ?> <!-- Include the locations section -->
        </div>
        <!-- div /locations -->

        <div class="map">
            <?php include 'homeViewSections/map.php'; ?> <!-- Include the map section -->
        </div>
        <!-- div /map -->

        <div class="footer">
            <?php include 'homeViewSections/footer.php'; ?> <!-- Include the footer section -->
        </div>
        <!-- div /footer -->

    </div>
    <!-- div /grid-container -->


    
</body>
</html>