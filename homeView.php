<?php

include 'includes/header.php'; // Include the header file

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

<?php include 'footer.php'; ?> <!-- Include the footer file -->