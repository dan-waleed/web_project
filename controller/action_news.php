<?php
require_once 'config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $action = $_POST['action'];

    if ($action == 'draft') {
       news::update($id, 'draft');
    } elseif ($action == 'published') {
        news::update($id, 'published');
    } elseif ($action == 'archived') {
         news::update($id, 'archived');
    } elseif ($action == 'delete') {
        news::deleteNews($id);
    } else {
        echo "Action not recognized.";
        exit;   
    }
    // Redirect to the news page after the action
    header("Location: auther.php");
    exit;
} else {
    // If the request method is not POST, redirect to the news page
    header("Location: auther.php");
    exit;
    // echo "Invalid request method.";
    // exit;
    

}
?>
