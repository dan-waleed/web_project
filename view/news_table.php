<h4 class="mb-4">جميع الأخبار</h4>

<?php if (!empty($result) && is_array($result)): ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>الرقم</th>
                <th>العنوان</th>
                <th>القسم</th>
                <th>تاريخ النشر</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result as $row): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['title']) ?></td>
                    <td><?= htmlspecialchars($row['category_id']) ?></td>
                    <td><?= isset($row['datePosted']) ? htmlspecialchars($row['datePosted']) : '---' ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p class="text-muted">لا توجد أخبار لعرضها.</p>
<?php endif; ?>
