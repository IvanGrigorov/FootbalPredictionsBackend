<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoundsRepository")
 */
class Rounds
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
    private $RoundNumber;

    /**
     * @ORM\Column(type="integer")
     */
    private $GamesId;


    public function getId()
    {
        return $this->id;
    }

    public function getRoundNumber(): ?int
    {
        return $this->RoundNumber;
    }

    public function setRoundNumber(int $RoundNumber): self
    {
        $this->RoundNumber = $RoundNumber;

        return $this;
    }

    public function getGamesId(): ?int
    {
        return $this->GamesId;
    }

    public function setGamesId(int $GamesId): self
    {
        $this->GamesId = $GamesId;

        return $this;
    }

    public function formatRound(): array {
        return array(
            'roundNumber' => $this->getRoundNumber(),
            'gameId' => $this->getGamesId()
        );
    }
}
