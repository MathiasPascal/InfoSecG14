<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="../js/register.js"></script>
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
            background: transparent;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            padding: 40px;
            max-width: 500px;
            width: 100%;
            box-sizing: border-box;
            transform: translateY(-10px);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
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

        .form-group input,
        .form-group select {
            border: 2px solid #007bff;
            border-radius: 25px;
            padding-left: 40px;
            transition: all 0.3s ease;
            width: 100%;
            box-sizing: border-box;
        }

        .form-group input:focus,
        .form-group select:focus {
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
        <h2>Register</h2>
        <form id="registerForm" action="../actions/signup_process.php" method="POST">
            <div class="form-group">
                <label for="full_name">Full Name:</label>
                <input type="text" class="form-control" name="full_name" required>
            </div>
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
            <div class="form-group">
                <label for="country">Country:</label>
                <select class="form-control" name="country" id="country" required>
                    <option value="">Select Country</option>
                    <?php
                    $countries = [
                        "Afghanistan",
                        "Albania",
                        "Algeria",
                        "Andorra",
                        "Angola",
                        "Antigua and Barbuda",
                        "Argentina",
                        "Armenia",
                        "Australia",
                        "Austria",
                        "Azerbaijan",
                        "Bahamas",
                        "Bahrain",
                        "Bangladesh",
                        "Barbados",
                        "Belarus",
                        "Belgium",
                        "Belize",
                        "Benin",
                        "Bhutan",
                        "Bolivia",
                        "Bosnia and Herzegovina",
                        "Botswana",
                        "Brazil",
                        "Brunei",
                        "Bulgaria",
                        "Burkina Faso",
                        "Burundi",
                        "Cabo Verde",
                        "Cambodia",
                        "Cameroon",
                        "Canada",
                        "Central African Republic",
                        "Chad",
                        "Chile",
                        "China",
                        "Colombia",
                        "Comoros",
                        "Congo, Democratic Republic of the",
                        "Congo, Republic of the",
                        "Costa Rica",
                        "Croatia",
                        "Cuba",
                        "Cyprus",
                        "Czech Republic",
                        "Denmark",
                        "Djibouti",
                        "Dominica",
                        "Dominican Republic",
                        "Ecuador",
                        "Egypt",
                        "El Salvador",
                        "Equatorial Guinea",
                        "Eritrea",
                        "Estonia",
                        "Eswatini",
                        "Ethiopia",
                        "Fiji",
                        "Finland",
                        "France",
                        "Gabon",
                        "Gambia",
                        "Georgia",
                        "Germany",
                        "Ghana",
                        "Greece",
                        "Grenada",
                        "Guatemala",
                        "Guinea",
                        "Guinea-Bissau",
                        "Guyana",
                        "Haiti",
                        "Honduras",
                        "Hungary",
                        "Iceland",
                        "India",
                        "Indonesia",
                        "Iran",
                        "Iraq",
                        "Ireland",
                        "Israel",
                        "Italy",
                        "Jamaica",
                        "Japan",
                        "Jordan",
                        "Kazakhstan",
                        "Kenya",
                        "Kiribati",
                        "Korea, North",
                        "Korea, South",
                        "Kosovo",
                        "Kuwait",
                        "Kyrgyzstan",
                        "Laos",
                        "Latvia",
                        "Lebanon",
                        "Lesotho",
                        "Liberia",
                        "Libya",
                        "Liechtenstein",
                        "Lithuania",
                        "Luxembourg",
                        "Madagascar",
                        "Malawi",
                        "Malaysia",
                        "Maldives",
                        "Mali",
                        "Malta",
                        "Marshall Islands",
                        "Mauritania",
                        "Mauritius",
                        "Mexico",
                        "Micronesia",
                        "Moldova",
                        "Monaco",
                        "Mongolia",
                        "Montenegro",
                        "Morocco",
                        "Mozambique",
                        "Myanmar",
                        "Namibia",
                        "Nauru",
                        "Nepal",
                        "Netherlands",
                        "New Zealand",
                        "Nicaragua",
                        "Niger",
                        "Nigeria",
                        "North Macedonia",
                        "Norway",
                        "Oman",
                        "Pakistan",
                        "Palau",
                        "Palestine",
                        "Panama",
                        "Papua New Guinea",
                        "Paraguay",
                        "Peru",
                        "Philippines",
                        "Poland",
                        "Portugal",
                        "Qatar",
                        "Romania",
                        "Russia",
                        "Rwanda",
                        "Saint Kitts and Nevis",
                        "Saint Lucia",
                        "Saint Vincent and the Grenadines",
                        "Samoa",
                        "San Marino",
                        "Sao Tome and Principe",
                        "Saudi Arabia",
                        "Senegal",
                        "Serbia",
                        "Seychelles",
                        "Sierra Leone",
                        "Singapore",
                        "Slovakia",
                        "Slovenia",
                        "Solomon Islands",
                        "Somalia",
                        "South Africa",
                        "South Sudan",
                        "Spain",
                        "Sri Lanka",
                        "Sudan",
                        "Suriname",
                        "Sweden",
                        "Switzerland",
                        "Syria",
                        "Taiwan",
                        "Tajikistan",
                        "Tanzania",
                        "Thailand",
                        "Timor-Leste",
                        "Togo",
                        "Tonga",
                        "Trinidad and Tobago",
                        "Tunisia",
                        "Turkey",
                        "Turkmenistan",
                        "Tuvalu",
                        "Uganda",
                        "Ukraine",
                        "United Arab Emirates",
                        "United Kingdom",
                        "United States",
                        "Uruguay",
                        "Uzbekistan",
                        "Vanuatu",
                        "Vatican City",
                        "Venezuela",
                        "Vietnam",
                        "Yemen",
                        "Zambia",
                        "Zimbabwe"
                    ];
                    foreach ($countries as $country) {
                        echo "<option value=\"$country\">$country</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" class="form-control" name="city" required>
            </div>
            <div class="form-group">
                <label for="contact_number">Contact Number:</label>
                <input type="text" class="form-control" name="contact_number" id="contact_number" required>
            </div>
            <input type="hidden" name="action" value="register">
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
        <p class="mt-3">Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>

</html>