<?php
session_start();
require_once __DIR__ . '/auth.php';

$auth = new Auth();

if ($auth->isLoggedIn()) {
    header('Location: ../view/index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // missing credentials?
    if ($email === '' || $password === '') {
        $_SESSION['login_error'] = 'يرجى إدخال البريد الإلكتروني وكلمة المرور';
        header('Location: ../view/login_form.php');
        exit;
    }

    if ($auth->login($email, $password)) {
        // logged in—send to index (or split by role if you like)
        header('Location: ../view/index.php');
        exit;
    } else {
        // bad credentials
        $_SESSION['login_error'] = 'البريد الإلكتروني أو كلمة المرور غير صحيحة';
        header('Location: ../view/login_form.php');
        exit;
    }
}

// If someone visits this file directly, drop them back to the form
header('Location: ../view/login_form.php');
exit;
