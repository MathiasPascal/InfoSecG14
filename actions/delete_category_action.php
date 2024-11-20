<?php
include("../controllers/category_controller.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cat_id = filter_input(INPUT_POST, 'cat_id', FILTER_SANITIZE_NUMBER_INT);

    if ($cat_id) {
        $result = deleteCategoryController($cat_id);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Category deleted successfully']);
        } else {
            error_log('Failed to delete category: ' . print_r($result, true));
            echo json_encode(['success' => false, 'message' => 'Failed to delete category']);
        }
    } else {
        error_log('Invalid input data: ' . print_r($_POST, true));
        echo json_encode(['success' => false, 'message' => 'Invalid input data']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>