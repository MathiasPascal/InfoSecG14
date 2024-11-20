<?php
include("../controllers/category_controller.php");

$categories = viewCategoryController();

$category_data = array();
if ($categories && $categories instanceof mysqli_result) {
    while ($category = mysqli_fetch_assoc($categories)) {
        $category_data[] = $category;
    }
}
header('Content-Type: application/json');
echo json_encode($category_data);
?>