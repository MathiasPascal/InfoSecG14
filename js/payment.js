$(document).ready(function () {
    $('#paymentForm').submit(function (event) {
        event.preventDefault();

        var formData = {
            amt: $('#amt').val(),
            order_id: $('#order_id').val(),
            currency: $('#currency').val()
        };

        // Initialize Paystack payment
        var handler = PaystackPop.setup({
            key: 'pk_test_77ec42645ca666362284603f5c0c32866795216b',
            email: $('#email').val(),
            amount: formData.amt * 100, 
            currency: formData.currency,
            ref: '' + Math.floor((Math.random() * 1000000000) + 1), 
            callback: function (response) {
                $.ajax({
                    url: '../actions/verify_payment.php',
                    method: 'POST',
                    data: { reference: response.reference },
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            Swal.fire('Success', response.message, 'success');
                        } else {
                            Swal.fire('Error', response.message, 'error');
                        }
                    },
                    error: function (xhr, status, error) {
                        Swal.fire('Error', 'An error occurred while verifying the payment', 'error');
                    }
                });
            },
            onClose: function () {
                Swal.fire('Error', 'Payment was not completed', 'error');
            }
        });

        handler.openIframe();
    });
});