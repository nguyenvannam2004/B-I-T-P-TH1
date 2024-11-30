<?php

$servername = "localhost";
$username = "root";  
$password = "";      
$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS quiz";
if ($conn->query($sql) === TRUE) {
    echo "Cơ sở dữ liệu 'quiz' đã được tạo thành công.\n";
} else {
    echo "Lỗi khi tạo cơ sở dữ liệu: " . $conn->error;
}

$conn->select_db("quiz");

$sql = "CREATE TABLE IF NOT EXISTS questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question TEXT NOT NULL,
    option_a TEXT NOT NULL,
    option_b TEXT NOT NULL,
    option_c TEXT NOT NULL,
    option_d TEXT NOT NULL,
    correct_answer CHAR(1) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Bảng 'questions' đã được tạo thành công.\n";
} else {
    echo "Lỗi khi tạo bảng: " . $conn->error;
}

$conn->close();
?>
<?php

$filename = "question.txt";
$questions = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$answers = [];
$current_question = [];
foreach ($questions as $line) {
    if (strpos($line, "Câu") === 0) {
        if (!empty($current_question)) {
            if (isset($current_question[5])) {
                $answers[] = trim(substr($current_question[5], strpos($current_question[5], ":") + 1));
            }
        }
        $current_question = [];
    }
    $current_question[] = $line;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài trắc nghiệm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Bài Trắc Nghiệm</h2>
        <form method="post" action="result.php">
            <?php
            $question_number = 1; // Đếm câu hỏi

            for ($i = 0; $i < count($questions); $i++) {
                if (strpos($questions[$i], "Câu") === 0) {
                    // Lấy câu hỏi và các đáp án
                    $question_text = $questions[$i];
                    $option_a = $questions[$i + 1];
                    $option_b = $questions[$i + 2];
                    $option_c = $questions[$i + 3];
                    $option_d = $questions[$i + 4];

                    echo "<div class='card mb-4'>";
                    echo "<div class='card-header'><strong>{$question_text}</strong></div>";
                    echo "<div class='card-body'>";

                    // Hiển thị các đáp án
                    $options = [$option_a, $option_b, $option_c, $option_d];
                    foreach ($options as $option) {
                        $answer = substr($option, 0, 1); // Lấy ký tự đầu làm giá trị
                        echo "<div class='form-check'>";
                        echo "<input class='form-check-input' type='radio' name='question{$question_number}' value='{$answer}' id='question{$question_number}_{$answer}'>";
                        echo "<label class='form-check-label' for='question{$question_number}_{$answer}'>{$option}</label>";
                        echo "</div>";
                    }

                    echo "</div>";
                    echo "</div>";

                    $question_number++;
                }
            }
            ?>
            <button type="submit" class="btn btn-primary">Nộp bài</button>
        </form>
    </div>
</body>
</html>
