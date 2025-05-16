<?php
class User
{
    public function create($name, $email, $password, $role)
    {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (name, email, password, role) 
                VALUES ('$name', '$email', '$hashed_password', '$role')";

        $conn = DBConnection::connect();
        $result = $conn->query($sql);
        if ($result) {
            return true;
        }

        return false;
    }

    public function getAllUsers()
    {
        $sql = "SELECT * FROM users";
        $conn = DBConnection::connect();
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return null;
    }

    function deleteUser($id)
    {
        $sql = "DELETE FROM users WHERE id = $id";
        $conn = DBConnection::connect();
        $result = $conn->query($sql);
        if ($result) {
            return true;
        }

        return false;
    }
}
