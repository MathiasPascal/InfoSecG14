<?php
require_once("../controllers/order_controller.php");
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_id = filter_input(INPUT_POST, 'customer_id', FILTER_SANITIZE_NUMBER_INT);
    $invoice_no = filter_input(INPUT_POST, 'invoice_no', FILTER_SANITIZE_NUMBER_INT);
    $order_date = filter_input(INPUT_POST, 'order_date', FILTER_SANITIZE_SPECIAL_CHARS);
    $order_status = filter_input(INPUT_POST, 'order_status', FILTER_SANITIZE_SPECIAL_CHARS);

    if ($customer_id && $invoice_no && $order_date && $order_status) {
        $order_id = addOrderController($customer_id, $invoice_no, $order_date, $order_status);
        error_log("Order ID: " . $order_id);
        if ($order_id) {
            session_start();
            $_SESSION['order_id'] = $order_id;                              
            echo json_encode(['success' => true, 'order_id' => $order_id, 'message' => 'Order added successfully']);
        } else {
            error_log("Failed to add order: " . json_encode(['customer_id' => $customer_id, 'invoice_no' => $invoice_no, 'order_date' => $order_date, 'order_status' => $order_status]));
            echo json_encode(['success' => false, 'message' => 'Failed to add order']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid input data']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
