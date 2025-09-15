<!-- filepath: c:\xampp\htdocs\ASCapstone2025\upload.php -->
<?php
include './models/db.php'; // Include database connection

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

// Handle description update
if (isset($_POST['updateDescription']) && !empty($_POST['imageId'])) {
    $imageId = $_POST['imageId'];
    $description = $_POST['description'];

    try {
        // Update the description in the database
        $stmt = $db->prepare("UPDATE bcimage SET description = :description WHERE id = :id");
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':id', $imageId, PDO::PARAM_INT);
        $stmt->execute();

        // Refresh the page
        header("Location: upload.php");
        exit();
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger mt-3'>Error updating description: " . $e->getMessage() . "</div>";
    }
}

// Handle image deletion
// Handle image update
if (isset($_POST['update']) && !empty($_POST['imageId'])) {
    $imageId = $_POST['imageId'];
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    if (isset($_FILES['fileToUpdate']) && $_FILES['fileToUpdate']['error'] === 0) {
        $file = $_FILES['fileToUpdate'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileError = $file['error'];
        $fileSize = $file['size'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($fileExt, $allowed)) {
            if ($fileSize < 5000000) {
                $newFileName = uniqid('', true) . '.' . $fileExt;
                $fileDestination = './bcimage/' . $newFileName;
                // Ensure the upload directory exists
                if (!is_dir('./bcimage/')) {
                    mkdir('./bcimage/', 0777, true);
                }
                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                    // Delete old image file
                    $stmt = $db->prepare("SELECT filename FROM bcimage WHERE id = :id");
                    $stmt->bindParam(':id', $imageId, PDO::PARAM_INT);
                    $stmt->execute();
                    $image = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($image) {
                        $oldFilePath = './bcimage/' . $image['filename'];
                        if (file_exists($oldFilePath)) {
                            unlink($oldFilePath);
                        }
                    }
                    // Update database record (filename and description)
                    $stmt = $db->prepare("UPDATE bcimage SET filename = :filename, description = :description WHERE id = :id");
                    $stmt->bindParam(':filename', $newFileName);
                    $stmt->bindParam(':description', $description);
                    $stmt->bindParam(':id', $imageId, PDO::PARAM_INT);
                    $stmt->execute();
                    header("Location: upload.php");
                    exit();
                } else {
                    echo "<div class='alert alert-danger mt-3'>Failed to move the updated file.</div>";
                }
            } else {
                echo "<div class='alert alert-danger mt-3'>File size exceeds the limit of 5MB.</div>";
            }
        } else {
            echo "<div class='alert alert-danger mt-3'>Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.</div>";
        }
    } else {
        // No file uploaded, just update description
        $stmt = $db->prepare("UPDATE bcimage SET description = :description WHERE id = :id");
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':id', $imageId, PDO::PARAM_INT);
        $stmt->execute();
        header("Location: upload.php");
        exit();
    }
}
if (isset($_POST['delete']) && !empty($_POST['imageId'])) {
    $imageId = $_POST['imageId'];

    // Fetch the image filename
    $stmt = $db->prepare("SELECT filename FROM bcimage WHERE id = :id");
    $stmt->bindParam(':id', $imageId, PDO::PARAM_INT);
    $stmt->execute();
    $image = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($image) {
        $filePath = './bcimage/' . $image['filename'];
        if (file_exists($filePath)) {
            unlink($filePath); // Delete the file
        }

        // Delete the record from the database
        $stmt = $db->prepare("DELETE FROM bcimage WHERE id = :id");
        $stmt->bindParam(':id', $imageId, PDO::PARAM_INT);
        $stmt->execute();

        // Refresh the page
        header("Location: upload.php");
        exit();
    } else {
        echo "<div class='alert alert-danger mt-3'>Image not found for deletion.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Images</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Cropper.js CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" />
</head>
<body>
    <div class="container mt-5">
        <!-- Back to Home Button -->
        <div class="mb-3">
            <a href="homeView2.php" class="btn btn-secondary">Back to Home</a>
        </div>

        <h2>Manage Images</h2>
        <form id="uploadForm" action="upload.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="fileToUpload" class="form-label">Select Image to Upload:</label>
                <input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Image Description:</label>
                <textarea name="description" id="description" class="form-control" rows="2"></textarea>
            </div>
            <!-- Image Preview and Crop Modal -->
            <div id="previewContainer" style="display:none;">
                <img id="previewImage" style="max-width:100%;" />
            </div>
            <div id="cropControls" style="display:none;" class="mb-3">
                <button type="button" id="cropBtn" class="btn btn-success">Crop</button>
                <button type="button" id="useFullBtn" class="btn btn-info">Use Full Image</button>
                <button type="button" id="cancelCropBtn" class="btn btn-secondary">Cancel</button>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Upload</button>
        </form>

        <hr>

        <h3>Existing Images</h3>
        <div class="row">
            <?php
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
                    echo '<form class="updateForm" action="upload.php" method="POST" enctype="multipart/form-data">';
                    echo '<input type="hidden" name="imageId" value="' . $image['id'] . '">';
                    echo '<div class="mb-3">';
                    echo '<label for="fileToUpdate_' . $image['id'] . '" class="form-label">Update Image:</label>';
                    echo '<input type="file" name="fileToUpdate" id="fileToUpdate_' . $image['id'] . '" class="form-control update-file">';
                    echo '</div>';
                    echo '<div id="updatePreviewContainer_' . $image['id'] . '" style="display:none;">
                            <img id="updatePreviewImage_' . $image['id'] . '" style="max-width:100%;" />
                        </div>';
                    echo '<div id="updateCropControls_' . $image['id'] . '" style="display:none;" class="mb-3">
                            <button type="button" class="btn btn-success updateCropBtn" data-id="' . $image['id'] . '">Crop</button>
                            <button type="button" class="btn btn-info updateUseFullBtn" data-id="' . $image['id'] . '">Use Full Image</button>
                            <button type="button" class="btn btn-secondary updateCancelCropBtn" data-id="' . $image['id'] . '">Cancel</button>
                        </div>';
                    echo '<div class="mb-3">';
                    echo '<label for="description" class="form-label">Image Description:</label>';
                    echo '<textarea name="description" class="form-control" rows="2">' . htmlspecialchars($image['description']) . '</textarea>';
                    echo '</div>';
                    echo '<button type="submit" name="update" class="btn btn-warning btn-sm updateSubmitBtn">Update</button>';
                    echo '<button type="submit" name="delete" class="btn btn-danger btn-sm">Delete Image</button>';
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

    <!-- Cropper.js JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
    <script>
    let cropper;
    const fileInput = document.getElementById('fileToUpload');
    const previewContainer = document.getElementById('previewContainer');
    const previewImage = document.getElementById('previewImage');
    const cropControls = document.getElementById('cropControls');
    const cropBtn = document.getElementById('cropBtn');
    const useFullBtn = document.getElementById('useFullBtn');
    const cancelCropBtn = document.getElementById('cancelCropBtn');
    const uploadForm = document.getElementById('uploadForm');

    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file && /^image\/(jpe?g|png|gif)$/i.test(file.type)) {
            const reader = new FileReader();
            reader.onload = function(evt) {
                previewImage.src = evt.target.result;
                previewContainer.style.display = 'block';
                cropControls.style.display = 'block';
                if (cropper) cropper.destroy();
                cropper = new Cropper(previewImage, {
                    aspectRatio: 16/9,
                    viewMode: 1
                });
            };
            reader.readAsDataURL(file);
            // Hide default submit button
            uploadForm.querySelector('[name="submit"]').style.display = 'none';
        }
    });

    cropBtn.addEventListener('click', function() {
        if (cropper) {
            cropper.getCroppedCanvas().toBlob(function(blob) {
                const dataTransfer = new DataTransfer();
                const croppedFile = new File([blob], fileInput.files[0].name, {type: blob.type});
                dataTransfer.items.add(croppedFile);
                fileInput.files = dataTransfer.files;
                previewContainer.style.display = 'none';
                cropControls.style.display = 'none';
                uploadForm.querySelector('[name="submit"]').style.display = 'inline-block';
            }, fileInput.files[0].type);
        }
    });
    // Add Use Full Image button logic
    document.getElementById('useFullBtn').addEventListener('click', function() {
        previewContainer.style.display = 'none';
        cropControls.style.display = 'none';
        if (cropper) cropper.destroy();
        uploadForm.querySelector('[name="submit"]').style.display = 'inline-block';
    });

    cancelCropBtn.addEventListener('click', function() {
        previewContainer.style.display = 'none';
        cropControls.style.display = 'none';
        if (cropper) cropper.destroy();
        fileInput.value = '';
        uploadForm.querySelector('[name="submit"]').style.display = 'inline-block';
    });

    // Enable Cropper for updating images
    document.querySelectorAll('.update-file').forEach(function(input) {
        input.addEventListener('change', function(e) {
            const id = input.id.split('_')[1];
            const file = e.target.files[0];
            const previewContainer = document.getElementById('updatePreviewContainer_' + id);
            const previewImage = document.getElementById('updatePreviewImage_' + id);
            const cropControls = document.getElementById('updateCropControls_' + id);
            const cropBtn = cropControls.querySelector('.updateCropBtn');
            const cancelCropBtn = cropControls.querySelector('.updateCancelCropBtn');
            // Add Use Full Image button for update
            let useFullBtn = cropControls.querySelector('.updateUseFullBtn');
            if (!useFullBtn) {
                useFullBtn = document.createElement('button');
                useFullBtn.type = 'button';
                useFullBtn.className = 'btn btn-info updateUseFullBtn';
                useFullBtn.textContent = 'Use Full Image';
                cropControls.insertBefore(useFullBtn, cancelCropBtn);
            }
            const updateSubmitBtn = input.closest('form').querySelector('.updateSubmitBtn');
            let updateCropper;
            if (file && /^image\/(jpe?g|png|gif)$/i.test(file.type)) {
                const reader = new FileReader();
                reader.onload = function(evt) {
                    previewImage.src = evt.target.result;
                    previewContainer.style.display = 'block';
                    cropControls.style.display = 'block';
                    if (updateCropper) updateCropper.destroy();
                    updateCropper = new Cropper(previewImage, {
                        aspectRatio: 16/9,
                        viewMode: 1
                    });
                };
                reader.readAsDataURL(file);
                updateSubmitBtn.style.display = 'none';
            }
            cropBtn.onclick = function() {
                if (updateCropper) {
                    updateCropper.getCroppedCanvas().toBlob(function(blob) {
                        const dataTransfer = new DataTransfer();
                        const croppedFile = new File([blob], file.name, {type: blob.type});
                        dataTransfer.items.add(croppedFile);
                        input.files = dataTransfer.files;
                        previewContainer.style.display = 'none';
                        cropControls.style.display = 'none';
                        updateSubmitBtn.style.display = 'inline-block';
                    }, file.type);
                }
            };
            useFullBtn.onclick = function() {
                previewContainer.style.display = 'none';
                cropControls.style.display = 'none';
                if (updateCropper) updateCropper.destroy();
                updateSubmitBtn.style.display = 'inline-block';
            };
            cancelCropBtn.onclick = function() {
                previewContainer.style.display = 'none';
                cropControls.style.display = 'none';
                if (updateCropper) updateCropper.destroy();
                input.value = '';
                updateSubmitBtn.style.display = 'inline-block';
            };
        });
    });
    </script>
</body>
</html>