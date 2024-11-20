$(document).ready(function () {
    $('#registerForm').on('submit', function (e) {
        e.preventDefault();

        let email = $('#email').val();
        let password = $('#password').val();
        let contactNumber = $('#contact_number').val();

        let emailRegex = /^[a-zA-Z0-9._%+-]+@ashesi.edu.gh$/;
        if (!emailRegex.test(email)) {
            Swal.fire('Error', 'Email must be an Ashesi email', 'error');
            return;
        }
        if (password.length < 6) {
            Swal.fire('Error', 'Password must be at least 6 characters long', 'error');
            return;
        }
        let phoneRegex = /^\+[1-9]\d{1,14}$/;
        if (!phoneRegex.test(contactNumber)) {
            Swal.fire('Error', 'Contact number must be in E.164 format', 'error');
            return;
        }

        $.ajax({
            url: '../actions/signup_process.php',
            type: 'POST',
            data: $('#registerForm').serialize(),
            success: function (response) {
                if (response.status === 'success') {
                    Swal.fire('Success', response.message, 'success').then(() => {
                        window.location.href = 'login.php';
                    });
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function () {
                Swal.fire('Error', 'Error processing request', 'error');
            }
        });
    });
});