<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoundSettingsRepository")
 */
class RoundSettings
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
    private $until;

    /**
     * @ORM\Column(type="integer")
     */
    private $roundId;

    public function getId()
    {
        return $this->id;
    }

    public function getUntil(): ?string
    {
        return $this->until;
    }

    public function setUntil(string $until): self
    {
        $this->until = $until;

        return $this;
    }

    public function getRoundId()
    {
        return $this->roundId;
    }

    public function setRoundId(string $roundId): self
    {
        $this->roundId = $roundId;

        return $this;
    }
}
