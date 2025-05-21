<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../controller/auther.php';

$conn = DBConnection::connect();
$controller = new NewsController($conn);

ob_start();

if (isset($_GET['category'])) {
    $controller->showCategoryPage($_GET['category']);
} else {
    $controller->displayNews();
}

$content = ob_get_clean();
?>


<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الاخبار اليوم</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }
        .navbar-brand {
            font-weight: bold;
        }
        .card-title {
            font-size: 1.1rem;
            font-weight: 700;
        }
        .card-text {
            font-size: 0.95rem;
        }
        footer ul li {
            padding: 5px 0;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" dir="rtl">
    <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <img src="https://www.maannews.net/2022_assets/images/logo.png" class="w-1 h-auto" alt="logo">
        <a class="navbar-brand" href="#">أخبار اليوم</a>
        <div class="collapse navbar-collapse" id="navbarNav">
           <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/web_project/view/index.php">الرئيسية</a></li>
                <li class="nav-item"><a class="nav-link" href="/web_project/view/index.php?category=1">سياسة</a></li>
                <li class="nav-item"><a class="nav-link" href="/web_project/view/index.php?category=2">اقتصاد</a></li>
                <li class="nav-item"><a class="nav-link" href="/web_project/view/index.php?category=3">رياضة</a></li>
                <li class="nav-item"><a class="nav-link" href="/web_project/view/index.php?category=4">صحة</a></li>
          </ul>

        </div>
        <form class="row" role="search">
            <input class="form-control me-2" type="search" placeholder="ادخل كلمة البحث" aria-label="ادخل كلمة البحث">
        </form>
    </div>
</nav>

<div class="container mt-4">
    <?= $content ?>
</div>

<footer class="bg-dark text-light text-center p-3 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <img src="https://www.maannews.net/2022_assets/images/logo.png" class="w-1 h-auto" alt="logo">
                <p class="p-3">الاخبار هي عينك في العالم الواسع</p>
            </div>
            <div class="col-md-3">
                <h5>روابط سريعة</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-light text-decoration-none">الرئيسية</a></li>
                    <li><a href="#" class="text-light text-decoration-none">سياسة</a></li>
                    <li><a href="#" class="text-light text-decoration-none">اقتصاد</a></li>
                    <li><a href="#" class="text-light text-decoration-none">رياضة</a></li>
                    <li><a href="#" class="text-light text-decoration-none">صحة</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5>عن الموقع</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-light text-decoration-none">من نحن</a></li>
                    <li><a href="#" class="text-light text-decoration-none">اعلن معنا</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5>تواصل معنا</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-light text-decoration-none">اتصل بنا</a></li>
                    <li><a href="#" class="text-light text-decoration-none">سياسة الخصوصية</a></li>
                    <li><a href="#" class="text-light text-decoration-none">شروط الاستخدام</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
