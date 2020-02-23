<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChildMeasurementsRepository")
 */
class ChildMeasurements
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

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

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\GroupMeetingAttendance", inversedBy="childMeasurements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $groupMeetingAttendance;

    public function getId(): ?int
    {
        return $this->id;
    }

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
