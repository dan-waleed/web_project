<?php
require_once '../../config.php';

$news_id = $_GET['news_id'] ?? 0;

$stmt = $conn->prepare("SELECT user_name, comment, created_at FROM comments WHERE news_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $news_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="mt-5">
    <h5>💬 التعليقات:</h5>
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="border p-3 mb-2 bg-white rounded shadow-sm">
                <strong><?= htmlspecialchars($row['user_name']) ?></strong>
                <p><?= nl2br(htmlspecialchars($row['comment'])) ?></p>
                <small class="text-muted"><?= $row['created_at'] ?></small>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p class="text-muted">لا توجد تعليقات حتى الآن.</p>
    <?php endif; ?>
</div>
