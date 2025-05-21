<?php
require_once __DIR__ . '/../models/commints.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $news_id = intval($_POST['news_id'] ?? 0);
    $username = trim($_POST['user_name'] ?? '');
    $comment = trim($_POST['comment'] ?? '');

    if ($news_id > 0 && $username !== '' && $comment !== '') {
        $commentModel = new Comment();
        $success = $commentModel->create($news_id, $username, $comment);

        echo json_encode([
            'success' => $success,
            'message' => $success ? 'تم إرسال التعليق بنجاح.' : 'حدث خطأ أثناء إرسال التعليق.'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'يرجى ملء جميع الحقول.'
        ]);
    }
    exit;
}

echo json_encode([
    'success' => false,
    'message' => 'طريقة الطلب غير صحيحة.'
]);
exit;
?>
