<?php
include("../controllers/product_controller.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $brand = filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
    $desc = filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $keywords = filter_input(INPUT_POST, 'keywords', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if ($title && $brand && $category && $price && $desc && $keywords) {
        $result = addProductController($title, $brand, $category, $price, $desc, $keywords);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Product added successfully']);
        } else {
            error_log('Failed to add product: ' . print_r($result, true));
            echo json_encode(['success' => false, 'message' => 'Failed to add product']);
        }
    } else {
        error_log('Invalid input data: ' . print_r($_POST, true));
        echo json_encode(['success' => false, 'message' => 'Invalid input data']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>