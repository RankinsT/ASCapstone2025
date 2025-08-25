<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage 2</title>

    <link rel="stylesheet" href="./css/homeStyle2.css"> <!-- Link to your home CSS file -->
    <link rel="stylesheet" href="./css/adminStyle.css"> <!-- Link to your admin CSS file -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
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
                <div><a href="tel:+1234567890">(234) 567-8901</a></div>
            </button>
        </div>
     </div>
    <!-- end header -->
    

    <!-- review/form -->
    <div class="description-quote row elements row-1">
        <div class="description col-lg-6">
            <div class="title">Who are we?</div>
            <p id="company-description-text" class="text">
                NORCAL Pool Movers is a locally owned and operated small business based in Coventry, Connecticut, specializing in professional pool table moving, setup, and installation. We pride ourselves on delivering reliable, careful, and friendly service to ensure your pool table is transported and reassembled with the utmost care. Whether you’re relocating across town, setting up a new game room, or need expert leveling for the perfect play, we bring the tools, skill, and experience to get the job done right. As a small business, we value personal connections with our customers and go the extra mile to provide top-quality service at fair prices.
            </p>
            <form id="company-description-form" style="display:none;">
                <textarea id="company-description-editor">Welcome to TinyMCE!</textarea>
            </form>
            <?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) { ?>
                <button id="edit-save-btn" type="button">Edit</button>
            <?php } ?>
        </div>
                <!-- form -->
        <div class="form col-lg-6">
            <form action="" method="POST">

                <div class="quote-container quote-show starting-page" style="background-image: url('images/balls2.png'); background-size: cover; background-position: center; border:none; background-color: transparent; box-shadow: none; color: white;">
                    <div>
                        <div><h2>Free Quote</h2></div>
                        <div><p>Get a free quote today!</p></div>
                    </div>
                    
                    <div class="form-btns-container">
                        <div>
                            <!-- <button>previous</button> -->
                        </div>
                        <div class="get-started-btn">
                            <button type="button">Get Started</button>
                            <a href="">Privacy Policy</a>
                        </div>
                    </div>
                                                                <!-- Progress Bar Example -->
                                                                <div class="progression-bar">
                                                                    <div class="progression-bar-fill" style="width: 33%;"></div>
                                                                </div>
                </div>

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
                                                                <!-- Progress Bar Example -->
                                                                <div class="progression-bar">
                                                                    <div class="progression-bar-fill" style="width: 33%;"></div>
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
                                            <div class="progression-bar-fill" style="width: 66%;"></div>
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
                                            <div class="progression-bar-fill" style="width: 100%;"></div>
                                        </div>
                </div>
            </form>
        </div>
    </div>
    <!-- end review/form -->

    <!-- carousel -->
     <?php

    try {
        // Fetch all images from the database
        $query = "SELECT * FROM bcimage ORDER BY id ASC";
        $stmt = $db->query($query);
        $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "<h3>Error fetching images: " . $e->getMessage() . "</h3>";
        $images = [];
    }
    ?>


    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="6000">
    <div class="carousel-inner">
        <?php if (!empty($images)): ?>
            <?php foreach ($images as $index => $image): ?>
                <div class="carousel-item styl <?php echo $index === 0 ? 'active' : ''; ?>">
                    <img src="./bcimage/<?php echo htmlspecialchars($image['filename']); ?>" class="d-block w-100" alt="Slide <?php echo $index + 1; ?>" style="height: 780px; object-fit: cover; border-radius: 20px;">
                    <div class="carousel-caption d-none d-md-block" style=" top: 50%; bottom: 0; left: 0; right: 0; background: linear-gradient(to bottom, rgba(0, 0, 0, 0), rgba(0, 0, 0, 1)); padding: 10px; border-radius: 0;">
                        <div class="text-start d-flex align-items-start" style="position: absolute; bottom: 20px; left: 20px; padding: 20px; border-radius: 10px; width: calc(70% - 60px); flex-direction: row;">
                            <div style="margin-bottom: 10px; width: 500px;"><?php echo htmlspecialchars($image['description']); ?><br><span class="review-stars" style="color: gold; font-size: 3em;">★★★★★</span></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="carousel-item active">
                <div class="d-flex justify-content-center align-items-center" style="height: 25em; background-color:rgb(46, 138, 230);">
                    <h5>No images available</h5>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <!-- Carousel Indicators -->
    <div class="carousel-indicators">
        <?php foreach ($images as $index => $image): ?>
            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="<?php echo $index; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>" aria-label="Slide <?php echo $index + 1; ?>"></button>
        <?php endforeach; ?>
    </div>
    <!-- Carousel Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: drop-shadow(0px 0px 3px rgba(0, 0, 0, 0.74));"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next" style="filter: drop-shadow(0px 0px 3px rgba(0, 0, 0, 0.74));">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
    <!-- end carousel -->

    <!-- services -->
     <div class="services col-lg-12">
        <div class="title">Services</div>
     </div>
     <div class="pool-table">
        <div class="table-rows">
                        <div class="table-row-section">
                                <div class="service-emblem">
                                    <!-- Improved Toolbox Icon -->
                                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none">
                                        <rect x="16" y="32" width="48" height="32" rx="8" fill="white" stroke="#222c2c" stroke-width="3"/>
                                        <rect x="26" y="20" width="28" height="16" rx="5" fill="white" stroke="#222c2c" stroke-width="2"/>
                                        <rect x="36" y="44" width="8" height="12" fill="#222c2c"/>
                                    </svg>
                                </div>
                                <div class="service-title">Felt Replacement & Repairs</div>
                                <div class="service-text text"> <p>Re-covering in a variety of colors, repairing small tears, and tightening rails.</p></div>
                        </div>
                        <div class="table-row-section">
                                <div class="service-emblem">
                                    <!-- Improved House Icon -->
                                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none">
                                        <polygon points="40,16 16,40 64,40" fill="white" stroke="#222c2c" stroke-width="3"/>
                                        <rect x="24" y="40" width="32" height="24" fill="white" stroke="#222c2c" stroke-width="2"/>
                                        <rect x="36" y="52" width="8" height="12" fill="#222c2c"/>
                                    </svg>
                                </div>
                                <div class="service-title">In-Home Relocation</div>
                                <div class="service-text text"><p>Shifting your table to a new room or basement without leaving the property.</p></div>
                        </div>
                        <div class="table-row-section">
                                <div class="service-emblem">
                                    <!-- Improved Box Truck Icon -->
                                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none">
                                        <rect x="12" y="40" width="36" height="20" rx="4" fill="white" stroke="#222c2c" stroke-width="3"/>
                                        <rect x="48" y="48" width="16" height="12" rx="2" fill="white" stroke="#222c2c" stroke-width="2"/>
                                        <circle cx="24" cy="64" r="6" fill="white" stroke="#222c2c" stroke-width="2"/>
                                        <circle cx="56" cy="64" r="6" fill="white" stroke="#222c2c" stroke-width="2"/>
                                    </svg>
                                </div>
                                <div class="service-title">Long-Distance Moves</div>
                                <div class="service-text text"><p>Secure transport across states with full insurance coverage</p></div>
                        </div>
        </div>
        <div class="table-rows">
                        <div class="table-row-section">
                                <div class="service-emblem">
                                    <!-- Improved Commercial Building Icon -->
                                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none">
                                        <rect x="20" y="24" width="40" height="32" fill="white" stroke="#222c2c" stroke-width="3"/>
                                        <rect x="28" y="44" width="8" height="12" fill="#222c2c"/>
                                        <rect x="44" y="44" width="8" height="12" fill="#222c2c"/>
                                        <rect x="36" y="32" width="8" height="8" fill="#222c2c"/>
                                    </svg>
                                </div>
                                <div class="service-title">Residential & Commercial  Pool Table Moving</div>
                                <div class="service-text text"><p>Moving tables for bars, clubs, rec centers, apartment complexs and event spaces.</p></div>
                        </div>
                        <div class="table-row-section">
                                <div class="service-emblem">
                                    <!-- Improved Hammer Icon -->
                                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none">
                                        <rect x="36" y="48" width="8" height="20" fill="white" stroke="#222c2c" stroke-width="2"/>
                                        <rect x="24" y="24" width="32" height="10" rx="5" fill="white" stroke="#222c2c" stroke-width="3"/>
                                    </svg>
                                </div>
                                <div class="service-title">Slate Repair & Replacement</div>
                                <div class="service-text text"><p>Handling cracked or damaged slate </p></div>
                        </div>
                        <div class="table-row-section">
                                <div class="service-emblem">
                                    <!-- Improved Screwdriver Icon -->
                                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none">
                                        <rect x="38" y="20" width="4" height="28" fill="white" stroke="#222c2c" stroke-width="2"/>
                                        <polygon points="40,48 34,60 46,60" fill="white" stroke="#222c2c" stroke-width="2"/>
                                    </svg>
                                </div>
                                <div class="service-title">Assembly & Dismantle</div>
                                <div class="service-text text"><p>Disassembly, transport, and reassembly of all table sizes, including slate tables.</p></div>
            </div>
        </div>
     </div>
    <!-- end services -->

    <!-- footer -->
    <div class="home-footer">
        <hr style="border: 5px solid white">
        <hr style="border: 5px solid white">
        <div class="contact-info">
            <div class="header-img">
                <img src="images/LogoTemp.png" alt="logo" class="logo-img">
            </div>
            <div><a href="tel:+1234567890"><span style="color: white; font-weight: bold;">CONTACT: </span>234.567.8901</a></div>
            <div><a href="loginView.php">Admin Login</a></div>
        </div>
        <hr style="border: 5px solid white">
        <div class="footer-content">
            <p>&copy; 2025 NORCAL Pool Movers. All rights reserved.</p>
            <!-- link to top -->
            <div class="back-to-top">
                <a href="#top" style="color: white; text-decoration: underline;">Back to Top</a>
            </div>
        </div>
    </div>
    <!-- end footer -->
    <script src="javascript/script2.js"></script>
</body>
</html>