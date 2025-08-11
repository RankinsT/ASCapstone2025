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
<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <!-- First Slide -->
        <div class="carousel-item active">
            <img src="images/slide1.jpg" class="d-block w-100" alt="First Slide" style="height: 25em; object-fit: cover;">
            <div class="carousel-caption d-none d-md-block">
                <h5>First Slide</h5>
                <p>Description for the first slide.</p>
            </div>
        </div>
        <!-- Second Slide -->
        <div class="carousel-item">
            <img src="images/slide2.jpg" class="d-block w-100" alt="Second Slide" style="height: 25em; object-fit: cover;">
            <div class="carousel-caption d-none d-md-block">
                <h5>Second Slide</h5>
                <p>Description for the second slide.</p>
            </div>
        </div>
        <!-- Third Slide -->
        <div class="carousel-item">
            <img src="images/slide3.jpg" class="d-block w-100" alt="Third Slide" style="height: 25em; object-fit: cover;">
            <div class="carousel-caption d-none d-md-block">
                <h5>Third Slide</h5>
                <p>Description for the third slide.</p>
            </div>
        </div>
    </div>
    <!-- Carousel Indicators -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1" style="background-color:rgb(14, 75, 28);"></button>
        <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1" aria-label="Slide 2" style="background-color:rgb(14, 75, 28);"></button>
        <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2" aria-label="Slide 3" style="background-color:rgb(14, 75, 28);"></button>
    </div>
    </div>
    <!-- Carousel Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev"style="background-color:rgba(46, 82, 51, 0.28)";>
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next" style="background-color:rgba(46, 82, 51, 0.28)";>
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
            </div>
        </div>
    </div>
</body>
</html>