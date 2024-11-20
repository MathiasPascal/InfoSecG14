<?php
require("../settings/db_class.php");

class CategoryManager extends db_connection
{
    public function addCategory($category_name)
    {
        $ndb = new db_connection();
        $category_name = mysqli_real_escape_string($ndb->db_conn(), $category_name);
        $sql = "INSERT INTO `categories`(`cat_name`) VALUES ('$category_name')";
        return $this->db_query($sql);
    }

    public function viewAllCategories()
    {
        $sql = "SELECT * FROM `categories`";
        return $this->db_query($sql);
    }

    public function deleteCategory($cat_id)
    {
        $cat_id = mysqli_real_escape_string($this->db_conn(), $cat_id);
        $sql = "DELETE FROM `categories` WHERE `cat_id` = '$cat_id'";
        return $this->db_query($sql);
    }

}
?>