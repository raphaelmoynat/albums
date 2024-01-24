<?php



namespace App\Entity;


use App\Repository\CommentRepository;
use App\Repository\UserRepository;
use Core\Attributes\Table;
use Core\Attributes\TargetEntity;
use Core\Attributes\TargetRepository;

#[TargetRepository(name: CommentRepository::class)]
#[Table(name: "comments")]
class Comment
{
    private int $id;
    private string $content;
    private int $album_id;

    private int $user_id;


    public function getId(): int
    {
        return $this->id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getAlbumId(): int
    {
        return $this->album_id;
    }

    public function setAlbumId(int $album_id): void
    {
        $this->album_id = $album_id;
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