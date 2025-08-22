<?php
require 'db.php';
if (isset($_POST['register'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $pass = $_POST['password'];
    $confirm_pass = $_POST['confirm_password'];
    if ($pass !== $confirm_pass) {
        echo "<script>alert('Passwords do not match!');</script>";
    } else {
        $hash_pass = password_hash($pass, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hash_pass')";
        if ($conn->query($sql)) {
            echo "<script>alert('Registration Successful!'); window.location='login.php';</script>";
        } else {
            echo "<script>alert('Email already exists or error!');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9fafb;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 360px;
            background: #fff;
            margin: 60px auto;
            padding: 20px 25px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        input[type=text],
        input[type=email],
        input[type=password] {
            width: 100%;
            padding: 10px 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }

        input[type=text]:focus,
        input[type=email]:focus,
        input[type=password]:focus {
            border-color: #4a90e2;
            outline: none;
        }

        button {
            width: 100%;
            background: #4a90e2;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            margin-top: 12px;
            transition: background 0.3s;
        }

        button:hover {
            background: #357ABD;
        }

        p {
            margin-top: 15px;
            font-size: 14px;
            color: #555;
        }

        a {
            color: #4a90e2;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Register</h2>
        <form method="POST" autocomplete="off">
            <input type="text" name="name" placeholder="Full Name" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required><br>
            <button type="submit" name="register">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>

</html>