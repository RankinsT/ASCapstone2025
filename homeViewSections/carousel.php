<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Example</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Bootstrap Carousel -->
<!-- filepath: c:\xampp\htdocs\ASCapstone2025\homeViewSections\carousel.php -->
<!-- filepath: c:\xampp\htdocs\ASCapstone2025\homeViewSections\carousel.php -->
<?php
// Include the database connection
include __DIR__ . '/../models/db.php';

try {
    // Fetch all images from the bcimage table
    $query = "SELECT * FROM bcimage ORDER BY id ASC";
    $stmt = $db->query($query);
    $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<h3>Error fetching images: " . $e->getMessage() . "</h3>";
    $images = [];
}
?>
<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php if (!empty($images)): ?>
            <?php foreach ($images as $index => $image): ?>
                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                    <img src="./bcimage/<?php echo htmlspecialchars($image['filename']); ?>" class="d-block w-100" alt="Slide <?php echo $index + 1; ?>" style="height: 25em; object-fit: cover;">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Slide <?php echo $index + 1; ?></h5>
                        <p>Description for slide <?php echo $index + 1; ?>.</p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="carousel-item active">
                <div class="d-flex justify-content-center align-items-center" style="height: 25em; background-color: #f8f9fa;">
                    <h5>No images available</h5>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <!-- Carousel Indicators -->
    <div class="carousel-indicators">
        <?php foreach ($images as $index => $image): ?>
            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="<?php echo $index; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>" aria-label="Slide <?php echo $index + 1; ?>"></button>
        <?php endforeach; ?>
    </div>
    <!-- Carousel Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
</body>
</html>