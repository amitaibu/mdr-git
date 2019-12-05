<?php


namespace App\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * Class Child
 *
 * Hold the full Child data.
 *
 * @package App\Model
 */
class Child
{

    private $fileId;

    /**
     * @var \App\Model\ChildIdentifier
     */
    private $identifier;

    /**
     * @var \App\Model\ChildMeasurements[] | ArrayCollection
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
     * @return \App\Model\ChildIdentifier
     */
    public function getIdentifier(): \App\Model\ChildIdentifier
    {
        return $this->identifier;
    }

    /**
     * @param \App\Model\ChildIdentifier $identifier
     */
    public function setIdentifier(\App\Model\ChildIdentifier $identifier): void
    {
        $this->identifier = $identifier;
    }

    /**
     * @return \App\Model\ChildMeasurements[]|\Doctrine\Common\Collections\ArrayCollection
     */
    public function getMeasurements()
    {
        return $this->measurements;
    }

    /**
     * @param \App\Model\ChildMeasurements[]|\Doctrine\Common\Collections\ArrayCollection $measurements
     */
    public function setMeasurements($measurements): void
    {
        $this->measurements = $measurements;
    }

}