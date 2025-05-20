<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/news.php';

class newsController {
    private $model;

    public function __construct() {
        $this->model = new News();
    }

    public function displayNews() {
        $result = $this->model->getAllNews();
        include __DIR__ . '/../view/news_table.php';
    }

    public function displayNewsDesc() {
        $result = $this->model->getAllNewsDesc();
        include __DIR__ . '/../view/news_table.php';
    }

    public function showCategoryPage($category_id) {
    $result = $this->model->getNewsByCategory($category_id);
    include __DIR__ . '/../view/news_table.php';
    }


    public function displayMostCommented() {
        $result = $this->model->getNewsByMostCommented();
        include __DIR__ . '/../view/news_table.php';
    }

    public function displayMostViewed() {
        $result = $this->model->getNewsByMostViewed();
        include __DIR__ . '/../view/news_table.php';
    }
    
}
