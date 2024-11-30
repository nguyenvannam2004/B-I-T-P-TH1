<?php
// Đọc dữ liệu từ file questions.txt
$filename = "question.txt";
$questions = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Lưu đáp án đúng vào mảng
$answers = [];
$current_question = [];
foreach ($questions as $line) {
    if (strpos($line, "Câu") === 0) {
        if (!empty($current_question)) {
            // Lưu đáp án đúng vào mảng
            if (isset($current_question[5])) {
                $answers[] = trim(substr($current_question[5], strpos($current_question[5], ":") + 1));
            }
        }
        $current_question = [];
    }
    $current_question[] = $line;
}

// Xử lý bài nộp và tính điểm
$score = 0;
foreach ($_POST as $key => $userAnswer) {
    $questionNumber = (int)filter_var($key, FILTER_SANITIZE_NUMBER_INT);
    if (isset($answers[$questionNumber - 1]) && $answers[$questionNumber - 1] === $userAnswer) {
        $score++;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả bài trắc nghiệm</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Kết quả bài trắc nghiệm</h2>
        <div class="alert alert-success text-center">
            Bạn trả lời đúng <strong><?php echo $score; ?></strong> / <?php echo count($answers); ?> câu.
        </div>
        <a href="index.php" class="btn btn-primary">Làm lại</a>
    </div>
</body>
</html>
