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
class Mother
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $birthdayEstimated;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Child", mappedBy="mother", orphanRemoval=true)
     */
    private $children;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastName;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\GroupMeetingAttendanceList", mappedBy="mother")
     */
    private $groupMeetingAttendanceLists;

    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->groupMeetingAttendanceLists = new ArrayCollection();
    }


    public function getId(): ?string
    {
        return $this->id;
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

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

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
            $groupMeetingAttendanceList->setMother($this);
        }

        return $this;
    }

    public function removeGroupMeetingAttendanceList(GroupMeetingAttendanceList $groupMeetingAttendanceList): self
    {
        if ($this->groupMeetingAttendanceLists->contains($groupMeetingAttendanceList)) {
            $this->groupMeetingAttendanceLists->removeElement($groupMeetingAttendanceList);
            // set the owning side to null (unless already changed)
            if ($groupMeetingAttendanceList->getMother() === $this) {
                $groupMeetingAttendanceList->setMother(null);
            }
        }

        return $this;
    }
}
