<?php

namespace App\Controller;

use App\Repository\TrucRepository;
use Core\Http\Response;

class HomeController extends \Core\Controller\Controller
{

    public function index():Response
    {

        //echo $variable;
//
//        try{
//    $trucRepo = new TrucRepository();
//      $trucs = $trucRepo->findAll();
//    }catch(\Exception $e)
//        {
//           throw new \Exception("un message d'erreur perso");
//        }


        return $this->render("home/index", [
            "pageTitle"=> "Welcome to the framework"
        ]);
    }

public function show():Response
{
    return $this->render("home/show", [
        "pageTitle"=> "Welcome to the framework"
    ]);
}


}