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
		$photos = $this->database->selectAll('photos', 8);
        echo $this->view->render('home', ['photos'   =>  $photos]);
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
}