<?php


namespace App\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * Class MotherIdentifier
 *
 * Hold only the basic info of a mother, without loading entire data.
 *
 * @package App\Model
 */
class MotherIdentifier
{

    private $fileId;

    private $id;

    private $firstName;

    private $lastName;

    /**
     * @var \App\Model\ChildIdentifier[] | \Doctrine\Common\Collections\ArrayCollection
     */
    private $childrenIdentifiers;


    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return \App\Model\ChildIdentifier[]|\Doctrine\Common\Collections\ArrayCollection
     */
    public function getChildrenIdentifiers()
    {
        return $this->childrenIdentifiers;
    }

    /**
     * @param \App\Model\ChildIdentifier[]|\Doctrine\Common\Collections\ArrayCollection $childrenIdentifiers
     */
    public function setChildrenIdentifiers($childrenIdentifiers): void
    {
        $this->childrenIdentifiers = $childrenIdentifiers;
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