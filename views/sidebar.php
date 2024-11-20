<?php
session_start();
$loggedIn = isset($_SESSION['user']);

if (!$loggedIn) {
    header('Location:../login/login.php');
    exit();
}

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 2) {
        header('Location: index.php');
    }
} else {
    header('Location: ../login/login.php');
}
?>
<div class="d-flex flex-column flex-shrink-0 p-3 bg-dark text-white" style="width: 250px; height: 100vh;">
    <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">Admin Panel</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="dashboard.php" class="nav-link text-white">
                <i class="fas fa-tachometer-alt me-2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="../actions/set_user_view.php" class="nav-link text-white">
                <i class="fas fa-eye me-2"></i> User View
            </a>
        </li>
        <li class="nav-item">
            <a href="productmgmt.php" class="nav-link text-white">
                <i class="fas fa-boxes me-2"></i> Product Management
            </a>
        </li>
        <li class="nav-item">
            <a href="brand.php" class="nav-link text-white">
                <i class="fas fa-tags me-2"></i> Brand Management
            </a>
        </li>
        <li class="nav-item">
            <a href="category.php" class="nav-link text-white">
                <i class="fas fa-list me-2"></i> Category Management
            </a>
        </li>
    </ul>
    <hr>
    <div>
        <a href="../login/logout.php" class="btn btn-danger w-100">Logout</a>
    </div>
</div>

<style>
    .nav-link.active {
        background-color: #495057;
    }

    .nav-link:hover {
        background-color: #495057;
    }
</style>