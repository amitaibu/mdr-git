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

}