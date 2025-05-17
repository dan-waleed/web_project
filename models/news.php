<?php
class News
{
    public function create($title, $body, $image, $category_id, $author_id, $status = null, $datePosted = null)
    {
        $sql = "INSERT INTO news (title, body, image, datePosted, category_id, author_id, status) 
                VALUES ('$title', '$body', '$image', '$datePosted', '$category_id', '$author_id', '$status')";

        $conn = DBConnection::connect();
        $result = $conn->query($sql);
        if ($result) {
            return true;
        }

        return false;
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
            return $result->fetch_assoc();
        }

        return null;
    }
    public function getAllNewsDesc()
    {
        $sql = "SELECT * FROM news ORDER BY dateposted DESC";
        $conn = DBConnection::connect();
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return null;
    } 
    public function getNewsById($id)
    {
        $sql = "SELECT * FROM news WHERE id = $id";
        $conn = DBConnection::connect();
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return null;
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
    
}
