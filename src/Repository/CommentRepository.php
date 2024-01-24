<?php

namespace App\Repository;

use App\Entity\Album;
use App\Entity\Comment;
use Core\Attributes\TargetEntity;

#[TargetEntity(name: Comment::class)]
class CommentRepository extends \Core\Repository\Repository
{
    public function findAllByAlbum(Album $album)
    {
        $query = $this->pdo->prepare("SELECT * FROM $this->tableName WHERE album_id = :album_id");
        $query->execute([
            "album_id"=>$album->getId()
        ]);
        $comments = $query->fetchAll(\PDO::FETCH_CLASS,get_class(new $this->targetEntity()));

        return $comments;

    }


    public function save(Comment $comment):object
    {
        $query = $this->pdo->prepare("INSERT INTO $this->tableName SET content = :content, album_id = :album_id, user_id= :user_id");
        $query->execute([
            "content"=>$comment->getContent(),
            "album_id"=>$comment->getAlbumId(),
            "user_id"=>$comment->getUserId()
        ]);

        return $this->find($this->pdo->lastInsertId());
    }

    public function edit(object $comment):object
    {
        $query = $this->pdo->prepare("UPDATE $this->tableName SET content = :content WHERE id = :id");
        $query->execute([
            "content"=>$comment->getContent(),
            "id"=>$comment->getId(),

        ]);

        return $this->find($comment->getId());
    }


}