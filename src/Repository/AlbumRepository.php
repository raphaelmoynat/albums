<?php

namespace App\Repository;



use App\Entity\Album;
use Core\Attributes\TargetEntity;
use Core\Repository\Repository;


#[TargetEntity(name: Album::class)]
class AlbumRepository extends Repository
{

    public function save(Album $album)
    {
        $query = $this->pdo->prepare("INSERT INTO $this->tableName SET name = :name, artist = :artist, year= :year, user_id=:user_id");
        $query->execute([
            "name"=>$album->getName(),
            "artist"=>$album->getArtist(),
            "year"=>$album->getYear(),
            "user_id"=>$album->getUserId()
        ]);
    }

    public function edit(Album $album)
    {

        $query = $this->pdo->prepare("UPDATE $this->tableName SET name = :name, artist = :artist, year= :year WHERE id = :id");
        $query->execute([
            "id"=>$album->getId(),
            "name"=>$album->getName(),
            "artist"=>$album->getArtist(),
            "year"=>$album->getYear()
        ]);

        return $this->find($album->getId());

    }
}