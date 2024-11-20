<?php
session_start();
if (isset($_SESSION['user'])) {
    $_SESSION['role'] = 1;
    $_SESSION['user_view'] = false;

    header('Location: ../views/dashboard.php');
    exit();
} else {
    header('Location: ../login/login.php');
    exit();
}
