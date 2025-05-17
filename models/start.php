<?php
session_start();

if (isset($_SESSION['username'])){
    $name = $_SESSION['username'];
    echo $name;
}
else{
    echo "not found!";
}


?>