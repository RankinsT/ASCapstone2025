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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php
    session_start();
    include './models/model_admin.php'; // Include the model file
    include './models/php.php';
    // Fetch company description with ID 1
    $companyDescription = getTextBox(1);
    $firstService = getTextBox(2);
    $secondService = getTextBox(3);
    $thirdService = getTextBox(4);
    $fourthService = getTextBox(5);
    $fifthService = getTextBox(6);
    $sixthService = getTextBox(7);
    $contactInfo = getPhoneNumber(1);

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
                <div><a href="tel:<?= htmlspecialchars($contactInfo) ?? 'Phone number not available.' ?>"><?= htmlspecialchars(formatPhoneNumber($contactInfo)) ?? 'Phone number not available.' ?></a></div>
            </button>
        </div>
     </div>
    <!-- end header -->
    

    <!-- review/form -->
    <div class="description-quote row elements row-1">
        <div class="description col-lg-6">
            <div class="title">Who are we?</div>
            <div id="company-description-text" class="text">
                <?= $companyDescription['textBox'] ?? 'Description not available.' ?>
            </div>
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
                    <div class="rotated">
                        <div>Get your<br> <span style="font-weight: bold;">FREE</span><br> estimate</div>
                        <div></div>
                    </div>
                    
                    <div class="form-btns-container">
                        <div>
                            <!-- <button>previous</button> -->
                        </div>
                        <div class="get-started-btn">
                            <button type="button" class="next-btn">Get Started</button>
                            <a href="privacyPolicy.php" class="outlined-text">Privacy Policy</a>
                        </div>
                    </div>
                                                                <!-- Custom Progress Bar with Balls -->
                                                                <div class="progression-bar-balls">
                                                                    <div class="progress-bar-track">
                                                                        <div class="progress-ball" data-step="0"><span>1</span></div>
                                                                        <div class="progress-bar-line"></div>
                                                                        <div class="progress-ball" data-step="1"><span>2</span></div>
                                                                        <div class="progress-bar-line"></div>
                                                                        <div class="progress-ball" data-step="2"><span>3</span></div>
                                                                        <div class="progress-bar-line"></div>
                                                                        <div class="progress-ball" data-step="3"><span>4</span></div>
                                                                    </div>
                                                                </div>
                </div>

                <div class="quote-container quote-show" style="background-image: url('images/balls2.png'); background-size: cover; background-position: center; border:none; background-color: transparent; box-shadow: none; color: white;">
                    <div>
                        <div><h2 class="outlined-text">Get a free quote today!</h2></div>
                        <div><p class="outlined-text">Fill out the form below to get started.</p></div>
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
                                                                <!-- Custom Progress Bar with Balls -->
                                                                <div class="progression-bar-balls">
                                                                    <div class="progress-bar-track">
                                                                        <div class="progress-ball" data-step="0"><span>1</span></div>
                                                                        <div class="progress-bar-line"></div>
                                                                        <div class="progress-ball" data-step="1"><span>2</span></div>
                                                                        <div class="progress-bar-line"></div>
                                                                        <div class="progress-ball" data-step="2"><span>3</span></div>
                                                                        <div class="progress-bar-line"></div>
                                                                        <div class="progress-ball" data-step="3"><span>4</span></div>
                                                                    </div>
                                                                </div>
                </div>

                <div class="quote-container quote-hide" style="background-image: url('images/balls2.png'); background-size: cover; background-position: center; border:none; background-color: transparent; box-shadow: none; color: white;">
                    <div>
                        <div><h2 class="outlined-text">Get a free quote today!</h2></div>
                        <div><p class="outlined-text">Fill out the form below to get started.</p></div>
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
                                        <div class="progression-bar-balls">
                                            <div class="progress-bar-track">
                                                <div class="progress-ball" data-step="0"><span>1</span></div>
                                                <div class="progress-bar-line"></div>
                                                <div class="progress-ball" data-step="1"><span>2</span></div>
                                                <div class="progress-bar-line"></div>
                                                <div class="progress-ball" data-step="2"><span>3</span></div>
                                                <div class="progress-bar-line"></div>
                                                <div class="progress-ball" data-step="3"><span>4</span></div>
                                            </div>
                                        </div>
                </div>

                <div class="quote-container quote-hide" style="background-image: url('images/balls2.png'); background-size: cover; background-position: center; border:none; background-color: transparent; box-shadow: none; color: white;">
                    <div>
                        <div><h2 class="outlined-text">Get a free quote today!</h2></div>
                        <div><p class="outlined-text">Fill out the form below to get started.</p></div>
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
                            <button type="button">previous</button>
                        </div>
                        <div>
                            <button class="send-btn" type="submit" name="send-btn">send</button>
                        </div>
                    </div>
                                        <div class="progression-bar-balls">
                                            <div class="progress-bar-track">
                                                <div class="progress-ball" data-step="0"><span>1</span></div>
                                                <div class="progress-bar-line"></div>
                                                <div class="progress-ball" data-step="1"><span>2</span></div>
                                                <div class="progress-bar-line"></div>
                                                <div class="progress-ball" data-step="2"><span>3</span></div>
                                                <div class="progress-bar-line"></div>
                                                <div class="progress-ball" data-step="3"><span>4</span></div>
                                            </div>
                                        </div>
                </div>
            </form>
        </div>
    </div>
    <!-- end review/form -->

<!-- carousel -->
<?php
try {
    $stmt = $db->query("SELECT * FROM bcimage ORDER BY id ASC");
    $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<h3>Error fetching images: " . htmlspecialchars($e->getMessage()) . "</h3>";
    $images = [];
}
?>



<div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="6000">
  <div class="carousel-inner">
    <?php if (!empty($images)): ?>
      <?php foreach ($images as $index => $image): ?>
        <div class="carousel-item styl <?php echo $index === 0 ? 'active' : ''; ?>">
          <img
            src="./bcimage/<?php echo htmlspecialchars($image['filename']); ?>"
            class="d-block w-100 carousel-img"
            alt="Slide <?php echo $index + 1; ?>"
            loading="lazy"
          >

          <!-- Desktop caption (overlay, your original layout) -->
            <div class="carousel-caption cap-desktop d-none d-md-block">
                <div class="cap-text">
                    <?php echo htmlspecialchars($image['description']); ?><br>
                    <span class="review-stars">★★★★★</span>
                </div>
            </div>

          <!-- Mobile caption (visible on < md) -->
          <div class="cap-mobile d-block d-md-none">
            <div class="cap-text">
              <?php echo htmlspecialchars($image['description']); ?>
            </div>
            <div class="review-stars">★★★★★</div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="carousel-item active">
        <div class="d-flex justify-content-center align-items-center" style="height: 25em; background-color:rgb(46, 138, 230); border-radius: 20px;">
          <h5 class="text-white m-0">No images available</h5>
        </div>
      </div>
    <?php endif; ?>
  </div>

  <!-- Indicators -->
  <div class="carousel-indicators">
    <?php foreach ($images as $index => $image): ?>
      <button type="button" data-bs-target="#carouselExample"
              data-bs-slide-to="<?php echo $index; ?>"
              class="<?php echo $index === 0 ? 'active' : ''; ?>"
              aria-label="Slide <?php echo $index + 1; ?>"></button>
    <?php endforeach; ?>
  </div>

  <!-- Controls -->
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: drop-shadow(0 0 3px rgba(0,0,0,.74));"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true" style="filter: drop-shadow(0 0 3px rgba(0,0,0,.74));"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<!-- end carousel -->

        <?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) { ?>
                    <div style="text-align:center; margin: 1.5em 0;">
                                <form action="upload.php" method="get" style="display:inline-block;">
                                    <button type="submit" class="edit-save-title-btn">Edit Carousel</button>
                                </form>
                    </div>
        <?php } ?>
        <!-- services -->
            <!-- services -->
            <div class="services-section col-lg-12" style="margin-top: 3em;">
                <div class="title" style="font-size:3em; font-weight:800; text-align:center; margin-bottom:1em;">Our Services</div>
                <div class="services-intro text" style="text-align:center; color:white; margin-bottom:2em; font-size:1.1em;">Professional pool table moving, repair, and installation. Explore what we offer below!</div>
                <div class="services-cards row justify-content-center" style="gap:2em;">
                    <?php
                    $services = [
                        [
                            'icon' => '<svg width="48" height="48" viewBox="0 0 80 80" fill="none"><rect x="16" y="32" width="48" height="32" rx="8" fill="white" stroke="#222c2c" stroke-width="3"/><rect x="26" y="20" width="28" height="16" rx="5" fill="white" stroke="#222c2c" stroke-width="2"/><rect x="36" y="44" width="8" height="12" fill="#222c2c"/></svg>',
                            'title' => $firstService['section'] ?? 'Service Title Not Available',
                            'desc' => $firstService['textBox'] ?? 'Description not available.',
                            'titleId' => 'service-title-1',
                            'descId' => 'service-desc-1',
                            'titleInputId' => 'service-title-input-1',
                            'descFormId' => 'service-desc-form-1',
                            'descEditorId' => 'service-desc-editor-1',
                            'editTitleBtnId' => 'edit-save-title-btn-1',
                            'editDescBtnId' => 'edit-save-desc-btn-1',
                        ],
                        [
                            'icon' => '<svg width="48" height="48" viewBox="0 0 80 80" fill="none"><polygon points="40,16 16,40 64,40" fill="white" stroke="#222c2c" stroke-width="3"/><rect x="24" y="40" width="32" height="24" fill="white" stroke="#222c2c" stroke-width="2"/><rect x="36" y="52" width="8" height="12" fill="#222c2c"/></svg>',
                            'title' => $secondService['section'] ?? 'Service Title Not Available',
                            'desc' => $secondService['textBox'] ?? 'Description not available.',
                            'titleId' => 'service-title-2',
                            'descId' => 'service-desc-2',
                            'titleInputId' => 'service-title-input-2',
                            'descFormId' => 'service-desc-form-2',
                            'descEditorId' => 'service-desc-editor-2',
                            'editTitleBtnId' => 'edit-save-title-btn-2',
                            'editDescBtnId' => 'edit-save-desc-btn-2',
                        ],
                        [
                            'icon' => '<svg width="48" height="48" viewBox="0 0 80 80" fill="none"><rect x="12" y="40" width="36" height="20" rx="4" fill="white" stroke="#222c2c" stroke-width="3"/><rect x="48" y="48" width="16" height="12" rx="2" fill="white" stroke="#222c2c" stroke-width="2"/><circle cx="24" cy="64" r="6" fill="white" stroke="#222c2c" stroke-width="2"/><circle cx="56" cy="64" r="6" fill="white" stroke="#222c2c" stroke-width="2"/></svg>',
                            'title' => $thirdService['section'] ?? 'Service Title Not Available',
                            'desc' => $thirdService['textBox'] ?? 'Description not available.',
                            'titleId' => 'service-title-3',
                            'descId' => 'service-desc-3',
                            'titleInputId' => 'service-title-input-3',
                            'descFormId' => 'service-desc-form-3',
                            'descEditorId' => 'service-desc-editor-3',
                            'editTitleBtnId' => 'edit-save-title-btn-3',
                            'editDescBtnId' => 'edit-save-desc-btn-3',
                        ],
                        [
                            'icon' => '<svg width="48" height="48" viewBox="0 0 80 80" fill="none"><rect x="20" y="24" width="40" height="32" fill="white" stroke="#222c2c" stroke-width="3"/><rect x="28" y="44" width="8" height="12" fill="#222c2c"/><rect x="44" y="44" width="8" height="12" fill="#222c2c"/><rect x="36" y="32" width="8" height="8" fill="#222c2c"/></svg>',
                            'title' => $fourthService['section'] ?? 'Service Title Not Available',
                            'desc' => $fourthService['textBox'] ?? 'Description not available.',
                            'titleId' => 'service-title-4',
                            'descId' => 'service-desc-4',
                            'titleInputId' => 'service-title-input-4',
                            'descFormId' => 'service-desc-form-4',
                            'descEditorId' => 'service-desc-editor-4',
                            'editTitleBtnId' => 'edit-save-title-btn-4',
                            'editDescBtnId' => 'edit-save-desc-btn-4',
                        ],
                        [
                            'icon' => '<svg width="48" height="48" viewBox="0 0 80 80" fill="none"><rect x="36" y="48" width="8" height="20" fill="white" stroke="#222c2c" stroke-width="2"/><rect x="24" y="24" width="32" height="10" rx="5" fill="white" stroke="#222c2c" stroke-width="3"/></svg>',
                            'title' => $fifthService['section'] ?? 'Service Title Not Available',
                            'desc' => $fifthService['textBox'] ?? 'Description not available.',
                            'titleId' => 'service-title-5',
                            'descId' => 'service-desc-5',
                            'titleInputId' => 'service-title-input-5',
                            'descFormId' => 'service-desc-form-5',
                            'descEditorId' => 'service-desc-editor-5',
                            'editTitleBtnId' => 'edit-save-title-btn-5',
                            'editDescBtnId' => 'edit-save-desc-btn-5',
                        ],
                        [
                            'icon' => '<svg width="48" height="48" viewBox="0 0 80 80" fill="none"><rect x="38" y="20" width="4" height="28" fill="white" stroke="#222c2c" stroke-width="2"/><polygon points="40,48 34,60 46,60" fill="white" stroke="#222c2c" stroke-width="2"/></svg>',
                            'title' => $sixthService['section'] ?? 'Service Title Not Available',
                            'desc' => $sixthService['textBox'] ?? 'Description not available.',
                            'titleId' => 'service-title-6',
                            'descId' => 'service-desc-6',
                            'titleInputId' => 'service-title-input-6',
                            'descFormId' => 'service-desc-form-6',
                            'descEditorId' => 'service-desc-editor-6',
                            'editTitleBtnId' => 'edit-save-title-btn-6',
                            'editDescBtnId' => 'edit-save-desc-btn-6',
                        ],
                    ];
                    foreach ($services as $i => $service) {
                    ?>
                    <div class="service-card col-md-4 col-sm-6 col-12" style="background: #fff; border-radius: 18px; box-shadow: 0 4px 16px rgba(46,138,230,0.10); padding:2em 1.5em; margin-bottom:2em; transition: box-shadow 0.2s; min-height: 320px; display: flex; flex-direction: column; align-items: center; justify-content: flex-start; position:relative;">
                        <div class="service-icon" style="margin-bottom:1em;"><?= $service['icon'] ?></div>
                        <div class="service-title-group" style="width:100%; text-align:center;">
                            <span id="<?= $service['titleId'] ?>" class="service-title" style="font-size:2em; font-weight:700; color:#00a19a;"><?= htmlspecialchars($service['title']) ?></span>
                            <input id="<?= $service['titleInputId'] ?>" class="service-title-input" type="text" style="display:none; width:100%; margin-top:0.5em;" value="<?= htmlspecialchars($service['title']) ?>">
                            <?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) { ?>
                                <button id="<?= $service['editTitleBtnId'] ?>" type="button" class="edit-save-title-btn" style="margin-top:0.5em;">Edit</button>
                            <?php } ?>
                        </div>
                        <div class="service-text-group" style="width:100%; display:flex; flex-direction:column; align-items:center; margin-top:1em; font-family: "Roboto", regular;">
                            <span id="<?= $service['descId'] ?>" class="service-text text" style="color:#222c2c; font-size:1.25em; text-align:center; max-width:90%;">
                                <?= $service['desc'] ?>
                            </span>
                            <form id="<?= $service['descFormId'] ?>" style="display:none; width:100%;"><textarea id="<?= $service['descEditorId'] ?>" style="width:100%;"></textarea></form>
                            <?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) { ?>
                                <button id="<?= $service['editDescBtnId'] ?>" type="button" class="edit-save-desc-btn" style="margin-top:0.5em;">Edit</button>
                            <?php } ?>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <!-- end services -->
            <style>
                .service-card:hover {
                    box-shadow: 0 8px 32px rgba(46,138,230,0.18);
                    transform: translateY(-4px);
                }
                @media (max-width: 768px) {
                    .services-cards {
                        gap: 1em !important;
                    }
                    .service-card {
                        min-height: 260px;
                        padding: 1.2em 0.7em;
                    }
                }
                @media (max-width: 576px) {
                    .service-card {
                        min-height: 180px;
                        padding: 0.7em 0.2em;
                    }
                    .services-section .title {
                        font-size: 1.3em !important;
                    }
                }
            </style>

            <div style="text-align:center; margin: 2em 0;">
                <a href="#" onclick="document.querySelector('.form').scrollIntoView({behavior: 'smooth'}); return false;" class="edit-save-title-btn" style="display:inline-block; background:#00897b;">Get a Free Quote</a>
            </div>

    <!-- footer -->
    <div class="home-footer">
        <hr style="border: 5px solid white">
        <hr style="border: 5px solid white">
        <div class="contact-info">
            <div class="header-img">
                <img src="images/LogoTemp.png" alt="logo" class="logo-img">
            </div>
            <div><a href="tel:<?= htmlspecialchars($contactInfo) ?? 'Phone number not available.' ?>"><span style="color: white; font-weight: bold;">CONTACT: </span><?= htmlspecialchars(formatPhoneNumber($contactInfo)) ?? 'Phone number not available.' ?></a></div>
            <div><a href="loginView.php">Admin Login</a></div>
            
        </div>
        <hr style="border: 5px solid white">
    <div class="footer-content">
        <p>&copy; 2025 NORCAL Pool Movers. All rights reserved.</p>
        <!-- link to top -->
        <div class="back-to-top">
            <a href="#top" style="color: white; text-decoration: underline;">Back to Top</a>
        </div>
        <div>
             <a href="index.html" style="color: white; text-decoration: underline;">Code Review</a>
        </div>
        
    </div>
    </div>
    <!-- end footer -->
    <script src="javascript/script2.js"></script>
</body>
</html>