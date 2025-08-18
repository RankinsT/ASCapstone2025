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

// ?>

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
                    <option value="Felt Replacement & Repairs">Felt Replacement & Repairs</option>
                    <option value="In-Home Relocation">In-Home Relocation</option>
                    <option value="Long-Distance Moves">Long-Distance Moves</option>
                    <option value="Residential & Commercial Pool Table Moving">Residential & Commercial Pool Table Moving</option>
                    <option value="Slate Repair & Replacement">Slate Repair & Replacement</option>
                    <option value="Assembly & Dismantle">Assembly & Dismantle</option>
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
});

$(document).ready(function() {
    $('#service-requested').select2({
        placeholder: "Select services",
        allowClear: true
    });
});
</script>