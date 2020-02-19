<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MotherRepository")
 *
 * Hold the full Mother data.
 */
class Mother
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $birthdayEstimated;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getBirthdayEstimated(): ?bool
    {
        return $this->birthdayEstimated;
    }

    public function setBirthdayEstimated(bool $birthdayEstimated): self
    {
        $this->birthdayEstimated = $birthdayEstimated;

        return $this;
    }
}
