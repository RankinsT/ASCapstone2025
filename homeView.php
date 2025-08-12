<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage</title>

    <link rel="stylesheet" href="./css/homeStyle.css"> <!-- Link to your home CSS file -->
    <link rel="stylesheet" href="./css/adminStyle.css"> <!-- Link to your admin CSS file -->

    <script src="https://cdn.tiny.cloud/1/a568yvdjcxzu2hhaiwp0fdun5rd6z9s4d51urh6m0lrpw0eu/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>

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
            <div class="reviews col-lg-7 col-md-6 col-sm-12">
                <?php include 'homeViewSections/reviews.php'; ?> <!-- Include the reviews section -->
            </div>
            <!-- div /reviews -->

            <form method="POST" class="form col-lg-4 col-md-6 col-sm-12">
                <?php include 'homeViewSections/form.php'; ?> <!-- Include the form section -->
            </form>
            <!-- div /form -->
        </div>
        
        <div class="row elements row-2" style="margin:20px;">
            <div class="companyDescription col-lg-4 col-md-6 col-sm-12">
                <?php include 'homeViewSections/companyDescription.php'; ?> <!-- Include the company description section -->
            </div>
            <!-- div /companyDescription -->

            <div class="carousel col-lg-7 col-md-7 col-sm-12" style="margin:20px; height: 450px;">
                <?php include 'homeViewSections/carousel.php'; ?> 
                <!-- Include the carousel section -->
            </div>
            <!-- div /carousel -->
        </div>
        
        <div class="row elements" style="margin:50px;">
            <div class="services col-lg-12 col-md-12 col-sm-12">
                <?php include 'homeViewSections/services.php'; ?> <!-- Include the services section -->
            </div>
            <!-- div /services -->  
        </div>
       

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