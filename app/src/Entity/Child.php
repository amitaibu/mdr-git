<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChildRepository")
 */
class Child extends Person
{

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Mother", inversedBy="children")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mother;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\ChildMeasurements", mappedBy="child", cascade={"persist", "remove"})
     */
    private $childMeasurements;


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
