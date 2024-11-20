<?php
require("../settings/db_class.php");

class cart_class extends db_connection
{
    public function addToCart($productId, $ipAddress, $CustomerId, $quantity)
    {
        $ndb = new db_connection();

        $productId = mysqli_real_escape_string($ndb->db_conn(), $productId);
        $ipAddress = mysqli_real_escape_string($ndb->db_conn(), $ipAddress);
        $CustomerId = mysqli_real_escape_string($ndb->db_conn(), $CustomerId);
        $quantity = mysqli_real_escape_string($ndb->db_conn(), $quantity);

        $sql = "SELECT * FROM `cart` WHERE `p_id` = '$productId' AND `ip_add` = '$ipAddress' AND `c_id` = '$CustomerId'";
        $result = $this->db_fetch_one($sql);

        if ($result) {
            $newQuantity = $result['qty'] + $quantity;
            $sqlUpdate = "UPDATE `cart` SET `qty` = '$newQuantity' WHERE `p_id` = '$productId' AND `ip_add` = '$ipAddress' AND `c_id` = '$CustomerId'";
            return $this->db_query($sqlUpdate);
        } else {
            $sqlInsert = "INSERT INTO `cart` (`p_id`, `ip_add`, `c_id`, `qty`) VALUES ('$productId', '$ipAddress', '$CustomerId', '$quantity')";
            return $this->db_query($sqlInsert);
        }
    }

    public function updateCart($productId, $customerId, $quantity)
    {
        $ndb = new db_connection();
        $productId = mysqli_real_escape_string($ndb->db_conn(), $productId);
        $customerId = mysqli_real_escape_string($ndb->db_conn(), $customerId);
        $quantity = mysqli_real_escape_string($ndb->db_conn(), $quantity);

        $sqlUpdate = "UPDATE `cart` SET `qty` = '$quantity' WHERE `p_id` = '$productId' AND `c_id` = '$customerId'";
        return $this->db_query($sqlUpdate);
    }

    public function deleteFromCart($productId, $customerId)
    {
        $ndb = new db_connection();
        $productId = mysqli_real_escape_string($ndb->db_conn(), $productId);
        $customerId = mysqli_real_escape_string($ndb->db_conn(), $customerId);

        $sqlDelete = "DELETE FROM `cart` WHERE `p_id` = '$productId' AND `c_id` = '$customerId'";
        return $this->db_query($sqlDelete);
    }

    public function getCartItems($CustomerId)
    {
        $ndb = new db_connection();
        $CustomerId = mysqli_real_escape_string($ndb->db_conn(), $CustomerId);

        $sql = "SELECT
                    products.product_id,
                    products.product_title,
                    products.product_price,
                    cart.qty,
                    (products.product_price * cart.qty) AS total
                FROM 
                    cart
                JOIN 
                    products ON cart.p_id = products.product_id
                WHERE 
                    cart.c_id = '$CustomerId'";

        return $this->db_fetch_all($sql);
    }

    public function clearCart($CustomerId)
    {
        $ndb = new db_connection();
        $CustomerId = mysqli_real_escape_string($ndb->db_conn(), $CustomerId);

        $sql = "DELETE FROM `cart` WHERE `c_id` = '$CustomerId'";
        return $this->db_query($sql);
    }
}
?>