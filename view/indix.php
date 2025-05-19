<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../controller/auther.php';

$conn = DBConnection::connect();
$controller = new NewsController($conn);

// إما تعرض مباشرة هنا (لو displayNews تطبع HTML) أو تخزن البيانات وتعرضها داخل HTML
ob_start(); // لتأجيل الطباعة
$controller->displayNews();
$content = ob_get_clean(); // خزّن المحتوى
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">      
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الأخبار اليوم</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-4">
        <?= $content ?> <!-- عرض محتوى الأخبار هنا -->
    </div>

</body>
</html>
