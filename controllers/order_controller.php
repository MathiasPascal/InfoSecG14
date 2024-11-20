<?php
require("../classes/order_class.php");

function addOrderController($customer_id, $invoice_no, $order_date, $order_status) {
    $orderManager = new OrderManager();
    return $orderManager->addOrder($customer_id, $invoice_no, $order_date, $order_status);
}

function viewAllOrdersController() {
    $orderManager = new OrderManager();
    return $orderManager->viewAllOrders();
}

function deleteOrderController($order_id) {
    $orderManager = new OrderManager();
    return $orderManager->deleteOrder($order_id);
}

function addOrderDetailsController($order_id, $product_id, $qty) {
    $orderManager = new OrderManager();
    return $orderManager->addOrderDetails($order_id, $product_id, $qty);
}

function viewOrderDetailsController($order_id) {
    $orderManager = new OrderManager();
    return $orderManager->viewOrderDetails($order_id);
}

function deleteOrderDetailsController($order_id) {
    $orderManager = new OrderManager();
    return $orderManager->deleteOrderDetails($order_id);
}
?>