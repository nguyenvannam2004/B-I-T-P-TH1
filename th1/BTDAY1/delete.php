<?php

$dbname = "qlsp";
$servername = "localhost"; 
$username = "root";       
$password = "";  
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM sanpham WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Sản phẩm đã được xóa thành công.";
        header('Location: index.php');
        exit();
    } else {
        echo "Lỗi khi xóa sản phẩm: " . $conn->error;
    }
} else {
    echo "ID sản phẩm không hợp lệ.";
    exit();
}
$conn->close();

?>