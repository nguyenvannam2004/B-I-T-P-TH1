<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quanlyhoa";

// Kết nối đến cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra xem có tham số 'id' trong URL không
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Truy vấn xóa hoa theo ID
    $sql = "DELETE FROM hoa WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Nếu xóa thành công, quay lại trang danh sách hoa
        header("Location: admin.php");
        exit();
    } else {
        echo "Lỗi: " . $conn->error;
    }
} else {
    echo "Không tìm thấy ID hoa để xóa.";
}

$conn->close();
?>
