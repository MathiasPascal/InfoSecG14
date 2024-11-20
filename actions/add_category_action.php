<?php
include("../controllers/category_controller.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cat_name = filter_input(INPUT_POST, 'cat_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if ($cat_name) {
        $result = addCategoryController($cat_name);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Category added successfully']);
        } else {
            error_log('Failed to add category: ' . print_r($result, true));
            echo json_encode(['success' => false, 'message' => 'Failed to add category']);
        }
    } else {
        error_log('Invalid input data: ' . print_r($_POST, true));
        echo json_encode(['success' => false, 'message' => 'Invalid input data']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>