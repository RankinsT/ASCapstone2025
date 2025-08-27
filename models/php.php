<?php
// form
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

// Fetch all text boxes
$textBoxes = getAllTextBoxes();