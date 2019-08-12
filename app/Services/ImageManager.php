<?php
namespace App\Services;

use Intervention\Image\ImageManager as image;

class ImageManager{

    private $imageManager;

    public function __construct(image $imageManager)
    {

        $this->imageManager = $imageManager;
    }


    public function upload($path, $filename){
        $this->imageManager->make($_FILES['image']['tmp_name'])->save($path . $filename);
    }

    public function get_dimensions($path, $filename){
        $width = $this->imageManager->make($path.$filename)->width();
        $height = $this->imageManager->make($path.$filename)->height();
        return $dimensions = $width." x ". $height;
    }
}
