<?php
if (isset($_POST['submit'])) {
    $file = $_FILES['fileToUpload'];
    $slideNumber = $_POST['slideNumber']; // Get the selected slide number
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];
    $fileType = $file['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg',);

    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 5000000) { // Limit file size to 5MB
                $fileNameNew = "slide" . $slideNumber . "." . $fileActualExt; // Name the file based on the slide number
                $fileDestination = __DIR__ . '/../images/' . $fileNameNew; // Save in the images directory

                move_uploaded_file($fileTmpName, $fileDestination); // Move the file to the destination
                header("Location: ../homeView.php?uploadsuccess&slide=" . $slideNumber); // Redirect with success message
                exit();
            } else {
                echo "Your file is too big!";
            }
        } else {
            echo "There was an error uploading your file!";
        }
    } else {
        echo "You cannot upload files of this type!";
    }
}
?>