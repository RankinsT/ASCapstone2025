<!-- filepath: c:\xampp\htdocs\ASCapstone2025\sqlUpload.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Image Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <?php include __DIR__ . '/models/db.php'; ?>
</head>
<body>
<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Handle deletion of an image
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    try {
        // Fetch the filename to delete the file from the directory
        $stmt = $db->prepare("SELECT filename FROM bcimage WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $image = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($image) {
            $filePath = './bcimage/' . $image['filename'];
            if (file_exists($filePath)) {
                unlink($filePath); // Delete the file from the directory
            }

            // Delete the record from the database
            $stmt = $db->prepare("DELETE FROM bcimage WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            echo "<h3>&nbsp; Image deleted successfully!</h3>";
        }
    } catch (PDOException $e) {
        echo "<h3>&nbsp; Error deleting image: " . $e->getMessage() . "</h3>";
    }
}

// Handle updating an image
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];
    $folder = "./bcimage/" . $filename;

    // Ensure the upload directory exists
    if (!is_dir('./bcimage/')) {
        mkdir('./bcimage/', 0777, true);
    }

    // Validate file upload
    if ($_FILES["uploadfile"]["error"] !== UPLOAD_ERR_OK) {
        echo "<h3>&nbsp; Error uploading file: " . $_FILES["uploadfile"]["error"] . "</h3>";
        exit();
    }

    // Move the uploaded file to the target directory
    if (move_uploaded_file($tempname, $folder)) {
        try {
            // Fetch the old filename to delete the old file
            $stmt = $db->prepare("SELECT filename FROM bcimage WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $oldImage = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($oldImage) {
                $oldFilePath = './bcimage/' . $oldImage['filename'];
                if (file_exists($oldFilePath)) {
                    unlink($oldFilePath); // Delete the old file
                }
            }

            // Update the database with the new filename
            $stmt = $db->prepare("UPDATE bcimage SET filename = :filename WHERE id = :id");
            $stmt->bindParam(':filename', $filename);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            echo "<h3>&nbsp; Image updated successfully!</h3>";
        } catch (PDOException $e) {
            echo "<h3>&nbsp; Error updating image: " . $e->getMessage() . "</h3>";
        }
    } else {
        echo "<h3>&nbsp; Failed to upload image!</h3>";
    }
}
?>
    <div id="content">
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <input class="form-control" type="file" name="uploadfile" value="" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit" name="upload">UPLOAD</button>
            </div>
        </form>
    </div>
    <div id="display-image">
        <h3 class="text-center">Manage Images</h3>
        <div class="row">
        <?php
        try {
            $query = "SELECT * FROM bcimage";
            $stmt = $db->query($query);
            $totalImages = $stmt->rowCount(); // Get total number of images
            $imageNumber = $totalImages; // Initialize image counter to total images

            while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="col-md-4 mb-3">';
            echo '<div class="image-number">Image #' . $imageNumber . '</div>'; // Display image number
            echo '<img src="./bcimage/' . htmlspecialchars($data['filename']) . '" class="img-fluid" alt="Image">';
            echo '<form method="POST" action="" enctype="multipart/form-data" class="mt-2">';
            echo '<input type="hidden" name="id" value="' . $data['id'] . '">';
            echo '<input class="form-control mb-2" type="file" name="uploadfile">';
            echo '<button class="btn btn-warning btn-sm" type="submit" name="update">Update</button>';
            echo '<a href="?delete=' . $data['id'] . '" class="btn btn-danger btn-sm">Delete</a>';
            echo '</form>';
            echo '</div>';
            $imageNumber--; // Decrement image counter
            }
        } catch (PDOException $e) {
            echo "<h3>&nbsp; Error fetching images: " . $e->getMessage() . "</h3>";
        }
        ?>
        </div>
    </div>
</body>
</html>