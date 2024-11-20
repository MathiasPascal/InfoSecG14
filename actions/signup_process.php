<?php
require_once '../controllers/user_controller.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullName = $_POST['full_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $country = $_POST['country'] ?? '';
    $city = $_POST['city'] ?? '';
    $contactNumber = $_POST['contact_number'] ?? '';
    $role = $_POST['role'] ?? 2;

    $user_controller = new user_controller();

    $result = $user_controller->register($fullName, $email, $password, $country, $city, $contactNumber, $role);
    echo $result;
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
