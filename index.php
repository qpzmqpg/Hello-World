<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>qpzmqpg账号管理系统</title>
</head>
<body>
    <h1>账号列表</h1>
    <ul id="student-list"></ul>

    <script>
        fetch('get_students.php')
            .then(response => response.json())
            .then(data => {
                const studentList = document.getElementById('student-list');
                data.forEach(student => {
                    const listItem = document.createElement('li');
                    listItem.textContent = `${student.name} (${student.id})`;
                    studentList.appendChild(listItem);
                });
            });
    </script>
</body>
</html>
