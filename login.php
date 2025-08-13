<?php
session_start();
require 'db.php';
if (isset($_POST['login'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $pass = $_POST['password'];
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($pass, $user['password'])) {
            $_SESSION['user'] = $user;
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<script>alert('Invalid Password!');</script>";
        }
    } else {
        echo "<script>alert('User Not Found!');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <!-- <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9fafb;
            margin: 0; padding: 0;
        }
        .container {
            max-width: 360px;
            background: #fff;
            margin: 60px auto;
            padding: 20px 25px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        input[type=email], input[type=password] {
            width: 100%;
            padding: 10px 12px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }
        input[type=email]:focus, input[type=password]:focus {
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
    </style> -->
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <form method="POST" autocomplete="off">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>
    <p>No account? <a href="register.php">Register</a></p>
</div>
</body>
</html>
