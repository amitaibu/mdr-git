<?php


namespace App\Model;

/**
 * Class ChildIdentifier
 *
 * Hold only the basic info of a child, without loading entire data.
 *
 * @package App\Model
 */
class ChildIdentifier
{

    /**
     * @var string
     */
    private $identifier;

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
     */
    private $motherIdentifier;

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
     * @return string
     */
    public function getMotherIdentifier(): string
    {
        return $this->motherIdentifier;
    }

    /**
     * @param string $motherIdentifier
     */
    public function setMotherIdentifier(string $motherIdentifier): void
    {
        $this->motherIdentifier = $motherIdentifier;
    }


}