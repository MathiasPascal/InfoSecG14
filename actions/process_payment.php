<?php
require("../controllers/payment_controller.php");
header('Content-Type: application/json');

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amt = filter_input(INPUT_POST, 'amt', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $order_id = filter_input(INPUT_POST, 'order_id', FILTER_SANITIZE_NUMBER_INT);
    $currency = filter_input(INPUT_POST, 'currency', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $customer_id = $_SESSION['user_id'];
    $payment_date = date('Y-m-d H:i:s');

    if ($amt && $customer_id && $order_id && $currency) {
        $result = addPaymentController($amt, $customer_id, $order_id, $currency, $payment_date);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Payment processed successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to process payment']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid input data']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>