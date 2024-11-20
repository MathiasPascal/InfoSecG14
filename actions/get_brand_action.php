<?php

include("../controllers/brand_controller.php");
$brands = viewBrandsController();

$brand_data = array();
if ($brands && $brands instanceof mysqli_result) {
    while ($brand = mysqli_fetch_assoc($brands)) {
        $brand_data[] = $brand;
    }
}
header('Content-Type: application/json');
echo json_encode($brand_data);
?>