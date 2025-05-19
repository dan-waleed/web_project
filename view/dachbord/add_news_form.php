<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إضافة خبر</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h4 class="mb-4">➕ إضافة خبر جديد</h4>

    <form action="../../action_news.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">عنوان الخبر</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">محتوى الخبر</label>
            <textarea name="body" rows="5" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">الصورة</label>
            <input type="file" name="image" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">القسم</label>
            <select name="category_id" class="form-control" required>
                <option value="1">سياسة</option>
                <option value="2">اقتصاد</option>
                <option value="3">رياضة</option>
                <option value="4">صحة</option>
            </select>
        </div>

        <input type="hidden" name="author_id" value="<?= $_SESSION['user_id'] ?? 1 ?>"> <!-- أو من السيشن -->
        <button type="submit" class="btn btn-success">نشر الخبر</button>
    </form>
</div>

</body>
</html>
