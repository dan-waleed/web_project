<?php
require_once __DIR__ . '/../config/config.php';

class Auth
{
    private $conn;

    public function __construct()
    {
        $this->conn = DBConnection::connect();
    }

   public function login($email, $password)
    {
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
            $stored = $user['password'];

          
            if ( $password === $stored ) {
                $_SESSION['user_id']    = $user['id'];
                $_SESSION['user_name']  = $user['name'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['user_role']  = $user['role'];
                return true;
            }
        }
        return false;
    }


    public function getUserRole()
    {
        return $_SESSION['user_role'] ?? null;
    }

    public function getUserId()
    {
        return $_SESSION['user_id'] ?? null;
    }

    public function getUserName()
    {
        return $_SESSION['user_name'] ?? 'Guest';
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
}
?>