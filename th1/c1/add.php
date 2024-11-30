<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Hoa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Thêm Hoa Mới</h2>
        <form action="admin.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="flowerName" class="form-label">Tên Hoa</label>
                <input type="text" class="form-control" id="flowerName" name="flowerName" required>
            </div>
            <div class="mb-3">
                <label for="flowerDescription" class="form-label">Mô Tả</label>
                <textarea class="form-control" id="flowerDescription" name="flowerDescription" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="flowerImage" class="form-label">Hình Ảnh</label>
                <input type="file" class="form-control" id="flowerImage" name="flowerImage" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-primary">Lưu</button>
        </form>
    </div>
</body>
</html>
