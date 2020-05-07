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


    public function getMother(): ?Mother
    {
        return $this->mother;
    }

    public function setMother(?Mother $mother): self
    {
        $this->mother = $mother;

        return $this;
    }

}
