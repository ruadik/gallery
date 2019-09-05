<?php
namespace App\Services;

use Intervention\Image\ImageManagerStatic as image;

class ImageManager{

    public $folder;

    public function __construct()
    {
        $this->folder = config('uploadsFolder');
    }

    public function uploadImage($image, $currentImage = null){

        if(!is_file($image['tmp_name']) && !is_uploaded_file($image['tmp_name'])) { return $currentImage; }

        $this->deleteImage($currentImage);

        $filename = strtolower(str_random(10).'.'.pathinfo($image['name'], PATHINFO_EXTENSION));
        $img = image::make($image['tmp_name']);
        $img->save($this->folder.$filename);
        return $filename;
    }

    public function checkImageExist($path){
        if($path != null && is_file($this->folder.$path) && file_exists($this->folder.$path)){
            return true;
            };
    }

    public function deleteImage($image){
        if($this->checkImageExist($image)) {
            unlink($this->folder.$image);
        }
    }

    public function get_dimensions($image){
        if($this->checkImageExist($image)) {
            $width = image::make($this->folder . $image)->width();
            $height = image::make($this->folder . $image)->height();
            return $dimensions = $width . " x " . $height;
        }
    }

    public function getImage($image){
        if($this->checkImageExist($image)) {
            return '/'. $this->folder . $image;
        }
        return '/img/no-user.png';
    }

}
