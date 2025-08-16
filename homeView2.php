<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomePage 2</title>

    <link rel="stylesheet" href="css/homeStyle2.css">
    <link rel="stylesheet" href="css/adminStyle.css">

    <!-- carousel stuff -->
     <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=arrow_back_ios" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- bootstrap -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

     <!-- tinymce -->
      <script src="https://cdn.tiny.cloud/1/a568yvdjcxzu2hhaiwp0fdun5rd6z9s4d51urh6m0lrpw0eu/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
</head>
<body>
    <?php 
    
    session_start();
    include './models/model_admin.php';

    // if user is logged in 
    if(isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']): ?> 
    
    <!-- admin header  -->
     <div class="admin-header">
        <div class="homepageButton-customerSearch">
            <div class="homepageButton">
                <a href="adminView.php">Admin Page</a>
            </div>
            <div class="logoutButton-updateAccountButton">
                <div class="logoutButton">
                    <a href="loginView.php">Logout</a>
                </div>
            </div>
        </div>
     </div>

    <?php endif; ?>

    <!-- header -->

    <div class="header-container">
        
        <div class="header-img">

            <img src="images/LogoTemp.png" alt="logo" class="logo-img">
        </div>

        <div>
            <button type="button" class="phone-num-btn">
                <p>Call Now!</p>
                <p><a href="tel:508-717-1249">508-717-1249</a></p>
            </button>
        </div>

    </div>

</body>
</html>