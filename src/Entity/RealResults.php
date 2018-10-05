<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RealResultsRepository")
 */
class RealResults
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
    private $RoundTeamsId;

    /**
     * @ORM\Column(type="integer")
     */
    private $Host;

    /**
     * @ORM\Column(type="integer")
     */
    private $Guest;

    public function getId()
    {
        return $this->id;
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
}
