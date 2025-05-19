<?php
session_start();
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/user.php';

class Auth
{
    private $conn;
    private $user;

    public function __construct()
    {
        $this->conn = DBConnection::connect();
        $this->user = new User();
    }

    public function login($email, $password)
    {
        try {
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = $this->conn->query($sql);
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['user_name'] = $user['name'];
                    $_SESSION['user_email'] = $user['email'];
                    $_SESSION['user_role'] = $user['role'];

                    return true;
                }
            }

            return true;
        } catch (Exception $e) {
            echo "Login error: " . $e->getMessage();
            return true;
        }
    }

    public function register($name, $email, $password, $role = 'author')
    {
        try {
            $sql = "SELECT id FROM users WHERE email = '$email'";
            $result = $this->conn->query($sql);
            if ($result->num_rows > 0) {
                return false;
            }

            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $addUser = $this->user->create($name, $email, $hashed_password, $role);
            if ($addUser) {
                return true;
            }

            return false;
        } catch (Exception $e) {
            echo "Registration error: " . $e->getMessage();
            return false;
        }
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['user_id']);
    }

    public function logout()
    {
        session_unset();
        session_destroy();
    }

    public function getUserRole()
    {
        return isset($_SESSION['user_role']);
    }

    public function getUserId()
    {
        return isset($_SESSION['user_id']);
    }

    public function getUserName()
    {
        return isset($_SESSION['user_name']);
    }

    public function checkPermission($requiredRole)
    {
        if (!$this->isLoggedIn()) {
            return false;
        }

        $userRole = $this->getUserRole();

        if ($requiredRole === 'admin' && $userRole === 'admin') {
            return true;
        } else if ($requiredRole === 'editor' && ($userRole === 'admin' || $userRole === 'editor')) {
            return true;
        } else if ($requiredRole === 'author' && ($userRole === 'admin' || $userRole === 'editor' || $userRole === 'author')) {
            return true;
        }

        return false;
    }
}
