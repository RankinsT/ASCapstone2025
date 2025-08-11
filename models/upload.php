<!-- filepath: c:\xampp\htdocs\ASCapstone2025\upload.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Upload Image</h2>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="fileToUpload" class="form-label">Select Image to Upload:</label>
                <input type="file" name="fileToUpload" id="fileToUpload" class="form-control" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Upload</button>
        </form>
    </div>

    <?php
    include './models/db.php'; // Include database connection

    if (isset($_POST['submit'])) {
        $file = $_FILES['fileToUpload'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileError = $file['error'];
        $fileSize = $file['size'];

        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 5000000) { // Limit file size to 5MB
                    $newFileName = uniqid('', true) . '.' . $fileExt;
                    $fileDestination = './bcimage/' . $newFileName;

                    // Ensure the upload directory exists
                    if (!is_dir('./bcimage/')) {
                        mkdir('./bcimage/', 0777, true);
                    }

                    // Move the uploaded file
                    if (move_uploaded_file($fileTmpName, $fileDestination)) {
                        // Insert the filename into the database
                        $stmt = $db->prepare("INSERT INTO bcimage (filename) VALUES (:filename)");
                        $stmt->bindParam(':filename', $newFileName);
                        $stmt->execute();

                        echo "<div class='alert alert-success mt-3'>Image uploaded successfully!</div>";
                    } else {
                        echo "<div class='alert alert-danger mt-3'>Failed to move the uploaded file.</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger mt-3'>File size exceeds the limit of 5MB.</div>";
                }
            } else {
                echo "<div class='alert alert-danger mt-3'>Error uploading the file.</div>";
            }
        } else {
            echo "<div class='alert alert-danger mt-3'>Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.</div>";
        }
    }
    ?>
</body>
</html>