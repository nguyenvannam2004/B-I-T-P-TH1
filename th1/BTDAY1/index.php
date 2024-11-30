<?php
$servername = "localhost"; 
$username = "root";      
$password = "";            

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS qlsp";
if ($conn->query($sql) === TRUE) {
    echo "Cơ sở dữ liệu đã được tạo thành công.";
} else {
    echo "Lỗi tạo cơ sở dữ liệu: " . $conn->error;
}

$conn->select_db("qlsp");

$sql = "CREATE TABLE IF NOT EXISTS sanpham (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  price DECIMAL(10, 2) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
  echo "Bảng sp đã được tạo thành công.";
} else {
  echo "Lỗi tạo bảng: " . $conn->error;
}

$sql = "SELECT * FROM sanpham";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                  <a class="nav-link active" aria-current="page" href="#">ADMINISTRATION</a>
                  <a class="nav-link" href="#">Trang chủ</a>
                  <a class="nav-link" href="#">Trang ngoài</a>
                  <a class="nav-link" href="#">Thể loại</a>
                  <a class="nav-link" href="#">Tác giả</a>
                  <a class="nav-link" href="#">Bài viết</a>
                </div>
              </div>
            </div>
          </nav>
    </div>


    <div>
        <div class="container" style="width:70%;margin-top:50px">
            <a href="add.php">
              <button type="button" class="btn btn-success">Thêm</button>
            </a>

            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Sản Phẩm</th>
                    <th scope="col">Giá thành</th>
                    <th scope="col">Sửa</th>
                    <th scope="col">Xóa</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    if ($result->num_rows > 0) {
                      // Duyệt qua các kết quả và hiển thị trong bảng
                      while($row = $result->fetch_assoc()) {
                          echo "<tr>
                                  <td>" . $row["name"] . "</td>
                                  <td>" . $row["price"] . "</td>
                                  <td><a href='update.php?id=" . $row["id"] . "' class='btn btn-warning'>Sửa</a></td>
                                  <td><a href='delete.php?id=" . $row['id'] . "' class='btn btn-danger' onclick='return confirm(\"Bạn có chắc chắn muốn xóa không?\")'>Xóa</a></td>
                              </tr>";
                      }
                  } else {
                      echo "<tr><td colspan='4'>Không có sản phẩm nào.</td></tr>";
                  }
                  ?>
                </tbody>
              </table>
        </div>
    </div>

    <div class="container" style="margin-top:15%">
        <hr>
    </div>

    <div class="text-center">
        <h1>TLU's MUSIC GARDEN</h1>
    </div>
</body>
</html>