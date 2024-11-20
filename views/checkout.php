<?php
session_start();
$customerId = $_SESSION['user'] ?? null;
$_SESSION['user_id'] = $customerId; // Set the user_id session variable
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script src="../js/payment.js"></script>
</head>

<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Checkout</h1>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Order Summary</h5>
            </div>
            <div class="card-body">
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
            <div class="card-footer text-right">
                <button type="button" class="btn btn-secondary" onclick="window.history.back();">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirm-order-button">Confirm Order</button>
            </div>
        </div>
    </div>

    <!-- Payment Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Payment Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="paymentForm">
                        <div class="form-group">
                            <label for="amt">Amount:</label>
                            <input type="number" step="0.01" class="form-control" id="amt" name="amt" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="currency">Currency:</label>
                            <input type="text" class="form-control" id="currency" name="currency" value="GHS" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Process Payment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var customerId = <?php echo json_encode($customerId); ?>;

        $(document).ready(function() {
            function fetchCartItems() {
                $.ajax({
                    url: '../actions/get_cart_action.php',
                    method: 'GET',
                    data: {
                        customer_id: customerId
                    },
                    dataType: 'json',
                    success: function(response) {
                        var orderSummaryBody = $('#order-summary-body');
                        orderSummaryBody.empty();
                        if (response.success) {
                            if (response.empty) {
                                orderSummaryBody.append(`
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            Your cart is empty. Add something to the cart to see it here.
                                            <br>
                                            <a href="../views/products.php" class="btn btn-primary mt-3">Go to Products</a>
                                        </td>
                                    </tr>
                                `);
                                $('#order-summary-total-cost').text('0.00');
                            } else {
                                var totalCost = 0;
                                $.each(response.data, function(index, item) {
                                    var itemTotal = item.qty * item.product_price;
                                    totalCost += itemTotal;
                                    orderSummaryBody.append(`
                                        <tr>
                                            <td>${item.product_title}</td>
                                            <td>$${item.product_price}</td>
                                            <td>${item.qty}</td>
                                            <td>$${itemTotal.toFixed(2)}</td>
                                        </tr>
                                    `);
                                });
                                $('#order-summary-total-cost').text(totalCost.toFixed(2));
                                $('#amt').val(totalCost.toFixed(2)); // Set the amount in the payment form
                            }
                        } else {
                            Swal.fire('Error', response.message, 'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire('Error', 'An error occurred while fetching cart items', 'error');
                    }
                });
            }

            fetchCartItems();

            $('#confirm-order-button').click(function() {
                // Gather order details
                var orderDetails = [];
                $('#order-summary-body tr').each(function() {
                    var productId = $(this).data('product-id');
                    var quantity = $(this).find('.update-quantity').val();
                    if (productId && quantity) {
                        orderDetails.push({
                            product_id: productId,
                            qty: quantity
                        });
                    }
                });

                // Send order details to the server
                $.ajax({
                    url: '../actions/add_orders_action.php',
                    method: 'POST',
                    data: {
                        customer_id: customerId,
                        invoice_no: Date.now(),
                        order_date: new Date().toISOString().slice(0, 19).replace('T', ' '),
                        order_status: 'Pending'
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            var orderId = response.order_id;
                            console.log('Order ID: ' + orderId);
                            // Set the order_id session variable

                            $.each(orderDetails, function(index, detail) {
                                $.ajax({
                                    url: '../actions/add_orderdetails_action.php',
                                    method: 'POST',
                                    data: {
                                        order_id: orderId,
                                        product_id: detail.product_id,
                                        qty: detail.qty
                                    },
                                    dataType: 'json',
                                    success: function(response) {
                                        if (response.success) {
                                            $.ajax({
                                                url: '../actions/delete_cart_item_action.php',
                                                method: 'POST',
                                                data: {
                                                    product_id: detail.product_id,
                                                    customer_id: customerId
                                                },
                                                dataType: 'json',
                                                success: function(response) {
                                                    if (!response.success) {
                                                        Swal.fire('Error', response.message, 'error');
                                                    }
                                                },
                                                error: function(xhr, status, error) {
                                                    Swal.fire('Error', 'An error occurred while removing the item from the cart', 'error');
                                                }
                                            });
                                        } else {
                                            Swal.fire('Error', response.message, 'error');
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        Swal.fire('Error', 'An error occurred while adding order details', 'error');
                                    }
                                });
                            });

                            // Show the payment modal
                            $('#paymentModal').modal('show');
                        } else {
                            Swal.fire('Error', response.message, 'error');
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire('Error', 'An error occurred while placing the order', 'error');
                    }
                });
            });

            $('#paymentForm').submit(function(event) {
                event.preventDefault();

                var formData = {
                    amt: $('#amt').val(),
                    currency: $('#currency').val(),
                    email: $('#email').val()
                };

                // Initialize Paystack payment
                var handler = PaystackPop.setup({
                    key: 'pk_test_77ec42645ca666362284603f5c0c32866795216b',
                    email: formData.email,
                    amount: formData.amt * 100, // Paystack accepts amount in kobo
                    currency: formData.currency,
                    ref: '' + Math.floor((Math.random() * 1000000000) + 1), // Generate a random reference number
                    callback: function(response) {
                        // Verify the payment
                        $.ajax({
                            url: '../actions/verify_payment.php',
                            method: 'POST',
                            data: {
                                reference: response.reference
                            },
                            dataType: 'json',
                            success: function(response) {
                                if (response.success) {
                                    // Clear the cart
                                    $.ajax({
                                        url: '../actions/clear_cart_action.php',
                                        method: 'POST',
                                        data: {
                                            customer_id: customerId
                                        },
                                        dataType: 'json',
                                        success: function(response) {
                                            if (response.success) {
                                                Swal.fire({
                                                    title: 'Success',
                                                    text: 'Payment was successful and your cart has been cleared!',
                                                    icon: 'success',
                                                    confirmButtonText: 'OK'
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        window.location.href = 'index.php';
                                                    }
                                                });
                                            } else {
                                                Swal.fire('Error', response.message, 'error');
                                            }
                                        },
                                        error: function(xhr, status, error) {
                                            Swal.fire('Error', 'An error occurred while clearing the cart', 'error');
                                        }
                                    });
                                } else {
                                    Swal.fire('Error', response.message, 'error');
                                }
                            },
                            error: function(xhr, status, error) {
                                Swal.fire('Error', 'An error occurred while verifying the payment', 'error');
                            }
                        });
                    },
                    onClose: function() {
                        Swal.fire('Error', 'Payment was not completed', 'error');
                    }
                });

                handler.openIframe();
            });
        });
    </script>
</body>

</html>