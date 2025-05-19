<?php
require_once '/../config/config.php';

$title = $_POST['titel'];
$body_text = $_POST['body_text'];
$img_url = $_POST['img_url'];
$category_id = $_POST['category_id'];
$author_id = $_POST['author_id'];
$sql = "INSERT INTO `news` (`title`, `body`, `image`, `dateposted`, `category_id`, `author_id`) VALUES ('$title', '$body_text', '$img_url', current_timestamp(), '$category_id', '$author_id');";

if ($conn->query($sql) === TRUE) {
    echo "The news has been added.";
} else {
    echo "Something went wrong: " . $conn->error;
}
?>
