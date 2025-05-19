<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../models/news.php';

$newsModel = new News();                   // ← أنشئ كائن
$allNews = $newsModel->getAllNews(); // ← استرجع جميع الأخبار
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
                <td><?= htmlspecialchars($news['id']) ?></td>
                <td><?= htmlspecialchars($news['title']) ?></td>
                <td><?= htmlspecialchars($news['category_id']) ?></td>
                <td>
                    <?php
                    $rawDate = $news['datePosted'] ?? '';
                    if (!empty($rawDate) && $rawDate !== '0000-00-00 00:00:00' && $rawDate !== '1970-01-01') {
                        echo date('Y-m-d', strtotime($rawDate));
                    } else {
                        echo '---';
                    }
                    ?>
                </td>

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
