<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * A single attendance of a Person in a group meeting.
 *
 * @ORM\Entity(repositoryClass="App\Repository\GroupMeetingAttendanceRepository")
 */
class GroupMeetingAttendance
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Person", inversedBy="groupMeetingAttendances")
     * @ORM\JoinColumn(nullable=false)
     */
    private $person;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\GroupMeeting", inversedBy="groupMeetingAttendances")
     * @ORM\JoinColumn(nullable=false)
     */
    private $groupMeeting;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Measurements", mappedBy="groupMeetingAttendance", cascade={"persist", "remove"})
     */
    private $measurements;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPerson(): ?Person
    {
        return $this->person;
    }

    public function setPerson(?Person $person): self
    {
        $this->person = $person;

        return $this;
    }

    public function getGroupMeeting(): ?GroupMeeting
    {
        return $this->groupMeeting;
    }

    public function setGroupMeeting(?GroupMeeting $groupMeeting): self
    {
        $this->groupMeeting = $groupMeeting;

        return $this;
    }

    public function getMeasurements(): ?Measurements
    {
        return $this->measurements;
    }

    public function setMeasurements(Measurements $measurements): self
    {
        $this->measurements = $measurements;

        // set the owning side of the relation if necessary
        if ($measurements->getGroupMeetingAttendance() !== $this) {
            $measurements->setGroupMeetingAttendance($this);
        }

        return $this;
    }



}
