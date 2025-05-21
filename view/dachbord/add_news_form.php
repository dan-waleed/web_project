<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../view/login_form.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>إضافة خبر</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet"
  >
  <style>
    body { background-color: #f0f2f5; }
    .card { border-radius:8px; box-shadow:0 2px 10px rgba(0,0,0,0.1); }
  </style>
</head>
<body>
  <div class="container mt-5">
    <div class="card p-4">
      <h4 class="mb-4">➕ إضافة خبر جديد</h4>
      <form 
        action="../../action_news.php" 
        method="POST" 
        enctype="multipart/form-data"
      >
        <!-- Title -->
        <div class="mb-3">
          <label class="form-label">عنوان الخبر</label>
          <input 
            type="text" 
            name="title" 
            class="form-control" 
            required
          >
        </div>

        <!-- Body -->
        <div class="mb-3">
          <label class="form-label">محتوى الخبر</label>
          <textarea 
            name="body" 
            rows="6" 
            class="form-control" 
            required
          ></textarea>
        </div>

        <!-- Image -->
        <div class="mb-3">
          <label class="form-label">الصورة</label>
          <input 
            type="file" 
            name="image" 
            class="form-control" 
            accept="image/*" 
            required
          >
        </div>

        <!-- Category -->
        <div class="mb-3">
          <label class="form-label">القسم</label>
          <select 
            name="category_id" 
            class="form-control" 
            required
          >
            <option value="">اختر القسم</option>
            <option value="1">سياسة</option>
            <option value="2">اقتصاد</option>
            <option value="3">رياضة</option>
            <option value="4">صحة</option>
          </select>
        </div>

        <!-- Status -->
        <div class="mb-3">
          <label class="form-label">حالة الخبر</label>
          <select 
            name="status" 
            class="form-control" 
            required
          >
            <option value="draft">مسودة</option>
            <option value="published">منشور</option>
          </select>
        </div>

        <!-- Optional Publish Date -->
        <div class="mb-3">
          <label class="form-label">تاريخ النشر (اختياري)</label>
          <input
            type="datetime-local"
            name="datePosted"
            class="form-control"
          >
          <small class="form-text text-muted">
            اترك الحقل فارغًا لاستخدام التاريخ الحالي
          </small>
        </div>

        <!-- Author (from session) -->
        <input 
          type="hidden" 
          name="author_id" 
          value="<?= htmlspecialchars($_SESSION['user_id']) ?>"
        >

        <button 
          type="submit" 
          class="btn btn-success w-100"
        >
          نشر الخبر
        </button>
      </form>
    </div>
  </div>
</body>
</html>
