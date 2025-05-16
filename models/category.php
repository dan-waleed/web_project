<?php
class Category
{
    public function create($name, $description)
    {
        $sql = "INSERT INTO users (name, description) 
                VALUES ('$name', '$description')";

        $conn = DBConnection::connect();
        $result = $conn->query($sql);
        if ($result) {
            return true;
        }

        return false;
    }

    public function getAllCategories()
    {
        $sql = "SELECT * FROM categories";
        $conn = DBConnection::connect();
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return null;
    }
}
