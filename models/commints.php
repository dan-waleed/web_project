<?php
require_once __DIR__ . '/../controller/auth.php';
require_once __DIR__ . '/../config/config.php';

class Comment
{
    public function create($news_id, $username, $comment_text)
    {
        $conn = DBConnection::connect();

        // تأمين البيانات باستخدام prepared statements
        $stmt = $conn->prepare("INSERT INTO comments (news_id, username, comment_text) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $news_id, $username, $comment_text);

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
            return $result->fetch_all(MYSQLI_ASSOC); // fetch_all instead of fetch_assoc for multiple rows
        }

        return [];
    }

    
}
?>
