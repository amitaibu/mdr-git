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

    /**
     * @var string
     */
    private $identifier;

    /**
     * @var string
     *
     * @SerializedName("first_name")
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var \App\Model\ChildIdentifier[] | ArrayCollection
     */
    private $children;

    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * @param string $identifier
     */
    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
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
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param \App\Model\ChildIdentifier[]|\Doctrine\Common\Collections\ArrayCollection $children
     */
    public function setChildren($children): void
    {
        $this->children = $children;
    }





}