<!-- filepath: c:\xampp\htdocs\ASCapstone2025\upload.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Images</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <!-- Back to Home Button -->
        <div class="mb-3">
            <a href="homeView.php" class="btn btn-secondary">Back to Home</a>
        </div>

        <h2>Manage Images</h2>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="fileToUpload" class="form-label">Select Image to Upload:</label>
                <input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Image Description:</label>
                <textarea name="description" id="description" class="form-control" rows="2"></textarea>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Upload</button>
        </form>

        <hr>

        <h3>Existing Images</h3>
        <div class="row">
            <?php
            include './models/db.php'; // Include database connection

            try {
                // Fetch all images from the database
                $query = "SELECT * FROM bcimage ORDER BY id ASC";
                $stmt = $db->query($query);
                $images = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($images as $image) {
                    echo '<div class="col-md-4 mb-3">';
                    echo '<div class="card">';
                    echo '<img src="./bcimage/' . htmlspecialchars($image['filename']) . '" class="card-img-top" alt="Image">';
                    echo '<div class="card-body">';
                    echo '<form action="upload.php" method="POST" enctype="multipart/form-data">';
                    echo '<input type="hidden" name="imageId" value="' . $image['id'] . '">';
                    echo '<div class="mb-3">';
                    echo '<label for="fileToUpdate" class="form-label">Update Image:</label>';
                    echo '<input type="file" name="fileToUpdate" id="fileToUpdate" class="form-control">';
                    echo '</div>';
                    echo '<div class="mb-3">';
                    echo '<label for="description" class="form-label">Image Description:</label>';
                    echo '<textarea name="description" class="form-control" rows="2">' . htmlspecialchars($image['description']) . '</textarea>';
                    echo '</div>';
                    echo '<button type="submit" name="update" class="btn btn-warning btn-sm">Update</button>';
                    echo '<button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } catch (PDOException $e) {
                echo "<div class='alert alert-danger'>Error fetching images: " . $e->getMessage() . "</div>";
            }
            ?>
        </div>
    </div>

    <?php
    // Handle file upload
    if (isset($_POST['submit'])) {
        $file = $_FILES['fileToUpload'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileError = $file['error'];
        $fileSize = $file['size'];
        $description = $_POST['description'];

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

                    if (move_uploaded_file($fileTmpName, $fileDestination)) {
                        $stmt = $db->prepare("INSERT INTO bcimage (filename, description) VALUES (:filename, :description)");
                        $stmt->bindParam(':filename', $newFileName);
                        $stmt->bindParam(':description', $description);
                        $stmt->execute();

                        // Refresh the page
                        header("Location: upload.php");
                        exit();
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

    // Handle image update
    if (isset($_POST['update']) && !empty($_POST['imageId'])) {
        $imageId = $_POST['imageId'];
        $file = $_FILES['fileToUpdate'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileError = $file['error'];
        $fileSize = $file['size'];
        $description = $_POST['description'];

        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($fileExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 5000000) { // Limit file size to 5MB
                    $newFileName = uniqid('', true) . '.' . $fileExt;
                    $fileDestination = './bcimage/' . $newFileName;

                    // Fetch the old image filename
                    $stmt = $db->prepare("SELECT filename FROM bcimage WHERE id = :id");
                    $stmt->bindParam(':id', $imageId, PDO::PARAM_INT);
                    $stmt->execute();
                    $oldImage = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($oldImage) {
                        $oldFilePath = './bcimage/' . $oldImage['filename'];
                        if (file_exists($oldFilePath)) {
                            unlink($oldFilePath); // Delete the old file
                        }

                        if (move_uploaded_file($fileTmpName, $fileDestination)) {
                            $stmt = $db->prepare("UPDATE bcimage SET filename = :filename, description = :description WHERE id = :id");
                            $stmt->bindParam(':filename', $newFileName);
                            $stmt->bindParam(':description', $description);
                            $stmt->bindParam(':id', $imageId, PDO::PARAM_INT);
                            $stmt->execute();

                            // Refresh the page
                            header("Location: upload.php");
                            exit();
                        } else {
                            echo "<div class='alert alert-danger mt-3'>Failed to move the uploaded file.</div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger mt-3'>Image not found for update.</div>";
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