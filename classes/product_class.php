<?php
//connect to database class
require("../settings/db_class.php");

/**
 * Product class to handle all product-related functions
 */
class Product extends db_connection
{
    // Add a new product/service
    public function addProduct($title, $brand, $category, $price, $desc, $keywords)
    {
        $title = mysqli_real_escape_string($this->db_conn(), $title);
        $brand = mysqli_real_escape_string($this->db_conn(), $brand);
        $category = mysqli_real_escape_string($this->db_conn(), $category);
        $price = mysqli_real_escape_string($this->db_conn(), $price);
        $desc = mysqli_real_escape_string($this->db_conn(), $desc);
        $keywords = mysqli_real_escape_string($this->db_conn(), $keywords);
        $sql = "INSERT INTO `products`(`product_title`, `product_cat`, `product_brand`, `product_price`, `product_desc`, `product_keywords`) 
                VALUES ('$title', '$category', '$brand', '$price', '$desc', '$keywords')";
        $result = $this->db_query($sql);
        if (!$result) {
            error_log('SQL Error: ' . mysqli_error($this->db_conn()));
        }
        return $result;
    }

    // Delete a product/service by id
    public function deleteProduct($id)
    {
        $id = mysqli_real_escape_string($this->db_conn(), $id);
        $sql = "DELETE FROM `products` WHERE `product_id` = '$id'";
        return $this->db_query($sql);
    }

    // Get all products/services
    public function getProducts()
    {
        $sql = "SELECT * FROM `products`";
        return $this->db_query($sql);
    }

    public function viewProducts($category_id = '')
    {
        $sql = "SELECT * FROM `products`";
        if ($category_id) {
            $category_id = mysqli_real_escape_string($this->db_conn(), $category_id);
            $sql .= " WHERE `product_cat` = '$category_id'";
        }
        return $this->db_query($sql);
    }
}
