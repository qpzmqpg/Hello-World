<?php
include 'config.php';

$sql = "SELECT id, name FROM students";
$result = $conn->query($sql);

$students = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}

// 设置响应头为 JSON 格式
header('Content-Type: application/json');

// 将学生数据转换为 JSON 并输出
echo json_encode($students);

// 关闭数据库连接
$conn->close();
?>