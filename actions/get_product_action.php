<?php

include("../controllers/product_controller.php");

$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : '';

$products = viewProductsController($category_id);

$product_data = array();
if ($products && $products instanceof mysqli_result) {
    while ($product = mysqli_fetch_assoc($products)) {
        $product_data[] = $product;
    }
}
header('Content-Type: application/json');
echo json_encode($product_data);
