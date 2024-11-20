<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/category.js"></script>
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
        <h1 class="text-center mb-4">Manage Categories</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2>Add a Category</h2>
                    </div>
                    <div class="card-body">
                        <form id="categoryForm" action="../actions/add_category_action.php" method="POST">
                            <div class="form-group">
                                <label for="name">Category Name:</label>
                                <input type="text" class="form-control" id="name" name="cat_name" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Category</button>
                        </form>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h2>Delete a Category</h2>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="category-dropdown">Select a Category:</label>
                            <select id="category-dropdown" class="form-control">
                            </select>
                        </div>
                        <button id="delete-category-button" class="btn btn-danger">Delete Category</button>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2>View Categories</h2>
                    </div>
                    <div class="card-body">
                        <ul id="category-list" class="list-group">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>