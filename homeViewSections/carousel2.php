<?php
include __DIR__ . '/../models/db.php'; // Include database connection

try {
    // Fetch all images from the database
    $query = "SELECT * FROM bcimage ORDER BY id ASC";
    $stmt = $db->query($query);
    $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "<h3>Error fetching images: " . $e->getMessage() . "</h3>";
    $images = [];
}
?>


<div id="carouselExample" class="carousel slide" data-bs-ride="carousel" data-bs-interval="6000">
    <div class="carousel-inner">
        <?php if (!empty($images)): ?>
            <?php foreach ($images as $index => $image): ?>
                <div class="carousel-item styl <?php echo $index === 0 ? 'active' : ''; ?>">
                    <img src="./bcimage/<?php echo htmlspecialchars($image['filename']); ?>" class="d-block w-100" alt="Slide <?php echo $index + 1; ?>" style="height: 780px; object-fit: cover; border-radius: 20px;">
                    <div class="carousel-caption d-none d-md-block" style=" top: 50%; bottom: 0; left: 0; right: 0; background: linear-gradient(to bottom, rgba(0, 0, 0, 0), rgba(0, 0, 0, 1)); padding: 10px; border-radius: 0;">
                        <div class="text-start d-flex align-items-start" style="position: absolute; bottom: 20px; left: 20px; padding: 20px; border-radius: 10px; width: calc(70% - 60px); flex-direction: row;">
                            <div style="margin-bottom: 10px; width: 500px;"><?php echo htmlspecialchars($image['description']); ?><br><span class="review-stars" style="color: gold; font-size: 3em;">★★★★★</span></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="carousel-item active">
                <div class="d-flex justify-content-center align-items-center" style="height: 25em; background-color:rgb(46, 138, 230);">
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
        <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: drop-shadow(0px 0px 3px rgba(0, 0, 0, 0.74));"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next" style="filter: drop-shadow(0px 0px 3px rgba(0, 0, 0, 0.74));">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
