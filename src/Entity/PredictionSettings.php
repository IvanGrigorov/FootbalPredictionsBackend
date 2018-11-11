<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PredictionSettingsRepository")
 */
class PredictionSettings
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
     * @ORM\Column(type="string", length=255)
     */
    private $Until;

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

    public function getUntil(): ?string
    {
        return $this->Until;
    }

    public function setUntil(string $Until): self
    {
        $this->Until = $Until;

        return $this;
    }
}
