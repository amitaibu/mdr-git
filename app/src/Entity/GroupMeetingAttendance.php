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
     * @ORM\OneToMany(targetEntity="App\Entity\ChildMeasurements", mappedBy="groupMeetingAttendance")
     */
    private $childMeasurements;

    public function __construct()
    {
        $this->childMeasurements = new ArrayCollection();
    }

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

    /**
     * @return Collection|ChildMeasurements[]
     */
    public function getChildMeasurements(): Collection
    {
        return $this->childMeasurements;
    }

    public function addChildMeasurement(ChildMeasurements $childMeasurement): self
    {
        if (!$this->childMeasurements->contains($childMeasurement)) {
            $this->childMeasurements[] = $childMeasurement;
            $childMeasurement->setGroupMeetingAttendance($this);
        }

        return $this;
    }

    public function removeChildMeasurement(ChildMeasurements $childMeasurement): self
    {
        if ($this->childMeasurements->contains($childMeasurement)) {
            $this->childMeasurements->removeElement($childMeasurement);
            // set the owning side to null (unless already changed)
            if ($childMeasurement->getGroupMeetingAttendance() === $this) {
                $childMeasurement->setGroupMeetingAttendance(null);
            }
        }

        return $this;
    }

}
