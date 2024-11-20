<?php
include("../classes/cart_class.php");

function addToCartController($productId, $ipAddress, $CustomerId, $quantity) {
    $cart = new cart_class();
    return $cart->addToCart($productId, $ipAddress, $CustomerId, $quantity);
}

function updateCartController($productId, $customerId, $quantity) {
    $cart = new cart_class();
    return $cart->updateCart($productId, $customerId, $quantity);
}

function deleteFromCartController($productId, $customerId) {
    $cart = new cart_class();
    return $cart->deleteFromCart($productId, $customerId);
}

function getCartItemsController($CustomerId) {
    $cart = new cart_class();
    return $cart->getCartItems($CustomerId);
}

function clearCartController($customerId) {
    $cart = new cart_class();
    return $cart->clearCart($customerId);
}
?>