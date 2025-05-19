<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../models/ads.php';

$adsModel = new Ads();

if (isset($_GET['toggle'])) {
    $adsModel->toggleAdStatus($_GET['toggle']);
    header("Location: ads_dashboard.php");
    exit;
}

if (isset($_GET['delete'])) {
    $adsModel->deleteAd($_GET['delete']);
    header("Location: ads_dashboard.php");
    exit;
}

$ads = $adsModel->getAllAds();
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إدارة الإعلانات</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<a href="add_ad.php" class="btn btn-primary mb-3">➕ إضافة إعلان جديد</a>

<div class="container mt-5">
    <h4 class="mb-4">📢 إدارة الإعلانات</h4>

    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th>#</th>
                <th>العنوان</th>
                <th>الصورة</th>
                <th>الرابط</th>
                <th>الحالة</th>
                <th>التحكم</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ads as $ad): ?>
            <tr>
                <td><?= $ad['id'] ?></td>
                <td><?= htmlspecialchars($ad['title']) ?></td>
                <td><img src="<?= $ad['image_url'] ?>" width="100"></td>
                <td><a href="<?= $ad['link'] ?>" target="_blank"><?= $ad['link'] ?></a></td>
                <td><?= $ad['is_active'] ? 'مفعّل' : 'معطّل' ?></td>
                <td>
                    <a href="?toggle=<?= $ad['id'] ?>" class="btn btn-sm btn-warning">تفعيل/تعطيل</a>
                    <a href="?delete=<?= $ad['id'] ?>" class="btn btn-sm btn-danger">حذف</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
