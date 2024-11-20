<?php
class db_connection
{
    protected function db_conn()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "shoppn";


        $conn = new mysqli($servername, $username, $password, $dbname);


        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }
}
