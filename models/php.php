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

    // Server-side validation
    $validationError = '';
    if (empty($firstName) || empty($lastName) || empty($email) || empty($street) || empty($city) || empty($state) || empty($zip) || empty($serviceRequested)) {
        $validationError = 'Please fill out all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $validationError = 'Please enter a valid email address.';
    }

    if ($validationError) {
        echo "<script>alert('$validationError');</script>";
        return;
    }

    requestQuote($firstName, $lastName, $email, $phoneNumber, $street, $apt, $city, $state, $zip, $serviceRequested, $notes);

        // Use PHPMailer for email sending
        require_once __DIR__ . '/../src/PHPMailer.php';
        require_once __DIR__ . '/../src/SMTP.php';
        require_once __DIR__ . '/../src/Exception.php';

        $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        try {
            // SMTP config (example: Gmail SMTP)
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'YOUR_GMAIL_ADDRESS@gmail.com'; // <-- CHANGE THIS
            $mail->Password = 'YOUR_APP_PASSWORD'; // <-- CHANGE THIS
            $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Send to user
            $mail->setFrom('noreply@norcalpoolmovers.com', 'NORCAL Pool Movers');
            $mail->addAddress($email, "$firstName $lastName");
            $mail->Subject = "Thank you for your quote request";
            $mail->Body = "Hello $firstName $lastName,\n\nThank you for requesting a quote. We have received your information and will contact you soon.\n\nDetails:\nName: $firstName $lastName\nEmail: $email\nPhone: $phoneNumber\nAddress: $street $apt, $city, $state $zip\nServices Requested: $serviceRequested\nNotes: $notes\n\nNORCAL Pool Movers";
            $mail->send();
            error_log("User mail sent: SUCCESS");
        } catch (Exception $e) {
            error_log("User mail sent: FAILURE - " . $mail->ErrorInfo);
        }

        // Send to admin
        try {
            $mail = new PHPMailer\PHPMailer\PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'YOUR_GMAIL_ADDRESS@gmail.com'; // <-- CHANGE THIS
            $mail->Password = 'YOUR_APP_PASSWORD'; // <-- CHANGE THIS
            $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            include_once __DIR__ . '/model_admin.php';
            $adminEmail = getAdminEmailById(1);
            if ($adminEmail) {
                $mail->setFrom('noreply@norcalpoolmovers.com', 'NORCAL Pool Movers');
                $mail->addAddress($adminEmail);
                $mail->Subject = "New Quote Request Submitted";
                $mail->Body = "A new quote request has been submitted:\n\nName: $firstName $lastName\nEmail: $email\nPhone: $phoneNumber\nAddress: $street $apt, $city, $state $zip\nServices Requested: $serviceRequested\nNotes: $notes";
                $mail->send();
                error_log("Admin mail sent: SUCCESS");
            }
        } catch (Exception $e) {
            error_log("Admin mail sent: FAILURE - " . $mail->ErrorInfo);
        }
}

// Fetch all text boxes
    $textBoxes = getAllTextBoxes();

    // Helper function to get admin email by ID
    function getAdminEmailById($adminID) {
        global $db;
        $sql = 'SELECT adminEmail FROM capstone_202540_qball.adminlogin WHERE adminID = :adminID';
        $stmt = $db->prepare($sql);
        $stmt->execute([':adminID' => $adminID]);
        return $stmt->fetchColumn();
    }

function formatPhoneNumber($number) {
    $number = preg_replace('/[^0-9]/', '', $number);
    if (strlen($number) == 10) {
        return '(' . substr($number, 0, 3) . ') ' . substr($number, 3, 3) . '-' . substr($number, 6);
    }
    return $number;
}