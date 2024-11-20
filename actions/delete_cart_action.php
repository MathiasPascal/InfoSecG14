<?php
include("../controllers/cart_controller.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = filter_input(INPUT_POST, 'product_id', FILTER_SANITIZE_NUMBER_INT);
    $customerId = filter_input(INPUT_POST, 'customer_id', FILTER_SANITIZE_NUMBER_INT);

    if ($productId && $customerId) {
        $result = deleteFromCartController($productId, $customerId);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Product removed from cart successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to remove product from cart']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid input data']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>