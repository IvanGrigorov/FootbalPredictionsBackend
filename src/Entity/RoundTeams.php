<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoundTeamsRepository")
 */
class RoundTeams
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Host;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Guest;

    /**
     * @ORM\Column(type="integer")
     */
    private $RoundId;

    public function getId()
    {
        return $this->id;
    }

    public function getHost(): ?string
    {
        return $this->Host;
    }

    public function setHost(string $Host): self
    {
        $this->Host = $Host;

        return $this;
    }

    public function getGuest(): ?string
    {
        return $this->Guest;
    }

    public function setGuest(string $Guest): self
    {
        $this->Guest = $Guest;

        return $this;
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

    public function formatTeam(): array {
        return array(
            'host' => $this->getHost(),
            'guest' => $this->getGuest(),
            'roundId' => $this->getRoundId()
        );
    }
}
