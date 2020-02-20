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
     * @ORM\ManyToOne(targetEntity="App\Entity\Mother", inversedBy="groupMeetingAttendanceLists")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mother;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\GroupMeeting", inversedBy="groupMeetingAttendanceLists")
     * @ORM\JoinColumn(nullable=false)
     */
    private $groupMeeting;

    public function getId(): ?int
    {
        return $this->id;
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
