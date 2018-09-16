<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PredictionsRepository")
 */
class Predictions
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
    private $RoindId;

    /**
     * @ORM\Column(type="integer")
     */
    private $UserId;

    /**
     * @ORM\Column(type="smallint")
     */
    private $Host;

    /**
     * @ORM\Column(type="smallint")
     */
    private $Guest;

    /**
     * @ORM\Column(type="integer")
     */
    private $RoundTeamsId;

    public function getId()
    {
        return $this->id;
    }

    public function getRoindId(): ?int
    {
        return $this->RoindId;
    }

    public function setRoindId(int $RoindId): self
    {
        $this->RoindId = $RoindId;

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

    public function getHost(): ?int
    {
        return $this->Host;
    }

    public function setHost(int $Host): self
    {
        $this->Host = $Host;

        return $this;
    }

    public function getGuest(): ?int
    {
        return $this->Guest;
    }

    public function setGuest(int $Guest): self
    {
        $this->Guest = $Guest;

        return $this;
    }

    public function getRoundTeamsId(): ?int
    {
        return $this->RoundTeamsId;
    }

    public function setRoundTeamsId(int $RoundTeamsId): self
    {
        $this->RoundTeamsId = $RoundTeamsId;

        return $this;
    }
}
