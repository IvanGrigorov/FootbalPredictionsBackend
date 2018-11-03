<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoundGenerationStatusRepository")
 */
class RoundGenerationStatus
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
    private $Status;

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

    public function getStatus(): ?string
    {
        return $this->Status;
    }

    public function setStatus(string $Status): self
    {
        $this->Status = $Status;

        return $this;
    }
}
