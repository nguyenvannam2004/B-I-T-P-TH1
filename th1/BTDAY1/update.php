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

    $sql = "SELECT * FROM sanpham WHERE id = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $price = $row['price'];
    } else {
        echo "Không tìm thấy sản phẩm.";
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $price = $_POST['price'];

        $sql_update = "UPDATE sanpham SET name = '$name', price = '$price' WHERE id = $id";
        if ($conn->query($sql_update) === TRUE) {
            echo "Cập nhật sản phẩm thành công.";
            header('Location: index.php'); 
            exit();
        } else {
            echo "Lỗi khi cập nhật sản phẩm: " . $conn->error;
        }
    }
} else {
    echo "ID sản phẩm không hợp lệ.";
    exit();
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Sản Phẩm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="text-center">
        <h1>Sửa Thông Tin Sản Phẩm</h1>
    </div>
    <div class="container" style="width: 50%; margin-top: 50px;">
        <form action="update.php?id=<?php echo $id; ?>" method="POST">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" required>
                <label for="floatingInput">Tên Sản Phẩm</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="price" value="<?php echo $price; ?>" required>
                <label for="floatingPassword">Giá Thành</label>
            </div>
            <button type="submit" class="btn btn-success">Cập Nhật</button>
        </form>
    </div>
    <div class="container" style="margin-top: 15%">
        <hr>
    </div>

    <div class="text-center">
        <h1>TLU's MUSIC GARDEN</h1>
    </div>

</body>
</html>
