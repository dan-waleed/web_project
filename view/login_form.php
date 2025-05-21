<?php
session_start();
$error = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>تسجيل الدخول</title>
  <!-- Bootstrap CSS -->
  <link 
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
    rel="stylesheet"
  >
  <style>
    body {
      background-color: #f0f2f5;
      font-family: 'Segoe UI', Tahoma, sans-serif;
    }
    .login-container {
      max-width: 400px;
      margin: 80px auto;
    }
    .login-card {
      background: #ffffff;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      padding: 30px;
    }
    .login-card h2 {
      text-align: center;
      margin-bottom: 20px;
      font-size: 1.6rem;
      font-weight: 600;
    }
    .form-label {
      font-weight: 500;
    }
    .form-control {
      border-radius: 4px;
      padding: 10px;
    }
    .btn-primary {
      background-color: #007bff;
      border: none;
      border-radius: 4px;
      padding: 10px;
      font-size: 1rem;
    }
    .btn-primary:hover {
      background-color: #0069d9;
    }
    .alert {
      font-size: 0.95rem;
      padding: 10px;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="login-card">
      <h2>تسجيل الدخول</h2>
      <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
      <?php endif; ?>
      <form action="../controller/login.php" method="post">
        <div class="mb-3">
          <label class="form-label" for="email">البريد الإلكتروني</label>
          <input 
            type="email" 
            id="email" 
            name="email" 
            class="form-control" 
            placeholder="أدخل بريدك الإلكتروني" 
            required 
            autofocus
          >
        </div>
        <div class="mb-3">
          <label class="form-label" for="password">كلمة المرور</label>
          <input 
            type="password" 
            id="password" 
            name="password" 
            class="form-control" 
            placeholder="أدخل كلمة المرور" 
            required
          >
        </div>
        <button type="submit" class="btn btn-primary w-100">دخول</button>
      </form>
    </div>
  </div>
</body>
</html>
