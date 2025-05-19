<?php
<?php
require_once __DIR__ . '/../config/config.php';
require_once 'models/news.php'

$sql = "SELECT * FROM news";
$result = $conn->query($sql);

class newsController{
    private $model;

    public function __construct($db) {
        $this->model = new NewsModel($db);
    }

    public function displayNews() {
        $result = $this->model->getAllNews();
        include __DIR__ . '/../view/news_table.php';
    }

}

?>
