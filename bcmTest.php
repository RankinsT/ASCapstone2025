<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>  
<?php
    include __DIR__ . '/models/uploads.php'; // Include the uploads model
?>
<!-- filepath: c:\xampp\htdocs\ASCapstone2025\bcmTest.php -->
<form action="models/uploads.php" method="post" enctype="multipart/form-data">
    <label for="fileToUpload">Select image to upload:</label>
    <input type="file" name="fileToUpload" id="fileToUpload" required>
    
    <label for="slideNumber">Select Slide to Replace:</label>
    <select name="slideNumber" id="slideNumber" required>
        <option value="1">Slide 1</option>
        <option value="2">Slide 2</option>
        <option value="3">Slide 3</option>
    </select>
    
    <button type="submit" name="submit">Upload Image</button>
</form>

<?php
    // Check if the file upload was successful and $fileDestination is set
    if (isset($_GET['uploadsuccess']) && isset($fileDestination)) {
        echo "File Destination: " . htmlspecialchars($fileDestination);
        header("Location: homeView.php?uploadsuccess&slide=" . htmlspecialchars($_GET['slide']));
    }
?>
</body>
</html>