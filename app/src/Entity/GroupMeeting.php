<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GroupMeetingRepository")
 */
class GroupMeeting
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\GroupMeetingAttendanceList", mappedBy="groupMeeting", cascade={"persist", "remove"})
     */
    private $groupMeetingAttendanceList;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\GroupMeetingAttendanceList", mappedBy="groupMeeting")
     */
    private $groupMeetingAttendanceLists;

    public function __construct()
    {
        $this->groupMeetingAttendanceLists = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getGroupMeetingAttendanceList(): ?GroupMeetingAttendanceList
    {
        return $this->groupMeetingAttendanceList;
    }

    public function setGroupMeetingAttendanceList(GroupMeetingAttendanceList $groupMeetingAttendanceList): self
    {
        $this->groupMeetingAttendanceList = $groupMeetingAttendanceList;

        // set the owning side of the relation if necessary
        if ($groupMeetingAttendanceList->getGroupMeeting() !== $this) {
            $groupMeetingAttendanceList->setGroupMeeting($this);
        }

        return $this;
    }

    /**
     * @return Collection|GroupMeetingAttendanceList[]
     */
    public function getGroupMeetingAttendanceLists(): Collection
    {
        return $this->groupMeetingAttendanceLists;
    }

    public function addGroupMeetingAttendanceList(GroupMeetingAttendanceList $groupMeetingAttendanceList): self
    {
        if (!$this->groupMeetingAttendanceLists->contains($groupMeetingAttendanceList)) {
            $this->groupMeetingAttendanceLists[] = $groupMeetingAttendanceList;
            $groupMeetingAttendanceList->setGroupMeeting($this);
        }

        return $this;
    }

    public function removeGroupMeetingAttendanceList(GroupMeetingAttendanceList $groupMeetingAttendanceList): self
    {
        if ($this->groupMeetingAttendanceLists->contains($groupMeetingAttendanceList)) {
            $this->groupMeetingAttendanceLists->removeElement($groupMeetingAttendanceList);
            // set the owning side to null (unless already changed)
            if ($groupMeetingAttendanceList->getGroupMeeting() === $this) {
                $groupMeetingAttendanceList->setGroupMeeting(null);
            }
        }

        return $this;
    }
}
