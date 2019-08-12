<?php

namespace App\controllers;

use App\Services\QueryBilder;
use League\Plates\Engine;
use JasonGrimes\Paginator;

class HomeController
{
    private $queryBilder;
    private $views;
    private $imageController;

    public function __construct(QueryBilder $queryBilder, Engine $views, ImageController $imageController)
	{
        $this->queryBilder = $queryBilder;
        $this->views = $views;
        $this->imageController = $imageController;
    }

	public function index()
	{
		$photos = $this->queryBilder->selectAll('photos', 8);
//		var_dump($photos); exit();
        echo $this->views->render('index', ['photos' =>	$photos]);
	}

	public function upload(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->imageController->uploadImage();
            Header('Location: /upload');
        }else {
            echo $this->views->render('upload');
        }
    }

	public function show($id)
	{
		$this->database->find($id);
	}
}