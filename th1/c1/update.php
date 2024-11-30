<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quanlyhoa";

// Kết nối đến cơ sở dữ liệu
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra nếu có id trong URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Lấy thông tin hoa từ CSDL
    $sql = "SELECT * FROM hoa WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $description = $row['description'];
        $image_path = $row['image_path'];
    } else {
        echo "Không tìm thấy hoa với ID này.";
        exit;
    }
}

// Kiểm tra xem form sửa đã được gửi chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flowerName = $_POST['flowerName'];
    $flowerDescription = $_POST['flowerDescription'];

    // Cập nhật thông tin hoa vào CSDL
    $sql = "UPDATE hoa SET name = '$flowerName', description = '$flowerDescription' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Sau khi cập nhật thành công, chuyển hướng về trang admin (index.php)
        header("Location: admin.php");
        exit(); // Dừng thực thi script tiếp theo
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Thông Tin Hoa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container" style="width: 50%; margin-top: 50px;">
        <h2>Sửa Thông Tin Hoa</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="flowerName" class="form-label">Tên Hoa</label>
                <input type="text" class="form-control" id="flowerName" name="flowerName" value="<?php echo $name; ?>" required>
            </div>
            <div class="mb-3">
                <label for="flowerDescription" class="form-label">Mô Tả</label>
                <textarea class="form-control" id="flowerDescription" name="flowerDescription" rows="3" required><?php echo $description; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="flowerImage" class="form-label">Ảnh Hoa</label>
                <input type="file" class="form-control" id="flowerImage" name="flowerImage">
                <img src="<?php echo $image_path; ?>" alt="Hoa" width="100" style="margin-top: 10px;">
            </div>
            <button type="submit" class="btn btn-primary">Cập Nhật</button>
            <a href="index.php" class="btn btn-secondary" style="margin-left: 10px;">Quay lại</a>
        </form>
    </div>
</body>
</html>
