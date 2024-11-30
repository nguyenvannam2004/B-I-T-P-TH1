<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "quanlyhoa";
    
    // Kết nối đến cơ sở dữ liệu
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }else
    {
        echo "kết nối thành công";
    }

    // Kiểm tra xem form đã được gửi chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy thông tin từ form
    $flowerName = $_POST['flowerName'];
    $flowerDescription = $_POST['flowerDescription'];

    if (isset($_FILES['flowerImage']) && $_FILES['flowerImage']['error'] == 0) {
        // Đường dẫn lưu ảnh
        $targetDir = "images"; 
        $targetFile = $targetDir . basename($_FILES["flowerImage"]["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $allowed = array("jpg", "jpeg", "png", "gif");
        if (in_array($imageFileType, $allowed)) {
            if (move_uploaded_file($_FILES["flowerImage"]["tmp_name"], $targetFile)) {
                echo "Ảnh đã được tải lên thành công.";

                // Thêm thông tin vào CSDL
                $sql = "INSERT INTO hoa ( name, description, image_path) 
                        VALUES ('$flowerName', '$flowerDescription', '$targetFile')";

                if ($conn->query($sql) === TRUE) {
                    echo "Dữ liệu đã được lưu vào CSDL thành công!";
                } else {
                    echo "Lỗi: " . $sql . "<br>" . $conn->error;
                }
            } else {
                echo "Lỗi khi tải ảnh lên.";
            }
        } else {
            echo "Chỉ chấp nhận các định dạng ảnh JPG, JPEG, PNG, GIF.";
        }
    }
}

$sql = "SELECT id, name, description, image_path FROM hoa";
$result = $conn->query($sql);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="text-center">
        <h1>QUẢN LÝ HOA</h1>
    </div>

    <div class="container mx-auto" style="width:80%;margin-top: 100px;">
        <div class="container" style="margin-bottom: 30px;">
            <a href="add.php">
            <button type="button" class="btn btn-success">
                THÊM HOA MỚI
            </button>
            </a>
        </div>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">NAME</th>
                <th scope="col">DESCRIPTION</th>
                <th scope="col">IMAGE</th>
                <th scope="col">HANDLE</th>
              </tr>
            </thead>
            <tbody>
                <?php
                // Kiểm tra nếu có kết quả từ truy vấn
                if ($result->num_rows > 0) {
                    // Lặp qua từng dòng kết quả và hiển thị
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<th scope='row'>" . $row["id"] . "</th>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["description"] . "</td>";
                        echo "<td><img src='" . $row["image_path"] . "' alt='Hoa' width='50'></td>";
                        echo "<td><a href='update.php?id=" . $row["id"] . "' class='btn btn-warning'>Sửa</a></td>";
                        echo "<td><a href='delete.php?id=" . $row["id"] . "' class='btn btn-danger' onclick='return confirm(\"Bạn có chắc chắn muốn xóa?\");'>Xóa</a></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Không có dữ liệu</td></tr>";
                }
                ?>
            </tbody>
          </table>
    </div>

</body>
</html>
