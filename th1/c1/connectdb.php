<?php
$servername = "localhost"; 
$username = "root";      
$password = "";            

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
} else {
    echo "Kết nối thành công!<br>";
}

$sql = "CREATE DATABASE IF NOT EXISTS QUANLYHOA";
if ($conn->query($sql) === TRUE) {
    echo "Cơ sở dữ liệu đã được tạo hoặc đã tồn tại.<br>";
} else {
    echo "Lỗi khi tạo cơ sở dữ liệu: " . $conn->error . "<br>";
}

$conn->select_db("QUANLYHOA");

$sql = "CREATE TABLE IF NOT EXISTS HOA (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image_path VARCHAR(255) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Bảng 'HOA' đã được tạo thành công.<br>";
} else {
    echo "Lỗi khi tạo bảng: " . $conn->error . "<br>";
}

$conn->close();

?>
