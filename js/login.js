$(document).ready(function () {
    $('#loginForm').on('submit', function (e) {
        e.preventDefault();

        let email = $('#email').val();
        let password = $('#password').val();

        
        let emailRegex = /^[a-zA-Z0-9._%+-]+@ashesi.edu.gh$/;
        if (!emailRegex.test(email)) {
            Swal.fire('Error', 'Email must be an Ashesi email', 'error');
            return;
        }

        
        if (password.length < 6) {
            Swal.fire('Error', 'Password must be at least 6 characters long', 'error');
            return;
        }

        
        $.ajax({
            url: '../actions/login_process.php',
            type: 'POST',
            data: $('#loginForm').serialize(),
            success: function (response) {
                let res = response;
                if (res.status === 'success') {
                    Swal.fire('Success', res.message, 'success').then(() => {
                        window.location.href = '../views/index.php';
                    });
                } else {
                    Swal.fire('Error', res.message, 'error');
                }
            },
            error: function () {
                Swal.fire('Error', 'Error processing request', 'error');
            }
        });
    });
});