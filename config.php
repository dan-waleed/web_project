<?php
$host="localhost";
$user="root";
$pass="";
$dbName="news_database";

$conn= new mysqli($host, $user, $pass, $dbName);
if ($conn->connect_error ) {
    die("connection faild".$conn->connect_error);
}

