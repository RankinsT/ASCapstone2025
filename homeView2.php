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
        <div>
            <button type="button" class="phone-num-btn">
                <div>Call Now</div>
                <div><a href="tel:+1234567890">(234) 567-890</a></div>
            </button>
        </div>
     </div>
    <!-- end header -->
    

        <!-- review/form -->
        <div class="review-quote">
            <div class="reviews" id="reviews" style="display: flex; flex-direction: column; flex: 1; max-width: 500px;">
                                <div id="review-text1" class="review-divs">
                                    <div style="display: flex; align-items: center; justify-content: space-between;">
                                        <p style="margin: 0; flex: 1;">
                                            “I was nervous about moving my 8-foot pool table, but this team made it completely stress-free. They arrived on time, handled everything with care, and had it set up perfectly in my new game room. Highly professional and efficient—definitely recommend them to anyone needing a pool table moved safely!”
                                        </p>
                                        <span class="review-stars" style="color: gold; font-size: 3em; margin-left: 16px;">★★★★★</span>
                                    </div>
                                    <form action="" id="review-form1" style="display: none;">
                                        <textarea name="" id="review-editor1"></textarea>
                                    </form>
                                    <?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) { ?>
                                        <button id="review-edit-save-btn1" type="button">Edit</button>
                                    <?php } ?>
                                </div>

                                <div id="review-text2" class="review-divs">
                                    <div style="display: flex; align-items: center; justify-content: space-between;">
                                        <p style="margin: 0; flex: 1;">
                                            “Great experience overall. The movers were friendly, careful, and worked quickly. My only minor issue was that the setup took a little longer than expected, but the job was done right, and my pool table arrived without a scratch. I would hire them again in a heartbeat.”
                                        </p>
                                        <span class="review-stars" style="color: gold; font-size: 3em; margin-left: 16px;">★★★★★</span>
                                    </div>
                                    <form action="" id="review-form2" style="display: none;">
                                        <textarea name="" id="review-editor2"></textarea>
                                    </form>
                                    <?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) { ?>
                                        <button id="review-edit-save-btn2" type="button">Edit</button>
                                    <?php } ?>
                                </div>

                                <div id="review-text3" class="review-divs">
                                    <div style="display: flex; align-items: center; justify-content: space-between;">
                                        <p style="margin: 0; flex: 1;">
                                            “Exceptional service from start to finish. The crew communicated clearly, protected all corners of my table, and navigated some tricky stairs without a problem. They even gave me tips for maintaining the table after the move. Worth every penny!”
                                        </p>
                                        <span class="review-stars" style="color: gold; font-size: 3em; margin-left: 16px;">★★★★★</span>
                                    </div>
                                    <form action="" id="review-form3" style="display: none;">
                                        <textarea name="" id="review-editor3"></textarea>
                                    </form>
                                    <?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) { ?>
                                        <button id="review-edit-save-btn3" type="button">Edit</button>
                                    <?php } ?>
                                </div>
            </div>

            <div class="form">
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