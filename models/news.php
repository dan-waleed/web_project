<?php
class News
{
    public function create($title, $body, $image, $category_id, $author_id, $status = null, $datePosted = null)
        {
            if ($datePosted === null) {
                $datePosted = date('Y-m-d H:i:s'); // ← التاريخ الحالي
            }

            $sql = "INSERT INTO news (title, body, image, datePosted, category_id, author_id, status) 
                    VALUES ('$title', '$body', '$image', '$datePosted', '$category_id', '$author_id', '$status')";

            $conn = DBConnection::connect();
            $result = $conn->query($sql);
            return $result ? true : false;
        }

    public function update($id,$status)
    {
        $sql = "UPDATE news SET 'status'='$status' WHERE id=$id";

        $conn = DBConnection::connect();
        $result = $conn->query($sql);
        if ($result) {
            return true;
        }

        return false;
    }
    public function getAllNews()
    {
        $sql = "SELECT * FROM news";
        $conn = DBConnection::connect();
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
             return $result->fetch_all(MYSQLI_ASSOC);
        }

        return null;
    }
    public function getAllNewsDesc()    
    {
        $sql = "SELECT * FROM news ORDER BY datePosted DESC";
        $conn = DBConnection::connect();
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return null;
    } 
    public function getNewsById($id) {
        $conn = DBConnection::connect();
        $stmt = $conn->prepare("SELECT * FROM news WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getRelatedNews($category_id, $exclude_id) {
        $conn = DBConnection::connect();
        $stmt = $conn->prepare("SELECT id, title, image_url FROM news WHERE category_id = ? AND id != ? ORDER BY publish_date DESC LIMIT 4");
        $stmt->bind_param("ii", $category_id, $exclude_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function deleteNews($id)
    {
        $sql = "DELETE FROM news WHERE id = $id";
        $conn = DBConnection::connect();
        $result = $conn->query($sql);
        if ($result) {
            return true;
        }

        return false;
    }

    public function getNewsByCategory($category_id) 
    {
        $sql = "SELECT * FROM news WHERE category_id = $category_id";
        $conn = DBConnection::connect();
        $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC); // ✅ Return all news
    }

        return [];
    }

    public function getNewsByMostCommented()
    {
        $sql = "SELECT news.*, COUNT(comments.id) as comment_count 
                FROM news 
                LEFT JOIN comments ON news.id = comments.news_id 
                GROUP BY news.id 
                ORDER BY comment_count DESC";
        $conn = DBConnection::connect();
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return null;
    }

    public function getNewsByMostViewed()
    {
        $sql = "SELECT news.*, COUNT(views.id) as view_count 
                FROM news 
                LEFT JOIN views ON news.id = views.news_id 
                GROUP BY news.id 
                ORDER BY view_count DESC";
        $conn = DBConnection::connect();
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return null;
    }
    public function updateNews($id, $title, $body, $category_id, $status)
    {
    $conn = DBConnection::connect();
    
    // استخدام prepared statement أكثر أمانًا
    $stmt = $conn->prepare("UPDATE news SET title = ?, body = ?, category_id = ?, status = ? WHERE id = ?");
    $stmt->bind_param("ssisi", $title, $body, $category_id, $status, $id);
    
    return $stmt->execute();
    }




    
}

