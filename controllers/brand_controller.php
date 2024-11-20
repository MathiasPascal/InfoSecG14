<?php

include("../classes/brand_class.php");


function addBrandController($brandName)
{
    $addbrand = new brand_class();
    return $addbrand->addBrand($brandName);
}

function viewBrandsController()
{
    $brand = new brand_class();
    return $brand->getBrands();
}

function deleteBrandController($brand_id)
{
    $brand = new brand_class();
    return $brand->deleteBrand($brand_id);
}


