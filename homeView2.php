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

    <div class="header">
        
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

    <!-- row 1 -->

    <div class="row elements row-1">
        <div id="reviews col-lg-6">
            <div id="review-text1" class="review-divs">“I was nervous about moving my 8-foot pool table, but this team made it completely stress-free. They arrived on time, handled everything with care, and had it set up perfectly in my new game room. Highly professional and efficient—definitely recommend them to anyone needing a pool table moved safely!”</div><div><span class="review-stars" style="color: gold; font-size: 3em; margin-left: 20px;">★★★★★</span></div>
            <form action="" id="review-form1" style="display:none;">
                <textarea id="review-editor1">Welcome to TinyMCE!</textarea>
            </form>
            <?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) { ?>
                <button id="review-edit-save-btn1" type="button">Edit</button>
            <?php } ?>
            </div>

            <div id="review2">
            <div id="review-text2" class="review-divs">“Great experience overall. The movers were friendly, careful, and worked quickly. My only minor issue was that the setup took a little longer than expected, but the job was done right, and my pool table arrived without a scratch. I would hire them again in a heartbeat.”</div><div><span class="review-stars" style="color: gold; font-size: 3em; margin-left: 20px;">★★★★★</span></div>
            <form action="" id="review-form2" style="display:none;">
                <textarea id="review-editor2">Welcome to TinyMCE!</textarea>
            </form>
            <?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) { ?>
                <button id="review-edit-save-btn2" type="button">Edit</button>
            <?php } ?>
            </div>

            <div id="review3">
            <div id="review-text3" class="review-divs">“Exceptional service from start to finish. The crew communicated clearly, protected all corners of my table, and navigated some tricky stairs without a problem. They even gave me tips for maintaining the table after the move. Worth every penny!”</div><div><span class="review-stars" style="color: gold; font-size: 3em; margin-left: 20px;">★★★★★</span></div>
            <form action="" id="review-form3" style="display:none;">
                <textarea id="review-editor3">Welcome to TinyMCE!</textarea>
            </form>
            <?php if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']) { ?>
                <button id="review-edit-save-btn3" type="button">Edit</button>
            <?php } ?>
            </div>

            <script>
            document.addEventListener('DOMContentLoaded', function() {
            for (let i = 1; i <= 3; i++) {
                initEditableSection({
                editButtonId: `review-edit-save-btn${i}`,
                textElementId: `review-text${i}`,
                formId: `review-form${i}`,
                editorId: `review-editor${i}`
                });
            }
            });
            </script>

        </div>

        <!-- form -->
         <div col-lg-6>

            <?php
            if(isset($_POST['send-btn'])) {
                // Use htmlspecialchars and trim for sanitization
                $firstName = isset($_POST['firstName']) ? htmlspecialchars(trim($_POST['firstName'])) : '';
                $lastName = isset($_POST['lastName']) ? htmlspecialchars(trim($_POST['lastName'])) : '';
                $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
                $phoneNumber = isset($_POST['phone']) ? htmlspecialchars(trim($_POST['phone'])) : '';
                $street = isset($_POST['street']) ? htmlspecialchars(trim($_POST['street'])) : '';
                $apt = isset($_POST['unit']) ? htmlspecialchars(trim($_POST['unit'])) : '';
                $city = isset($_POST['city']) ? htmlspecialchars(trim($_POST['city'])) : '';
                $state = isset($_POST['state']) ? htmlspecialchars(trim($_POST['state'])) : '';
                $zip = isset($_POST['zip']) ? htmlspecialchars(trim($_POST['zip'])) : '';
                $serviceRequestedArr = isset($_POST['service-requested']) ? $_POST['service-requested'] : [];
                $serviceRequested = $serviceRequestedArr ? implode(', ', array_map('htmlspecialchars', $serviceRequestedArr)) : '';
                $notes = isset($_POST['notes']) ? htmlspecialchars(trim($_POST['notes'])) : '';

                requestQuote($firstName, $lastName, $email, $phoneNumber, $street, $apt, $city, $state, $zip, $serviceRequested, $notes);
            }
            ?>

            <form class="form" method="POST">

            <div class="quote-container quote-show">
                <div>
                    <div><h2>Free Quote</h2></div>
                    <div><p>Get a free quote today!</p></div>
                </div>
                <div class="customer-info">
                    <div>
                        <div><input type="text" name="firstName" placeholder="First Name*" required></div>
                    </div>
                    <div>
                        <div><input type="text" name="lastName" placeholder="Last Name*" required></div>
                    </div>
                    <div><input type="text" name="email" placeholder="Email*" required></div>
                    <div><input type="text" name="phone" placeholder="Phone"></div>
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
                        <div><input type="text" name="street" placeholder="Street Address*" required></div>
                    </div>
                    <div><input type="text" name="unit" placeholder="Unit/Apt"></div>
                    <div>
                        <div><input type="text" name="city" placeholder="City*" required></div>
                    </div>
                    <div>
                        <div><input type="text" name="state" placeholder="State*" required></div>
                    </div>
                    <div>
                        <div><input type="text" name="zip" placeholder="Zip Code*" required></div>
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
                            <select name="service-requested[]" id="service-requested" style="width:100%;" multiple>
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
                        <textarea name="notes" placeholder="Additional Notes"></textarea>
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

            <script>
            document.addEventListener('DOMContentLoaded', function() {
                const quoteContainers = document.querySelectorAll('.quote-container');
                let currentStep = 0;

                function updateProgressionBars() {
                    quoteContainers.forEach((container, index) => {
                        const bar = container.querySelector('.progression-bar div');
                        if (bar) {
                            bar.textContent = `Step ${currentStep + 1} of ${quoteContainers.length}`;
                        }
                    });
                }

                function showCurrentStep() {
                    quoteContainers.forEach((container, index) => {
                        container.classList.toggle('quote-show', index === currentStep);
                        container.classList.toggle('quote-hide', index !== currentStep);
                    });
                    updateProgressionBars();
                }

                document.querySelectorAll('.form-btns-container button').forEach(button => {
                    button.addEventListener('click', function() {
                        if (this.textContent.toLowerCase() === 'next') {
                            // Validate required fields in the current step before proceeding
                            const visibleStep = quoteContainers[currentStep];
                            const requiredFields = visibleStep.querySelectorAll('input[required], select[required], textarea[required], select[name="service-requested[]"]');
                            let missing = [];
                            requiredFields.forEach(field => {
                                if (field.tagName === 'SELECT') {
                                    if (!field.selectedOptions.length) {
                                        missing.push('Service Requested');
                                    }
                                } else if (!field.value.trim()) {
                                    missing.push(field.placeholder || field.name);
                                }
                            });
                            if (missing.length > 0) {
                                alert('Please fill out all required fields: ' + missing.join(', '));
                                return;
                            }
                            if (currentStep < quoteContainers.length - 1) {
                                currentStep++;
                                showCurrentStep();
                            }
                        } else if (this.textContent.toLowerCase() === 'previous') {
                            if (currentStep > 0) {
                                currentStep--;
                                showCurrentStep();
                            }
                        }
                    });
                });

                showCurrentStep(); // Initialize the first step

                // Client-side validation for required fields
                const form = document.querySelector('form.form');
                if (form) {
                    form.addEventListener('submit', function(e) {
                        // Only validate fields in the currently visible step
                        const visibleStep = form.querySelector('.quote-container.quote-show');
                        const requiredFields = visibleStep ? visibleStep.querySelectorAll('input[required], select[required], textarea[required], select[name="service-requested[]"]') : [];
                        let missing = [];
                        requiredFields.forEach(field => {
                            if (field.tagName === 'SELECT') {
                                if (!field.selectedOptions.length) {
                                    missing.push('Service Requested');
                                }
                            } else if (!field.value.trim()) {
                                missing.push(field.placeholder || field.name);
                            }
                        });
                        if (missing.length > 0) {
                            e.preventDefault();
                            alert('Please fill out all required fields: ' + missing.join(', '));
                        }
                    });
                }
            });

            $(document).ready(function() {
                $('#service-requested').select2({
                    placeholder: "Select services",
                    allowClear: true
                });
            });
            </script>
            </form>
         </div>

    </div>

</body>
</html>