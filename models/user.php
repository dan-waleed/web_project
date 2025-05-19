<?php
require_once __DIR__ . '/../config/config.php';

class User
{
        // ✅ الدالة المطلوبة
    public function create($name, $email, $password, $role)
     {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO user (name, email, password, role) 
                VALUES ('$name', '$email', '$hashed_password', '$role')";

        $conn = DBConnection::connect();
        return $conn->query($sql);
     }
     
    public static function getAuthors()
    {
        $conn = DBConnection::connect();
        $sql = "SELECT * FROM user WHERE role = 'author'";
        $result = $conn->query($sql);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function login($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email='$email'";
        $conn = DBConnection::connect();
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }

        return false;
    }

    public function getAllUsers()
    {
        $sql = "SELECT * FROM users";
        $conn = DBConnection::connect();
        $result = $conn->query($sql);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function deleteUser($id)
    {
        $sql = "DELETE FROM users WHERE id = $id";
        $conn = DBConnection::connect();
        return $conn->query($sql);
    }



}
