<?php
include("../controllers/cart_controller.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $CustomerId = filter_input(INPUT_GET, 'customer_id', FILTER_SANITIZE_NUMBER_INT);

    if ($CustomerId) {
        $result = getCartItemsController($CustomerId);

        if ($result) {
            echo json_encode(['success' => true, 'empty' => false, 'data' => $result]);
        } else {
            echo json_encode(['success' => true, 'empty' => true, 'message' => 'No items in cart']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid input data']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
