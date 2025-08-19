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
    include './models/php.php';

    if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) { ?>
    
    <!-- admin-header -->
     <div class="admin-header">
        <div class="homepageButton-customerSearch">
            <div class="homepageButton">
                <a href="adminView.php">Admin Page</a>
            </div>
        </div>

        <div class="logoutButton-updateAccountButton">
            <div class="logoutButton">
                <a href="loginView.php">Logout</a>
            </div>
        </div>
     </div>
    <?php } ?>
    <!-- end admin-header -->

    <!-- header -->
     <div class="header">
        <div class="header-img">
            <img src="images/LogoTemp.png" alt="logo" class="logo-img">
        </div>
        <div class="sticky-btn">
            <button type="button" class="phone-num-btn">
                <div>Call Now</div>
                <div><a href="tel:+1234567890">(234) 567-890</a></div>
            </button>
        </div>
     </div>
    <!-- end header -->
    

        <!-- review/form -->
        <div class="description-quote row elements row-1">
            <div class="description col-lg-6">
                <h1>Who are we?</h1>
                <p id="company-description-text">
                    NORCAL Pool Movers is a locally owned and operated small business based in Coventry, Connecticut, specializing in professional pool table moving, setup, and installation. We pride ourselves on delivering reliable, careful, and friendly service to ensure your pool table is transported and reassembled with the utmost care. Whether you’re relocating across town, setting up a new game room, or need expert leveling for the perfect play, we bring the tools, skill, and experience to get the job done right. As a small business, we value personal connections with our customers and go the extra mile to provide top-quality service at fair prices.
                </p>
                <form id="company-description-form" style="display:none;">
                    <textarea id="company-description-editor">Welcome to TinyMCE!</textarea>
                </form>
                <?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) { ?>
                    <button id="edit-save-btn" type="button">Edit</button>
                <?php } ?>
            </div>

            <div class="form col-lg-6">
                <form action="" method="POST">
                    <div class="quote-container quote-show">
                        <div>
                            <div><h2>Free Quote</h2></div>
                            <div><p>Get a free quote today!</p></div>
                        </div>
                        <div class="customer-info">
                            <div>
                                <div><input type="text" id="firstName" name="firstName" placeholder="First Name*" autocomplete="given-name" required></div>
                            </div>
                            <div>
                                <div><input type="text" id="lastName" name="lastName" placeholder="Last Name*" autocomplete="family-name" required></div>
                            </div>
                            <div><input type="email" id="email" name="email" placeholder="Email*" autocomplete="email" required></div>
                            <div><input type="tel" id="phone" name="phone" placeholder="Phone" autocomplete="tel"></div>
                        </div>
                        <div class="form-btns-container">
                            <div>
                                <!-- <button>previous</button> -->
                            </div>
                            <div>
                                <button type="button">next</button>
                            </div>
                        </div>
                        <div class="progression-bar">
                            <div>Progression bar</div>
                        </div>
                    </div>

                    <div class="quote-container quote-hide">
                        <div>
                            <div><h2>Free Quote</h2></div>
                            <div><p>Get a free quote today!</p></div>
                        </div>
                        <div class="customer-info">
                            <div>
                                <div><input type="text" id="street" name="street" placeholder="Street Address*" autocomplete="street-address" required></div>
                            </div>
                            <div><input type="text" id="unit" name="unit" placeholder="Unit/Apt" autocomplete="address-line2"></div>
                            <div>
                                <div><input type="text" id="city" name="city" placeholder="City*" autocomplete="address-level2" required></div>
                            </div>
                            <div>
                                <div><input type="text" id="state" name="state" placeholder="State*" autocomplete="address-level1" required></div>
                            </div>
                            <div>
                                <div><input type="text" id="zip" name="zip" placeholder="Zip Code*" autocomplete="postal-code" required></div>
                            </div>
                        </div>
                        <div class="form-btns-container">
                            <div>
                                <button type="button">previous</button>
                            </div>
                            <div>
                                <button type="button">next</button>
                            </div>
                        </div>
                        <div class="progression-bar">
                            <div>Progression bar</div>
                        </div>
                    </div>

                    <div class="quote-container quote-hide">
                        <div>
                            <div><h2>Free Quote</h2></div>
                            <div><p>Get a free quote today!</p></div>
                        </div>
                        <div class="customer-info">
                            <div>
                                <div>
                                    <select name="service-requested[]" id="service-requested" style="width:100%;" autocomplete="off" multiple>
                                        <option value="Felt Replacement & Repairs">1. Felt Replacement & Repairs</option>
                                        <option value="In-Home Relocation">2. In-Home Relocation</option>
                                        <option value="Long-Distance Moves">3. Long-Distance Moves</option>
                                        <option value="Residential & Commercial Pool Table Moving">4. Residential & Commercial Pool Table Moving</option>
                                        <option value="Slate Repair & Replacement">5. Slate Repair & Replacement</option>
                                        <option value="Assembly & Dismantle">6. Assembly & Dismantle</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <textarea id="notes" name="notes" placeholder="Additional Notes" autocomplete="off"></textarea>
                            </div>
                        </div>
                        <div class="form-btns-container">
                            <div>
                                <button class="previous-btn" type="button">previous</button>
                            </div>
                            <div>
                                <button class="send-btn" type="submit" name="send-btn">send</button>
                            </div>
                        </div>
                        <div class="progression-bar">
                            <div>Progression bar</div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end review/form -->

    <script src="javascript/script2.js"></script>
</body>
</html>