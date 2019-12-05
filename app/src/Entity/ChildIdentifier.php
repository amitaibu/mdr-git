<?php


namespace App\Entity;

/**
 * Class ChildIdentifier
 *
 * Hold only the basic info of a child, without loading entire data.
 *
 * @package App\Entity
 */
class ChildIdentifier
{

    private $fileId;

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     *
     * Prevent circular dependency, so we just capture the file ID of the
     * mother.
     *
     * @todo: When trying to "@SerializedName("mother")" and have the name be
     * `$motherFileId` it didn't map.
     */
    private $mother;

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
     * @return \App\Entity\MotherIdentifier[]|\Doctrine\Common\Collections\ArrayCollection
     */
    public function getMother()
    {
        return $this->mother;
    }

    /**
     * @param \App\Entity\MotherIdentifier[]|\Doctrine\Common\Collections\ArrayCollection $mother
     */
    public function setMother($mother): void
    {
        $this->mother = $mother;
    }


}