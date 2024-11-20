<?php
require("../controllers/payment_controller.php");
header('Content-Type: application/json');

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reference = $_POST['reference'] ?? '';

    if ($reference) {
        $url = "https://api.paystack.co/transaction/verify/" . $reference;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer sk_test_06a22baf4e7b63c39fc57d7949989e10e3b06032"
        ]);
        $response = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($response, true);

        // Log the response for debugging
        error_log('Paystack Response: ' . print_r($result, true));

        if ($result['status'] && $result['data']['status'] == 'success') {
            $amt = $result['data']['amount'] / 100;
            $customer_id = $_SESSION['user_id'];
            $order_id = $_SESSION['order_id'];
            $currency = $result['data']['currency'];
            $payment_date = date('Y-m-d');

            // Log the payment details for debugging
            error_log('Payment Details: ' . print_r([
                'amt' => $amt,
                'customer_id' => $customer_id,
                'order_id' => $order_id,
                'currency' => $currency,
                'payment_date' => $payment_date
            ], true));

            // Add payment to the database
            $payment_result = addPaymentController($amt, $customer_id, $order_id, $currency, $payment_date);

            if ($payment_result) {
                echo json_encode(['success' => true, 'message' => 'Payment verified and processed successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to process payment']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Payment verification failed']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid input data']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
