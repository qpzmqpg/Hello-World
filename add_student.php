<?php
include 'config.php'; // 包含数据库连接配置文件

// 处理 POST 请求
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $accountpassword = $_POST['accountpassword'];
    $miyao = $_POST['miyao'];

    // 首先检查用户名是否已经存在
    $check_stmt = $conn->prepare("SELECT id FROM students WHERE name = ?");
    $check_stmt->bind_param("s", $name);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        // 用户名已存在
        echo json_encode(["message" => "用户名已存在"]);
    } else {
        // 用户名不存在，继续插入新用户
        $hashed_password = password_hash($accountpassword, PASSWORD_BCRYPT);
        $stmt = $conn->prepare("INSERT INTO students (name, accountpassword, miyao, hashed_password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $accountpassword, $miyao, $hashed_password); // Store hashed password in iv

        if ($stmt->execute()) {
            echo json_encode(["message" => "学生添加成功"]);
        } else {
            echo json_encode(["message" => "错误: " . $stmt->error]);
        }

        $stmt->close();
    }

    $check_stmt->close();
}

$conn->close();
?>
