<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GroupMeetingAttendanceListRepository")
 */
class GroupMeetingAttendanceList
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\GroupMeeting", inversedBy="groupMeetingAttendanceList", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $groupMeeting;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Mother", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $mother;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGroupMeeting(): ?GroupMeeting
    {
        return $this->groupMeeting;
    }

    public function setGroupMeeting(GroupMeeting $groupMeeting): self
    {
        $this->groupMeeting = $groupMeeting;

        return $this;
    }

    public function getMother(): ?Mother
    {
        return $this->mother;
    }

    public function setMother(Mother $mother): self
    {
        $this->mother = $mother;

        return $this;
    }

}
