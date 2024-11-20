<?php

include("../controllers/brand_controller.php");

$brand_id = $_POST['brand_id'];

$delete_result = deleteBrandController($brand_id);

if ($delete_result) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to delete brand']);
}
