<?php
// الاتصال بقاعدة البيانات
require_once 'config.php';
require_once 'auth.php';

// التحقق من أن الطلب جاء عبر POST
class Comment
{
    public function create($news_id, $user_name, $comment)
    {
        $conn = DBConnection::connect();

        // تأمين البيانات باستخدام prepared statements
        $stmt = $conn->prepare("INSERT INTO comments (news_id, user_name, comment) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $news_id, $user_name, $comment);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function getAllComments()
    {
        $sql = "SELECT * FROM comments";
        $conn = DBConnection::connect();
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return null;
    }

}
?>
