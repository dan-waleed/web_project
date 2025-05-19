<?php
require_once '../../config.php';
require_once '../../models/news.php';

$allNews = News::getAll(); // دالة افتراضية لجلب كل الأخبار
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إدارة الأخبار</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
    <h4 class="mb-3">📝 إدارة الأخبار</h4>

    <table class="table table-bordered table-hover bg-white">
        <thead>
            <tr>
                <th>#</th>
                <th>العنوان</th>
                <th>القسم</th>
                <th>تاريخ النشر</th>
                <th>التحكم</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allNews as $news): ?>
            <tr>
                <td><?= $news['id'] ?></td>
                <td><?= $news['title'] ?></td>
                <td><?= $news['category_id'] ?></td>
                <td><?= $news['datePosted'] ?></td>
                <td>
                    <a href="edit_news.php?id=<?= $news['id'] ?>" class="btn btn-sm btn-warning">تعديل</a>
                    <a href="../../action_news.php?delete=<?= $news['id'] ?>" class="btn btn-sm btn-danger">حذف</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
