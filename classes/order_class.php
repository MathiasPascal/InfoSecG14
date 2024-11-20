<?php
require("../settings/db_class.php");

class OrderManager extends db_connection
{
    public function addOrder($customer_id, $invoice_no, $order_date, $order_status)
    {
        $conn = $this->db_conn(); // Get the database connection
        $customer_id = mysqli_real_escape_string($conn, $customer_id);
        $invoice_no = mysqli_real_escape_string($conn, $invoice_no);
        $order_date = mysqli_real_escape_string($conn, $order_date);
        $order_status = mysqli_real_escape_string($conn, $order_status);
        $customer_id = intval($customer_id);
        $invoice_no = intval($invoice_no);

        $sql = "INSERT INTO `orders`(`customer_id`, `invoice_no`, `order_date`, `order_status`) 
                VALUES ('$customer_id', '$invoice_no', '$order_date', '$order_status')";

        if (mysqli_query($conn, $sql)) {
            $order_id = mysqli_insert_id($conn);
            error_log("Order ID: " . $order_id);
            return $order_id;
        } else {
            error_log("Failed to add order: " . mysqli_error($conn));
            return false;
        }
    }

    public function viewAllOrders()
    {
        $sql = "SELECT * FROM `orders`";
        return $this->db_query($sql);
    }

    public function deleteOrder($order_id)
    {
        $conn = $this->db_conn();
        $order_id = mysqli_real_escape_string($conn, $order_id);
        $sql = "DELETE FROM `orders` WHERE `order_id` = '$order_id'";
        return mysqli_query($conn, $sql);
    }

    public function addOrderDetails($order_id, $product_id, $qty)
    {
        $conn = $this->db_conn();
        $order_id = mysqli_real_escape_string($conn, $order_id);
        $product_id = mysqli_real_escape_string($conn, $product_id);
        $qty = mysqli_real_escape_string($conn, $qty);

        $sql = "INSERT INTO `orderdetails`(`order_id`, `product_id`, `qty`) 
                VALUES ('$order_id', '$product_id', '$qty')";
        return mysqli_query($conn, $sql);
    }

    public function viewOrderDetails($order_id)
    {
        $conn = $this->db_conn();
        $order_id = mysqli_real_escape_string($conn, $order_id);
        $sql = "SELECT * FROM `orderdetails` WHERE `order_id` = '$order_id'";
        return $this->db_query($sql);
    }

    public function deleteOrderDetails($order_id)
    {
        $conn = $this->db_conn();
        $order_id = mysqli_real_escape_string($conn, $order_id);
        $sql = "DELETE FROM `orderdetails` WHERE `order_id` = '$order_id'";
        return mysqli_query($conn, $sql);
    }
}
?>