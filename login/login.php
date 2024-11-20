<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="../js/login.js"></script>
    <style>
        body {
            background-color: #f0f4f8;
            color: #333;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100dvh;
            margin: 0;
        }

        .container {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            padding: 40px;
            max-width: 500px;
            width: 100%;
            box-sizing: border-box;
            transform: translateY(-10px);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .container:hover {
            transform: translateY(-20px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
        }

        h2 {
            color: #007bff;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            position: relative;
        }

        .form-group input {
            border: 2px solid #007bff;
            border-radius: 25px;
            padding-left: 40px;
            transition: all 0.3s ease;
            width: 100%;
            box-sizing: border-box;
        }

        .form-group input:focus {
            border-color: #0056b3;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
        }

        .form-group label {
            color: #007bff;
            font-weight: bold;
        }

        .form-group .fa {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #007bff;
        }

        .btn-primary {
            background: #007bff;
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            transition: background 0.3s ease;
            width: 100%;
            box-sizing: border-box;
        }

        .btn-primary:hover {
            background: #0056b3;
        }

        p {
            text-align: center;
        }

        p a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        p a:hover {
            color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Login</h2>
        <form id="loginForm" action="../actions/login_process.php" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <i class="fa fa-envelope"></i>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <i class="fa fa-lock"></i>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <p class="mt-3">Don't have an account? <a href="signup.php">Register here</a></p>
    </div>
</body>

</html>