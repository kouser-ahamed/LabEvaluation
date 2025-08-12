<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$user = $_SESSION['user'];
$success = $error = "";

if (isset($_POST['update'])) {
    $new_email = $conn->real_escape_string($_POST['email']);
    $new_pass = $_POST['password'];

    if (!empty($new_pass)) {
        $hashed_pass = password_hash($new_pass, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET email='$new_email', password='$hashed_pass' WHERE id={$user['id']}";
    } else {
        $sql = "UPDATE users SET email='$new_email' WHERE id={$user['id']}";
    }

    if ($conn->query($sql)) {
        $result = $conn->query("SELECT * FROM users WHERE id={$user['id']}");
        $_SESSION['user'] = $result->fetch_assoc();
        $success = "Profile updated successfully!";
    } else {
        $error = "Update failed! Try again.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9fafb;
            margin: 0; padding: 0;
        }
        .container {
            max-width: 400px;
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
        p.message {
            font-size: 14px;
            color: green;
        }
        p.error {
            font-size: 14px;
            color: red;
        }
        a {
            color: #4a90e2;
            text-decoration: none;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Update Profile</h2>
    <?php if ($success) echo "<p class='message'>$success</p>"; ?>
    <?php if ($error) echo "<p class='error'>$error</p>"; ?>
    <form method="POST" autocomplete="off">
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
        <input type="password" name="password" placeholder="New Password (leave blank to keep same)">
        <button type="submit" name="update">Update</button>
    </form>
    <p><a href="dashboard.php">Back to Dashboard</a></p>
</div>
</body>
</html>
