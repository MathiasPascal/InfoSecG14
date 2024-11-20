<?php
require_once '../controllers/user_controller.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $user_controller = new user_controller();
    $result = $user_controller->login($email, $password);

    $response = json_decode($result, true);

    if ($response['status'] === 'success') {
        session_start();
        $_SESSION['user'] = $response['data']['id'];
        $_SESSION['role'] = $response['data']['role'];
        echo json_encode([
            'status' => 'success',
            'message' => 'Login successful',
            'data' => $response['data']
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => $response['message']
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method.'
    ]);
}