<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../view/login_form.php');
    exit;
}

require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../models/news.php';

$newsModel = new News();

if (!isset($_GET['id'])) {
    die("معرّف الخبر غير موجود.");
}
$id   = intval($_GET['id']);
$news = $newsModel->getNewsById($id);
if (!$news) {
    die("الخبر غير موجود.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title       = $_POST['title'];
    $body        = $_POST['body'];
    $category_id = intval($_POST['category_id']);
    $status      = $_POST['status'];

    $newsModel->update($id, $title, $body, $category_id, $status);
    header("Location: manage_news.php?updated=1");
    exit;
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>📝 تعديل الخبر</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet"
  >
  <style>
    body {
      background-color: #f0f2f5;
      font-family: 'Segoe UI', Tahoma, sans-serif;
    }
    .card {
      max-width: 600px;
      margin: 80px auto;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .card-header {
      background-color: #ffffff;
      border-bottom: none;
      text-align: center;
      font-size: 1.4rem;
      font-weight: 600;
      padding: 1rem;
    }
    .card-body {
      padding: 1.5rem;
    }
    .form-label {
      font-weight: 500;
    }
    .form-control {
      border-radius: 4px;
      padding: 10px;
    }
    .btn-success {
      border-radius: 4px;
      padding: 10px 20px;
      font-size: 1rem;
    }
    .btn-secondary {
      border-radius: 4px;
      padding: 10px 20px;
      font-size: 1rem;
      margin-left: 0.5rem;
    }
  </style>
</head>
<body>
  <div class="card">
    <div class="card-header">
      📝 تعديل الخبر
    </div>
    <div class="card-body">
      <form method="POST">
        <div class="mb-3">
          <label class="form-label" for="title">العنوان</label>
          <input
            type="text"
            id="title"
            name="title"
            class="form-control"
            value="<?= htmlspecialchars($news['title']) ?>"
            required
          >
        </div>
        <div class="mb-3">
          <label class="form-label" for="body">المحتوى</label>
          <textarea
            id="body"
            name="body"
            rows="6"
            class="form-control"
            required
          ><?= htmlspecialchars($news['body']) ?></textarea>
        </div>
        <div class="mb-3">
          <label class="form-label" for="category_id">القسم</label>
          <select
            id="category_id"
            name="category_id"
            class="form-control"
          >
            <option value="1" <?= $news['category_id'] == 1 ? 'selected' : '' ?>>سياسة</option>
            <option value="2" <?= $news['category_id'] == 2 ? 'selected' : '' ?>>اقتصاد</option>
            <option value="3" <?= $news['category_id'] == 3 ? 'selected' : '' ?>>رياضة</option>
            <option value="4" <?= $news['category_id'] == 4 ? 'selected' : '' ?>>صحة</option>
          </select>
        </div>
        <div class="mb-3">
          <label class="form-label" for="status">الحالة</label>
          <select
            id="status"
            name="status"
            class="form-control"
          >
            <option value="draft" <?= $news['status'] === 'draft' ? 'selected' : '' ?>>مسودة</option>
            <option value="published" <?= $news['status'] === 'published' ? 'selected' : '' ?>>منشور</option>
          </select>
        </div>
        <div class="d-flex justify-content-between">
          <button type="submit" class="btn btn-success">حفظ التعديلات</button>
          <a href="manage_news.php" class="btn btn-secondary">إلغاء</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
