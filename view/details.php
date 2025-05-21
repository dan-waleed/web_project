<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/news.php';
require_once __DIR__ . '/../models/commints.php';

$newsModel = new News();
$news = null;
$relatedNews = [];
$commentModel = new Comment();

if (isset($_GET['id'])) {
    $news = $newsModel->getNewsById($_GET['id']);

    if ($news && isset($news['category_id'])) {
        $relatedNews = $newsModel->getRelatedNews($news['category_id'], $news['id']);
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تفاصيل الخبر</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="ابحث" aria-label="Search">
        </form>
    </div>
</nav>

<div class="container py-4">
    <?php if ($news): ?>
        <div class="row mb-3">
            <h1 class="mt-2 fw-bold"><?= htmlspecialchars($news['title']) ?></h1>
            <div class="text-muted mt-2"><?= htmlspecialchars($news['publish_date'] ?? '') ?></div>
            <h6 class="mb-3">قسم: <?= htmlspecialchars($news['category'] ?? '') ?></h6>
        </div>

        <div class="row mb-3">
            <div class="col-8">
                <img src="<?= !empty($news['image_url']) ? htmlspecialchars($news['image_url']) : 'https://cdn-icons-png.flaticon.com/512/2748/2748558.png' ?>"
                     class="img-fluid mt-4" alt="صورة الخبر" style="height: 500px;">
                <p class="p-2"><?= nl2br(htmlspecialchars($news['body'])) ?></p>

                <!-- نموذج التعليق -->
                <div class="mt-5">
                    <h5 class="mb-3">أضف تعليقك</h5>
                    <form id="commentForm">
                        <input type="hidden" name="news_id" value="<?= $news['id'] ?>">
                        <div class="mb-3">
                            <label for="user_name" class="form-label">الاسم</label>
                            <input type="text" name="user_name" id="user_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="comment" class="form-label">التعليق</label>
                            <textarea name="comment" id="comment" rows="4" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">إرسال</button>
                    </form>
                    <div id="commentAlert" class="mt-3"></div>
                </div>

                <div class="mt-4">
                    <h5 class="mb-3">التعليقات السابقة</h5>
                    <div id="commentList">
                    <?php
                        $conn = DBConnection::connect();
                        $news_id = $news['id'];
                        $comments = $conn->query("SELECT username, comment_text, created_at FROM comments WHERE news_id = $news_id ORDER BY created_at DESC");
                        if ($comments->num_rows > 0):
                            while ($row = $comments->fetch_assoc()): ?>
                                <div class="border-bottom pb-2 mb-3">
                                    <strong><?= htmlspecialchars($row['username']) ?></strong>
                                    <small class="text-muted d-block"><?= $row['created_at'] ?></small>
                                    <p class="mb-0"><?= nl2br(htmlspecialchars($row['comment_text'])) ?></p>
                                </div>
                            <?php endwhile;
                        else:
                            echo '<p class="text-muted">لا توجد تعليقات بعد.</p>';
                        endif;
                    ?>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <h5 class="mb-3 border-bottom p-2">المزيد من الأخبار</h5>
                <?php if (!empty($relatedNews)): ?>
                    <?php foreach ($relatedNews as $item): ?>
                        <a href="details.php?id=<?= $item['id'] ?>" class="text-decoration-none text-dark">
                            <div class="d-flex mb-3">
                                <img src="<?= !empty($item['image_url']) ? htmlspecialchars($item['image_url']) : 'https://cdn-icons-png.flaticon.com/512/2748/2748558.png' ?>"
                                     style="width: 100px; height: 60px; object-fit: cover;"
                                     class="me-2 rounded" alt="صورة">
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 small"><?= htmlspecialchars($item['title']) ?></h6>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted">لا توجد أخبار مشابهة.</p>
                <?php endif; ?>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger">الخبر غير موجود أو تم حذفه.</div>
    <?php endif; ?>
</div>

<footer class="bg-dark text-light text-center p-3 mt-4">
    <div class="container">
        <div class="row text-end">
            <div class="col-md-3">
                <img src="https://www.maannews.net/2022_assets/images/logo.png" alt="logo">
                <p>الاخبار هي عينك في العالم الواسع</p>
            </div>
            <div class="col-md-3">
                <h5>روابط سريعة</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-light">الرئيسية</a></li>
                    <li><a href="#" class="text-light">سياسة</a></li>
                    <li><a href="#" class="text-light">اقتصاد</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5>عن الموقع</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-light">من نحن</a></li>
                    <li><a href="#" class="text-light">اعلن معنا</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5>تواصل معنا</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-light">اتصل بنا</a></li>
                    <li><a href="#" class="text-light">سياسة الخصوصية</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<script>
$('#commentForm').on('submit', function(e) {
    e.preventDefault();

    const user_name = $('#user_name').val();
    const comment_text = $('#comment').val();

    $.ajax({
        url: 'submit_comment.php',
        type: 'POST',
        data: $(this).serialize(),
        success: function(response) {
            let alertType = response.success ? 'alert-success' : 'alert-danger';
            $('#commentAlert').html(`<div class="alert ${alertType}">${response.message}</div>`);

            if (response.success) {
                // إعادة تعيين النموذج
                $('#commentForm')[0].reset();

                // إضافة التعليق إلى قائمة التعليقات
                $('#commentList').prepend(`
                    <div class="border-bottom pb-2 mb-3">
                        <strong>${user_name}</strong>
                        <small class="text-muted d-block">الآن</small>
                        <p class="mb-0">${comment_text.replace(/\\n/g, '<br>')}</p>
                    </div>
                `);
            }
        },
        error: function() {
            $('#commentAlert').html(`<div class="alert alert-danger">فشل الاتصال بالخادم.</div>`);
        }
    });
});

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
