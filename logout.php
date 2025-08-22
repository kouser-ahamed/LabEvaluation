<?php
session_start();
session_unset();
session_destroy();
header("Location: login.php");
exit();
?>
<!-- CREATE DATABASE IF NOT EXISTS users_db;
USE users_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
); -->


