<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>

    <link rel="stylesheet" href="./css/homeStyle.css"> <!-- Link to your home CSS file -->
    <link rel="stylesheet" href="./css/adminStyle.css"> <!-- Link to your admin CSS file -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=arrow_back_ios" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.tiny.cloud/1/a568yvdjcxzu2hhaiwp0fdun5rd6z9s4d51urh6m0lrpw0eu/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

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
                    <a href="adminView.php">Admin Page</a>
                </div>
                <!-- <div class="homepageButton">
                    <button class="edit-homepage-button">
                        Edit
                    </button>
                </div> -->
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
    <div class="header">
        <?php include 'homeViewSections/header.php'; ?> <!-- Include the header section -->
    </div>
    <div class="grid-container">

        

        
        <!-- div /header -->
        <div class="row elements row-1">
            <div class="reviews col-lg-6">
                <?php include 'homeViewSections/reviews.php'; ?> <!-- Include the reviews section -->
            </div>
            <!-- div /reviews -->

            <form method="POST" class="form col-lg-6 col-md-6 col-sm-12">
                <?php include 'homeViewSections/form.php'; ?> <!-- Include the form section -->
            </form>
            <!-- div /form -->
        </div>
        
        <div class="row elements row-4">
            <div class="companyDescription col-lg-4">
                <?php include 'homeViewSections/companyDescription.php'; ?> <!-- Include the company description section -->
            </div>
            <!-- div /companyDescription -->

            <div class="main-carousel-div col-lg-8">
                <div>
                    <?php include 'homeViewSections/carousel2.php'; ?>
                </div>
                <!-- Include the carousel section -->
            </div>
            <!-- div /carousel -->
        </div>
        
        <div class="row elements row-3 col-lg-12">
            <div class="services">
                <?php include 'homeViewSections/services.php'; ?> <!-- Include the services section -->
            </div>
            <!-- div /services -->  
        </div>

        <div class="row elements row-4">
            <div class="locations">
                <?php include 'homeViewSections/locations.php'; ?> <!-- Include the locations section -->
            </div>
            <!-- div /locations -->

        <footer class="row elements row-5">
            <?php include 'homeViewSections/footer.php'; ?> <!-- Include the footer section -->
        </footer>

    </div>
    <!-- div /grid-container -->


    
</body>
</html>