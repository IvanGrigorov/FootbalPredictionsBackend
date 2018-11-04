<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PointSettingsRepository")
 */
class PointSettings
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $PointsCorrectResult;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $PointsCorrectFixture;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $PointsAmountOfGoals;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $GameId;

    public function getId()
    {
        return $this->id;
    }

    public function getPointsCorrectResult(): ?int
    {
        return $this->PointsCorrectResult;
    }

    public function setPointsCorrectResult(?int $PointsCorrectResult): self
    {
        $this->PointsCorrectResult = $PointsCorrectResult;

        return $this;
    }

    public function getPointsCorrectFixture(): ?int
    {
        return $this->PointsCorrectFixture;
    }

    public function setPointsCorrectFixture(?int $PointsCorrectFixture): self
    {
        $this->PointsCorrectFixture = $PointsCorrectFixture;

        return $this;
    }

    public function getPointsAmountOfGoals(): ?int
    {
        return $this->PointsAmountOfGoals;
    }

    public function setPointsAmountOfGoals(?int $PointsAmountOfGoals): self
    {
        $this->PointsAmountOfGoals = $PointsAmountOfGoals;

        return $this;
    }

    public function getGameId(): ?int
    {
        return $this->GameId;
    }

    public function setGameId(?int $gameId): self
    {
        $this->GameId = $gameId;

        return $this;
    }
}
