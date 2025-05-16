<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbName = "news_database";

class DBConnection
{
    public static function connect(): mysqli
    {
        $conn = new mysqli("localhost", "root", "", "News Portal", 3306);
        if ($conn->connect_error) {
            echo "Connection error: " . $conn->connect_error;
        }

        return $conn;
    }
}
