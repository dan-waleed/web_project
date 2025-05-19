<?php
require_once '../../config.php';
require_once '../../models/user.php';

$authors = User::getAuthors(); // يفترض أن تعيد جميع المستخدمين من النوع author
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>قائمة المؤلفين</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-4">
    <h4 class="mb-3">👤 المؤلفون</h4>

    <table class="table table-bordered bg-white">
        <thead>
            <tr>
                <th>#</th>
                <th>الاسم</th>
                <th>البريد الإلكتروني</th>
                <th>الدور</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($authors as $author): ?>
            <tr>
                <td><?= $author['id'] ?></td>
                <td><?= $author['username'] ?></td>
                <td><?= $author['email'] ?></td>
                <td><?= $author['role'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
