<?php if (!empty($result)): ?>
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <?php foreach ($result as $news): ?>
            <div class="col">
                <a href="details.php?id=<?= $news['id'] ?>" class="text-decoration-none text-dark">
                    <div class="card news-card h-100">
                        <?php if (!empty($news['image_url'])): ?>
                            <img src="<?= htmlspecialchars($news['image_url']) ?>" class="card-img-top" style="height: 200px; object-fit: cover;" alt="صورة الخبر">
                        <?php else: ?>
                            <img src="https://cdn-icons-png.flaticon.com/512/2748/2748558.png" class="card-img-top" style="height: 200px; object-fit: cover;" alt="صورة افتراضية">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($news['title']) ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                <i class="fas fa-calendar-alt"></i> <?= htmlspecialchars($news['publish_date']) ?>
                            </h6>
                            <p class="card-text">
                                <?= mb_substr(strip_tags($news['body']), 0, 120) . '...' ?>
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="alert alert-info text-center">لا توجد أخبار متاحة حاليًا.</div>
<?php endif; ?>