<?php


namespace App\controllers\admin;

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

class CategoriesController extends Controller
{
    public function index(){
        $categories = $this->database->SelectAll('categories');

        echo $this->view->render('admin/categories/index', ['categories' => $categories]);
    }

    public function create(){
        echo $this->view->render('admin/categories/create');
    }

    public function store(){
        $validator = v::key('title', v::stringType()->notEmpty());
        $this->validate($validator, $_POST, ['title'   =>  'Заполните поле Название']);
        $this->database->insert('categories', ['title' => $_POST['title']]);
        flash()->success('Категоря успешно добавлена!');

        redirect('/admin/categories/create ');
    }

    public function edit($id){
        $category = $this->database->selectOne('categories', 'id', $id);
        echo $this->view->render('admin/categories/edit', ['category' => $category]);
    }

    public function update($id){

        $validator = v::key('title', v::stringType()->notEmpty());

        $this->validate($validator, $_POST, ['title'=>'Название не пожет быть пустым!']);

        $this->database->update('categories', $id, ['title' => $_POST['title']]);
        flash()->success('Категоря обловлена!');
        redirect('/admin/categories');
    }

    public function delete($id){
        $this->database->delete('categories', 'id', $id);
        back();
    }


    private function validate($validator, $data, $message)
    {
        try {
            $validator->assert($data);

        } catch (ValidationException $exception) {
            $exception->findMessages($message);
            flash()->error($exception->getMessages());

            return back();
        }
    }

}