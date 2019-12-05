<?php


namespace App\Model;

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
     * @return \App\Model\MotherIdentifier
     */
    public function getIdentifier(): \App\Model\MotherIdentifier
    {
        return $this->identifier;
    }

    /**
     * @param \App\Model\MotherIdentifier $identifier
     */
    public function setIdentifier(\App\Model\MotherIdentifier $identifier): void
    {
        $this->identifier = $identifier;
    }

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

}