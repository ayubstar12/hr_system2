<?php include 'config.php'; ?>

<?php
// معالجة إرسال النموذج
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];

    $stmt = $pdo->prepare("INSERT INTO job_offers (title, description) VALUES (?, ?)");
    $stmt->execute([$title, $description]);

    echo "<p style='color:green;'>تم إنشاء العرض الوظيفي بنجاح!</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>إنشاء عرض وظيفي</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>إنشاء عرض وظيفي</h2>
<form method="post" action="job_offer.php">
    <input type="text" name="title" placeholder="عنوان الوظيفة" required>
    <textarea name="description" placeholder="وصف الوظيفة" required></textarea>
    <button type="submit">نشر الوظيفة</button>
</form>

<hr>

<!-- عرض بيانات العروض -->
<h3>العروض الوظيفية الحالية</h3>
<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>العنوان</th>
        <th>الوصف</th>
    </tr>

    <?php
    // استرجاع جميع العروض من قاعدة البيانات
    $stmt = $pdo->query("SELECT * FROM job_offers ORDER BY id DESC");

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>" . htmlspecialchars($row['title']) . "</td>
                <td>" . nl2br(htmlspecialchars($row['description'])) . "</td>
              </tr>";
    }
    ?>
</table>

</body>
</html>