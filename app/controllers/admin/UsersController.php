<?php

namespace App\controllers\admin;

use App\Services\ImageManager;
use App\Services\Roles;
use Delight\Auth\Auth;
use Delight\Auth\Status;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Validator as v;

class UsersController extends Controller
{
    private $imageManager;

    public function __construct(ImageManager $imageManager)
    {
        parent::__construct();
        $this->imageManager = $imageManager;
    }

    public function index(){
        $users = $this->database->selectAll('users');
        echo $this->view->render('/admin/users/index', ['users' => $users]);
    }

    public function create(){
        $roles = Roles::getRoles();
        echo $this->view->render('admin/users/create', ['roles' => $roles]);
    }

    public function store(){
//        dd($_POST);
        $validator = v::key('username', v::stringType()->notEmpty())
            ->key('email', v::email())
            ->key('password', v::stringType()->notEmpty())
            ->keyValue('password_confirmation', 'equals', 'password')
            ->key('roles_mask', v::stringType()->notEmpty());
//            ->keyNested('image.tmp_name', v::image());

        $this->validation($validator);

        try {
            $userId = $this->auth->admin()->createUser($_POST['email'], $_POST['password'], $_POST['username']);

            $data = [
                'status' => isset($_POST['status']) ?  Status::BANNED : Status::NORMAL,
                'roles_mask' => $_POST['roles_mask']
            ];


            $this->database->update('users', $userId, $data);

            flash()->success('Вы добавили пользователя ' . $_POST['username']);
            back();
        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            die('Invalid email address');
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            die('Invalid password');
        }
        catch (\Delight\Auth\UserAlreadyExistsException $e) {
            die('User already exists');
        }
    }

    public function edit($id){
        $user = $this->database->selectOne('users', 'id', $id);
        $roles = Roles::getRoles();

        echo $this->view->render('/admin/users/edit', [
                                                        'user' => $user,
                                                        'roles' => $roles
                                                      ]);
    }

    public function update($id){

        $validator = v::key('username', v::stringType()->notEmpty())
            ->key('email', v::email())
            ->key('roles_mask', v::stringType()->notEmpty());

        $this->validation($validator);

        $user = $this->database->selectOne('users', 'id', $id);
        $filename = $this->imageManager->uploadImage($_FILES['image'], $user['image']);

        $data = [
                    'username' => $_POST['username'],
                    'email' => $_POST['email'],
                    'roles_mask' => $_POST['roles_mask'],
                    'status' => isset($_POST['status']) ? Status::BANNED : Status::NORMAL,
                    'image' => $filename
                ];

        $this->database->update('users', $id, $data);

        if(!empty($_POST['newPassword']))
        {
            try {
                $this->auth->admin()->changePasswordForUserById($id, $_POST['newPassword']);
            }
            catch (\Delight\Auth\UnknownIdException $e) {
                die('Unknown ID');
            }
            catch (\Delight\Auth\InvalidPasswordException $e) {
                die('Invalid password');
            }
        }

        flash()->success('Данные пользователя обновлены!');
        redirect('/admin/users');
    }

    public function delete($id){
        try {
            $this->auth->admin()->deleteUserById($id);
            flash()->success('Пользователь удален!');
            redirect('/admin/users');
        }
        catch (\Delight\Auth\UnknownIdException $e) {
            die('Unknown ID');
        }
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
        return [
                'username' => 'Введите имя',
                'email' => 'Введите email',
                'password' => 'Введите пароль',
                'password_confirmation' => 'Пароли не совпадают',
                'roles_mask' => 'Установите роль',
                'image' => 'Неверный формат картинки'
                ];
    }

}