<?php
require_once 'config.php';

// جلب الأخبار من الأحدث إلى الأقدم
$sql = "SELECT * FROM news ORDER BY dateposted DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>لوحة تحكم المحرر</title>
</head>
<body>

    <h2>لوحة تحكم المحرر</h2>

    <?php if ($result && $result->num_rows > 0): ?>
        <table border="1" cellpadding="10">
            <tr>
                <th>رقم</th>
                <th>العنوان</th>
                <th>النص</th>
                <th>الصورة</th>
                <th>تاريخ النشر</th>
                <th>الحالة</th>
                <th>العمليات</th>
            </tr>

            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['title'] ?></td>
                    <td><?= $row['body'] ?></td>
                    <td><img src="<?= $row['image'] ?>" width="100"></td>
                    <td><?= $row['dateposted'] ?></td>
                    <td><?= $row['status'] ?></td>
                    <td>
                        <form action="action_news.php" method="post" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>">
                            <button type="submit" name="action" value="published">موافقة</button>
                            <button type="submit" name="action" value="archived">رفض</button>
                            <button type="submit" name="action" value="delete" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>لا توجد أخبار حالياً.</p>
    <?php endif; ?>

</body>
</html>
