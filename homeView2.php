<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage 2</title>

    <link rel="stylesheet" href="./css/homeStyle2.css"> <!-- Link to your home CSS file -->
    <link rel="stylesheet" href="./css/adminStyle.css"> <!-- Link to your admin CSS file -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=arrow_back_ios" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <script src="https://cdn.tiny.cloud/1/a568yvdjcxzu2hhaiwp0fdun5rd6z9s4d51urh6m0lrpw0eu/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body>
    <?php
    session_start();
    include './models/model_admin.php'; // Include the model file

    if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) { ?>
    
    <!-- admin-header -->
     <div class="admin-header">
        <div class="homepageButton-customerSearch">
            <div class="homepageButton">
                <a href="adminView.php">Admin Page</a>
            </div>
        </div>

        <div class="logoutButton-updateAccountButton">
            <div class="logoutButton">
                <a href="logingView.php">Logout</a>
            </div>
        </div>
     </div>
    <!-- end admin-header -->

    <!-- header -->
     <div class="header">
        <div class="header-img">
            <img src="images/LogoTemp.png" alt="logo" class="logo-img">
        </div>
        <div>
            <button type="button" class="phone-num-btn">
                <div>Call Now</div>
                <div><a href="tel:+1234567890">(234) 567-890</a></div>
            </button>
        </div>
     </div>
     <!-- end header -->
    <?php }?>
    <script src="javascript/script2.js"></script>
</body>
</html>