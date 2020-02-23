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
    private $measurements;

    public function __construct()
    {
        $this->measurements = new ArrayCollection();
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
    public function getMeasurements(): Collection
    {
        return $this->measurements;
    }

    public function addMeasurement(ChildMeasurements $measurement): self
    {
        if (!$this->measurements->contains($measurement)) {
            $this->measurements[] = $measurement;
            $measurement->setGroupMeetingAttendance($this);
        }

        return $this;
    }

    public function removeMeasurement(ChildMeasurements $measurements): self
    {
        if ($this->measurements->contains($measurements)) {
            $this->measurements->removeElement($measurements);
            // set the owning side to null (unless already changed)
            if ($measurements->getGroupMeetingAttendance() === $this) {
                $measurements->setGroupMeetingAttendance(null);
            }
        }

        return $this;
    }

}
