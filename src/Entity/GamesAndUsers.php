<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GamesAndUsersRepository")
 */
class GamesAndUsers
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $GameId;

    /**
     * @ORM\Column(type="integer")
     */
    private $UserId;

    public function getId()
    {
        return $this->id;
    }

    public function getGameId(): ?int
    {
        return $this->GameId;
    }

    public function setGameId(int $GameId): self
    {
        $this->GameId = $GameId;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->UserId;
    }

    public function setUserId(int $UserId): self
    {
        $this->UserId = $UserId;

        return $this;
    }
}
