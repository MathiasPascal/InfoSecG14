<?php
session_start();
if (isset($_SESSION['user'])) {
    $_SESSION['role'] = 2;
    $_SESSION['user_view'] = true;

    header('Location: ../views/index.php');
    exit();
} else {
    header('Location: ../login/login.php');
    exit();
}
