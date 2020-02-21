<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MotherRepository")
 *
 * Hold the full Mother data.
 */
class Mother extends Person
{

    /**
     * @ORM\Column(type="boolean")
     */
    private $birthdayEstimated;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Child", mappedBy="mother", orphanRemoval=true)
     */
    private $children;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\GroupMeetingAttendance", mappedBy="mother")
     */
    private $groupMeetingAttendances;

    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->groupMeetingAttendances = new ArrayCollection();
    }

    public function getBirthdayEstimated(): ?bool
    {
        return $this->birthdayEstimated;
    }

    public function setBirthdayEstimated(bool $birthdayEstimated): self
    {
        $this->birthdayEstimated = $birthdayEstimated;

        return $this;
    }

    /**
     * @return Collection|Child[]
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function addChild(Child $child): self
    {
        if (!$this->children->contains($child)) {
            $this->children[] = $child;
            $child->setMother($this);
        }

        return $this;
    }

    public function removeChild(Child $child): self
    {
        if ($this->children->contains($child)) {
            $this->children->removeElement($child);
            // set the owning side to null (unless already changed)
            if ($child->getMother() === $this) {
                $child->setMother(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|GroupMeetingAttendance[]
     */
    public function getGroupMeetingAttendances(): Collection
    {
        return $this->groupMeetingAttendances;
    }

    public function addGroupMeetingAttendanceList(GroupMeetingAttendance $groupMeetingAttendanceList): self
    {
        if (!$this->groupMeetingAttendances->contains($groupMeetingAttendanceList)) {
            $this->groupMeetingAttendances[] = $groupMeetingAttendanceList;
            $groupMeetingAttendanceList->setPerson($this);
        }

        return $this;
    }

    public function removeGroupMeetingAttendanceList(GroupMeetingAttendance $groupMeetingAttendanceList): self
    {
        if ($this->groupMeetingAttendances->contains($groupMeetingAttendanceList)) {
            $this->groupMeetingAttendances->removeElement($groupMeetingAttendanceList);
            // set the owning side to null (unless already changed)
            if ($groupMeetingAttendanceList->getPerson() === $this) {
                $groupMeetingAttendanceList->setPerson(null);
            }
        }

        return $this;
    }
}
