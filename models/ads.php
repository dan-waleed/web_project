<?php
require_once __DIR__ . '/../config/config.php';

class Ads
{
    public function getAllAds()
    {
        $conn = DBConnection::connect();
        $sql = "SELECT * FROM ads";
        $result = $conn->query($sql);
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function toggleAdStatus($id)
    {
        $conn = DBConnection::connect();
        $sql = "UPDATE ads SET is_active = NOT is_active WHERE id = $id";
        return $conn->query($sql);
    }

    public function deleteAd($id)
    {
        $conn = DBConnection::connect();
        $sql = "DELETE FROM ads WHERE id = $id";
        return $conn->query($sql);
    }
}
