<?php
namespace App\controllers;

use App\Services\ImageManager;
use JasonGrimes\Paginator;

class PhotosController extends Controller {

    private $imageManager;

    public function __construct(ImageManager $imageManager)
    {
        parent::__construct();
        $this->imageManager = $imageManager;
    }


    public function index(){
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $totalItems = $this->database->count('photos', 'user_id', $this->auth->getUserId());
        $itemsPerPage = 8;

        $photos = $this->database->getPaginatedFrom('photos', 'user_id', $this->auth->getUserId(), $currentPage, $itemsPerPage);
//        var_dump($totalItems); exit();

        $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, "/photos?page=(:num)");

        echo $this->view->render('photos/photos', [
                                                    'photos' => $photos,
                                                    'paginator' => $paginator
                                                   ]);
    }

    public function show($id){
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $totalItems = $this->database->count('photos', 'user_id', $this->auth->getUserId());
        $itemsPerPage = 8;

        $photos = $this->database->getPaginatedFrom('photos', 'user_id', $this->auth->getUserId(), $currentPage, $itemsPerPage);
//        var_dump($totalItems); exit();

        $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, "/photos/$id?page=(:num)");

        echo $this->view->render('photos/photos', [
            'photos' => $photos,
            'paginator' => $paginator
        ]);
    }

    public function uploadImage(){
        $path = 'uploads/';
        $filename = strtolower(str_random(10)) . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $this->imageManager->upload($path, $filename);

        $categories = $this->database->selectOne('categories', 'title', $_POST['categories']);

        $dimensions = $this->imageManager->get_dimensions($path, $filename);

        if (file_exists($path.$filename)) {
            $cols_values = ['title' => $_POST['title'],
                'description' => $_POST['description'],
                'image' => $filename,
                'dimensions' => $dimensions,
//                'date' => '',
                'category_id' => $categories['id'],
                'user_id' => '1'];
            $this->database->insert('photos', $cols_values);
        }
    }
}
