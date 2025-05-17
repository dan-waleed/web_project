<?php
session_start();
require_once 'models/user.php';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

$userModel = new User();

$user = $userModel->login($email, $password);


if($user){
    echo "Welcome " . $user['name'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['role'] = $user['role'];
    setcookie("name", $user['name'], time() + 3600);
    setcookie("email", $user['email'], time() + 3600);
    setcookie("role", $user['role'], time() + 3600);

    //header('location: index.php');
    exit();

}
else{
    echo "Invalid  username or password!";
}


?>