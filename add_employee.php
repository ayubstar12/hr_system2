<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $department = $_POST['department'];

    $stmt = $pdo->prepare("INSERT INTO employees (name, position, department) VALUES (?, ?, ?)");
    $stmt->execute([$name, $position, $department]);

    echo "تمت الإضافة بنجاح! <a href='index.php'>العودة</a>";
}
?>