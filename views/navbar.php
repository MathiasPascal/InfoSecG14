<?php
session_start();
$loggedIn = isset($_SESSION['user']);

if ($loggedIn) {
    $user = $_SESSION['user'];
} else {
    header('Location:../login/login.php');
    exit();
}

if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 1) {
        header('Location: dashboard.php');
        exit();
    }
} else {
    header('Location: ../login/login.php');
    exit();
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Shopmore</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="products.php">View Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cart.php">Cart</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="checkout.php">Checkout</a>
            </li>
            <li class="nav-item">
                <?php if ($loggedIn): ?>
                    <a class="nav-link" href="../login/logout.php">Logout</a>
                <?php else: ?>
                    <a class="nav-link" href="../login/login.php">Login</a>
                <?php endif; ?>
            </li>
            <li class="nav-item">
                <?php if (!$loggedIn): ?>
                    <a class="nav-link" href="../login/signup.php">Register</a>
                <?php endif; ?>
            </li>
            <?php if (isset($_SESSION['user_view']) && $_SESSION['user_view'] === true): ?>
                <li class="nav-item">
                    <a class="nav-link" href="../actions/unset_user_view.php">Return to Admin View</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>