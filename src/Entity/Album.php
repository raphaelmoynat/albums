<?php

namespace App\Entity;

use App\Repository\AlbumRepository;
use App\Repository\CommentRepository;
use App\Repository\UserRepository;
use Core\Attributes\Table;
use Core\Attributes\TargetRepository;

#[TargetRepository(name: AlbumRepository::class)]
#[Table(name: "albums")]
class Album
{
    private int $id;
    private string $name;
    private string $artist;
    private int $year;
    private int $user_id;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getArtist(): string
    {
        return $this->artist;
    }

    public function setArtist(string $artist): void
    {
        $this->artist = $artist;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function setYear(int $year): void
    {
        $this->year = $year;
    }

    public function getComments(): array
    {
        $commentRepository = new CommentRepository();
        $comments = $commentRepository->findAllByAlbum($this);
        return $comments;
    }

    public function getAuthor(): User
    {
        $userRepository = new UserRepository();
        return $userRepository->find($this->user_id);
    }


    public function setAuthor(User $user)
    {
        $this->user_id = $user->getId();
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }


    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }
}