<?php
require("../controllers/cart_controller.php");
header('Content-Type: application/json');

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customerId = $_SESSION['user'] ?? null;

    if ($customerId) {
        $result = clearCartController($customerId);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Cart cleared successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to clear cart']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'User not logged in']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
