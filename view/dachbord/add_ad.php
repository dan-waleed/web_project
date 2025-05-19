<?php
require_once __DIR__ . '/../../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $link = $_POST['link'];

    // حفظ الصورة
    $image_url = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['image']['tmp_name'];
        $image_name = time() . '_' . basename($_FILES['image']['name']);
        $upload_path = '../../uploads/' . $image_name;
        move_uploaded_file($file_tmp, $upload_path);
        $image_url = 'uploads/' . $image_name;
    }

    $conn = DBConnection::connect();
    $stmt = $conn->prepare("INSERT INTO ads (title, image_url, link, is_active) VALUES (?, ?, ?, 1)");
    $stmt->bind_param("sss", $title, $image_url, $link);
    $stmt->execute();

    header("Location: ads_dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>إضافة إعلان</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h4 class="mb-4">➕ إضافة إعلان جديد</h4>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">عنوان الإعلان</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">رابط الإعلان</label>
            <input type="url" name="link" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">صورة الإعلان</label>
            <input type="file" name="image" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">حفظ الإعلان</button>
        <a href="ads_dashboard.php" class="btn btn-secondary">إلغاء</a>
    </form>
</div>

</body>
</html>
