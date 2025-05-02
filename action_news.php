<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $action = $_POST['action'];

    if ($action == 'draft') {
        $sql = "UPDATE `news` SET `status` = 'draft' WHERE `news`.`id` = $id;";
    } elseif ($action == 'published') {
        $sql = "UPDATE `news` SET `status` = 'published' WHERE `news`.`id` = $id;";
    } elseif ($action == 'archived') {
        $sql = "UPDATE `news` SET `status` = 'archived' WHERE `news`.`id` = $id;";
    } elseif ($action == 'delete') {
        $sql = "DELETE FROM news WHERE id = $id";
    }

    if ($conn->query($sql)) {
        header("Location: editor_dashboard.php");
        exit;
    } else {
        echo "حدث خطأ: " . $conn->error;
    }
}
?>
