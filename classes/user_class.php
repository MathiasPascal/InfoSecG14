<?php
require_once 'DatabaseConnection.php';

class Customer extends db_connection
{
    public function addCustomer($fullName, $email, $password, $country, $city, $contactNumber, $role = 2)
    {
        $conn = $this->db_conn();

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        
        if (!preg_match("/^[a-zA-Z0-9._%+-]+@ashesi.edu.gh$/", $email)) {
            return json_encode(['status' => 'error', 'message' => 'Invalid Ashesi email address.']);
        }

        
        $checkEmailQuery = "SELECT * FROM customer WHERE customer_email = ?";
        $stmt = $conn->prepare($checkEmailQuery);
        if (!$stmt) {
            return json_encode(['status' => 'error', 'message' => 'Prepare failed: (' . $conn->errno . ') ' . $conn->error]);
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            return json_encode(['status' => 'error', 'message' => 'Email already exists.']);
        }

        
        $insertQuery = "INSERT INTO customer (customer_name, customer_email, customer_pass, customer_country, customer_city, customer_contact, user_role) 
                        VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        if (!$stmt) {
            return json_encode(['status' => 'error', 'message' => 'Prepare failed: (' . $conn->errno . ') ' . $conn->error]);
        }
        $stmt->bind_param("ssssssi", $fullName, $email, $hashedPassword, $country, $city, $contactNumber, $role);

        if ($stmt->execute()) {
            return json_encode(['status' => 'success', 'message' => 'Customer added successfully.']);
        } else {
            return json_encode(['status' => 'error', 'message' => 'Error adding customer: (' . $stmt->errno . ') ' . $stmt->error]);
        }
    }

    public function login($email, $password)
    {
        $conn = $this->db_conn();

        
        if (!preg_match("/^[a-zA-Z0-9._%+-]+@ashesi.edu.gh$/", $email)) {
            return json_encode(['status' => 'error', 'message' => 'Invalid Ashesi email address.']);
        }

        
        $checkEmailQuery = "SELECT customer_id, customer_pass, user_role FROM customer WHERE customer_email = ?";
        $stmt = $conn->prepare($checkEmailQuery);
        if (!$stmt) {
            return json_encode(['status' => 'error', 'message' => 'Prepare failed: (' . $conn->errno . ') ' . $conn->error]);
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 0) {
            return json_encode(['status' => 'error', 'message' => 'Email does not exist.']);
        }

        $stmt->bind_result($customerId, $hashedPassword, $userRole);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
            return json_encode([
                'status' => 'success',
                'message' => 'Login successful.',
                'data' => [
                    'id' => $customerId,
                    'role' => $userRole
                ]
            ]);
        } else {
            return json_encode(['status' => 'error', 'message' => 'Invalid password.']);
        }
    }
}
