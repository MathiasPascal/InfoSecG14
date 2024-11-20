<?php
require_once '../classes/user_class.php';

class user_controller
{
    private $customer;

    public function __construct()
    {
        $this->customer = new Customer();
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            $fullName = $_POST['full_name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $country = $_POST['country'] ?? '';
            $city = $_POST['city'] ?? '';
            $contactNumber = $_POST['contact_number'] ?? '';
            $role = $_POST['role'] ?? 2; 

            
            $result = $this->customer->addCustomer($fullName, $email, $password, $country, $city, $contactNumber, $role);

            
            echo $result;
        } else {
            echo "Invalid request method.";
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $result = $this->customer->login($email, $password);
            return $result;
        } else {
            return json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
        }
    }
}
