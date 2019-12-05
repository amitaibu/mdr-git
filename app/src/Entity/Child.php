<?php


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * Class Child
 *
 * Hold the full Child data.
 *
 * @package App\Entity
 */
class Child
{

    private $fileId;

    /**
     * @var \App\Entity\ChildIdentifier
     */
    private $identifier;

    /**
     * @var \App\Entity\ChildMeasurements[] | ArrayCollection
     */
    private $measurements;

    /**
     * @return mixed
     */
    public function getFileId()
    {
        return $this->fileId;
    }

    /**
     * @param mixed $fileId
     */
    public function setFileId($fileId): void
    {
        $this->fileId = $fileId;
    }

    /**
     * @return \App\Entity\ChildIdentifier
     */
    public function getIdentifier(): \App\Entity\ChildIdentifier
    {
        return $this->identifier;
    }

    /**
     * @param \App\Entity\ChildIdentifier $identifier
     */
    public function setIdentifier(\App\Entity\ChildIdentifier $identifier): void
    {
        $this->identifier = $identifier;
    }

    /**
     * @return \App\Entity\ChildMeasurements[]|\Doctrine\Common\Collections\ArrayCollection
     */
    public function getMeasurements()
    {
        return $this->measurements;
    }

    /**
     * @param \App\Entity\ChildMeasurements[]|\Doctrine\Common\Collections\ArrayCollection $measurements
     */
    public function setMeasurements($measurements): void
    {
        $this->measurements = $measurements;
    }

}