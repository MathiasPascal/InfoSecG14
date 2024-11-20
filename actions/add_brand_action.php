<?php

include("../controllers/brand_controller.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $brandName = $_POST['name'];
    $addBrand = addBrandController($brandName);
    if($addBrand !== false){
        header("Location: ../views/brand.php");
    }else{
        echo "Failed to add brand";
    }
}

?>