<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/product.js"></script>
    <style>
        body {
            display: flex;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .content {
            flex-grow: 1;
            padding: 20px;
        }
    </style>
</head>

<body>
    <?php include 'sidebar.php'; ?>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Manage Products</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2>Add a Product</h2>
                    </div>
                    <div class="card-body">
                        <form id="productForm">
                            <div class="form-group">
                                <label for="title">Product Title:</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="brand">Brand:</label>
                                <select id="brand" name="brand" class="form-control" required>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="category">Category:</label>
                                <select id="category" name="category" class="form-control" required>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                            </div>
                            <div class="form-group">
                                <label for="desc">Description:</label>
                                <textarea class="form-control" id="desc" name="desc" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="keywords">Keywords:</label>
                                <input type="text" class="form-control" id="keywords" name="keywords" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Product</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2>Delete a Product</h2>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="product-dropdown">Select a Product:</label>
                            <select id="product-dropdown" class="form-control">
                            </select>
                        </div>
                        <button id="delete-product-button" class="btn btn-danger">Delete Product</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>