<?php
session_start();

// تأكد من تسجيل الدخول
if (!isset($_SESSION['user_id'])) {
    header('Location: ../view/login_form.php');
    exit;
}

require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../models/user.php';

$authors = User::getAuthors(); // يجب أن تعيد جميع المؤلفين
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>👤 قائمة المؤلفين</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet"
  >
  <style>
    body {
      background-color: #f0f2f5;
      font-family: 'Segoe UI', Tahoma, sans-serif;
    }
    .card {
      margin: 50px auto;
      max-width: 800px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    .card-header {
      background-color: #ffffff;
      border-bottom: none;
      font-size: 1.4rem;
      font-weight: 600;
      text-align: center;
    }
    .table {
      margin-bottom: 0;
    }
    .table thead {
      background-color: #007bff;
      color: #fff;
    }
  </style>
</head>
<body>
  <div class="card">
    <div class="card-header">
      👤 المؤلفون
    </div>
    <div class="card-body p-0">
      <table class="table table-striped table-hover mb-0">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">الاسم</th>
            <th scope="col">البريد الإلكتروني</th>
            <th scope="col">الدور</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($authors)): ?>
            <?php foreach ($authors as $author): ?>
              <tr>
                <td><?= htmlspecialchars($author['id']) ?></td>
                <td><?= htmlspecialchars($author['username']) ?></td>
                <td><?= htmlspecialchars($author['email']) ?></td>
                <td><?= htmlspecialchars($author['role']) ?></td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="4" class="text-center py-3">
                لا يوجد مؤلفون مسجلون.
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
