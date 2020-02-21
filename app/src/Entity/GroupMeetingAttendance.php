<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * A single attendance of a Person in a group meeting.
 *
 * @ORM\Entity(repositoryClass="App\Repository\GroupMeetingAttendanceListRepository")
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
     * @ORM\ManyToOne(targetEntity="App\Entity\GroupMeeting", inversedBy="groupMeetingAttendancesZ")
     * @ORM\JoinColumn(nullable=false)
     */
    private $groupMeeting;

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

}
