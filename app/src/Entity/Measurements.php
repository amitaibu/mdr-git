<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MeasurementsRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"child" = "ChildMeasurements"})
 */
abstract class Measurements
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\GroupMeetingAttendance", inversedBy="measurements", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $groupMeetingAttendance;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGroupMeetingAttendance(): ?GroupMeetingAttendance
    {
        return $this->groupMeetingAttendance;
    }

    public function setGroupMeetingAttendance(GroupMeetingAttendance $groupMeetingAttendance): self
    {
        $this->groupMeetingAttendance = $groupMeetingAttendance;

        return $this;
    }
}
