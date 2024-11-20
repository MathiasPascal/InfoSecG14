<?php
require("../controllers/order_controller.php");
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = filter_input(INPUT_POST, 'order_id', FILTER_SANITIZE_NUMBER_INT);
    $product_id = filter_input(INPUT_POST, 'product_id', FILTER_SANITIZE_NUMBER_INT);
    $qty = filter_input(INPUT_POST, 'qty', FILTER_SANITIZE_NUMBER_INT);

    if ($order_id && $product_id && $qty) {
        $result = addOrderDetailsController($order_id, $product_id, $qty);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Order details added successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to add order details']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid input data']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>