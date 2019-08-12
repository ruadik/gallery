<?php
namespace App\controllers;

use App\Services\ImageManager;
use App\Services\QueryBilder;

class ImageController{

    private $imageManager;
    private $queryBilder;

    public function __construct(ImageManager $imageManager, QueryBilder $queryBilder)
    {
        $this->imageManager = $imageManager;
        $this->queryBilder = $queryBilder;
    }

    public function uploadImage(){
        $path = 'uploads/';
        $filename = strtolower(str_random(10)) . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $this->imageManager->upload($path, $filename);

        $categories = $this->queryBilder->selectOne('categories', 'title', $_POST['categories']);

        $dimensions = $this->imageManager->get_dimensions($path, $filename);

        if (file_exists($path.$filename)) {
            $cols_values = ['title' => $_POST['title'],
                'description' => $_POST['description'],
                'image' => $filename,
                'dimensions' => $dimensions,
//                'date' => '',
                'category_id' => $categories['id'],
                'user_id' => '1'];
            $this->queryBilder->insert('photos', $cols_values);
        }
    }
}
