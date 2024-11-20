<?php

include("../classes/product_class.php");

function addProductController($title, $brand, $category, $price, $desc, $keywords) {
    $product = new Product();
    return $product->addProduct($title, $brand, $category, $price, $desc, $keywords);
}

function deleteProductController($product_id)
{
    $product = new Product();
    return $product->deleteProduct($product_id);
}

function viewProductsController($category_id = '') {
    $product = new Product();
    return $product->viewProducts($category_id);
}
