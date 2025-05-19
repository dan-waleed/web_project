<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الاخبار اليوم</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet"> <!-- Linked custom stylesheet -->
</head>
<body>
    <?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../controller/auther.php';

$controller = new NewsController($conn);
$controller->displayNews();
?>

</body>
</html>
