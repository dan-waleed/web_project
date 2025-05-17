<?php
session_start();
session_destroy();

setcookie("name", $user['name'], time() - 3600);
setcookie("email", $user['email'], time() - 3600);
setcookie("role", $user['role'], time() - 3600);

header("location: login_form.php");
exit();


?>