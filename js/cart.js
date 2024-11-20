$(document).ready(function () {
    function fetchCartItems() {
        $.ajax({
            url: '../actions/get_cart_action.php',
            method: 'GET',
            data: { customer_id: customerId },
            dataType: 'json',
            success: function (response) {
                var cartTableBody = $('#cart-table-body');
                cartTableBody.empty();
                if (response.success) {
                    if (response.empty) {
                        cartTableBody.append(`
                            <tr>
                                <td colspan="5" class="text-center">
                                    Your cart is empty. Add something to the cart to see it here.
                                    <br>
                                    <a href="../views/products.php" class="btn btn-primary mt-3">Go to Products</a>
                                </td>
                            </tr>
                        `);
                        $('#total-cost').text('0.00');
                    } else {
                        var totalCost = 0;
                        $.each(response.data, function (index, item) {
                            var itemTotal = item.qty * item.product_price;
                            totalCost += itemTotal;
                            cartTableBody.append(`
                                <tr>
                                    <td>${item.product_title}</td>
                                    <td>$${item.product_price}</td>
                                    <td>
                                        <input type="number" class="form-control update-quantity" data-product-id="${item.product_id}" value="${item.qty}" min="1">
                                    </td>
                                    <td>$${itemTotal.toFixed(2)}</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm delete-item" data-product-id="${item.product_id}">
                                            <i class="fas fa-trash-alt"></i> Remove
                                        </button>
                                    </td>
                                </tr>
                            `);
                        });
                        $('#total-cost').text(totalCost.toFixed(2));
                    }
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function (xhr, status, error) {
                Swal.fire('Error', 'An error occurred while fetching cart items', 'error');
            }
        });
    }

    fetchCartItems();

    $(document).on('change', '.update-quantity', function () {
        var productId = $(this).data('product-id');
        var quantity = $(this).val();

        $.ajax({
            url: '../actions/update_cart_action.php',
            method: 'POST',
            data: {
                product_id: productId,
                customer_id: customerId,
                quantity: quantity
            },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    Swal.fire('Success', response.message, 'success');
                    fetchCartItems();
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function (xhr, status, error) {
                Swal.fire('Error', 'An error occurred while updating the cart', 'error');
            }
        });
    });

    $(document).on('click', '.delete-item', function () {
        var productId = $(this).data('product-id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../actions/delete_cart_item_action.php',
                    method: 'POST',
                    data: {
                        product_id: productId,
                        customer_id: customerId
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            Swal.fire('Deleted!', response.message, 'success');
                            fetchCartItems();
                        } else {
                            Swal.fire('Error', response.message, 'error');
                        }
                    },
                    error: function (xhr, status, error) {
                        Swal.fire('Error', 'An error occurred while deleting the item from the cart', 'error');
                    }
                });
            }
        });
    });

    $('#checkout-button').click(function () {
        var cartItems = $('#cart-table-body').html();
        var totalCost = $('#total-cost').text();
        $('#order-summary-body').html(cartItems);
        $('#order-summary-total-cost').text(totalCost);

        $('#orderSummaryModal').modal('show');
    });

    $('#confirm-order-button').click(function () {
        var orderDetails = [];
        $('#cart-table-body tr').each(function () {
            var productId = $(this).find('.delete-item').data('product-id');
            var quantity = $(this).find('.update-quantity').val();
            if (productId && quantity) {
                orderDetails.push({ product_id: productId, qty: quantity });
            }
        });

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
            success: function (response) {
                if (response.success) {
                    var orderId = response.order_id;

                    $.each(orderDetails, function (index, detail) {
                        $.ajax({
                            url: '../actions/add_orderdetails_action.php',
                            method: 'POST',
                            data: {
                                order_id: orderId,
                                product_id: detail.product_id,
                                qty: detail.qty
                            },
                            dataType: 'json',
                            success: function (response) {
                                if (response.success) {
                                    $.ajax({
                                        url: '../actions/delete_cart_item_action.php',
                                        method: 'POST',
                                        data: {
                                            product_id: detail.product_id,
                                            customer_id: customerId
                                        },
                                        dataType: 'json',
                                        success: function (response) {
                                            if (!response.success) {
                                                Swal.fire('Error', response.message, 'error');
                                            }
                                        },
                                        error: function (xhr, status, error) {
                                            Swal.fire('Error', 'An error occurred while removing the item from the cart', 'error');
                                        }
                                    });
                                } else {
                                    Swal.fire('Error', response.message, 'error');
                                }
                            },
                            error: function (xhr, status, error) {
                                Swal.fire('Error', 'An error occurred while adding order details', 'error');
                            }
                        });
                    });

                    $('#orderSummaryModal').modal('hide');
                    Swal.fire({
                        title: 'Success',
                        text: 'Your order has been placed successfully!',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function (xhr, status, error) {
                Swal.fire('Error', 'An error occurred while placing the order', 'error');
            }
        });
    });
});