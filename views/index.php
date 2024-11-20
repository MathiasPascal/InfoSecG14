<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionBySiuuuuu - Your Online Store</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .carousel-item {
            height: 500px;
            background-color: #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
        }

        .category-card {
            transition: transform 0.2s;
        }

        .category-card:hover {
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>


    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div>Featured Product 1</div>
            </div>
            <div class="carousel-item">
                <div>Featured Product 2</div>
            </div>
            <div class="carousel-item">
                <div>Featured Product 3</div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


    <div class="container mt-5">
        <h2 class="text-center">Shop by Category</h2>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card category-card">
                    <div class="card-body">
                        <h5 class="card-title">Category 1</h5>
                        <p class="card-text">Explore our wide range of products in Category 1.</p>
                        <a href="category1.php" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card category-card">
                    <div class="card-body">
                        <h5 class="card-title">Category 2</h5>
                        <p class="card-text">Discover the best deals in Category 2.</p>
                        <a href="category2.php" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card category-card">
                    <div class="card-body">
                        <h5 class="card-title">Category 3</h5>
                        <p class="card-text">Find top products in Category 3.</p>
                        <a href="category3.php" class="btn btn-primary">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>.
    </div>


    <footer class="bg-dark text-white mt-5 p-4 text-center">
        <p>&copy; 2025 Shopmore. All Rights Reserved.</p>
    </footer>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>