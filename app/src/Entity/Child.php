<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChildRepository")
 */
class Child
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
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Mother", inversedBy="children")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mother;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ChildMeasurements", mappedBy="child", cascade={"persist", "remove"})
     */
    private $childMeasurements;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getMother(): ?Mother
    {
        return $this->mother;
    }

    public function setMother(?Mother $mother): self
    {
        $this->mother = $mother;

        return $this;
    }

    public function getChildMeasurements(): ?ChildMeasurements
    {
        return $this->childMeasurements;
    }

    public function setChildMeasurements(ChildMeasurements $childMeasurements): self
    {
        $this->childMeasurements = $childMeasurements;

        // set the owning side of the relation if necessary
        if ($childMeasurements->getChild() !== $this) {
            $childMeasurements->setChild($this);
        }

        return $this;
    }

}
