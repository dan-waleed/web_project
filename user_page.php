<?php
require_once 'config.php';

// جلب الأخبار من الأحدث إلى الأقدم
$sql = "SELECT * FROM `user`";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>لوحة تحكم المشرف</title>
</head>
<body>

    <h2>لوحة تحكم المشرف</h2>

    <?php if ($result && $result->num_rows > 0): ?>
        <table border="1" cellpadding="10">
            <tr>
                <th>رقم</th>
                <th>الاسم</th>
                <th>البريد الإلكتروني</th>
                <th>الدور</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['role'] ?></td>
                </tr>
                <button onclick="window.location.href='indx.php'">الذهاب الى الصفحه الأخبار</button>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>لا يوجد مستخدمين في النظام.</p>
    <?php endif; ?>

</body>
</html>
