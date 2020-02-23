<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChildMeasurementsRepository")
 */
class ChildMeasurements extends Measurements
{

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Child", inversedBy="childMeasurements", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $child;

    /**
     * @ORM\Column(type="float")
     */
    private $weight;

    /**
     * @ORM\Column(type="float")
     */
    private $height;

    public function getChild(): ?Child
    {
        return $this->child;
    }

    public function setChild(Child $child): self
    {
        $this->child = $child;

        return $this;
    }

    public function getWeight(): ?string
    {
        return $this->weight;
    }

    public function setWeight(string $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(float $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getGroupMeetingAttendance(): ?GroupMeetingAttendance
    {
        return $this->groupMeetingAttendance;
    }

    public function setGroupMeetingAttendance(?GroupMeetingAttendance $groupMeetingAttendance): self
    {
        $this->groupMeetingAttendance = $groupMeetingAttendance;

        return $this;
    }
}
