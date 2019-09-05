<?php
namespace App\controllers;

use App\Services\ImageManager;
use JasonGrimes\Paginator;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;
use Tamtamchik\SimpleFlash\Flash;

class PhotosController extends Controller {

    private $imageManager;

    public function __construct(ImageManager $imageManager)
    {
        parent::__construct();
        $this->imageManager = $imageManager;
        if(!$this->auth->isLoggedIn()){redirect('/login');}
    }


    public function index(){

        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $totalItems = $this->database->count('photos', 'user_id', $this->auth->getUserId());
        $itemsPerPage = 8;

        $photos = $this->database->getPaginatedFrom('photos', 'user_id', $this->auth->getUserId(), $currentPage, $itemsPerPage);
//        var_dump($photos); exit();

        $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, "/photos?page=(:num)");

        echo $this->view->render('photos/index', [
                                                    'photos' => $photos,
                                                    'paginator' => $paginator
                                                   ]);
    }

    public function show($id){
        $photo = $this->database->selectOne('photos', 'id', $id);
        $user = $this->database->selectOne('users', 'id', $photo['user_id']);
//        dd($user);
        $userImages = $this->database->whereAll('photos', 'user_id', $photo['user_id'], 4);
        echo $this->view->render('photos/show', [
                                                    'photo' => $photo,
                                                    'user' => $user,
                                                    'userImages' => $userImages
                                                 ]);
    }

    public function download($id){
        $photo = $this->database->selectOne('photos', 'id', $id);
        echo $this->view->render('photos/download', ['photo' => $photo]);
    }

    public function create(){
        echo $this->view->render('photos/create');
    }

    public function store(){
        $validator = v::key('title', v::stringType()->notEmpty())
                      ->key('description', v::stringType()->notEmpty())
                      ->key('categories', v::numeric()->notEmpty())
                      ->keyNested('image.tmp_name', v::image());

        $this->validate($validator);

        $image = $this->imageManager->uploadImage($_FILES['image']);
        $dimensions = $this->imageManager->get_dimensions($image);

        $data = [
                    'title' => $_POST['title'],
                    'description' => $_POST['description'],
                    'image' => $image,
                    'dimensions' => $dimensions,
                    'category_id' => $_POST['categories'],
                    'user_id' => $this->auth->getUserId()
                ];
        $this->database->insert('photos', $data);

        flash()->success('  
                            <div class="notification is-success">
                                Спасибо! Картинка успешно загружена!
                            </div>
                         ');
        return back();
    }

    public function edit($id){
        $photo = $this->database->selectOne('photos', 'id', $id);
            if($photo['user_id'] != $this->auth->getUserId()){
                flash()->error(['Можно редактировать только свои фотографии!!!']);
                return die(header ('Location:/photos'));
            }

        $categories = $this->database->selectAll('categories');

        echo $this->view->render('photos/edit', [
                                                    'photo' => $photo,
                                                    'categories' => $categories
                                                ]);
    }

    public function update($id){

        $validator = v::key('title', v::stringType()->notEmpty())
            ->key('description', v::stringType()->notEmpty())
            ->key('categories', v::numeric()->notEmpty())
            ->keyNested('image.tmp_name', v::image());
        $this->validate($validator);

        $photo = $this->database->selectOne('photos', 'id', $id);
        $image = $this->imageManager->uploadImage($_FILES['image'], $photo['image']);
        $dimensions = $this->imageManager->get_dimensions($image);

        $data = [
                    "image" =>  $image,
                    "title" =>  $_POST['title'],
                    "description" =>  $_POST['description'],
                    "category_id" =>  $_POST['categories'],
                    "user_id"   =>  $this->auth->getUserId(),
                    "dimensions"    =>  $dimensions
                ];

        $this->database->update('photos', $id, $data);

        return header('Location: /photos');
    }

    public function delete($id){

        $photo = $this->database->selectOne('photos', 'id', $id);

        if($photo['user_id'] != $this->auth->getUserId()){
            flash()->error(['Вы можете удалять только свои фотографии!!']);
            return header('Location: /photos');
        }

        $this->imageManager->deleteImage($photo['image']);
        $this->database->delete('photos', 'id', $id);

        return back();
    }


    private function validate($validator)
    {
        try {
            $validator->assert(array_merge($_POST,$_FILES));
        } catch(ValidationException $exception) {
            $exception->findMessages($this->getMessages());
            flash()->error($exception->getMessages());
            return back();
        }
    }

    private function getMessages(){
        return ['title' => 'Введите название',
                'description' => 'Введите описание',
                'categories' => 'Введите категорию',
                'image' => 'Неверный формат картинки'
              ];
    }
}
