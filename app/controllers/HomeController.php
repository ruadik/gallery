<?php

namespace App\controllers;

use App\Services\database;
use League\Plates\Engine;
use JasonGrimes\Paginator;
use Delight\Auth\Auth;

class HomeController extends Controller
{
	public function index()
	{

        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

        $itemsPerPage = 8;
		$photos = $this->database->getPaginatedFromAll('photos', $currentPage, $itemsPerPage);
        $totalItems = $this->database->countAll('photos');
        $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, '/?page=(:num)');
        echo $this->view->render('home', [
                                            'photos' => $photos,
                                            'paginator' => $paginator
                                         ]);
	}

	public function category($id){

	    $category = $this->database->selectOne('categories', 'id',  $id);

        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $itemsPerPage = 8;

        $photos = $this->database->getPaginatedFrom('photos', 'category_id', $id, $page, $itemsPerPage);
        $totalItems  = $this->database->count('photos', 'category_id', $id);

        $paginator = new Paginator($totalItems, $itemsPerPage, $page, "/category/$id?page=(:num)");
	    echo $this->view->render('category', [
	                                            'category' => $category,
                                                'photos' => $photos,
                                                'paginator' => $paginator
                                             ]);
    }

    public function user($id){

        if(isset($_GET['page'])){
            $currentPage = $_GET['page'];
        }else{
            $currentPage = 1;
        }

        $itemsPerPage = 8;
	    $photos = $this->database->getPaginatedFrom('photos', 'user_id', $id, $currentPage, $itemsPerPage);
        $totalItems = $this->database->count('photos','user_id', $id);
//        dd('/photos/'.$id.'/user?page=(:num)');
        $paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, '/photos/'.$id.'/user?page=(:num)');
	    echo $this->view->render('user', [
	                                        'photos' => $photos,
                                            'paginator' => $paginator
                                         ]);
    }
}