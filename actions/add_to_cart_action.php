<?php
include("../controllers/cart_controller.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = filter_input(INPUT_POST, 'product_id', FILTER_SANITIZE_NUMBER_INT);
    $ipAddress = filter_input(INPUT_POST, 'ip_address', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $CustomerId = filter_input(INPUT_POST, 'customer_id', FILTER_SANITIZE_NUMBER_INT);
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_NUMBER_INT);

    if ($productId && $ipAddress && $CustomerId && $quantity) {
        $result = addToCartController($productId, $ipAddress, $CustomerId, $quantity);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Product added to cart successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to add product to cart']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid input data']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>