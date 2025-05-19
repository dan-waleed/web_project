<form id="commentForm" method="POST" action="../../comment.php" class="mt-4">
    <div class="mb-3">
        <label class="form-label">اسمك</label>
        <input type="text" name="user_name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">التعليق</label>
        <textarea name="comment" rows="3" class="form-control" required></textarea>
    </div>

    <input type="hidden" name="news_id" value="<?= $news_id ?>">
    <button type="submit" class="btn btn-primary">إرسال التعليق</button>
</form>
