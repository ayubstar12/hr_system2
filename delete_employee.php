<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];

    $stmt = $pdo->prepare("DELETE FROM employees WHERE id = ?");
    $stmt->execute([$id]);

    echo "تم الحذف بنجاح! <a href='index.php'>العودة</a>";
}
?>


