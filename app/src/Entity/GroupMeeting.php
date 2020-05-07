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
     * @ORM\OneToMany(targetEntity="App\Entity\GroupMeetingAttendance", mappedBy="groupMeeting")
     */
    private $groupMeetingAttendances;

    public function __construct()
    {
        $this->groupMeetingAttendances = new ArrayCollection();
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

    /**
     * @return Collection|GroupMeetingAttendance[]
     */
    public function getGroupMeetingAttendances(): Collection
    {
        return $this->groupMeetingAttendances;
    }

    public function addGroupMeetingAttendances(GroupMeetingAttendance $groupMeetingAttendances): self
    {
        if (!$this->groupMeetingAttendances->contains($groupMeetingAttendances)) {
            $this->groupMeetingAttendances[] = $groupMeetingAttendances;
            $groupMeetingAttendances->setGroupMeeting($this);
        }

        return $this;
    }

    public function removeGroupMeetingAttendances(GroupMeetingAttendance $groupMeetingAttendances): self
    {
        if ($this->groupMeetingAttendances->contains($groupMeetingAttendances)) {
            $this->groupMeetingAttendances->removeElement($groupMeetingAttendances);
            // set the owning side to null (unless already changed)
            if ($groupMeetingAttendances->getGroupMeeting() === $this) {
                $groupMeetingAttendances->setGroupMeeting(null);
            }
        }

        return $this;
    }

}
