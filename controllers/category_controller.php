<?php

include("../classes/category_class.php");

function addCategoryController($cat_name)
{
    $categoryManager = new CategoryManager();
    return $categoryManager->addCategory($cat_name);
}

function viewCategoryController()
{
    $categoryManager = new CategoryManager();
    return $categoryManager->viewAllCategories();
}

function deleteCategoryController($cat_id)
{
    $categoryManager = new CategoryManager();
    return $categoryManager->deleteCategory($cat_id);
}
?>