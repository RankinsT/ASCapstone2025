<!DOCTYPE html>
<html>
  
<head>
    <title>Image Upload</title>
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" 
          href="css/style.css" />
    <?php include __DIR__ . '/models/db.php'; ?>
  
<body>
<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

$msg = "";

// If upload button is clicked ...
if (isset($_POST['upload'])) {
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
            // Use a prepared statement to insert the filename into the database
            $stmt = $db->prepare("INSERT INTO bcimage (filename) VALUES (:filename)");
            $stmt->bindParam(':filename', $filename);
            $stmt->execute();

            echo "<h3>&nbsp; Image uploaded successfully!</h3>";
        } catch (PDOException $e) {
            echo "<h3>&nbsp; Error saving to the database: " . $e->getMessage() . "</h3>";
        }
    } else {
        echo "<h3>&nbsp; Failed to upload image!</h3>";
    }
}
?>
    <div id="content">
        <form method="POST" action="" 
              enctype="multipart/form-data">
            <div class="form-group">
                <input class="form-control" type="file" 
                       name="uploadfile" value="" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary" 
                        type="submit" 
                        name="upload">UPLOAD</button>
            </div>
        </form>
    </div>
    <div id="display-image">
    <?php
        try {
            $query = "SELECT * FROM bcimage";
            $stmt = $db->query($query);

            while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<img src="./bcimage/' . htmlspecialchars($data['filename']) . '">';
            }
        } catch (PDOException $e) {
            echo "<h3>&nbsp; Error fetching images: " . $e->getMessage() . "</h3>";
        }
    ?>
    </div>
</body>

</html>