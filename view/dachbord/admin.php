<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>لوحة التحكم</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">لوحة التحكم</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a href="../index.PHP" class="nav-link">العودة للموقع</a></li>
                <li class="nav-item"><a href="../../logout.php" class="nav-link">تسجيل الخروج</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <h3 class="mb-4">👨‍💼 مرحباً بك في لوحة التحكم</h3>

    <div class="row g-3">
        <div class="col-md-4">
            <div class="card shadow-sm p-3">
                <h5>إدارة الأخبار</h5>
                <a href="add_news_form.php" class="btn btn-primary mt-2">➕ إضافة خبر</a>
                <a href="manage_news.php" class="btn btn-outline-secondary mt-2">📝 تعديل/حذف الأخبار</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm p-3">
                <h5>إدارة المؤلفين</h5>
                <a href="authors_list.php" class="btn btn-outline-secondary mt-2">👤 قائمة المؤلفين</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm p-3">
                <h5>الإعلانات</h5>
                <a href="ads_dashboard.php" class="btn btn-outline-secondary mt-2">📢 إدارة الإعلانات</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
