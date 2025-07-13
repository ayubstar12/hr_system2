<?php include 'config.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>نظام إدارة الموظفين</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>إدارة الموظفين</h1>

<!-- Form إضافة موظف -->
<form action="add_employee.php" method="post">
    <input type="text" name="name" placeholder="اسم الموظف" required>
    <input type="text" name="position" placeholder="المنصب" required>
    <input type="text" name="department" placeholder="القسم" required>
    <button type="submit">إضافة موظف</button>
</form>

<!-- Form حذف موظف -->
<form action="delete_employee.php" method="post">
    <input type="number" name="id" placeholder="رقم الموظف" required>
    <button type="submit">حذف موظف</button>
</form>

<a href="job_offer.php"><button>إنشاء عرض وظيفي</button></a>

<!-- شريط البحث -->
<form method="get" action="">
    <input type="text" name="search" placeholder="ابحث عن موظف..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
    <button type="submit">بحث</button>
</form>

<hr>

<h2>قائمة الموظفين</h2>
<table border="1">
    <tr><th>ID</th><th>الاسم</th><th>المنصب</th><th>القسم</th></tr>
    <?php
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = "%" . $_GET['search'] . "%";
        $stmt = $pdo->prepare("SELECT * FROM employees WHERE name LIKE ?");
        $stmt->execute([$search]);
    } else {
        $stmt = $pdo->query("SELECT * FROM employees");
    }

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['position']}</td>
                <td>{$row['department']}</td>
              </tr>";
    }

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = "%" . $_GET['search'] . "%";
    $stmt = $pdo->prepare("SELECT * FROM employees WHERE name LIKE ?");
    $stmt->execute([$search]);
} else {
    $stmt = $pdo->query("SELECT * FROM employees");
}

    
    ?>

<form method="get" action="">
    <input type="text" name="search" placeholder="ابحث عن موظف..."
           value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
    <button type="submit">بحث</button>
</form>



</table>

</body>
</html>