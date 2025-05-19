<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../models/news.php';

$newsModel = new News();

if (!isset($_GET['id'])) {
    die("معرّف الخبر غير موجود.");
}

$id = intval($_GET['id']);
$news = $newsModel->getNewsById($id);

if (!$news) {
    die("الخبر غير موجود.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $body = $_POST['body'];
    $category_id = $_POST['category_id'];
    $status = $_POST['status'];

    $newsModel->updateNews($id, $title, $body, $category_id, $status);
    header("Location: manage_news.php?updated=1");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تعديل خبر</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h4 class="mb-4">📝 تعديل الخبر</h4>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">العنوان</label>
            <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($news['title']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">المحتوى</label>
            <textarea name="body" rows="5" class="form-control" required><?= htmlspecialchars($news['body']) ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">القسم</label>
            <select name="category_id" class="form-control">
                <option value="1" <?= $news['category_id'] == 1 ? 'selected' : '' ?>>سياسة</option>
                <option value="2" <?= $news['category_id'] == 2 ? 'selected' : '' ?>>اقتصاد</option>
                <option value="3" <?= $news['category_id'] == 3 ? 'selected' : '' ?>>رياضة</option>
                <option value="4" <?= $news['category_id'] == 4 ? 'selected' : '' ?>>صحة</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">الحالة</label>
            <select name="status" class="form-control">
                <option value="draft" <?= $news['status'] == 'draft' ? 'selected' : '' ?>>مسودة</option>
                <option value="published" <?= $news['status'] == 'published' ? 'selected' : '' ?>>منشور</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">حفظ التعديلات</button>
        <a href="manage_news.php" class="btn btn-secondary">إلغاء</a>
    </form>
</div>

</body>
</html>
