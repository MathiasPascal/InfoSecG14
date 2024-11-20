<?php
require("../settings/db_class.php");

class payment_class extends db_connection
{
    public function addPayment($amt, $customer_id, $order_id, $currency, $payment_date)
    {

        error_log("Payment Details received in class: " . json_encode(['amt' => $amt, 'customer_id' => $customer_id, 'order_id' => $order_id, 'currency' => $currency, 'payment_date' => $payment_date]));
        $conn = $this->db_conn();
        $amt = mysqli_real_escape_string($conn, $amt);
        $customer_id = mysqli_real_escape_string($conn, $customer_id);
        $order_id = mysqli_real_escape_string($conn, $order_id);
        $currency = mysqli_real_escape_string($conn, $currency);
        $payment_date = mysqli_real_escape_string($conn, $payment_date);

        $sql = "INSERT INTO `payment`(`amt`, `customer_id`, `order_id`, `currency`, `payment_date`) 
                VALUES ('$amt', '$customer_id', '$order_id', '$currency', '$payment_date')";
        return $this->db_query($sql);
    }

    public function getPayments()
    {
        $sql = "SELECT * FROM `payments`";
        return $this->db_query($sql);
    }

    public function deletePayment($pay_id)
    {
        $sql = "DELETE FROM `payments` WHERE `pay_id` = '$pay_id'";
        return $this->db_query($sql);
    }
}
?>