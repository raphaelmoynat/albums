<?php

namespace App\Controller;

use App\Entity\Album;
use Core\Controller\Controller;
use App\Entity\Comment;
use App\Repository\AlbumRepository;
use App\Repository\CommentRepository;
use Core\Http\Response;

class CommentController extends Controller
{
    public function create():Response
    {

        $albumId = null;
        $content = null;

        if(!empty($_POST['albumId']) && ctype_digit($_POST['albumId']))
        {
            $albumId = $_POST['albumId'];
        }
        if(!empty($_POST['content']))
        {
            $content = $_POST['content'];
        }

        if($albumId && $content){

            $albumRepo = new AlbumRepository();
            $album = $albumRepo->find($albumId);

            if(!$album){return $this->redirect();}
            $comment = new Comment();
            $comment->setContent($content);
            $comment->setAlbumId($albumId);
            $comment->setAuthor($this->getUser());

            $commentRepository = new CommentRepository();
            $commentRepository->save($comment);

            return $this->redirect("?type=album&action=show&id=".$album->getId());

        }

        return $this->redirect("?type=album&action=index");
    }

    public function delete()
    {
        $id = null;

        if(!empty($_GET['id']) && ctype_digit($_GET['id'])){
            $id = $_GET['id'];
        }

        if(!$id){ return  $this->redirect();}


        $commentRepository = new CommentRepository();
        $comment = $commentRepository->find($id);

        if($comment)
        {
            $idAlbum = $comment->getAlbumId();
            $commentRepository->delete($comment);


            return $this->redirect("?type=album&action=show&id=$idAlbum");
        }
        return $this->redirect();


    }

    public function update():Response
    {
        $commentId = null;
        $content = null;


        if(!empty($_POST['id']) && ctype_digit($_POST['id']))
        {
            $commentId = $_POST['id'];
        }
        if(!empty($_POST['content']))
        {
            $content = $_POST['content'];
        }

        if($commentId && $content) {

            $commentRepository = new CommentRepository();

            $comment = $commentRepository->find($commentId);

            if (!$comment) {
                return $this->redirect();
            }


            $comment->setContent($content);


            $commentRepository->edit($comment);

            return $this->redirect("?type=album&action=show&id=" . $comment->getAlbumId());

        }


        $id = null;

        if(!empty($_GET['id']) && ctype_digit($_GET['id'])){
            $id = $_GET['id'];
        }

        if(!$id){ return  $this->redirect();}

        $commentRepository = new CommentRepository();
        $comment = $commentRepository->find($id);

        if($comment)
        {

            return $this->render("comment/edit", [
                "pageTitle"=>"modifier",
                "comment"=>$comment
            ]);
        }
        return $this->redirect();
    }

}