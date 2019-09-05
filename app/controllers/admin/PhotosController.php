<?php

namespace App\controllers\admin;

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;
use App\Services\ImageManager;


class PhotosController extends Controller{


    private $imageManager;

    public function __construct(ImageManager $imageManager)
    {
        parent::__construct();
        $this->imageManager = $imageManager;
    }

    public function index(){
        $photos = $this->database->selectAll('photos');

        echo $this->view->render('admin/photos/index', ['photos' => $photos]);
    }

    public function create(){
        echo $this->view->render('admin/photos/create');
    }

    public function store(){
        $validator = v::key('title', v::stringType()->notEmpty())
                      ->key('description', v::stringType()->notEmpty())
                      ->key('category', v::numeric()->notEmpty())
                      ->keyNested('image.tmp_name', v::image());


        $this->validation($validator);

        $fileName = $this->imageManager->uploadImage($_FILES['image']);
        $dimensions = $this->imageManager->get_dimensions($fileName);

        $data = [
                    'title' => $_POST['title'],
                    'description' => $_POST['title'],
                    'image' => $fileName,
                    'dimensions' => $dimensions,
                    'category_id' => $_POST['category'],
                    'user_id' => $this->auth->getUserId()
                ];

        $this->database->insert('photos', $data);

        flash()->success('Картинка добавлена в галерею');
        back();
    }

    public function edit($id){

        $photo = $this->database->selectOne('photos', 'id', $id);
        $categories = $this->database->selectAll('categories');

        echo $this->view->render('admin/photos/edit', ['photo' => $photo,
                                                       'categories' => $categories
                                                      ]);
    }

    public function update($id){

        $validator = v::key('title', v::stringType()->notEmpty())
            ->key('description', v::stringType()->notEmpty())
            ->key('category', v::numeric()->notEmpty())
            ->keyNested('image.tmp_name', v::image());

        $this->validation($validator);

        $fileName = $this->imageManager->uploadImage($_FILES['image'], $_POST['image']);
        $dimensions = $this->imageManager->get_dimensions($fileName);

//        dd($_POST);

        $data = [
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'image' => $fileName,
            'dimensions' => $dimensions,
            'category_id' => $_POST['category'],
            'user_id' => $this->auth->getUserId()
        ];

        $this->database->update('photos', $id, $data);
        flash()->success('Картинка отредактирована!');
        back();
    }

    public function delete($id){
        $this->database->delete('photos', 'id', $id);
        flash()->success('Фотография удалена');
        back();
    }


    public function validation($validator){
        try {
            $validator->assert(array_merge($_POST, $_FILES));
        } catch(ValidationException $exception) {
            $exception->findMessages($this->getMessages());
            flash()->error($exception->getMessages());
            return back();
        }
    }

    public function getMessages(){
        return ['title' => 'Введите название',
            'description' => 'Введите описание',
            'category' => 'Введите категорию',
            'image' => 'Неверный формат картинки'
        ];
    }

}



