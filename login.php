<?php
include 'config.php'; // 包含数据库连接配置文件

// 处理 POST 请求
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 获取请求中的用户名和密码
    $name = $_POST['name'];
    $accountpassword = $_POST['accountpassword'];

    // 准备 SQL 查询以查找用户
    $stmt = $conn->prepare("SELECT hashed_password FROM students WHERE name = ?");
    $stmt->bind_param("s", $name);
    $stmt->execute();
    $stmt->store_result();

    // 检查用户是否存在
    if ($stmt->num_rows > 0) {
        // 用户存在，获取数据库中的密码哈希
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // 验证输入的密码是否正确
        if (password_verify($accountpassword, $hashed_password)) {
            // 密码正确
            error_log("Password verification succeeded");
            echo json_encode(["message" => "登录成功"]);
        } else {
            // 密码错误
            error_log("Password verification failed");
            echo json_encode(["message" => "登录失败，密码错误"]);
        }
    } else {
        // 用户不存在
        error_log("User not found");
        echo json_encode(["message" => "登录失败，用户不存在"]);
    }

    $stmt->close();
} else {
    echo json_encode(["message" => "无效的请求方法"]);
}

$conn->close();
?>
