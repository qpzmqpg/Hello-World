<?php
// 数据库连接配置
$servername = "localhost";
$username = "ser209348828301";
$password = "zr1tbIwVcAjB";
$dbname = "ser209348828301";
$port = 3306;

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// 检查连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}
?>
