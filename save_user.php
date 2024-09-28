<?php
// config.php
$servername = "localhost";
$username = "root"; // เปลี่ยนตามที่คุณใช้
$password = ""; // เปลี่ยนตามที่คุณใช้
$dbname = "otop_db"; // เปลี่ยนตามที่คุณใช้

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// รับข้อมูล JSON
$data = json_decode(file_get_contents("php://input"), true);

$google_id = $conn->real_escape_string($data['google_id']);
$name = $conn->real_escape_string($data['name']);
$email = $conn->real_escape_string($data['email']);
$profile_picture = $conn->real_escape_string($data['profile_picture']);

// ตรวจสอบว่าผู้ใช้งานมีอยู่ในฐานข้อมูลหรือไม่
$sql = "SELECT * FROM user WHERE google_id='$google_id'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    // ถ้าไม่มีผู้ใช้ ให้เพิ่มผู้ใช้ใหม่
    $sql = "INSERT INTO user (google_id, name, email, profile_picture) VALUES ('$google_id', '$name', '$email', '$profile_picture')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
