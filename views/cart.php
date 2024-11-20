<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../js/cart.js"></script>
</head>

<body>
    <?php include 'navbar.php';
    $customerId = $_SESSION['user'] ?? null;
    ?>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Shopping Cart</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="cart-table-body">
            </tbody>
        </table>
        <div class="text-right">
            <h3>Total Cost: $<span id="total-cost">0.00</span></h3>
            <button id="checkout-button" class="btn btn-success mt-3" onclick="window.location.href='checkout.php'">Proceed to Checkout</button>
        </div>
    </div>

    <div class="modal fade" id="orderSummaryModal" tabindex="-1" aria-labelledby="orderSummaryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderSummaryModalLabel">Order Summary</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="order-summary-body">
                        </tbody>
                    </table>
                    <h3 class="text-right">Total Cost: $<span id="order-summary-total-cost">0.00</span></h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirm-order-button">Confirm Order</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var customerId = <?php echo json_encode($customerId); ?>;
    </script>
</body>

</html>