<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoundStandingsRepository")
 */
class RoundStandings
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
    private $RoundId;

    /**
     * @ORM\Column(type="integer")
     */
    private $UserId;

    /**
     * @ORM\Column(type="smallint")
     */
    private $Points;

    public function getId()
    {
        return $this->id;
    }

    public function getRoundId(): ?int
    {
        return $this->RoundId;
    }

    public function setRoundId(int $RoundId): self
    {
        $this->RoundId = $RoundId;

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

    public function getPoints(): ?int
    {
        return $this->Points;
    }

    public function setPoints(int $points): self
    {
        $this->Points = $points;

        return $this;
    }

    public function formatRoundStandings() {
        return array(
            'roundId' => $this->getRoundId(),
            'points' => $this->getPoints()
        );
    }
}
