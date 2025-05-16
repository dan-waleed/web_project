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
}
