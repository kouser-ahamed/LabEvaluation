<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

require 'db.php';
$user = $_SESSION['user'];

if (isset($_POST['delete_id'])) {
    $del_id = (int) $_POST['delete_id'];
    $conn->query("DELETE FROM users WHERE id=$del_id");
    header("Location: dashboard.php");
    exit();
}

$result = $conn->query("SELECT * FROM users ORDER BY id ASC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <!-- <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9fafb;
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        .container {
            max-width: 900px;
            background: #fff;
            margin: auto;
            padding: 20px 25px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #4a90e2;
            margin-bottom: 25px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            text-align: center;
        }
        th, td {
            padding: 12px 10px;
            border: 1px solid #ddd;
            font-size: 14px;
            color: #555;
        }
        th {
            background: #4a90e2;
            color: white;
        }
        a.action-link {
            color: #4a90e2;
            text-decoration: none;
            margin: 0 6px;
            font-weight: bold;
            cursor: pointer;
        }
        a.action-link:hover {
            text-decoration: underline;
        }
        .btn {
            display: inline-block;
            color: white;
            padding: 10px 18px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            float: right;
            margin-bottom: 15px;
            transition: background 0.3s;
        }
        .logout-btn {
            background: #e74c3c;
        }
        .logout-btn:hover {
            background: #c0392b;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
        form.delete-form {
            display: inline;
        }
        button.delete-btn {
            background: none;
            border: none;
            color: #e74c3c;
            font-weight: bold;
            cursor: pointer;
            text-decoration: underline;
            padding: 0;
            font-size: 14px;
        }
        button.delete-btn:hover {
            color: #c0392b;
        }
    </style> -->
</head>
<body>
    <div class="container">
        <h1>Welcome to Dashboard, <?= htmlspecialchars($user['name']) ?>!</h1>

        <div class="clearfix">
            <a href="logout.php" class="btn logout-btn">Logout</a>
        </div>

        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password (Hash)</th>
                <th>Registered At</th>
                <th>Action</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td style="font-size: 12px; word-break: break-all;"><?= $row['password'] ?></td>
                    <td><?= $row['reg_date'] ?></td>
                    <td>
                        <a href="update_profile.php?id=<?= $row['id'] ?>" class="action-link">Update</a> |
                        <form method="POST" class="delete-form" onsubmit="return confirm('Are you sure to delete this user?');">
                            <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
