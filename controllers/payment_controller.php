<?php
require("../classes/payment_class.php");

function addPaymentController($amt, $customer_id, $order_id, $currency, $payment_date)
{
    error_log("Payment Details received in controller: " . json_encode(['amt' => $amt, 'customer_id' => $customer_id, 'order_id' => $order_id, 'currency' => $currency, 'payment_date' => $payment_date]));
    $payment = new payment_class();
    return $payment->addPayment($amt, $customer_id, $order_id, $currency, $payment_date);
}

function viewPaymentsController()
{
    $payment = new payment_class();
    return $payment->getPayments();
}

function deletePaymentController($pay_id)
{
    $payment = new payment_class();
    return $payment->deletePayment($pay_id);
}
?>