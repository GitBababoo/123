<?php
// config.php

$host = 'localhost'; // เปลี่ยนเป็น host ของคุณ
$dbname = 'otop_db'; // ชื่อฐานข้อมูล
$username = 'root'; // ชื่อผู้ใช้ฐานข้อมูล
$password = ''; // รหัสผ่านฐานข้อมูล

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// ใช้งาน PDO ต่อไปในไฟล์อื่นๆ
