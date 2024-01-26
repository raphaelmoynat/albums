<?php

namespace App\Controller;

use App\Repository\AlbumRepository;
use App\Entity\Album;
use Core\Controller\Controller;
use Core\Http\Response;

class AlbumController extends Controller
{
    public function index():Response
    {
        $albumRepository = new AlbumRepository();
        $albums = $albumRepository->findAll();

        return $this->render("album/index", [
            "pageTitle"=> "All albums",
            "albums"=>$albums
        ]);
    }

    public function show():Response
    {
        $id = null;

        if(!empty($_GET['id']) && ctype_digit($_GET['id'])){
            $id = $_GET['id'];
        }

        if(!$id){
            return  $this->redirect();
        }

        $albumRepository = new AlbumRepository();
        $album = $albumRepository->find($id);

        if(!$album){
            return  $this->redirect();
        }

        return $this->render("album/show",[
            "pageTitle"=>$album->getName(),
            "album"=> $album
        ]);

    }

    public function delete():Response
    {
        $id = null;

        if(!empty($_GET['id']) && ctype_digit($_GET['id'])){
            $id = $_GET['id'];
        }

        if(!$id){
            return  $this->redirect();
        }

        $albumRepository = new AlbumRepository();
        $album = $albumRepository->find($id);

        if (!$album){
            return $this->redirect();
        }


        if($album->getAuthor() != $this->getUser())
        {
            $this->addFlash("Ce n'est pas ton album, tu ne peux pas le supprimer");

            return  $this->redirect("?type=album&action=index");

        }


        $this->addFlash("album bien supprimé");
        $albumRepository->delete($album);

        return $this->redirect("?type=album&action=index");

    }


    public function create():Response
    {

        if(!$this->getUser()){

            $this->addFlash("connecte toi d'abord coco", "warning");
            return  $this->redirect("?type=article&action=index");
        }

        $name = null;
        $artist = null;
        $year = null;

        if (!empty($_POST['name'])) {
            $name = $_POST['name'];
        }

        if (!empty($_POST['artist'])) {
            $artist = $_POST['artist'];
        }
        if (!empty($_POST['year'])) {
            $year = $_POST['year'];
        }

        if ($name && $artist && $year) {

            $album = new Album();

            $album->setName($name);
            $album->setArtist($artist);
            $album->setYear($year);
            $album->setAuthor($this->getUser());

            $albumRepository = new AlbumRepository();

            $albumRepository->save($album);

            return $this->redirect("?type=album&action=index");


        }

        return $this->render("album/create", [
            "pageTitle" => "Nouvel ALbum"
        ]);

    }


        public
        function edit(): Response
        {
            $idAlbum = null;
            $name = null;
            $artist = null;
            $year = null;

            if (!empty($_POST['idAlbum']) && ctype_digit($_POST['idAlbum'])) {
                $idAlbum = $_POST['idAlbum'];
            }

            if (!empty($_POST['name'])) {
                $name = $_POST['name'];
            }

            if (!empty($_POST['artist'])) {
                $artist = $_POST['artist'];
            }
            if (!empty($_POST['year'])) {
                if(!ctype_digit($_POST['year'])){
                    $this->addFlash("Entrez une année valide.");
                    return  $this->redirect("?type=album&action=edit&id=$idAlbum");

                }
                $year = $_POST['year'];
            }


            if ($name && $artist && $year) {
                $albumRepository = new AlbumRepository();
                $album = $albumRepository->find($idAlbum);

                if (!$album) {
                    return $this->redirect();
                }

                $album->setName($name);
                $album->setArtist($artist);
                $album->setYear($year);

                $albumRepository->edit($album);

                return $this->redirect("?type=album&action=index");

            }

            $id = null;

            if (!empty($_GET['id']) && ctype_digit($_GET['id'])) {
                $id = $_GET['id'];
            }

            if (!$id) {
                return $this->redirect();
            }

            $albumRepository= new AlbumRepository();
            $album = $albumRepository->find($id);

            if (!$album) {
                return $this->redirect();
            }

            if($album->getAuthor() != $this->getUser())
            {
                $this->addFlash("Ce n'est pas ton album, tu ne peux pas le modifier");

                return  $this->redirect("?type=album&action=index");

            }

            return $this->render("album/edit", [
                "pageTitle" => $album->getName(),
                "album" => $album
            ]);


        }
}